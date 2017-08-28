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
 * Local plugin "Boost navigation fumbling" - Settings
 *
 * @package    local_boostnavigation
 * @copyright  2017 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__) . '/lib.php');

if ($hassiteconfig) {
    // New settings page.
    $page = new admin_settingpage('local_boostnavigation',
            get_string('pluginname', 'local_boostnavigation', null, true));


    if ($ADMIN->fulltree) {
        // Add remove nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/removenodesheading',
                get_string('setting_removenodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create remove myhome node control widget (switch label and description depending on what will really happen on the site).
        if (get_config('core', 'defaulthomepage') == HOMEPAGE_SITE) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removehomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removehomenode_desc', 'local_boostnavigation', null, true).'<br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_MY) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removedashboardnode', 'local_boostnavigation', null, true),
                    get_string('setting_removedashboardnode_desc', 'local_boostnavigation', null, true).'<br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_USER) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removefirsthomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removefirsthomenode_desc', 'local_boostnavigation', null, true).'<br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else { // This should not happen.
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removehomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removehomenode_desc', 'local_boostnavigation', null, true).'<br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        }

        // Create remove home node control widget (switch label and description depending on what will really happen on the site).
        if (get_config('core', 'defaulthomepage') == HOMEPAGE_SITE) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removedashboardnode', 'local_boostnavigation', null, true),
                    get_string('setting_removedashboardnode_desc', 'local_boostnavigation', null, true).'<br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_MY) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removehomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removehomenode_desc', 'local_boostnavigation', null, true).'<br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_USER) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removesecondhomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removesecondhomenode_desc', 'local_boostnavigation', null, true).'<br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else { // This should not happen.
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removehomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removehomenode_desc', 'local_boostnavigation', null, true).'<br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        }

        // Create remove calendar node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removecalendarnode',
                get_string('setting_removecalendarnode', 'local_boostnavigation', null, true),
                get_string('setting_removecalendarnode_desc', 'local_boostnavigation', null, true).'<br />'.
                        get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove privatefiles node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removeprivatefilesnode',
                get_string('setting_removeprivatefilesnode', 'local_boostnavigation', null, true),
                get_string('setting_removeprivatefilesnode_desc', 'local_boostnavigation', null, true).'<br />'.
                        get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove mycourses node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemycoursesnode',
                get_string('setting_removemycoursesnode', 'local_boostnavigation', null, true),
                get_string('setting_removemycoursesnode_desc', 'local_boostnavigation', null, true).'<br />'.
                        get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true).'<br />'.
                        get_string('setting_removemycoursesnodeperformancehint', 'local_boostnavigation', null, true),
                0));

        // Add collapse nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/collapsenodesheading',
                get_string('setting_collapsenodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create my courses node collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsemycoursesnode',
                get_string('setting_collapsemycoursesnode', 'local_boostnavigation', null, true),
                get_string('setting_collapsemycoursesnode_desc', 'local_boostnavigation', null, true).'<br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true).'<br />'.
                        get_string('setting_collapsemycoursesnodeperformancehint', 'local_boostnavigation', null, true).'<br />'.
                        '<strong>'.get_string('setting_collapsenodestemplatehint', 'local_boostnavigation', null, true).'</strong>',
                0));
    }

    // Add settings page to the appearance settings category.
    $ADMIN->add('appearance', $page);
}
