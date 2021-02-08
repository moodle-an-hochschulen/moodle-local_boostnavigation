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
 * @param bool $accordion
 * @return array
 */
function local_boostnavigation_build_custom_nodes($customnodes, navigation_node $node,
        $keyprefix='localboostnavigationcustom', $showinflatnavigation=true, $collapse=false,
        $collapsedefault=false, $accordion=false) {
    global $USER, $FULLME;

    // Fetch config.
    $config = get_config('local_boostnavigation');

    // Build full page URL if we have it available to be used down below.
    if (!empty($FULLME)) {
        $pagefullurl = new moodle_url($FULLME);
    }

    // Initialize counter which is later used for the node IDs.
    $nodecount = 0;

    // Initialize variables for remembering the last parent node.
    $lastparentnode = null;
    $lastparentnodevisible = false;

    // Initialize variables for marking the first custom bottom parent nodes.
    $firstcustombuttomusersparentnodeseen = false;
    $firstcustombuttomadminsparentnodeseen = false;

    // Initialize variables for remembering the node keys for collapsing.
    $collapsenodesforjs = array();
    $collapselastparentprepared = false;

    // Initialize variables for remembering the status of an accordion.
    $accordionalreadyopen = false;

    // Make a new array on delimiter "new line".
    $lines = explode("\n", $customnodes);

    // Parse node settings.
    foreach ($lines as $line) {

        // Remember the node which we add the custom node to individually as we might change this node afterwards.
        $targetnode = $node;

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
        $nodebeforenodekey = null;

        // Initialize the logical combination operator and stack.
        $logicalcombinationoperator = 'AND';
        $logicalcombinationstack = array();

        // Make a new array on delimiter "|".
        $settings = explode('|', $line);

        // Check for the mandatory conditions first.
        // If array contains too less or too many settings, do not proceed and therefore do not create the node.
        // Furthermore check it at least the first two mandatory params are not an empty string.
        if (count($settings) >= 2 && count($settings) <= 11 && $settings[0] !== '' && $settings[1] !== '') {
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
                            // Otherwise, it is checked whether the user is a member of any of the provided cohorts and the result
                            // will be added to the logical combination stack for later evaluation.
                            $logicalcombinationstack[] = local_boostnavigation_cohort_is_member($USER->id, $setting);

                            break;
                        // Check for the optional fifth parameter: role filter.
                        case 4:
                            // Only proceed if some role is entered here. This parameter is optional.
                            // If no role shortnames are given, the node will be added to the navigation by default.
                            // Otherwise, it is checked whether the user has any of the provided roles and the result
                            // will be added to the logical combination stack for later evaluation.
                            $logicalcombinationstack[] = local_boostnavigation_user_has_role_on_page($USER->id, $setting);

                            break;
                        // Check for the optional sixth parameter: system role filter.
                        case 5:
                            // Only proceed if some role is entered here. This parameter is optional.
                            // If no system role shortnames are given, the node will be added to the navigation by default.
                            // Otherwise, it is checked whether the user has any of the provided system roles and the result
                            // will be added to the logical combination stack for later evaluation.
                            $logicalcombinationstack[] = local_boostnavigation_user_has_role_on_system($USER->id, $setting);

                            break;
                        // Check for the optional seventh parameter: logical combination operator.
                        case 6:
                            // Check if a valid logical combination operator is given and remember it for later use.
                            // The logical combination operator AND corresponds to the default combination which is automatically
                            // used if no logical operator is given.
                            // To change the combination only the OR operator is valid.
                            if (in_array($setting, ['AND', 'OR'])) {
                                switch ($setting) {
                                    case 'OR':
                                        $logicalcombinationoperator = 'OR';
                                        break;
                                    case 'AND':
                                    default:
                                        $logicalcombinationoperator = 'AND';
                                }
                            }

                            break;
                        // Check for the optional eighth parameter: icon.
                        case 7:
                            // Only proceed if some valid FontAwesome icon is entered here. This parameter is optional.
                            // If no valid icon is given, the node will be added to the navigation with the default icon.
                            if (local_boostnavigation_verify_faicon($setting) == true) {
                                $nodeicon = new pix_icon($setting, '', 'local_boostnavigation');
                            }

                            break;
                        // Check for the optional ninth parameter: id.
                        case 8:
                            // Only proceed if some id is entered here. This parameter is optional.
                            // If no id is given, the node will get an automatically created id later.
                            $nodekey = $keyprefix.clean_param($setting, PARAM_ALPHANUM);

                            break;
                        // Check for the optional tenth parameter: before node key.
                        case 9:
                            // Only proceed if some before node key is entered here. This parameter is optional.
                            // If no before node key is given, the node will be added to the end of the navigation.
                            $nodebeforenodekey = clean_param($setting, PARAM_ALPHANUM);

                            // The nodes 'myhome' and 'coursehome' cannot be taken as "beforenode".
                            // The former because it is the root node of the hierarchy.
                            // The latter since it only exists in the flatnavigation which can't be accessed here.
                            if ($nodebeforenodekey === 'myhome' || $nodebeforenodekey === 'coursehome') {
                                $nodebeforenodekey = null;

                                // Handle "beforenodes" that are known to be not direct children of $node but grand children.
                            } else if ($nodebeforenodekey === 'calendar' || $nodebeforenodekey === 'privatefiles' ||
                                    $nodebeforenodekey === 'contentbank') {
                                $nodebeforenode = $targetnode->find($nodebeforenodekey, global_navigation::TYPE_UNKNOWN);

                                if ($nodebeforenode) {
                                    $targetnode = $nodebeforenode->parent;
                                }
                            }

                            break;
                        // Check for the optional eleventh parameter: css class.
                        case 10:
                            // Only proceed if some class is entered here. This parameter is optional.
                            // If no class is given, the node will just get the classes which are needed for collapsing custom
                            // nodes.
                            $nodeclass = clean_param($setting, PARAM_NOTAGS); // More precisely, we would have needed
                                                                              // PARAM_ALPHANUMEXT with spaces, but that does not
                                                                              // exist unfortunately.

                            break;
                    }
                }
            }

            // Evaluate the cohort, role and system role settings together with the logical combination operator and calculate
            // these settings into node visibility.
            if (count($logicalcombinationstack) >= 2) {
                if ($logicalcombinationoperator == 'OR') {
                    $nodevisible &= array_reduce($logicalcombinationstack,
                            function($a, $b) {
                                return $a || $b;
                            },
                            false);
                } else {
                    $nodevisible &= array_reduce($logicalcombinationstack,
                            function($a, $b) {
                                return $a && $b;
                            },
                            true);
                }
            } else if (count($logicalcombinationstack) == 1) {
                $nodevisible &= $logicalcombinationstack[0];
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

        // Add a custom node to the given navigation_node.
        // This is if all mandatory params are set and the node is visible.
        if ($nodevisible) {

            // Generate automatic node key if no custom node key was set.
            if ($nodekey == null) {
                $nodekey = $keyprefix.++$nodecount;
            }

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

            // Add custom class if any class was given.
            if (!empty($nodeclass)) {
                $customnode->add_class($nodeclass);
            }

            // If it's a parent node.
            if (!$nodeischild) {
                // If the nodes should be collapsed and collapsing hasn't been prepared yet, prepare collapsing of the parent node.
                if ($collapse) {
                    // Remember that we haven't prepared collapsing yet for this parent node.
                    $collapselastparentprepared = false;
                }

                // If we are dealing with custom bottom nodes for users and this is the first parent node,
                // add a special class for later usage in CSS.
                if ($keyprefix == 'localboostnavigationcustombottomusers' && !$firstcustombuttomusersparentnodeseen) {
                    $customnode->add_class('localboostnavigationfirstcustombuttomusers');
                    $firstcustombuttomusersparentnodeseen = true;

                    // Otherwise,
                    // if we are dealing with custom bottom nodes for admins and this is the first parent node,
                    // add a special class for later usage in CSS.
                } else if ($keyprefix == 'localboostnavigationcustombottomadmins' && !$firstcustombuttomadminsparentnodeseen) {
                    $customnode->add_class('localboostnavigationfirstcustombuttomadmins');
                    $firstcustombuttomadminsparentnodeseen = true;
                }

                // Add the custom node to the given navigation_node.
                $targetnode->add_node($customnode, $nodebeforenodekey);

                // Remember the node as a potential parent node for the next node.
                $lastparentnode = $customnode;

                // Get the user preference for the collapse state of this custom node and set the collapse attribute accordingly.
                $userprefcustomnode = get_user_preferences('local_boostnavigation-collapse_'.$nodekey.'node', $collapsedefault);
                // The user preference is to collapse the node.
                if ($userprefcustomnode == 1) {
                    // Set the node to be collapsed.
                    $customnode->add_class('localboostnavigationcollapsedparent');

                    // The user preference is to expand the node.
                } else {
                    // If we create an accordion, we have to be careful now.
                    if ($accordion == true) {
                        // If have already created one expanded node, we must not open another one,
                        // regardless of the user preference.
                        if ($accordionalreadyopen == true) {
                            // Set the node to be collapsed.
                            $customnode->add_class('localboostnavigationcollapsedparent');
                        } else {
                            // If we have set this node to be the expanded node, we must remember this fact for the
                            // remaining accordion nodes.
                            $accordionalreadyopen = true;
                        }
                    }
                }

                // If the node should be collapsed, remove the active status in any case because otherwise it might get highlighted
                // as active which does not make sense for collapse parent nodes.
                if ($collapse) {
                    // If we are dealing with a custom course node.
                    if (substr($keyprefix, 0, 32) == 'localboostnavigationcustomcourse') {
                        // Basically, we could just call $customnode->make_inactive();
                        // However, it has been shown that, if we do this to custom course nodes, there are side effects to the
                        // my courses list as make_inactive() also makes the parent node (in this case: the course node) inactive.
                        // So we make just this custom node inactive manually, just like make_inactive() would do it.
                        $customnode->isactive = false;
                        $customnode->remove_class('active_tree_node');

                        // Otherwise.
                    } else {
                        $customnode->make_inactive();
                    }
                }

                // Finally, set the node icon.
                // This covers the case that the node should not be collapsed
                // as well as the case that the node should not be collapsed but does not have any children.
                // Later, when the first child node is added, the node icon might be removed again if the admin told us to do so.
                if ($nodeicon instanceof pix_icon) {
                    $customnode->icon = $nodeicon;
                } else {
                    $customnode->icon = new pix_icon('customnodexs', '', 'local_boostnavigation');
                }

                // Otherwise, if it's a child node.
            } else {
                // If the nodes should be collapsed and collapsing hasn't been prepared yet, prepare collapsing of the parent node.
                // This is done here (in the first child node and not in the parent node) because parent nodes without any child
                // node shouldn't be collapsible and should have an icon in any case.
                if ($collapse && !$collapselastparentprepared) {
                    // Remember the node key for collapsing.
                    $collapsenodesforjs[] = $lastparentnode->key;

                    // Add the localboostnavigationcollapsibleparent class to the parent node.
                    $lastparentnode->add_class('localboostnavigationcollapsibleparent');

                    // Check if admin really wanted to show an icon in the parent node and indent the parent node.
                    // Get the relevant customnodeicon config.
                    $customnodeiconconfig = local_boostnavigation_get_customnodeicon_config($keyprefix, $config);
                    // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_YES) - Icon and indent is already fine.
                    // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT - Icon has to be removed, but indent is fine.
                    // Note that the icon is removed by setting it to i/navigationitem which is mapped it fa-fw
                    // and which is the same as the navigation_node constructor sets if the icon is set to null.
                    if ($customnodeiconconfig == LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT) {
                        $lastparentnode->icon = new pix_icon('i/navigationitem', '');
                        // Case: LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE - Icon and indent have to be removed.
                    } else if ($customnodeiconconfig == LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE) {
                        $lastparentnode->icon = new pix_icon('i/navigationitem', '');
                        $lastparentnode->add_class('localboostnavigationcollapsibleparentforcenoindent');
                    }
                    // Remember that we have prepared collapsing now.
                    $collapselastparentprepared = true;
                }

                // For some crazy reason, if we add the child node directly to the parent node, it is not shown in the
                // course navigation section.
                // Thus, add the custom node to the given navigation_node.
                $targetnode->add_node($customnode, $nodebeforenodekey);
                // And change the parent node directly afterwards.
                $customnode->set_parent($lastparentnode);

                // If the nodes should be collapsed.
                if ($collapse) {
                    // Add the localboostnavigationcollapsiblechild class to the child node.
                    $customnode->add_class('localboostnavigationcollapsiblechild');

                    // And, but only if the last parent node is collapsed, set the child node to be hidden.
                    if (in_array('localboostnavigationcollapsedparent', $lastparentnode->classes)) {
                        $customnode->add_class('localboostnavigationcollapsedchild');
                    }
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
                    $customnode->icon = new pix_icon('customnodexxs', '', 'local_boostnavigation');
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

    // Variable to hold the placeholders as soon as needed.
    static $placeholders = null;

    // Check if there is any placeholder in the url.
    if (strpos($url, '{') !== false) {
        // If yes, create the placeholders array to be replaced later.
        if ($placeholders == null) {
            $placeholders = array('courseid' => (isset($COURSE->id) ? $COURSE->id : ''),
                                  'courseshortname' => (isset($COURSE->shortname) ? $COURSE->shortname : ''),
                                  'editingtoggle' => ($PAGE->user_is_editing() ? 'off' : 'on'),
                                  'userid' => (isset($USER->id) ? $USER->id : ''),
                                  'userusername' => (isset($USER->username) ? $USER->username : ''),
                                  'pagecontextid' => (is_object($PAGE->context) ? $PAGE->context->id : ''),
                                  'pagepath' => (is_object($PAGE->url) ? $PAGE->url->out_as_local_url() : ''),
                                  'sesskey' => sesskey());
        }

        // And replace the placeholders in the url.
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

    // Run the title through the filter processor to especially support multilanguage titles.
    $title = format_string($title);

    // Variable to hold the placeholders as soon as needed.
    static $placeholders = null;

    // Check if there is any placeholder in the title.
    if (strpos($title, '{') !== false) {
        // If yes, create the placeholders array to be replaced later.
        if ($placeholders == null) {
            $placeholders = array('coursefullname'  => (isset($COURSE->fullname) ? format_string($COURSE->fullname) : ''),
                                  'courseshortname' => (isset($COURSE->shortname) ? $COURSE->shortname : ''),
                                  'editingtoggle'   => ($PAGE->user_is_editing() ?
                                          get_string('turneditingoff') : get_string('turneditingon')),
                                  'userfullname'    => fullname($USER),
                                  'userusername'    => (isset($USER->username) ? $USER->username : ''));
        }

        // And replace the placeholders in the title.
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


/**
 * Helper function to generate the first part of the description for the custom nodes for users settings
 * which is needed three times.
 * It's not nice, but it serves its purpose.
 *
 * @return string
 */
function local_boostnavigation_customnodesusageusers() {

    $html = get_string('setting_customnodesusageusersintro', 'local_boostnavigation', null, true).'<br />'.
            '<hr />'.
            get_string('setting_customnodesusageexamples', 'local_boostnavigation', null, true).'<br />'.
            '<code>'.get_string('setting_customnodesusageusersexample', 'local_boostnavigation', null, true).'</code><br />'.
            '<hr />'.
            get_string('setting_customnodesusageparameters', 'local_boostnavigation', null, true).'<br />'.
            '<dl>'.
            '<dt>'.get_string('setting_customnodesusageparametertitledt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparametertitledd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparameterlinkdt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparameterlinkdd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparameterlanguagedt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparameterlanguagedd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparametercohortdt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparametercohortdd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparameterroledt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparameterroledd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparametersystemroledt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparametersystemroledd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparameterlogicaldt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparameterlogicaldd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparametericondt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparametericondd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparameteriddt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparameteriddd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparameterbeforenodedt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparameterbeforenodedd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparameterclassdt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparameterclassdd', 'local_boostnavigation', null, true).'</dd>'.
            '</dl>'.
            '<hr />'.
            get_string('setting_customnodesusagepleasenote', 'local_boostnavigation', null, true).
            '<ul>'.
            '<li>'.get_string('setting_customnodesusagepleasenotepipes', 'local_boostnavigation', null, true).'</li>';

    $html .= local_boostnavigation_customnodesusageadminsandusers();

    return $html;
}


/**
 * Helper function to generate the first part of the description for the custom nodes for admins settings
 * which is needed three times.
 * It's not nice, but it serves its purpose.
 *
 * @return string
 */
function local_boostnavigation_customnodesusageadmins() {

    $html = get_string('setting_customnodesusageadminsintro', 'local_boostnavigation', null, true).'<br />'.
            '<hr />'.
            get_string('setting_customnodesusageexamples', 'local_boostnavigation', null, true).'<br />'.
            '<code>'.get_string('setting_customnodesusageadminsexample', 'local_boostnavigation', null, true).'</code><br />'.
            '<hr />'.
            get_string('setting_customnodesusageparameters', 'local_boostnavigation', null, true).'<br />'.
            '<dl>'.
            '<dt>'.get_string('setting_customnodesusageparametertitledt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparametertitledd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparameterlinkdt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparameterlinkdd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusageparameterlanguagedt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusageparameterlanguagedd', 'local_boostnavigation', null, true).'</dd>'.
            '</dl>'.
            '<hr />'.
            get_string('setting_customnodesusagepleasenote', 'local_boostnavigation', null, true).
            '<ul>'.
            '<li>'.get_string('setting_customnodesusageadminsparameternote', 'local_boostnavigation', null, true).'</li>';

    $html .= local_boostnavigation_customnodesusageadminsandusers();

    return $html;
}

/**
 * Helper function to generate the second part of the description for the custom nodes for admins and users settings
 * which is needed six times.
 * It's not nice, but it serves its purpose.
 *
 * @return string
 */
function local_boostnavigation_customnodesusageadminsandusers() {

    $html = '<li>'.get_string('setting_customnodesusagepleasenotemultilang', 'local_boostnavigation', null, true).'</li>'.
            '<li>'.get_string('setting_customnodesusagepleasenotetitle', 'local_boostnavigation', null, true).' '.
            get_string('setting_customnodesusagepleasenotephexplanation', 'local_boostnavigation', null, true).'<br />'.
            get_string('setting_customnodesusagepleasenotephavailable', 'local_boostnavigation', null, true).
            '<dl>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephcoursefullnamedt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephcoursefullnamedd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephcourseshortnamedt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephcourseshortnamedd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotepheditingtitledt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotepheditingtitledd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephuserfullnamedt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephuserfullnamedd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephuserusernamedt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephuserusernamedd', 'local_boostnavigation', null, true).'</dd>'.
            '</dl>'.
            '</li>'.
            '<li>'.get_string('setting_customnodesusagepleasenotelink', 'local_boostnavigation', null, true).' '.
            get_string('setting_customnodesusagepleasenotephexplanation', 'local_boostnavigation', null, true).'<br />'.
            get_string('setting_customnodesusagepleasenotephavailable', 'local_boostnavigation', null, true).
            '<dl>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephcourseiddt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephcourseiddd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephcourseshortnamedt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephcourseshortnamedd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotepheditinglinkdt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotepheditinglinkdd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephuseriddt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephuseriddd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephuserusernamedt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephuserusernamedd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephpagecontextiddt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephpagecontextiddd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephpagepathdt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephpagepathdd', 'local_boostnavigation', null, true).'</dd>'.
            '<dt>'.get_string('setting_customnodesusagepleasenotephsesskeydt', 'local_boostnavigation', null, true).'</dt>'.
            '<dd>'.get_string('setting_customnodesusagepleasenotephsesskeydd', 'local_boostnavigation', null, true).'</dd>'.
            '</dl>'.
            '</li>'.
            '<li>'.get_string('setting_customnodesusagepleasenotecheck', 'local_boostnavigation', null, true).'</li>'.
            '<li>'.get_string('setting_customnodesusagepleasenotecss', 'local_boostnavigation', null, true).'</li>'.
            '</ul>'.
            '<hr />'.
            get_string('setting_customnodesusagechildnodes', 'local_boostnavigation', null, true).'<br />'.
            '<br />'.
            get_string('setting_customnodesusageexamples', 'local_boostnavigation', null, true).'<br />'.
            '<code>'.get_string('setting_customnodesusagechildnodesexample', 'local_boostnavigation', null, true).'</code><br />'.
            '<br />'.
            get_string('setting_customnodesusagepleasenote', 'local_boostnavigation', null, true).
            '<ul>'.
            '<li>'.get_string('setting_customnodesusagechildnodespleasenoteurl', 'local_boostnavigation', null, true).'</li>'.
            '<li>'.get_string('setting_customnodesusagechildnodespleasenoterecursive', 'local_boostnavigation', null, true).'</li>'.
            '</ul>';

    return $html;
}

/**
 * Get the relevant customnodeicon config for a given custom node key prefix.
 *
 * @param string $customnodekeyprefix
 * @param mixed $config
 * @return bool
 */
function local_boostnavigation_get_customnodeicon_config($customnodekeyprefix, $config = null) {
    // Check all possible custom node key prefixes and return the relevant config.
    if ($customnodekeyprefix == 'localboostnavigationcustomrootusers') {
        return $config->collapsecustomnodesusersicon;
    }
    if ($customnodekeyprefix == 'localboostnavigationcustomrootadmins') {
        return $config->collapsecustomnodesadminsicon;
    }
    if ($customnodekeyprefix == 'localboostnavigationcustomcourseusers') {
        return $config->collapsecustomcoursenodesusersicon;
    }
    if ($customnodekeyprefix == 'localboostnavigationcustomcourseadmins') {
        return $config->collapsecustomcoursenodesadminsicon;
    }
    if ($customnodekeyprefix == 'localboostnavigationcustombottomusers') {
        return $config->collapsecustombottomnodesusersicon;
    }
    if ($customnodekeyprefix == 'localboostnavigationcustombottomadmins') {
        return $config->collapsecustombottomnodesadminsicon;
    }

    // As a fallback, which should not happen, return the default setting of the configs.
    return LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE;
}

/**
 * Check if there is any badge in the course.
 *
 * @param int $courseid
 *
 * @return bool
 */
function local_boostnavigation_course_has_badges($courseid) {
    global $DB, $CFG;

    require_once($CFG->dirroot . '/lib/badgeslib.php');

    $sql = "SELECT id FROM {badge}
            WHERE status != :deleted AND type = :type AND courseid = :courseid";
    $params = array('deleted' => BADGE_STATUS_ARCHIVED,
            'type' => BADGE_TYPE_COURSE,
            'courseid' => $courseid);
    $recordexists = $DB->record_exists_sql($sql, $params);

    return $recordexists;
}

/**
 * Get the string of the selected custom field value.
 * This is a downsized version of get_customfield_values_for_export() with the only goal to get a single string.
 *
 * @param string $customfieldname The shortname of the custom field.
 * @param int $customfieldvalue The value of the selected custom field.
 *
 * @return string
 */
function local_boostnavigation_get_customfield_valuestring($customfieldname, $customfieldvalue) {
    global $CFG, $DB;

    // Include block_myoverview library which contains the BLOCK_MYOVERVIEW_CUSTOMFIELD_EMPTY constant which is needed for
    // calling the course_grouping_format_values() function later.
    require_once($CFG->dirroot.'/blocks/myoverview/lib.php');

    // Get the customfield record (which holds all available options).
    $fieldrecord = $DB->get_record('customfield_field', ['shortname' => $customfieldname]);
    // The field did not exist, we can't continue.
    if (!$fieldrecord) {
        return '';
    }

    // Get the field object and make sure that the field can be used for filtering courses at all.
    $field = \core_customfield\field_controller::create($fieldrecord->id);
    $isvisible = $field->get_configdata_property('visibility') == \core_course\customfield\course_handler::VISIBLETOALL;
    // Only visible fields to everybody supporting course grouping will be displayed.
    if (!$field->supports_course_grouping() || !$isvisible) {
        return ''; // The field shouldn't have been selectable in the global settings, but just skip it now.
    }

    // Finally, get the string of the selected custom field value.
    // We have to pass an array of value IDs to get (in this case: Just one single value) and we get back an array of the requested
    // string plus the string for "No value selected".
    $values = $field->course_grouping_format_values(array($customfieldvalue));
    // Make sure that the array contains the string we need.
    if (!is_array($values) || !array_key_exists($customfieldvalue, $values)) {
        return '';
    }

    // Pick the string of the single value from the array.
    $customfieldstring = $values[$customfieldvalue];

    // Return the string.
    return $customfieldstring;
}
