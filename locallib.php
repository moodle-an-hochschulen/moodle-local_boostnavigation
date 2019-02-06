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
    global $USER, $FULLME;

    // Build full page URL if we have it available to be used down below.
    if (!empty($FULLME)) {
        $pagefullurl = new moodle_url($FULLME);
    }

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
        $nodelanguage = null;
        $nodeicon = null;

        // Make a new array on delimiter "|".
        $settings = explode('|', $line);

        // Check for the mandatory conditions first.
        // If array contains too less or too many settings, do not proceed and therefore do not create the node.
        // Furthermore check it at least the first two mandatory params are not an empty string.
        if (count($settings) >= 2 && count($settings) <= 7 && $settings[0] !== '' && $settings[1] !== '') {
            foreach ($settings as $i => $setting) {
                $setting = trim($setting);
                if (!empty($setting)) {
                    switch ($i) {
                        // Check for the mandatory first param: title.
                        case 0:
                            // Check if this is a child node and get the node title.
                            if (substr($setting, 0, 1) == '-') {
                                $nodeischild = true;
                                $nodetitle = local_boostnavigation_build_node_title(substr($setting, 1));
                            } else {
                                $nodeischild = false;
                                $nodetitle = local_boostnavigation_build_node_title($setting);
                            }

                            // Set the node to be basically visible.
                            $nodevisible = true;

                            break;
                        // Check for the mandatory second param: URL.
                        case 1:
                            // Get the URL.
                            try {
                                $nodeurl = local_boostnavigation_build_node_url($setting);
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
                            $nodelanguage = in_array(current_language(), $nodelanguages);
                            $nodevisible &= $nodelanguage;

                            break;
                        // Check for the optional fourth param: cohort filter.
                        case 3:
                            // Only proceed if something is entered here. This parameter is optional.
                            // If no cohort is given the node will be added to the navigation by default.
                            $nodevisible &= local_boostnavigation_cohort_is_member($USER->id, $setting);

                            break;
                        // Check for the optional fifth parameter: role filter.
                        case 4:
                            // Only proceed if some role is entered here. This parameter is optional.
                            // If no role shortnames are given, the node will be added to the navigation by default.
                            // Otherwise, it is checked whether the user has any of the provided roles,
                            // so that the custom node is displayed.
                            $nodevisible &= local_boostnavigation_user_has_role_on_page($USER->id, $setting);

                            break;
                        // Check for the optional sixth parameter: system role filter.
                        case 5:
                            // Only proceed if some role is entered here. This parameter is optional.
                            // If no system role shortnames are given, the node will be added to the navigation by default.
                            // Otherwise, it is checked whether the user has any of the provided roles,
                            // so that the custom node is displayed.
                            $nodevisible &= local_boostnavigation_user_has_role_on_system($USER->id, $setting);

                            break;
                        // Check for the optional seventh parameter: icon.
                        case 6:
                            // Only proceed if some valid FontAwesome icon is entered here. This parameter is optional.
                            // If no valid icon is given, the node will be added to the navigation with the default icon.
                            if (local_boostnavigation_verify_faicon($setting) == true) {
                                $nodeicon = new pix_icon($setting, '', 'local_boostnavigation');
                            }

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

                // If the code should be collapsed, remove the active status in any case because otherwise it might get highlighted
                // as active which does not make sense for collapse parent nodes.
                if ($collapse) {
                    $customnode->make_inactive();
                }

                // Finally, if the node shouldn't be collapsed or if it does not have children, set the node icon.
                if (!$collapse || $customnode->has_children() == false) {
                    if ($nodeicon instanceof pix_icon) {
                        $customnode->icon = $nodeicon;
                    } else {
                        $customnode->icon = new pix_icon('customnode', '', 'local_boostnavigation');
                    }
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

                // For some strange reason, Moodle core does only compare the URL base when searching the active navigation node.
                // This will result in the wrong node being highlighted if we add multiple nodes which only differ by the URL
                // parameter as custom nodes.
                // We try to overcome this problem as best as possible by actively setting the active node.
                if ($pagefullurl instanceof moodle_url && $nodeurl->compare($pagefullurl, URL_MATCH_PARAMS)) {
                    $customnode->make_active();
                }

                // Finally, set the node icon.
                if ($nodeicon instanceof pix_icon) {
                    $customnode->icon = $nodeicon;
                } else {
                    $customnode->icon = new pix_icon('customnode', '', 'local_boostnavigation');
                }
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
 * @param string $setting A comma-seperated whitelist of allowed cohort idnumbers.
 *
 * @return bool
 */
function local_boostnavigation_cohort_is_member($userid, $setting) {
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

    // Second: Check if the user if a member of the given cohort(s).
    $cohortids = explode(',', $setting);
    if ($cohortids < 2) {
        $ismember = in_array($setting, $allmemberships);
    } else {
        $ismember = count(array_intersect($cohortids, $allmemberships)) > 0;
    }

    // Return the result.
    return $ismember;
}

/**
 * This function takes the plugin's custom node url, replaces placeholders if necessary and returns the url.
 *
 * @param string $url
 * @return object
 */
function local_boostnavigation_build_node_url($url) {
    global $USER, $COURSE, $PAGE;

    // Define placeholders which should be replaced later.
    $placeholders = array('courseid' => (isset($COURSE->id) ? $COURSE->id : ''),
            'courseshortname' => (isset($COURSE->shortname) ? $COURSE->shortname : ''),
            'editingtoggle' => ($PAGE->user_is_editing() ? 'off' : 'on'),
            'userid' => (isset($USER->id) ? $USER->id : ''),
            'userusername' => (isset($USER->username) ? $USER->username : ''),
            'pagecontextid' => (is_object($PAGE->context) ? $PAGE->context->id : ''),
            'pagepath' => (is_object($PAGE->url) ? $PAGE->url->out_as_local_url() : ''),
            'sesskey' => sesskey());

    // Check if there is any placeholder in the url.
    if (strpos($url, '{') !== false) {
        // If yes, replace the placeholders in the url.
        foreach ($placeholders as $search => $replace) {
            $url = str_replace('{' . $search . '}', $replace, $url);
        }
    }

    return new moodle_url($url);
}

/**
 * This function takes the plugin's custom node title, replaces placeholders if necessary and returns the title.
 *
 * @param string $title
 * @return string
 */
function local_boostnavigation_build_node_title($title) {
    global $USER, $COURSE, $PAGE;

    // Define placeholders which should be replaced later.
    $placeholders = array('coursefullname' => (isset($COURSE->fullname) ? format_string($COURSE->fullname) : ''),
            'courseshortname' => (isset($COURSE->shortname) ? $COURSE->shortname : ''),
            'editingtoggle' => ($PAGE->user_is_editing() ? get_string('turneditingoff') : get_string('turneditingon')),
            'userfullname' => fullname($USER),
            'userusername' => (isset($USER->username) ? $USER->username : ''));

    // Check if there is any placeholder in the title.
    if (strpos($title, '{') !== false) {
        // If yes, replace the placeholders in the title.
        foreach ($placeholders as $search => $replace) {
            $title = str_replace('{' . $search . '}', $replace, $title);
        }
    }

    return $title;
}

/**
 * Checks if the provided string is a valid FontAwesome icon name.
 * @param string $icon
 * @return bool
 */
function local_boostnavigation_verify_faicon($icon) {
    // The regex to identify a FontAwesome icon name.
    $faiconpattern = '~^fa-[\w\d-]+$~';

    // Check if it's matching the Font Awesome pattern.
    if (preg_match($faiconpattern, $icon) > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * Checks if the user has any of the allowed roles on this page. A comma-seperated list of role shortnames must be provided.
 * @param int $userid
 * @param string $setting A comma-seperated whitelist of allowed role shortnames.
 * @return bool
 */
function local_boostnavigation_user_has_role_on_page($userid, $setting) {
    global $PAGE, $USER, $COURSE, $DB, $CFG;

    // Split optional setting by comma.
    $showforroles = explode(',', $setting);

    // Is the user's course role switched?
    if (!empty($USER->access['rsw'][$PAGE->context->path])) {
        // Check only switched role.

        // Fetch all information for all roles only once and remember for next calls of this function.
        static $allroles;
        if ($allroles == null) {
            $allroles = get_all_roles();
        }

        // Check if the user has switch to a required role.
        return in_array($allroles[$USER->access['rsw'][$PAGE->context->path]]->shortname, $showforroles);

        // Or is the user currently having his own role(s)?
    } else {
        // Check all of the user's course roles.

        // Retrieve the assigned roles for the current page only once and remember for next calls of this function.
        static $rolesincontextshortnames;
        if ($rolesincontextshortnames == null) {
            // Get the assigned roles.
            $rolesincontext = get_user_roles($PAGE->context, $userid);
            $rolesincontextshortnames = array();
            foreach ($rolesincontext as $role) {
                array_push($rolesincontextshortnames, $role->shortname);
            }

            // As get_user_roles only returns roles for enrolled users, we have to check whether a user
            // is viewing the course as guest or is not logged in separately.
            // Is the user not logged in?
            if (isguestuser($userid)) {
                $notloggedinroleshortname = $DB->get_field('role', 'shortname', array('id' => $CFG->notloggedinroleid),
                        IGNORE_MISSING);
                if ($notloggedinroleshortname) {
                    array_push($rolesincontextshortnames, $notloggedinroleshortname);
                }
            }

            // Only proceed if we are inside a course and we are _not_ on the frontpage.
            if ($PAGE->context->get_course_context(false) == true && $COURSE->id != SITEID) {
                // Is the user viewing the course as guest?
                if (is_guest($PAGE->context, $userid)) {
                    array_push($rolesincontextshortnames, get_guest_role()->shortname);
                }
            }
        }

        // Check if the user has at least one of the required roles.
        return count(array_intersect($rolesincontextshortnames, $showforroles)) > 0;
    }
}

/**
 * Checks if the user has any of the allowed global system roles.
 * @param int $userid
 * @param string $setting A comma-separated whitelist of allowed system role shortnames.
 * @return bool
 */
function local_boostnavigation_user_has_role_on_system($userid, $setting) {

    // Split optional setting by comma.
    $showforroles = explode(',', $setting);

    // Retrieve the assigned roles for the system context only once and remember for next calls of this function.
    static $rolesinsystemshortnames;
    if ($rolesinsystemshortnames == null) {
        // Get the assigned roles.
        $rolesinsystem = get_user_roles(context_system::instance(), $userid);
        $rolesinsystemshortnames = array();
        foreach ($rolesinsystem as $role) {
            array_push($rolesinsystemshortnames, $role->shortname);
        }

        // Is the user an admin?
        if (is_siteadmin($userid)) {
            // Add it to the list of system roles.
            array_push($rolesinsystemshortnames, 'admin');
        }
    }

    // Check if the user has at least one of the required roles.
    return count(array_intersect($rolesinsystemshortnames, $showforroles)) > 0;
}
