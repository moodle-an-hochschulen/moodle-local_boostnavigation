<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Local plugin "Boost navigation fumbling" - Library
 *
 * @package    local_boostnavigation
 * @copyright  2017 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Fumble with Moodle's global navigation by leveraging Moodle's *_extend_navigation() hook.
 *
 * @param global_navigation $navigation
 */
function local_boostnavigation_extend_navigation(global_navigation $navigation) {
    global $CFG, $PAGE, $COURSE;

    // Fetch config.
    $config = get_config('local_boostnavigation');

    // Include local library.
    require_once(__DIR__ . '/locallib.php');

    // Check if admin wanted us to remove the myhome node from Boost's nav drawer.
    // We have to check explicitely if the configurations are set because this function will already be
    // called at installation time and would then throw PHP notices otherwise.
    if (isset($config->removemyhomenode) && $config->removemyhomenode == true) {
        // If yes, do it.
        // Hide myhome node (which is basically the $navigation global_navigation node).
        $navigation->showinflatnavigation = false;
    }

    // Check if admin wanted us to remove the home node from Boost's nav drawer.
    if (isset($config->removehomenode) && $config->removehomenode == true) {
        // If yes, do it.
        if ($homenode = $navigation->find('home', global_navigation::TYPE_ROOTNODE)) {
            // Hide home node.
            $homenode->showinflatnavigation = false;
        }
    }

    // Check if admin wanted us to remove the calendar node from Boost's nav drawer.
    if (isset($config->removecalendarnode) && $config->removecalendarnode == true) {
        // If yes, do it.
        if ($calendarnode = $navigation->find('calendar', global_navigation::TYPE_CUSTOM)) {
            // Hide calendar node.
            $calendarnode->showinflatnavigation = false;
        }
    }

    // Check if admin wanted us to remove the privatefiles node from Boost's nav drawer.
    if (isset($config->removeprivatefilesnode) && $config->removeprivatefilesnode == true) {
        // If yes, do it.
        // We have to support Moodle core 3.2 and 3.3 versions with MDL-58165 not yet integrated.
        if (moodle_major_version() == '3.2' && $CFG->version < 2016120503.05 ||
                moodle_major_version() == '3.3' && $CFG->version < 2017051500.02) {
            if ($privatefilesnode = local_boostnavigation_find_privatefiles_node($navigation)) {
                // Hide privatefiles node.
                $privatefilesnode->showinflatnavigation = false;
            }
        } else {
            if ($privatefilesnode = $navigation->find('privatefiles', global_navigation::TYPE_SETTING)) {
                // Hide privatefiles node.
                $privatefilesnode->showinflatnavigation = false;
            }
        }
    }

    // Next, we will need the mycourses node in any case and don't want to fetch it more than once.
    $mycoursesnode = $navigation->find('mycourses', global_navigation::TYPE_ROOTNODE);

    // Check if admin wanted us to remove the mycourses node from Boost's nav drawer.
    // Or if admin wanted us to collapse the mycourses node.
    // If one of these two settings is activated, we will need the mycourses node's children and don't want to fetch them more
    // than once.
    if (isset($config->removemycoursesnode) && $config->removemycoursesnode == true ||
        isset($config->collapsemycoursesnode) && $config->collapsemycoursesnode == true) {
        // Get the mycourses node children.
        $mycourseschildrennodeskeys = $mycoursesnode->get_children_key_list();
    }

    // Check if admin wanted us to remove the mycourses node from Boost's nav drawer.
    if (isset($config->removemycoursesnode) && $config->removemycoursesnode == true) {
        // If yes, do it.
        if ($mycoursesnode) {
            // Hide mycourses node.
            $mycoursesnode->showinflatnavigation = false;

            // Hide all courses below the mycourses node.
            foreach ($mycourseschildrennodeskeys as $k) {
                // If the admin decided to display categories, things get slightly complicated.
                if ($CFG->navshowmycoursecategories) {
                    // We need to find all children nodes first.
                    $allchildrennodes = local_boostnavigation_get_all_childrenkeys($mycoursesnode->get($k));
                    // Then we can hide each children node.
                    // Unfortunately, the children nodes have navigation_node type TYPE_MY_CATEGORY or navigation_node type
                    // TYPE_COURSE, thus we need to search without a specific navigation_node type.
                    foreach ($allchildrennodes as $cn) {
                        $mycoursesnode->find($cn, null)->showinflatnavigation = false;
                    }
                    // Otherwise we have a flat navigation tree and hiding the courses is easy.
                } else {
                    $mycoursesnode->get($k)->showinflatnavigation = false;
                }
            }
        }
    }

    // Check if admin wanted us to collapse the mycourses node.
    // We won't support the setting navshowmycoursecategories in this feature as this would have complicated the feature's
    // JavaScript code quite heavily.
    if (isset($config->collapsemycoursesnode) && $config->collapsemycoursesnode == true
            && $CFG->navshowmycoursecategories == false) {
        // If yes, do it.
        if ($mycoursesnode) {
            // Remember the collapsible node for JavaScript.
            $collapsenodesforjs[] = 'mycourses';
            // Change the isexpandable attribute for the mycourses node to true (it's the default in Moodle core, just to be safe).
            $mycoursesnode->isexpandable = true;
            // Get the user preference for the collapse state of the mycourses node and set the collapse and hidden
            // node of the course nodes attributes accordingly.
            // Note: We are somehow abusing the hidden node attribute here for our own purposes. In Boost core, it is
            // set to true for invisible courses, but these are currently displayed just as visible courses in the
            // nav drawer, so we accept this abuse.
            $userprefmycoursesnode = get_user_preferences('local_boostnavigation-collapse_mycoursesnode',
                    $config->collapsemycoursesnodedefault);
            if ($userprefmycoursesnode == 1) {
                $mycoursesnode->collapse = true;
                foreach ($mycourseschildrennodeskeys as $k) {
                    $mycoursesnode->get($k)->hidden = true;
                }
            } else {
                $mycoursesnode->collapse = false;
                foreach ($mycourseschildrennodeskeys as $k) {
                    $mycoursesnode->get($k)->hidden = false;
                }
            }
        }
        // If the node shouldn't be collapsed, set some node attributes to avoid side effects with the CSS styles
        // which ship with this plugin.
    } else {
        if ($mycoursesnode) {
            // Change the isexpandable attribute for the mycourses node to false.
            $mycoursesnode->isexpandable = false;
        }
    }

    // Check if admin wants us to insert the coursesections node in Boost's nav drawer.
    // Or if admin wants us to insert the activities and / or resources node in Boost's nav drawer.
    // If one of these three settings is activated, we will need the modinfo and the coursehome node and don't want
    // to fetch these more than once.
    if (isset($config->insertcoursesectionscoursenode) && $config->insertcoursesectionscoursenode == true ||
            isset($config->insertactivitiescoursenode) && $config->insertactivitiescoursenode == true ||
            isset($config->insertresourcescoursenode) && $config->insertresourcescoursenode == true) {
        // Fetch modinfo.
        $modinfo = get_fast_modinfo($COURSE->id);
        // Fetch course home node.
        $coursehomenode = $PAGE->navigation->find($COURSE->id, navigation_node::TYPE_COURSE);
    }

    // Check if admin wants us to insert the coursesections node in Boost's nav drawer.
    // We won't support adding the coursesections node if $CFG->linkcoursesections is not enabled as we couldn't fully rely
    // on the section nodes being present in Boost's nav drawer.
    if (isset($config->insertcoursesectionscoursenode) && $config->insertcoursesectionscoursenode == true &&
           $CFG->linkcoursesections == true) {
        // Only proceed if we are inside a course.
        if ($COURSE->id > 1) {
            // Fetch first section id from course modinfo.
            $firstsection = $modinfo->get_section_info(0)->id;

            // Only proceed if the course has a first section id.
            if ($firstsection) {
                // Create coursesections course node.
                $coursesectionsnode = navigation_node::create(get_string('sections', 'moodle'),
                        new moodle_url('/course/view.php', array('id' => $COURSE->id)), // We have to add a URL to the course node,
                                                                                        // otherwise the node wouldn't be added to
                                                                                        // the flat navigation by Boost.
                                                                                        // There is no better choice than the course
                                                                                        // home page.
                        global_navigation::TYPE_CUSTOM,
                        null,
                        'localboostnavigationcoursesections',
                        null);
                // Prevent that the coursesections course node is marked as active and added to the breadcrumb when showing the
                // course home page.
                $coursesectionsnode->make_inactive();
                 // Add the coursesection node before the first section.
                $coursehomenode->add_node($coursesectionsnode, $firstsection);

                // Check if admin wanted us to also collapse the coursesections node.
                if ($config->collapsecoursesectionscoursenode == true) {
                    // If yes, do it.
                    if ($coursesectionsnode) {
                        // Remember the collapsible node for JavaScript.
                        $collapsenodesforjs[] = 'localboostnavigationcoursesections';
                        // Get the children nodes for the coursehome node.
                        $coursehomenodechildrennodeskeys = $coursehomenode->get_children_key_list();
                        // Change the isexpandable attribute for the coursesections node to true.
                        $coursesectionsnode->isexpandable = true;
                        // Get the user preference for the collapse state of the coursesections node and set the collapse and hidden
                        // node attributes of the existing section nodes accordingly. At the same time, reallocate the parent of the
                        // existing section nodes.
                        // Note: We are somehow abusing the hidden node attribute here for our own purposes. In Boost core, it is
                        // set to true for invisible sections, but these are currently displayed just as visible sections in the
                        // nav drawer, so we accept this abuse.
                        $userprefcoursesectionsnode = get_user_preferences('local_boostnavigation-collapse_'.
                                'localboostnavigationcoursesectionsnode', $config->collapsecoursesectionscoursenodedefault);
                        if ($userprefcoursesectionsnode == 1) {
                            $coursesectionsnode->collapse = true;
                            foreach ($coursehomenodechildrennodeskeys as $k) {
                                // As $coursehomenodechildrennodeskeys also contains some other nodes, we have to check the node's
                                // action URL to see of we have a section node.
                                $node = $coursehomenode->get($k);
                                $url = $node->action->out_as_local_url();
                                $urlpath = parse_url($url, PHP_URL_PATH);
                                if ($urlpath == '/course/view.php' && $node->key != 'localboostnavigationcoursesections') {
                                    $node->set_parent($coursesectionsnode);
                                    $node->hidden = true;
                                }
                            }
                        } else {
                            $coursesectionsnode->collapse = false;
                            foreach ($coursehomenodechildrennodeskeys as $k) {
                                // As $coursehomenodechildrennodeskeys also contains some other nodes, we have to check the node's
                                // action URL to see of we have a section node.
                                $node = $coursehomenode->get($k);
                                $url = $node->action->out_as_local_url();
                                $urlpath = parse_url($url, PHP_URL_PATH);
                                if ($urlpath == '/course/view.php' && $node->key != 'localboostnavigationcoursesections') {
                                    $node->set_parent($coursesectionsnode);
                                    $node->hidden = false;
                                }
                            }
                        }
                    }
                    // If the node shouldn't be collapsed, set some node attributes to avoid side effects with the CSS styles
                    // which ship with this plugin.
                } else {
                    if ($coursesectionsnode) {
                        // Change the isexpandable attribute for the coursesections node to false
                        // (it's the default in Moodle core, just to be safe).
                        $coursesectionsnode->isexpandable = false;
                    }
                }
            }
        }
    }

    // Check if admin wants us to insert the activities and / or resources node in Boost's nav drawer.
    // If one of these two settings is activated, we will need the modfullnames from modinfo and don't want
    // to fetch these more than once.
    if (isset($config->insertactivitiescoursenode) && $config->insertactivitiescoursenode == true ||
            isset($config->insertresourcescoursenode) && $config->insertresourcescoursenode == true) {
        // Only proceed if we are inside a course.
        if ($COURSE->id > 1) {
            // Fetch list of activities (gracefully copied from /blocks/activity_modules/block_activity_modules.php).
            $modfullnames = array();
            $archetypes = array();
            foreach ($modinfo->cms as $cm) {
                // Exclude activities which are not visible or have no link (=label).
                if (!$cm->uservisible or !$cm->has_view()) {
                    continue;
                }
                if (array_key_exists($cm->modname, $modfullnames)) {
                    continue;
                }
                if (!array_key_exists($cm->modname, $archetypes)) {
                    $archetypes[$cm->modname] = plugin_supports('mod', $cm->modname, FEATURE_MOD_ARCHETYPE, MOD_ARCHETYPE_OTHER);
                }
                if ($archetypes[$cm->modname] == MOD_ARCHETYPE_RESOURCE) {
                    if (!array_key_exists('resources', $modfullnames)) {
                        $modfullnames['resources'] = get_string('resources');
                    }
                } else {
                    $modfullnames[$cm->modname] = $cm->modplural;
                }
            }
            core_collator::asort($modfullnames);
        }
    }

    // Check if admin wants us to insert the resources node in Boost's nav drawer.
    if (isset($config->insertresourcescoursenode) && $config->insertresourcescoursenode == true) {
        // Only proceed if we are inside a course.
        if ($COURSE->id > 1) {
            // Only proceed if the course has at least one resource activity.
            if (array_key_exists('resources', $modfullnames)) {
                // Create resources course node.
                $resourcesnode = navigation_node::create(get_string('resources'),
                        new moodle_url('/course/resources.php', array('id' => $COURSE->id)),
                        global_navigation::TYPE_ACTIVITY,
                        null,
                        'localboostnavigationresources',
                        new pix_icon('icon', '', 'mod_page')); // Boost ignores a navigation node's icon currently,
                                                               // but we set it for future-proofness.
                // Add the activities node to the end of the course navigation.
                $coursehomenode->add_node($resourcesnode);

                // Remove the resources element from the modfullnames array to avoid that courses which only have resources get
                // an empty activities node.
                unset ($modfullnames['resources']);
            }
        }
    }

    // Check if admin wants us to insert the activities node in Boost's nav drawer.
    if (isset($config->insertactivitiescoursenode) && $config->insertactivitiescoursenode == true) {
        // Only proceed if we are inside a course.
        if ($COURSE->id > 1) {
            // Only proceed if the course has at least one activity.
            if (!empty($modfullnames)) {
                // Create activities course node.
                $activitiesnode = navigation_node::create(get_string('activities', 'moodle'),
                        new moodle_url('/course/view.php', array('id' => $COURSE->id)), // We have to add a URL to the course node,
                                                                                        // otherwise the node wouldn't be added to
                                                                                        // the flat navigation by Boost.
                                                                                        // There is no better choice than the course
                                                                                        // home page.
                        global_navigation::TYPE_CUSTOM,
                        null,
                        'localboostnavigationactivities',
                        null);
                // Prevent that the activities course node is marked as active and added to the breadcrumb when showing the
                // course home page.
                $activitiesnode->make_inactive();
                 // Add the activities node to the end of the course navigation.
                $coursehomenode->add_node($activitiesnode);

                // Create an activity course node for each activity type.
                foreach ($modfullnames as $modname => $modfullname) {
                    // Process "Resources" activity type.
                    if ($modname === 'resources') {
                        // Do only if the admin does not want a dedicated resources node.
                        if ($config->insertresourcescoursenode == false) {
                            $activitynode = navigation_node::create($modfullname,
                                    new moodle_url('/course/resources.php', array('id' => $COURSE->id)),
                                    global_navigation::TYPE_ACTIVITY,
                                    null,
                                    'localboostnavigationactivity'.$modname,
                                    new pix_icon('icon', '', 'mod_page')); // Boost ignores a navigation node's icon currently,
                                                                           // but we set it for future-proofness.
                            // Add the activity course node to the coursehome node.
                            $coursehomenode->add_node($activitynode);
                            // Remember the activity course node's key for collapsing it later.
                            $activitiesnodechildrennodeskeys[] = $activitynode->key;
                        }

                        // Process all other activity types.
                    } else {
                        $activitynode = navigation_node::create($modfullname,
                                new moodle_url('/mod/'.$modname.'/index.php', array('id' => $COURSE->id)),
                                global_navigation::TYPE_ACTIVITY,
                                null,
                                'localboostnavigationactivity'.$modname,
                                new pix_icon('icon', '', $modname)); // Boost ignores a navigation node's icon currently,
                                                                     // but we set it for future-proofness.
                        // Add the activity course node to the coursehome node.
                        $coursehomenode->add_node($activitynode);
                        // Remember the activity course node's key for collapsing it later.
                        $activitiesnodechildrennodeskeys[] = $activitynode->key;
                    }
                }

                // Check if admin wanted us to also collapse the activities node.
                if ($config->collapseactivitiescoursenode == true) {
                    // If yes, do it.
                    if ($activitiesnode) {
                        // Remember the collapsible node for JavaScript.
                        $collapsenodesforjs[] = 'localboostnavigationactivities';
                        // Change the isexpandable attribute for the activities node to true.
                        $activitiesnode->isexpandable = true;
                        // Get the user preference for the collapse state of the activities node and set the collapse and hidden
                        // node attributes of the activity nodes accordingly. At the same time, reallocate the parent of the
                        // existing section nodes.
                        $userprefactivitiesnode = get_user_preferences('local_boostnavigation-collapse_'.
                                'localboostnavigationactivitiesnode', $config->collapseactivitiescoursenodedefault);
                        if ($userprefactivitiesnode == 1) {
                            $activitiesnode->collapse = true;
                            foreach ($activitiesnodechildrennodeskeys as $k) {
                                $node = $coursehomenode->get($k);
                                $node->set_parent($activitiesnode);
                                $node->hidden = true;
                            }
                        } else {
                            $activitiesnode->collapse = false;
                            foreach ($activitiesnodechildrennodeskeys as $k) {
                                $node = $coursehomenode->get($k);
                                $node->set_parent($activitiesnode);
                                $node->hidden = false;
                            }
                        }
                    }
                    // If the node shouldn't be collapsed, set some node attributes to avoid side effects with the CSS styles
                    // which ship with this plugin.
                } else {
                    if ($activitiesnode) {
                        // Change the isexpandable attribute for the activities node to false
                        // (it's the default in Moodle core, just to be safe).
                        $activitiesnode->isexpandable = false;
                    }
                }
            }
        }
    }

    // If at least one setting to collapse a node is enabled.
    if (!empty($collapsenodesforjs)) {
        // Add JavaScript for collapsing nodes to the page.
        $PAGE->requires->js_call_amd('local_boostnavigation/collapsenavdrawernodes', 'init', [$collapsenodesforjs]);
        // Allow updating the necessary user preferences via Ajax.
        foreach ($collapsenodesforjs as $node) {
            user_preference_allow_ajax_update('local_boostnavigation-collapse_'.$node.'node', PARAM_BOOL);
        }
    }
}
