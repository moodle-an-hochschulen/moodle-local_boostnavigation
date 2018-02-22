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
 * Local plugin "Boost navigation fumbling" - Local Library
 *
 * @package    local_boostnavigation
 * @copyright  2017 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Moodle core does not have a built-in functionality to get all keys of all children of a navigation node,
 * so we need to get these ourselves.
 *
 * @param navigation_node $navigationnode
 * @return array
 */
function local_boostnavigation_get_all_childrenkeys(navigation_node $navigationnode) {
    // Empty array to hold all children.
    $allchildren = array();

    // No, this node does not have children anymore.
    if (count($navigationnode->children) == 0) {
        return array();

        // Yes, this node has children.
    } else {
        // Get own own children keys.
        $childrennodeskeys = $navigationnode->get_children_key_list();
        // Get all children keys of our children recursively.
        foreach ($childrennodeskeys as $ck) {
            $allchildren = array_merge($allchildren, local_boostnavigation_get_all_childrenkeys($navigationnode->get($ck)));
        }
        // And add our own children keys to the result.
        $allchildren = array_merge($allchildren, $childrennodeskeys);

        // Return everything.
        return $allchildren;
    }
}


/**
 * This function takes the plugin's custom nodes setting, builds the custom nodes and adds them to the given navigation_node.
 *
 * @param string $customnodes
 * @param navigation_node $node
 * @param string $keyprefix
 * @param bool $showinflatnavigation
 * @param bool $collapse
 * @param bool $collapsedefault
 * @return array
 */
function local_boostnavigation_build_custom_nodes($customnodes, navigation_node $node,
        $keyprefix='localboostnavigationcustom', $showinflatnavigation=true, $collapse=false,
        $collapsedefault=false) {
    global $USER;

    // Initialize counter which is later used for the node IDs.
    $nodecount = 0;

    // Initialize variables for remembering the last parent node.
    $lastparentnode = null;
    $lastparentnodevisible = false;

    // Initialize variables for remembering the node keys for collapsing.
    $collapsenodesforjs = array();
    $collapselastparentprepared = false;

    // Make a new array on delimiter "new line".
    $lines = explode("\n", $customnodes);

    // Parse node settings.
    foreach ($lines as $line) {

        // Trim setting lines.
        $line = trim($line);

        // Skip empty lines.
        if (strlen($line) == 0) {
            continue;
        }

        // Initialize node variables.
        $nodeurl = null;
        $nodetitle = null;
        $nodevisible = false;
        $nodeischild = false;
        $nodekey = null;

        // Make a new array on delimiter "|".
        $settings = explode('|', $line);

        // Check for the mandatory conditions first.
        // If array contains too less or too many settings, do not proceed and therefore do not create the node.
        // Furthermore check it at least the first two mandatory params are not an empty string.
        if (count($settings) >= 2 && count($settings) <= 4 && $settings[0] !== '' && $settings[1] !== '') {
            foreach ($settings as $i => $setting) {
                $setting = trim($setting);
                if (!empty($setting)) {
                    switch ($i) {
                        // Check for the mandatory first param: title.
                        case 0:
                            // Check if this is a child node and get the node title.
                            if (substr($setting, 0, 1) == '-') {
                                $nodeischild = true;
                                $nodetitle = substr($setting, 1);
                            } else {
                                $nodeischild = false;
                                $nodetitle = $setting;
                            }

                            // Set the node to be basically visible.
                            $nodevisible = true;

                            break;
                        // Check for the mandatory second param: URL.
                        case 1:
                            // Get the URL.
                            try {
                                $nodeurl = new moodle_url($setting);
                                $nodevisible = true;
                            } catch (moodle_exception $exception) {
                                // We're not actually worried about this, we don't want to mess up the navigation
                                // just for a wrongly entered URL. We just don't create a node in this case.
                                $nodeurl = null;
                                $nodevisible = false;
                            }

                            break;
                        // Check for the optional third param: language support.
                        case 2:
                            // Only proceed if something is entered here. This parameter is optional.
                            // If no language is given the node will be added to the navigation by default.
                            $nodelanguages = array_map('trim', explode(',', $setting));
                            $nodevisible &= in_array(current_language(), $nodelanguages);

                            break;
                        // Check for the optional fourth param: cohort filter.
                        case 3:
                            // Only proceed if something is entered here. This parameter is optional.
                            // If no cohort is given the node will be added to the navigation by default.
                            $nodevisible &= local_boostnavigation_cohort_is_member($USER->id, $setting);

                            break;
                    }

                    // Support for inheritance of the parent node's visibility to his child notes.
                    if ($nodeischild == false) {
                        // To inherit the parent node's visibility to his child nodes later, we have to remember
                        // this visibility now.
                        $lastparentnodevisible = $nodevisible;
                    } else {
                        // Inherit the parent node's visibility. This overrules the child node's visibility.
                        $nodevisible &= $lastparentnodevisible;
                    }

                }
            }
        }

        // Add a custom node to the given navigation_node.
        // This is if all mandatory params are set and the node matches the optional given language setting.
        if ($nodevisible) {

            // Generate node key.
            $nodekey = $keyprefix.++$nodecount;

            // Create custom node.
            $customnode = navigation_node::create($nodetitle,
                    $nodeurl,
                    global_navigation::TYPE_CUSTOM,
                    null,
                    $nodekey,
                    null);

            // Show the custom node in Boost's nav drawer if requested.
            if ($showinflatnavigation) {
                $customnode->showinflatnavigation = true;
            }

            // If it's a parent node.
            if (!$nodeischild) {
                // If the nodes should be collapsed and collapsing hasn't been prepared yet, prepare collapsing of the parent node.
                if ($collapse) {
                    // Remember that we haven't prepared collapsing yet for this parent node.
                    $collapselastparentprepared = false;

                    // If the node shouldn't be collapsed, set some node attributes to avoid side effects with the CSS styles
                    // which ship with this plugin.
                } else {
                    // Change the isexpandable attribute for the parent node to false
                    // (it's the default in Moodle core, just to be safe).
                    $customnode->isexpandable = false;
                }

                // Add the custom node to the given navigation_node.
                $node->add_node($customnode);

                // Remember the node as a potential parent node for the next node.
                $lastparentnode = $customnode;

                // Get the user preference for the collapse state of this custom node and set the collapse attribute accordingly.
                $userprefcustomnode = get_user_preferences('local_boostnavigation-collapse_'.$nodekey.'node', $collapsedefault);
                if ($userprefcustomnode == 1) {
                    $customnode->collapse = true;
                } else {
                    $customnode->collapse = false;
                }

                // Finally, if the node shouldn't be collapsed or if it does not have children, set the node icon.
                if (!$collapse || $customnode->has_children() == false) {
                    $customnode->icon = new pix_icon('customnode', '', 'local_boostnavigation');
                }

                // Otherwise, if it's a child node.
            } else {
                // If the nodes should be collapsed and collapsing hasn't been prepared yet, prepare collapsing of the parent node.
                // This is done here (in the first child node and not in the parent node) because parent nodes without any child
                // node shouldn't be collapsible.
                if ($collapse && !$collapselastparentprepared) {
                    // Remember the node key for collapsing.
                    $collapsenodesforjs[] = $lastparentnode->key;

                    // Change the isexpandable attribute for the parent node to true.
                    $lastparentnode->isexpandable = true;

                    // Remember that we have prepared collapsing now.
                    $collapselastparentprepared = true;
                }

                // For some crazy reason, if we add the child node directly to the parent node, it is not shown in the
                // course navigation section.
                // Thus, add the custom node to the given navigation_node.
                $node->add_node($customnode);
                // And change the parent node directly afterwards.
                $customnode->set_parent($lastparentnode);

                // Get the user preference for the collapse state of the last parent node and set the hidden attribute accordingly.
                $userprefcustomnode = get_user_preferences('local_boostnavigation-collapse_'.$lastparentnode->key.'node',
                        $collapsedefault);
                if ($userprefcustomnode == 1) {
                    $customnode->hidden = true;
                } else {
                    $customnode->hidden = false;
                }

                // Finally, set the node icon.
                $customnode->icon = new pix_icon('customnode', '', 'local_boostnavigation');
            }
        }
    }

    // Return the node keys for collapsing.
    return $collapsenodesforjs;
}

/**
 * Moodle core does not have a built-in functionality to check if a user is a member of a given cohort (by cohort idnumber and
 * regardless of cohort visibility), so we need to get this information ourselves.
 *
 * @param int $userid
 * @param string $cohortidnumber
 *
 * @return bool
 */
function local_boostnavigation_cohort_is_member($userid, $cohortidnumber) {
    global $DB;

    // Initialize variable for memberships.
    static $allmemberships = null;

    // First: If the memberships haven't been fetched yet initially, fetch all of the user's cohort memberships
    // only once and remember for next calls of this function.
    if ($allmemberships == null) {
        // Prepare SQL statement.
        $sql = 'SELECT {cohort}.id, {cohort}.idnumber FROM {cohort_members}
            JOIN {cohort}
                ON {cohort}.id = {cohort_members}.cohortid
            WHERE {cohort_members}.userid = ?';
        $params = array($userid);

        // Run DB query.
        $ret = $DB->get_records_sql_menu($sql, $params);

        // Remember memberships.
        $allmemberships = $ret;
    }

    // Second: Check if the user if a member of the given cohort.
    $ismember = in_array($cohortidnumber, $allmemberships);

    // Return the result.
    return $ismember;
}
