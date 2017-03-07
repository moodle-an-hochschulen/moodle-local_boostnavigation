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
 * Local plugin "Boost navdrawer fumbling" - Settings
 *
 * @package    local_boost_navdrawerfumbling
 * @copyright  2017 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__) . '/lib.php');

if ($hassiteconfig) {
    // New settings page.
    $page = new admin_settingpage('local_boost_navdrawerfumbling',
            get_string('pluginname', 'local_boost_navdrawerfumbling', null, true));


    if ($ADMIN->fulltree) {
        // Add remove nodes heading.
        $page->add(new admin_setting_heading('local_boost_navdrawerfumbling/removenodesheading',
                get_string('setting_removenodesheading', 'local_boost_navdrawerfumbling', null, true),
                get_string('setting_removenodesheading_desc', 'local_boost_navdrawerfumbling', null, true)));

        // Create remove home node control widget (switch label and description depending on what will really happen on the site).
        if (get_config('core', 'defaulthomepage') == HOMEPAGE_SITE) {
            $page->add(new admin_setting_configcheckbox('local_boost_navdrawerfumbling/removehomenode',
                    get_string('setting_removedashboardnode', 'local_boost_navdrawerfumbling', null, true),
                    get_string('setting_removedashboardnode_desc', 'local_boost_navdrawerfumbling', null, true), 0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_MY) {
            $page->add(new admin_setting_configcheckbox('local_boost_navdrawerfumbling/removehomenode',
                    get_string('setting_removehomenode', 'local_boost_navdrawerfumbling', null, true),
                    get_string('setting_removehomenode_desc', 'local_boost_navdrawerfumbling', null, true), 0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_USER) {
            $page->add(new admin_setting_configcheckbox('local_boost_navdrawerfumbling/removesecondhomenode',
                    get_string('setting_removesecondhomenode', 'local_boost_navdrawerfumbling', null, true),
                    get_string('setting_removesecondhomenode_desc', 'local_boost_navdrawerfumbling', null, true), 0));
        } else { // This should not happen.
            $page->add(new admin_setting_configcheckbox('local_boost_navdrawerfumbling/removehomenode',
                    get_string('setting_removehomenode', 'local_boost_navdrawerfumbling', null, true),
                    get_string('setting_removehomenode_desc', 'local_boost_navdrawerfumbling', null, true), 0));
        }

        // Create remove calendar node control widget.
        $page->add(new admin_setting_configcheckbox('local_boost_navdrawerfumbling/removecalendarnode',
                get_string('setting_removecalendarnode', 'local_boost_navdrawerfumbling', null, true),
                get_string('setting_removecalendarnode_desc', 'local_boost_navdrawerfumbling', null, true), 0));

        // Create remove privatefiles node control widget.
        $page->add(new admin_setting_configcheckbox('local_boost_navdrawerfumbling/removeprivatefilesnode',
                get_string('setting_removeprivatefilesnode', 'local_boost_navdrawerfumbling', null, true),
                get_string('setting_removeprivatefilesnode_desc', 'local_boost_navdrawerfumbling', null, true), 0));

        // Create remove mycourses node control widget.
        $page->add(new admin_setting_configcheckbox('local_boost_navdrawerfumbling/removemycoursesnode',
                get_string('setting_removemycoursesnode', 'local_boost_navdrawerfumbling', null, true),
                get_string('setting_removemycoursesnode_desc', 'local_boost_navdrawerfumbling', null, true), 0));


        // Add current course presentation heading.
        $page->add(new admin_setting_heading('local_boost_navdrawerfumbling/currentcoursepresentationheading',
                get_string('setting_currentcoursepresentation', 'local_boost_navdrawerfumbling', null, true),
                ''));

        // Create current course fullname control widget.
        $page->add(new admin_setting_configcheckbox('local_boost_navdrawerfumbling/currentcoursefullname',
                get_string('setting_currentcoursefullname', 'local_boost_navdrawerfumbling', null, true),
                get_string('setting_currentcoursefullname_desc', 'local_boost_navdrawerfumbling', null, true), 0));
    }


    // Add settings page to the appearance settings category.
    $ADMIN->add('appearance', $page);
}
