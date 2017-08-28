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
    global $CFG, $PAGE;

    // Fetch config.
    $config = get_config('local_boostnavigation');

    // Include local library.
    require_once(dirname(__FILE__) . '/locallib.php');

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
        isset($config->collapsenodemycourses) && $config->collapsenodemycourses == true) {
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
            // Get the user preference for the collapse state of the mycourses node and set the collapse and hidden node attributes
            // accordingly.
            // Note: We are somehow abusing the hidden node attribute here for our own purposes. In Boost core, it is set to true
            // for invisible courses, but these are currently displayed just as visible courses in the nav drawer,
            // so we accept this abuse.
            $userprefmycoursesnode = get_user_preferences('local_boostnavigation-collapse_mycoursesnode', 0);
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
        // If yes, do it.
        if ($mycoursesnode) {
            // Change the isexpandable attribute for the mycourses node to false.
            $mycoursesnode->isexpandable = false;
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
