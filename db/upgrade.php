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

    return true;
}
