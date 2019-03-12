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
 * Local plugin "Boost navigation fumbling" - Upgrade steps
 *
 * @package    local_boostnavigation
 * @copyright  2017 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Upgrade steps for this plugin
 * @param int $oldversion the version we are upgrading from
 * @return boolean
 */
function xmldb_local_boostnavigation_upgrade($oldversion) {
    if ($oldversion < 2017050502) {
        global $CFG;

        // Currentcoursefullname setting was removed from this plugin.
        // If it was set and we have the Moodle version which uses $CFG->navshowfullcoursenames to control the nav drawer,
        // set $CFG->navshowfullcoursenames in Moodle core to achieve the same goal.
        if (get_config('local_boostnavigation', 'currentcoursefullname') == true && $CFG->version >= 2016120500.03) {
            unset_config('currentcoursefullname', 'local_boostnavigation');
            set_config('navshowfullcoursenames', 1);
        }

        upgrade_plugin_savepoint(true, 2017050502, 'local', 'boostnavigation');
    }

    if ($oldversion < 2017051000) {
        // If Moodle is configured with 'Default home page for users' = User preference,
        // the plugin's 'Remove second "Home" or "Dashboard" node' setting didn't have any effect.
        // Remove the wrong setting and set it correctly.
        if (get_config('local_boostnavigation', 'removesecondhomenode') == true) {
            unset_config('removesecondhomenode', 'local_boostnavigation');
            set_config('removehomenode', 1, 'local_boostnavigation');
        }

        upgrade_plugin_savepoint(true, 2017051000, 'local', 'boostnavigation');
    }

    if ($oldversion < 2019031201) {
        // After the logical combination operator has been added as node setting, we need to push the icon node settings
        // (if existing) one place to the right.
        $insertcustomnodesusers = get_config('local_boostnavigation', 'insertcustomnodesusers');
        $insertcustomnodesusers = str_replace('|fa-', '||fa-', $insertcustomnodesusers);
        set_config('insertcustomnodesusers', $insertcustomnodesusers, 'local_boostnavigation');
        unset($insertcustomnodesusers);

        $insertcustomnodesadmins = get_config('local_boostnavigation', 'insertcustomnodesadmins');
        $insertcustomnodesadmins = str_replace('|fa-', '||fa-', $insertcustomnodesadmins);
        set_config('insertcustomnodesadmins', $insertcustomnodesadmins, 'local_boostnavigation');
        unset($insertcustomnodesadmins);

        $insertcustomcoursenodesusers = get_config('local_boostnavigation', 'insertcustomcoursenodesusers');
        $insertcustomcoursenodesusers = str_replace('|fa-', '||fa-', $insertcustomcoursenodesusers);
        set_config('insertcustomcoursenodesusers', $insertcustomcoursenodesusers, 'local_boostnavigation');
        unset($insertcustomcoursenodesusers);

        $insertcustomcoursenodesadmins = get_config('local_boostnavigation', 'insertcustomcoursenodesadmins');
        $insertcustomcoursenodesadmins = str_replace('|fa-', '||fa-', $insertcustomcoursenodesadmins);
        set_config('insertcustomcoursenodesadmins', $insertcustomcoursenodesadmins, 'local_boostnavigation');
        unset($insertcustomcoursenodesadmins);

        $insertcustombottomnodesusers = get_config('local_boostnavigation', 'insertcustombottomnodesusers');
        $insertcustombottomnodesusers = str_replace('|fa-', '||fa-', $insertcustombottomnodesusers);
        set_config('insertcustombottomnodesusers', $insertcustombottomnodesusers, 'local_boostnavigation');
        unset($insertcustombottomnodesusers);

        $insertcustombottomnodesadmins = get_config('local_boostnavigation', 'insertcustombottomnodesadmins');
        $insertcustombottomnodesadmins = str_replace('|fa-', '||fa-', $insertcustombottomnodesadmins);
        set_config('insertcustombottomnodesadmins', $insertcustombottomnodesadmins, 'local_boostnavigation');
        unset($insertcustombottomnodesadmins);

        upgrade_plugin_savepoint(true, 2019031201, 'local', 'boostnavigation');
    }

    return true;
}
