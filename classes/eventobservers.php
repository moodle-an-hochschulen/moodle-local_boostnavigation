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
 * Local plugin "Boost navigation fumbling" - Event observers
 *
 * @package    local_boostnavigation
 * @copyright  2019 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_boostnavigation;

defined('MOODLE_INTERNAL') || die();

/**
 * Observer class containing methods monitoring various events.
 *
 * @package    local_boostnavigation
 * @copyright  2019 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class eventobservers
{

    /**
     * User loggedin event observer.
     *
     * @param \core\event\base $event The event.
     */
    public static function user_loggedin(\core\event\base $event) {

        self::clear_collapse_memory($event->userid);
    }

    /**
     * User loggedout event observer.
     *
     * @param \core\event\base $event The event.
     */
    public static function user_loggedout(\core\event\base $event) {

        self::clear_collapse_memory($event->userid);
    }

    /**
     * Clear collapse nodes' memory.
     *
     * @param int $userid A Moodle user id.
     */
    private static function clear_collapse_memory($userid) {
        // Fetch config.
        $config = get_config('local_boostnavigation');

        // We _should_ check here first if collapsing nodes is enabled at all (as stated in the descriptions of the
        // collapse*session settings).
        // However this would create quite an overhead of additional checking at login and logout time and would not really help
        // when the plugin is used correctly. If the admin has enabled one or more of the collapse*session settings but has not
        // enabled collapsing the node at all, it's his fault that we will be searching the user preference for no reason but we
        // are sure that nothing will break.

        // Do only if any collapsible node is configured to remember the collapse state only for the current session.
        // We have to check explicitely if the configurations are set because this function might already be
        // called before installation time and would then throw PHP notices otherwise.
        if (isset($config->collapsemycoursesnodesession) && $config->collapsemycoursesnodesession == true ||
                isset($config->collapsecoursesectionscoursenodesession) &&
                $config->collapsecoursesectionscoursenodesession == true ||
                isset($config->collapseactivitiescoursenodesession) && $config->collapseactivitiescoursenodesession == true ||
                isset($config->collapsecustomnodesuserssession) && $config->collapsecustomnodesuserssession == true ||
                isset($config->collapsecustomnodesadminssession) && $config->collapsecustomnodesadminssession == true ||
                isset($config->collapsecustomcoursenodesuserssession) && $config->collapsecustomcoursenodesuserssession == true ||
                isset($config->collapsecustomcoursenodesadminssession) && $config->collapsecustomcoursenodesadminssession == true ||
                isset($config->collapsecustombottomnodesuserssession) && $config->collapsecustombottomnodesuserssession == true ||
                isset($config->collapsecustombottomnodesadminssession) && $config->collapsecustombottomnodesadminssession == true) {

            // Fetch user preferences.
            // The way to fetch these user preferences is a choice between the devil and the deep blue sea.
            // We can fetch them with get_user_preferences() which is coming from Cache, but we would then iterate over all user
            // preferences later, even the preferences with are unrelated to this plugin.
            // And we can fetch them directly from DB, getting only preferences which are prefixes with
            // 'local_boostnavigation-collapse_', but this would definitely need one explicit DB call with a LIKE statement during
            // login time.
            // In the end, we decided for the first way.
            $userprefs = get_user_preferences(null, null, $userid);

            // Iterate over all existing user preferences.
            foreach ($userprefs as $key => $value) {

                // If the preference is prefixed with local_boostnavigation-collapse_.
                if (strpos($key, 'local_boostnavigation-collapse_') === 0) {

                    // Check if admin wanted the mycourses node to remember the collapse state only for the current session.
                    if ($config->collapsemycoursesnodesession == true && $key == 'local_boostnavigation-collapse_mycoursesnode') {
                        // Check if the user preference is different from the collapse default to avoid removing the
                        // user preference unnecessarily.
                        if ($config->collapsemycoursesnodedefault != $value) {
                            // Unset the user preference to have the default applied next time the node is rendered.
                            unset_user_preference($key, $userid);
                        }
                    }

                    // Check if admin wanted the coursesections course node to remember the collapse state only for the current
                    // session.
                    if ($config->collapsecoursesectionscoursenodesession == true &&
                            $key == 'local_boostnavigation-collapse_localboostnavigationcoursesectionsnode') {
                        // Check if the user preference is different from the collapse default to avoid removing the
                        // user preference unnecessarily.
                        if ($config->collapsecoursesectionscoursenodedefault != $value) {
                            // Unset the user preference to have the default applied next time the node is rendered.
                            unset_user_preference($key, $userid);
                        }
                    }

                    // Check if admin wanted the activities course node to remember the collapse state only for the current session.
                    if ($config->collapseactivitiescoursenodesession == true &&
                            $key == 'local_boostnavigation-collapse_localboostnavigationactivitiesnode') {
                        // Check if the user preference is different from the collapse default to avoid removing the
                        // user preference unnecessarily.
                        if ($config->collapseactivitiescoursenodedefault != $value) {
                            // Unset the user preference to have the default applied next time the node is rendered.
                            unset_user_preference($key, $userid);
                        }
                    }

                    // Check if admin wanted the custom nodes for users to remember the collapse state only for the current session.
                    if ($config->collapsecustomnodesuserssession == true &&
                            strpos($key, 'local_boostnavigation-collapse_localboostnavigationcustomrootusers') === 0) {
                        // Check if the user preference is different from the collapse default to avoid removing the
                        // user preference unnecessarily.
                        if ($config->collapsecustomnodesusersdefault != $value) {
                            // Unset the user preference to have the default applied next time the node is rendered.
                            unset_user_preference($key, $userid);
                        }
                    }

                    // Check if admin wanted the custom nodes for admins to remember the collapse state only for the current
                    // session.
                    if ($config->collapsecustomnodesadminssession == true &&
                            strpos($key, 'local_boostnavigation-collapse_localboostnavigationcustomrootadmins') === 0) {
                        // Check if the user preference is different from the collapse default to avoid removing the
                        // user preference unnecessarily.
                        if ($config->collapsecustomnodesadminsdefault != $value) {
                            // Unset the user preference to have the default applied next time the node is rendered.
                            unset_user_preference($key, $userid);
                        }
                    }

                    // Check if admin wanted the custom course nodes for users to remember the collapse state only for the current
                    // session.
                    if ($config->collapsecustomcoursenodesuserssession == true &&
                            strpos($key, 'local_boostnavigation-collapse_localboostnavigationcustomcourseusers') === 0) {
                        // Check if the user preference is different from the collapse default to avoid removing the
                        // user preference unnecessarily.
                        if ($config->collapsecustomcoursenodesusersdefault != $value) {
                            // Unset the user preference to have the default applied next time the node is rendered.
                            unset_user_preference($key, $userid);
                        }
                    }

                    // Check if admin wanted the custom course nodes for admins to remember the collapse state only for the current
                    // session.
                    if ($config->collapsecustomcoursenodesadminssession == true &&
                            strpos($key, 'local_boostnavigation-collapse_localboostnavigationcustomcourseadmins') === 0) {
                        // Check if the user preference is different from the collapse default to avoid removing the
                        // user preference unnecessarily.
                        if ($config->collapsecustomcoursenodesadminsdefault != $value) {
                            // Unset the user preference to have the default applied next time the node is rendered.
                            unset_user_preference($key, $userid);
                        }
                    }

                    // Check if admin wanted the custom bottom nodes for users to remember the collapse state only for the current
                    // session.
                    if ($config->collapsecustombottomnodesuserssession == true &&
                            strpos($key, 'local_boostnavigation-collapse_localboostnavigationcustombottomusers') === 0) {
                        // Check if the user preference is different from the collapse default to avoid removing the
                        // user preference unnecessarily.
                        if ($config->collapsecustombottomnodesusersdefault != $value) {
                            // Unset the user preference to have the default applied next time the node is rendered.
                            unset_user_preference($key, $userid);
                        }
                    }

                    // Check if admin wanted the custom bottom nodes for admins to remember the collapse state only for the current
                    // session.
                    if ($config->collapsecustombottomnodesadminssession == true &&
                            strpos($key, 'local_boostnavigation-collapse_localboostnavigationcustombottomadmins') === 0) {
                        // Check if the user preference is different from the collapse default to avoid removing the
                        // user preference unnecessarily.
                        if ($config->collapsecustombottomnodesadminsdefault != $value) {
                            // Unset the user preference to have the default applied next time the node is rendered.
                            unset_user_preference($key, $userid);
                        }
                    }
                }
            }
        }
    }
}
