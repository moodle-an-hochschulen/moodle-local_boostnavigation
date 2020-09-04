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

// Define constants used by this plugin.
define('LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE', 0);
define('LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT', 1);
define('LOCAL_BOOSTNAVIGATION_COLLAPSEICON_YES', 2);

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
        if ($privatefilesnode = $navigation->find('privatefiles', global_navigation::TYPE_SETTING)) {
            // Hide privatefiles node.
            $privatefilesnode->showinflatnavigation = false;
        }
    }

    // Next, we will need the mycourses node and the mycourses node children in any case and don't want to fetch them more
    // than once.
    $mycoursesnode = $navigation->find('mycourses', global_navigation::TYPE_ROOTNODE);
    $mycourseschildrennodeskeys = $mycoursesnode->get_children_key_list();

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
            // Add the localboostnavigationcollapsibleparent class to the mycourses node.
            $mycoursesnode->add_class('localboostnavigationcollapsibleparent');
            // Get the user preference for the collapse state of the mycourses node and add the localboostnavigationcollapsedparent
            // and localboostnavigationcollapsedchild classes accordingly.
            // Additionally, add the localboostnavigationcollapsiblechild class to all child nodes.
            $mycoursesnode->add_class('localboostnavigationcollapsibleparent');
            $userprefmycoursesnode = get_user_preferences('local_boostnavigation-collapse_mycoursesnode',
                    $config->collapsemycoursesnodedefault);
            if ($userprefmycoursesnode == 1) {
                $mycoursesnode->add_class('localboostnavigationcollapsedparent');
                foreach ($mycourseschildrennodeskeys as $k) {
                    $childnode = $mycoursesnode->get($k);
                    $childnode->add_class('localboostnavigationcollapsiblechild');
                    $childnode->add_class('localboostnavigationcollapsedchild');
                }
            } else {
                foreach ($mycourseschildrennodeskeys as $k) {
                    $childnode = $mycoursesnode->get($k);
                    $childnode->add_class('localboostnavigationcollapsiblechild');
                }
            }

            // Check if admin really wanted to show an icon in the parent node and indent the parent node.
            // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_YES) - Icon and indent is already fine.
            // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT - Icon has to be removed, but indent is fine.
            // Note that the icon is removed by setting it to i/navigationitem which is mapped it fa-fw
            // and which is the same as the navigation_node constructor sets if the icon is set to null.
            if ($config->collapsemycoursesnodeicon == LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT) {
                $mycoursesnode->icon = new pix_icon('i/navigationitem', '');
                // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE - Icon and indent have to be removed.
            } else if ($config->collapsemycoursesnodeicon == LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE) {
                $mycoursesnode->icon = new pix_icon('i/navigationitem', '');
                $mycoursesnode->add_class('localboostnavigationcollapsibleparentforcenoindent');
            }
        }
    }

    // Check if admin wanted us to remove the badges node from Boost's nav drawer
    // (only if there are no badges in course).
    if ($CFG->enablebadges == true && isset($config->removebadgescoursenode) && $config->removebadgescoursenode == true) {
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
            // Check if there is any badge in the course.
            require_once($CFG->dirroot . '/lib/badgeslib.php');

            // Get number of badges in course.
            $totalbadges = count(badges_get_badges(BADGE_TYPE_COURSE, $PAGE->course->id, '', '' , 0, 0));

            // Only proceed if there are no badges in course.
            if ($totalbadges == 0) {
                if ($badgesnode = $navigation->find('badgesview', global_navigation::TYPE_SETTING)) {
                    // Remove badges node (Just hiding it with the showinflatnavigation attribute does not work here).
                    $badgesnode->remove();
                }
            }
        }
    }

    // Check if admin wanted us to remove the competencies node from Boost's nav drawer
    // (only if there are no competencies in course).
    if (get_config('core_competency', 'enabled') == true && isset($config->removecompetenciescoursenode)
            && $config->removecompetenciescoursenode == true) {
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
            // Check if there is any competency in the course.
            require_once($CFG->dirroot . '/competency/classes/course_competency.php');

            // Get number of competencies in course.
            $totalcompetencies = core_competency\course_competency::count_competencies($PAGE->course->id);

            // Only proceed if there are no competencies in course.
            if ($totalcompetencies == 0) {
                if ($competenciesnode = $navigation->find('competencies', global_navigation::TYPE_SETTING)) {
                    // Remove competencies node (Just hiding it with the showinflatnavigation attribute does not work here).
                    $competenciesnode->remove();
                }
            }
        }
    }

    // Check if admin wanted us to remove the grades node from Boost's nav drawer.
    if (isset($config->removegradescoursenode) && $config->removegradescoursenode == true) {
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
            if ($gradesnode = $navigation->find('grades', global_navigation::TYPE_SETTING)) {
                // Remove grades node (Just hiding it with the showinflatnavigation attribute does not work here).
                $gradesnode->remove();
            }
        }
    }

    // Check if admin wanted us to remove the participants node from Boost's nav drawer.
    if (isset($config->removeparticipantscoursenode) && $config->removeparticipantscoursenode == true) {
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
            if ($participantsnode = $navigation->find('participants', global_navigation::TYPE_CONTAINER)) {
                // Check if we are on a user logs page.
                if (strpos($PAGE->url, 'report/log/user.php') === false) {
                    // If we are not, remove the participants node
                    // (Just hiding it with the showinflatnavigation attribute does not work here).
                    $participantsnode->remove();
                } else {
                    // If we are, we can't remove the node completely as this would result in an error when a teacher accesses the
                    // user logs. However, the user logs just need the participants node to be there to add it to the breadcrumbs.
                    // On a user logs page, the participants node won't be shown in the nav drawer as the page is outside the course
                    // scope. So we use a trick and don't set the participants node not to be rendered in the breadcrumbs.
                    // The end result in the nav drawer is the same as if we would remove the node completely, but the user logs
                    // remain usable.
                    $participantsnode->mainnavonly = true;
                }
            }
        }
    }

    // Check if admin wants us to insert the coursesections node in Boost's nav drawer.
    // Or if admin wants us to insert the activities and / or resources node in Boost's nav drawer.
    // If one of these three settings is activated, we will need the modinfo and don't want
    // to fetch these more than once.
    if (isset($config->insertcoursesectionscoursenode) && $config->insertcoursesectionscoursenode == true ||
            isset($config->insertactivitiescoursenode) && $config->insertactivitiescoursenode == true ||
            isset($config->insertresourcescoursenode) && $config->insertresourcescoursenode == true) {
        // Fetch modinfo.
        $modinfo = get_fast_modinfo($COURSE->id);
    }

    // Check if admin wants us to insert the coursesections node in Boost's nav drawer.
    // Or if admin wants us to insert the activities and / or resources node in Boost's nav drawer.
    // Or if admin wants us to insert custom course nodes in Boost's nav drawer.
    // If one of these four settings is activated, we will need the coursehome node and don't want
    // to fetch these more than once.
    if (isset($config->insertcoursesectionscoursenode) && $config->insertcoursesectionscoursenode == true ||
            isset($config->insertactivitiescoursenode) && $config->insertactivitiescoursenode == true ||
            isset($config->insertresourcescoursenode) && $config->insertresourcescoursenode == true ||
            isset($config->insertcustomcoursenodesusers) && $config->insertcustomcoursenodesusers == true ||
            isset($config->insertcustomcoursenodesadmins) && $config->insertcustomcoursenodesadmins == true) {
        // Fetch course home node.
        $coursehomenode = $PAGE->navigation->find($COURSE->id, navigation_node::TYPE_COURSE);
    }

    // Check if admin wants us to insert the coursesections node in Boost's nav drawer.
    // We won't support adding the coursesections node if $CFG->linkcoursesections is not enabled as we couldn't fully rely
    // on the section nodes being present in Boost's nav drawer.
    if (isset($config->insertcoursesectionscoursenode) && $config->insertcoursesectionscoursenode == true &&
           $CFG->linkcoursesections == true) {
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID && $coursehomenode) {
            // Fetch all section nodes from navigation tree.
            $allsectionnodes = $coursehomenode->children->type(navigation_node::TYPE_SECTION);

            // Only proceed if there is at least one section node shown in the nav drawer.
            if (count($allsectionnodes) > 0) {
                // Get first section node key.
                $firstsectionnode = reset($allsectionnodes);
                $firstsectionnodekey = $firstsectionnode->key;

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
                        new pix_icon('i/folder', ''));

                // Prevent that the coursesections course node is marked as active and added to the breadcrumb when showing the
                // course home page.
                $coursesectionsnode->make_inactive();
                // Add the coursesection node before the first section node.
                $coursehomenode->add_node($coursesectionsnode, $firstsectionnodekey);

                // Check if admin wanted us to also collapse the coursesections node.
                if ($config->collapsecoursesectionscoursenode == true) {
                    // If yes, do it.
                    if ($coursesectionsnode) {
                        // Remember the collapsible node for JavaScript.
                        $collapsenodesforjs[] = 'localboostnavigationcoursesections';
                        // Get the children nodes for the coursehome node.
                        $coursehomenodechildrennodeskeys = $coursehomenode->get_children_key_list();
                        // Add the localboostnavigationcollapsibleparent class to the coursesections node.
                        $coursesectionsnode->add_class('localboostnavigationcollapsibleparent');
                        // Get the user preference for the collapse state of the coursesections node and add the
                        // localboostnavigationcollapsedparent and localboostnavigationcollapsedchild classes accordingly.
                        // Additionally, add the localboostnavigationcollapsiblechild class to all child nodes.
                        // At the same time, reallocate the parent of the existing section nodes.
                        $userprefcoursesectionsnode = get_user_preferences('local_boostnavigation-collapse_'.
                                'localboostnavigationcoursesectionsnode', $config->collapsecoursesectionscoursenodedefault);
                        if ($userprefcoursesectionsnode == 1) {
                            $coursesectionsnode->add_class('localboostnavigationcollapsedparent');
                            foreach ($coursehomenodechildrennodeskeys as $k) {
                                // As $coursehomenodechildrennodeskeys also contains some other nodes, we have to check the node's
                                // action URL to see if we have a section node.
                                $node = $coursehomenode->get($k);
                                // If a node does not have an action URL, just skip it.
                                if ($node->action) {
                                    $url = $node->action->out_as_local_url();
                                    $urlpath = parse_url($url, PHP_URL_PATH);
                                    if ($urlpath == '/course/view.php' && $node->key != 'localboostnavigationcoursesections') {
                                        $node->set_parent($coursesectionsnode);
                                        $node->add_class('localboostnavigationcollapsiblechild');
                                        $node->add_class('localboostnavigationcollapsedchild');
                                    }
                                }
                            }
                        } else {
                            foreach ($coursehomenodechildrennodeskeys as $k) {
                                // As $coursehomenodechildrennodeskeys also contains some other nodes, we have to check the node's
                                // action URL to see if we have a section node.
                                $node = $coursehomenode->get($k);
                                // If a node does not have an action URL, just skip it.
                                if ($node->action) {
                                    $url = $node->action->out_as_local_url();
                                    $urlpath = parse_url($url, PHP_URL_PATH);
                                    if ($urlpath == '/course/view.php' && $node->key != 'localboostnavigationcoursesections') {
                                        $node->set_parent($coursesectionsnode);
                                        $node->add_class('localboostnavigationcollapsiblechild');
                                    }
                                }
                            }
                        }

                        // Check if admin really wanted to show an icon in the parent node and indent the parent node.
                        // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_YES) - Icon and indent is already fine.
                        // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT - Icon has to be removed, but indent is fine.
                        // Note that the icon is removed by setting it to i/navigationitem which is mapped it fa-fw
                        // and which is the same as the navigation_node constructor sets if the icon is set to null.
                        if ($config->collapsecoursesectionscoursenodeicon == LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT) {
                            $coursesectionsnode->icon = new pix_icon('i/navigationitem', '');
                            // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE - Icon and indent have to be removed.
                        } else if ($config->collapsecoursesectionscoursenodeicon == LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE) {
                            $coursesectionsnode->icon = new pix_icon('i/navigationitem', '');
                            $coursesectionsnode->add_class('localboostnavigationcollapsibleparentforcenoindent');
                        }
                    }

                    // If not, we have at least to reallocate the parent of the existing section nodes so that the section nodes
                    // can be referenced in CSS.
                } else {
                    // Get the children nodes for the coursehome node.
                    $coursehomenodechildrennodeskeys = $coursehomenode->get_children_key_list();
                    // Reallocate the parent of the existing section nodes.
                    foreach ($coursehomenodechildrennodeskeys as $k) {
                        // As $coursehomenodechildrennodeskeys also contains some other nodes, we have to check the node's
                        // action URL to see if we have a section node.
                        $node = $coursehomenode->get($k);
                        // If a node does not have an action URL, just skip it.
                        if ($node->action) {
                            $url = $node->action->out_as_local_url();
                            $urlpath = parse_url($url, PHP_URL_PATH);
                            if ($urlpath == '/course/view.php' && $node->key != 'localboostnavigationcoursesections') {
                                $node->set_parent($coursesectionsnode);
                            }
                        }
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
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
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
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
            // Only proceed if the course has at least one resource activity.
            if (array_key_exists('resources', $modfullnames)) {
                // Create resources course node.
                $resourcesnode = navigation_node::create(get_string('resources'),
                        new moodle_url('/course/resources.php', array('id' => $COURSE->id)),
                        global_navigation::TYPE_ACTIVITY,
                        null,
                        'localboostnavigationresources',
                        new pix_icon('resources', '', 'local_boostnavigation'));
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
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
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
                        new pix_icon('activities', '', 'local_boostnavigation'));
                // Prevent that the activities course node is marked as active and added to the breadcrumb when showing the
                // course home page.
                $activitiesnode->make_inactive();
                 // Add the activities node to the end of the course navigation.
                $coursehomenode->add_node($activitiesnode);

                // Create an activity course node for each activity type.
                foreach ($modfullnames as $modname => $modfullname) {
                    // If, for any reason, $modfullname is empty, skip this activity type as it would
                    // crash navigation_node::create() otherwise.
                    if (empty($modfullname)) {
                        continue;
                    }

                    // Process "Resources" activity type.
                    if ($modname === 'resources') {
                        // Do only if the admin does not want a dedicated resources node.
                        if ($config->insertresourcescoursenode == false) {
                            $activitynode = navigation_node::create($modfullname,
                                    new moodle_url('/course/resources.php', array('id' => $COURSE->id)),
                                    global_navigation::TYPE_ACTIVITY,
                                    null,
                                    'localboostnavigationactivity'.$modname,
                                    new pix_icon('resources', '', 'local_boostnavigation'));
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
                                new pix_icon('activities', '', 'local_boostnavigation'));
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
                        // Add the localboostnavigationcollapsibleparent class to the activities node.
                        $activitiesnode->add_class('localboostnavigationcollapsibleparent');
                        // Get the user preference for the collapse state of the activities node and add the
                        // localboostnavigationcollapsedparent and localboostnavigationcollapsedchild classes accordingly.
                        // Additionally, add the localboostnavigationcollapsiblechild class to all child nodes.
                        // At the same time, reallocate the parent of the existing activities nodes.
                        $userprefactivitiesnode = get_user_preferences('local_boostnavigation-collapse_'.
                                'localboostnavigationactivitiesnode', $config->collapseactivitiescoursenodedefault);
                        if ($userprefactivitiesnode == 1) {
                            $activitiesnode->add_class('localboostnavigationcollapsedparent');
                            foreach ($activitiesnodechildrennodeskeys as $k) {
                                $node = $coursehomenode->get($k);
                                $node->set_parent($activitiesnode);
                                $node->add_class('localboostnavigationcollapsiblechild');
                                $node->add_class('localboostnavigationcollapsedchild');
                            }
                        } else {
                            $activitiesnode->collapse = false;
                            foreach ($activitiesnodechildrennodeskeys as $k) {
                                $node = $coursehomenode->get($k);
                                $node->set_parent($activitiesnode);
                                $node->add_class('localboostnavigationcollapsiblechild');
                            }
                        }

                        // Check if admin really wanted to show an icon in the parent node and indent the parent node.
                        // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_YES) - Icon and indent is already fine.
                        // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT - Icon has to be removed, but indent is fine.
                        // Note that the icon is removed by setting it to i/navigationitem which is mapped it fa-fw
                        // and which is the same as the navigation_node constructor sets if the icon is set to null.
                        if ($config->collapseactivitiescoursenodeicon == LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT) {
                            $activitiesnode->icon = new pix_icon('i/navigationitem', '');
                            // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE - Icon and indent have to be removed.
                        } else if ($config->collapseactivitiescoursenodeicon == LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE) {
                            $activitiesnode->icon = new pix_icon('i/navigationitem', '');
                            $activitiesnode->add_class('localboostnavigationcollapsibleparentforcenoindent');
                        }
                    }
                        // If not, we have at least to reallocate the parent of the activities nodes so that the activities nodes
                        // can be referenced in CSS.
                } else {
                    // Reallocate the parent of the activities nodes.
                    foreach ($activitiesnodechildrennodeskeys as $k) {
                        $node = $coursehomenode->get($k);
                        $node->set_parent($activitiesnode);
                    }
                }
            }
        }
    }

    // Check if admin wants us to insert category nodes for users in Boost's nav drawer.
    if ( true === filter_var( $config->showcategorynodestreeinnavdrawer, FILTER_VALIDATE_BOOLEAN ) ) {

        // Edge case handling.
        if ( ! isset( $config->insertcustomnodesusers ) ) {
            $config->insertcustomnodesusers = '';
        }

        if ( ! empty( $config->insertcustomnodesusers ) ) {
            $config->insertcustomnodesusers .= PHP_EOL;
        }

        // Append categories to $config->insertcustomnodesusers (string).
        foreach (core_course_category::make_categories_list() as $categoryid => $category) {

            // Get relevant category information.
            $categoryconfiguration = core_course_category::get( $categoryid );

            // Hide category if nessessary.
            if ( $categoryconfiguration->visible == '0' ) {
                continue;
            }

            // Append "-" as level identifier (recursive).
            // int $n Counted parents. $s .= "-" as level identifier.
            // return (-,--,---,..., n*-) as level identifier.
            $getdeep = function( $n, $s = '-' ) use ( &$getdeep ) {
                if ( $n == 0 ) {
                    return '';
                }
                if ( $n == 1 ) {
                    return $s;
                }
                return $getdeep( $n - 1, $s .= '-' );
            };

            // Mapping to a "multi"-level-menue while using native boostnavigation "notations".
            $config->insertcustomnodesusers .= $getdeep( count( $categoryconfiguration->get_parents() ) )
                                               . $categoryconfiguration->get_formatted_name()
                                               . '|' . new moodle_url( '/course/index.php' )
                                               . '?categoryid=' . $categoryid
                                               . PHP_EOL;
        }
    }

    // Check if admin wants us to insert custom nodes for users in Boost's nav drawer.
    if (isset($config->insertcustomnodesusers) && !empty($config->insertcustomnodesusers)) {
        // If yes, do it.
        $customnodesret = local_boostnavigation_build_custom_nodes($config->insertcustomnodesusers, $navigation,
                'localboostnavigationcustomrootusers', true, $config->collapsecustomnodesusers,
                $config->collapsecustomnodesusersdefault, $config->collapsecustomnodesusersaccordion);

        // Check if admin wanted us to also collapse the custom nodes for users.
        if ($config->collapsecustomnodesusers == true) {
            // Remember the collapsible node for JavaScript.
            if (!empty($collapsenodesforjs) && is_array($collapsenodesforjs)) {
                $collapsenodesforjs = array_merge($collapsenodesforjs, $customnodesret);
            } else {
                $collapsenodesforjs = $customnodesret;
            }

            // Check if admin wanted us to collapse the custom nodes for users as accordion.
            if ($config->collapsecustomnodesusersaccordion == true) {
                $accordionnodesforjs[] = 'localboostnavigationcustomrootusers';
            }
        }
    }

    // Check if admin wants us to insert custom nodes for admins in Boost's nav drawer.
    if (isset($config->insertcustomnodesadmins) && !empty($config->insertcustomnodesadmins) && is_siteadmin()) {
        // If yes, do it.
        $customnodesret = local_boostnavigation_build_custom_nodes($config->insertcustomnodesadmins, $navigation,
                'localboostnavigationcustomrootadmins', true, $config->collapsecustomnodesadmins,
                $config->collapsecustomnodesadminsdefault, $config->collapsecustomnodesadminsaccordion);

        // Check if admin wanted us to also collapse the custom nodes for admins.
        if ($config->collapsecustomnodesadmins == true) {
            // Remember the collapsible node for JavaScript.
            if (!empty($collapsenodesforjs) && is_array($collapsenodesforjs)) {
                $collapsenodesforjs = array_merge($collapsenodesforjs, $customnodesret);
            } else {
                $collapsenodesforjs = $customnodesret;
            }

            // Check if admin wanted us to collapse the custom nodes for admins as accordion.
            if ($config->collapsecustomnodesadminsaccordion == true) {
                $accordionnodesforjs[] = 'localboostnavigationcustomrootadmins';
            }
        }
    }

    // Check if admin wants us to insert custom course nodes for users in Boost's nav drawer.
    if (isset($config->insertcustomcoursenodesusers) && !empty($config->insertcustomcoursenodesusers)) {
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID && $coursehomenode) {
            // If yes, do it.
            $customnodesret = local_boostnavigation_build_custom_nodes($config->insertcustomcoursenodesusers, $coursehomenode,
                    'localboostnavigationcustomcourseusers', false, $config->collapsecustomcoursenodesusers,
                    $config->collapsecustomcoursenodesusersdefault, $config->collapsecustomcoursenodesusersaccordion);

            // Check if admin wanted us to also collapse the custom course nodes for users.
            if ($config->collapsecustomcoursenodesusers == true) {
                // Remember the collapsible node for JavaScript.
                if (!empty($collapsenodesforjs) && is_array($collapsenodesforjs)) {
                    $collapsenodesforjs = array_merge($collapsenodesforjs, $customnodesret);
                } else {
                    $collapsenodesforjs = $customnodesret;
                }

                // Check if admin wanted us to collapse the custom course nodes for users as accordion.
                if ($config->collapsecustomcoursenodesusersaccordion == true) {
                    $accordionnodesforjs[] = 'localboostnavigationcustomcourseusers';
                }
            }
        }
    }

    // Check if admin wants us to insert custom course nodes for admins in Boost's nav drawer.
    if (isset($config->insertcustomcoursenodesadmins) && !empty($config->insertcustomcoursenodesadmins) && is_siteadmin()) {
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
            // If yes, do it.
            $customnodesret = local_boostnavigation_build_custom_nodes($config->insertcustomcoursenodesadmins, $coursehomenode,
                    'localboostnavigationcustomcourseadmins', false, $config->collapsecustomcoursenodesadmins,
                    $config->collapsecustomcoursenodesadminsdefault, $config->collapsecustomcoursenodesadminsaccordion);

            // Check if admin wanted us to also collapse the custom course nodes for admins.
            if ($config->collapsecustomcoursenodesadmins == true) {
                // Remember the collapsible node for JavaScript.
                if (!empty($collapsenodesforjs) && is_array($collapsenodesforjs)) {
                    $collapsenodesforjs = array_merge($collapsenodesforjs, $customnodesret);
                } else {
                    $collapsenodesforjs = $customnodesret;
                }

                // Check if admin wanted us to collapse the custom course nodes for admins as accordion.
                if ($config->collapsecustomcoursenodesadminsaccordion == true) {
                    $accordionnodesforjs[] = 'localboostnavigationcustomcourseadmins';
                }
            }
        }
    }

    // Check if admin wants us to insert custom bottom nodes for users in Boost's nav drawer.
    if (isset($config->insertcustombottomnodesusers) && !empty($config->insertcustombottomnodesusers)) {
        // If yes, do it.
        $customnodesret = local_boostnavigation_build_custom_nodes($config->insertcustombottomnodesusers, $navigation,
                'localboostnavigationcustombottomusers', true, $config->collapsecustombottomnodesusers,
                $config->collapsecustombottomnodesusersdefault, $config->collapsecustombottomnodesusersaccordion);

        // Check if admin wanted us to also collapse the custom bottom nodes for users.
        if ($config->collapsecustombottomnodesusers == true) {
            // Remember the collapsible node for JavaScript.
            if (!empty($collapsenodesforjs) && is_array($collapsenodesforjs)) {
                $collapsenodesforjs = array_merge($collapsenodesforjs, $customnodesret);
            } else {
                $collapsenodesforjs = $customnodesret;
            }

            // Check if admin wanted us to collapse the custom bottom nodes for users as accordion.
            if ($config->collapsecustombottomnodesusersaccordion == true) {
                $accordionnodesforjs[] = 'localboostnavigationcustombottomusers';
            }
        }
    }

    // Check if admin wants us to insert custom bottom nodes for admins in Boost's nav drawer.
    if (isset($config->insertcustombottomnodesadmins) && !empty($config->insertcustombottomnodesadmins) && is_siteadmin()) {
        // If yes, do it.
        $customnodesret = local_boostnavigation_build_custom_nodes($config->insertcustombottomnodesadmins, $navigation,
                'localboostnavigationcustombottomadmins', true, $config->collapsecustombottomnodesadmins,
                $config->collapsecustombottomnodesadminsdefault, $config->collapsecustombottomnodesadminsaccordion);

        // Check if admin wanted us to also collapse the custom bottom nodes for admins.
        if ($config->collapsecustombottomnodesadmins == true) {
            // Remember the collapsible node for JavaScript.
            if (!empty($collapsenodesforjs) && is_array($collapsenodesforjs)) {
                $collapsenodesforjs = array_merge($collapsenodesforjs, $customnodesret);
            } else {
                $collapsenodesforjs = $customnodesret;
            }

            // Check if admin wanted us to collapse the custom bottom nodes for admins as accordion.
            if ($config->collapsecustombottomnodesadminsaccordion == true) {
                $accordionnodesforjs[] = 'localboostnavigationcustombottomadmins';
            }
        }
    }

    // If at least one setting to collapse a node is enabled.
    if (!empty($collapsenodesforjs)) {
        // If at least one setting to collapse a node as accordion is enabled.
        if (!empty($accordionnodesforjs)) {
            // Add JavaScript for collapsing nodes to the page and pass the $collapsenodesforjs and $accordionnodesforjs data.
            $PAGE->requires->js_call_amd('local_boostnavigation/collapsenavdrawernodes', 'init',
                    [$collapsenodesforjs, $accordionnodesforjs]);
            // Otherwise.
        } else {
            // Add JavaScript for collapsing nodes to the page and pass the $collapsenodesforjs data only.
            $PAGE->requires->js_call_amd('local_boostnavigation/collapsenavdrawernodes', 'init',
                    [$collapsenodesforjs, []]);
        }
        // Allow updating the necessary user preferences via Ajax.
        foreach ($collapsenodesforjs as $node) {
            user_preference_allow_ajax_update('local_boostnavigation-collapse_'.$node.'node', PARAM_BOOL);
        }
    }
}


/**
 * Fumble with Moodle's global navigation by leveraging Moodle's *_extend_navigation_course() hook.
 *
 * @param navigation_node $navigation
 */
function local_boostnavigation_extend_navigation_course(navigation_node $navigation) {
    global $PAGE, $COURSE;

    // Fetch config.
    $config = get_config('local_boostnavigation');

    // Check if admin wanted us to remove the competencies node from Boost's nav drawer and insert it to the course (cog) menu.
    if (get_config('core_competency', 'enabled') == true && isset($config->removecompetenciescoursenode)
            && $config->removecompetenciescoursenode == true) {
        // Only proceed if we are inside a course and we are _not_ on the frontpage.
        if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
            // Create competencies node.
            $competenciesnode = navigation_node::create(get_string('competencies', 'core_competency'),
                    new moodle_url('/admin/tool/lp/coursecompetencies.php', array('courseid' => $PAGE->course->id)),
                    navigation_node::TYPE_SETTING,
                    null,
                    'competencies2',
                    new pix_icon('i/competencies', ''));
            // Add the competencies node.
            $navigation->add_node($competenciesnode);
        }
    }
}

/**
 * Get icon mapping for FontAwesome.
 * This function is only processed when the Moodle cache is cleared and not on every page load.
 * That's why we created the local_boostnavigation_reset_fontawesome_icon_map function and added it as a callback to this plugin's
 * settings for mapping icons as configured in the plugin's in custom nodes.
 */
function local_boostnavigation_get_fontawesome_icon_map() {
    // Fetch config.
    $config = get_config('local_boostnavigation');

    // Include local library.
    require_once(__DIR__ . '/locallib.php');

    // Create the icon map with the icons which are used in any case.
    $iconmapping = [
            'local_boostnavigation:customnodexxs' => 'fa-square local-boostnavigation-fa-xxs',
            'local_boostnavigation:customnodexs' => 'fa-square local-boostnavigation-fa-xs',
            'local_boostnavigation:resources' => 'fa-archive',
            'local_boostnavigation:activities' => 'fa-share-alt',
    ];

    // Fetch all FontAwesome icons from the custom nodes settings.
    // Collect all settings which contain custom nodes.
    $customnodesettings = array();
    if (isset($config->insertcustomnodesusers) && !empty($config->insertcustomnodesusers)) {
        $customnodesettings[] = $config->insertcustomnodesusers;
    }
    if (isset($config->insertcustomnodesadmins) && !empty($config->insertcustomnodesadmins)) {
        $customnodesettings[] = $config->insertcustomnodesadmins;
    }
    if (isset($config->insertcustomcoursenodesusers) && !empty($config->insertcustomcoursenodesusers)) {
        $customnodesettings[] = $config->insertcustomcoursenodesusers;
    }
    if (isset($config->insertcustomcoursenodesadmins) && !empty($config->insertcustomcoursenodesadmins)) {
        $customnodesettings[] = $config->insertcustomcoursenodesadmins;
    }
    if (isset($config->insertcustombottomnodesusers) && !empty($config->insertcustombottomnodesusers)) {
        $customnodesettings[] = $config->insertcustombottomnodesusers;
    }
    if (isset($config->insertcustombottomnodesadmins) && !empty($config->insertcustombottomnodesadmins)) {
        $customnodesettings[] = $config->insertcustombottomnodesadmins;
    }

    // Process the settings one by one.
    foreach ($customnodesettings as $c) {

        // Make a new array on delimiter "new line".
        $lines = explode("\n", $c);

        // Parse node settings.
        foreach ($lines as $line) {

            // Skip empty lines.
            if (strlen($line) == 0) {
                continue;
            }

            // Make a new array on delimiter "|".
            $settings = explode('|', $line);

            // Check if there is an icon configured.
            if (!empty($settings[7])) {

                // Pick the setting which represents the icon.
                $icon = trim($settings[7]);

                // If a valid icon is given, we remember it for the iconmapping.
                if (local_boostnavigation_verify_faicon($icon)) {
                    $iconmapping['local_boostnavigation:'.$icon] = $icon;
                }
            }
        }
    }

    return $iconmapping;
}

/**
 * Helper function to reset the icon system used as updatecallback function when saving some of the plugin's settings.
 */
function local_boostnavigation_reset_fontawesome_icon_map() {
    // Reset the icon system cache.
    // There is the function \core\output\icon_system::reset_caches() which does seem to be only usable in unit tests.
    // Thus, we clear the icon system cache brutally.
    $instance = \core\output\icon_system::instance(\core\output\icon_system::FONTAWESOME);
    $cache = \cache::make('core', 'fontawesomeiconmapping');
    $mapkey = 'mapping_'.preg_replace('/[^a-zA-Z0-9_]/', '_', get_class($instance));
    $cache->delete($mapkey);
    // And rebuild it brutally.
    $instance->get_icon_name_map();
}
