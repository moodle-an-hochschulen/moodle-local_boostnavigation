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

require_once(__DIR__ . '/lib.php');

if ($hassiteconfig) {
    // Create admin settings category.
    $ADMIN->add('appearance', new admin_category('local_boostnavigation',
            get_string('pluginname', 'local_boostnavigation', null, true)));



    // Create empty settings page structure to make the site administration work on non-admin pages.
    if (!$ADMIN->fulltree) {
        // Settings page: Root nodes.
        $page = new admin_settingpage('local_boostnavigation_rootnodes',
                get_string('settingspage_rootnodes', 'local_boostnavigation', null, true));
        $ADMIN->add('local_boostnavigation', $page);

        // Settings page: Course nodes.
        $page = new admin_settingpage('local_boostnavigation_coursenodes',
                get_string('settingspage_coursenodes', 'local_boostnavigation', null, true));
        $ADMIN->add('local_boostnavigation', $page);

        // Settings page: Bottom nodes.
        $page = new admin_settingpage('local_boostnavigation_bottomnodes',
                get_string('settingspage_bottomnodes', 'local_boostnavigation', null, true));
        $ADMIN->add('local_boostnavigation', $page);
    }


    // Create full settings page structure.
    // @codingStandardsIgnoreLine
    else if ($ADMIN->fulltree) {
        // Settings page: Root nodes.
        $page = new admin_settingpage('local_boostnavigation_rootnodes',
                get_string('settingspage_rootnodes', 'local_boostnavigation', null, true));

        // Add remove nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/removenodesheading',
                get_string('setting_removenodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create remove myhome node control widget (switch label and description depending on what will really happen on the site).
        if (get_config('core', 'defaulthomepage') == HOMEPAGE_SITE) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removehomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removehomenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_MY) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removedashboardnode', 'local_boostnavigation', null, true),
                    get_string('setting_removedashboardnode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_USER) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removefirsthomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removefirsthomenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else { // This should not happen.
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removehomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removehomenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        }

        // Create remove home node control widget (switch label and description depending on what will really happen on the site).
        if (get_config('core', 'defaulthomepage') == HOMEPAGE_SITE) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removedashboardnode', 'local_boostnavigation', null, true),
                    get_string('setting_removedashboardnode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_MY) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removehomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removehomenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_USER) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removesecondhomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removesecondhomenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else { // This should not happen.
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removehomenode', 'local_boostnavigation', null, true),
                    get_string('setting_removehomenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                            get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        }

        // Create remove calendar node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removecalendarnode',
                get_string('setting_removecalendarnode', 'local_boostnavigation', null, true),
                get_string('setting_removecalendarnode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove privatefiles node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removeprivatefilesnode',
                get_string('setting_removeprivatefilesnode', 'local_boostnavigation', null, true),
                get_string('setting_removeprivatefilesnode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove mycourses node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemycoursesnode',
                get_string('setting_removemycoursesnode', 'local_boostnavigation', null, true),
                get_string('setting_removemycoursesnode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_removemycoursesnodeperformancehint', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_removenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Add insert nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/insertnodesheading',
                get_string('setting_insertnodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create insert custom nodes for users widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustomnodesusers',
                get_string('setting_insertcustomnodesusers', 'local_boostnavigation', null, true),
                get_string('setting_insertcustomnodesusers_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_customnodesusageusers', 'local_boostnavigation', null, true).
                        get_string('setting_customnodesusagechildnodes', 'local_boostnavigation', null, true),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Create insert custom nodes for admins widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustomnodesadmins',
                get_string('setting_insertcustomnodesadmins', 'local_boostnavigation', null, true),
                get_string('setting_insertcustomnodesadmins_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_customnodesusageadmins', 'local_boostnavigation', null, true).
                        get_string('setting_customnodesusagechildnodes', 'local_boostnavigation', null, true),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Add collapse nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/collapsenodesheading',
                get_string('setting_collapsenodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create my courses node collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsemycoursesnode',
                get_string('setting_collapsemycoursesnode', 'local_boostnavigation', null, true),
                get_string('setting_collapsemycoursesnode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsemycoursesnodeperformancehint', 'local_boostnavigation', null, true),
                0));

        // Create my courses node collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsemycoursesnodedefault',
                get_string('setting_collapsemycoursesnodedefault', 'local_boostnavigation', null, true),
                get_string('setting_collapsemycoursesnodedefault_desc', 'local_boostnavigation', null, true),
                0));

        // Create custom nodes for users collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesusers',
                get_string('setting_collapsecustomnodesusers', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustomnodesusers_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom nodes for users collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesusersdefault',
                get_string('setting_collapsecustomnodesusersdefault', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustomnodesusersdefault_desc', 'local_boostnavigation', null, true),
                0));

        // Create custom nodes for admins collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesadmins',
                get_string('setting_collapsecustomnodesadmins', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustomnodesadmins_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom nodes for admins collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesadminsdefault',
                get_string('setting_collapsecustomnodesadminsdefault', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustomnodesadminsdefault_desc', 'local_boostnavigation', null, true),
                0));

        // Add settings page to the admin settings category.
        $ADMIN->add('local_boostnavigation', $page);



        // Settings page: Course nodes.
        $page = new admin_settingpage('local_boostnavigation_coursenodes',
                get_string('settingspage_coursenodes', 'local_boostnavigation', null, true));

        // Add remove course nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/removecoursenodesheading',
                get_string('setting_removecoursenodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create remove badges course node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removebadgescoursenode',
                get_string('setting_removebadgescoursenode', 'local_boostnavigation', null, true),
                get_string('setting_removebadgescoursenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_removecoursenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove competencies course node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removecompetenciescoursenode',
                get_string('setting_removecompetenciescoursenode', 'local_boostnavigation', null, true),
                get_string('setting_removecompetenciescoursenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_removecoursenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Add insert course nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/insertcoursenodesheading',
                get_string('setting_insertcoursenodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create insert course sections course node widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/insertcoursesectionscoursenode',
                get_string('setting_insertcoursesectionscoursenode', 'local_boostnavigation', null, true),
                get_string('setting_insertcoursesectionscoursenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_insertcoursesectionscoursenodecorehint', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_insertnodescollapsehint', 'local_boostnavigation', null, true),
                0));

        // Create insert activities course node widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/insertactivitiescoursenode',
                get_string('setting_insertactivitiescoursenode', 'local_boostnavigation', null, true),
                get_string('setting_insertactivitiescoursenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_insertnodescollapsehint', 'local_boostnavigation', null, true),
                0));

        // Create insert resources course node widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/insertresourcescoursenode',
                get_string('setting_insertresourcescoursenode', 'local_boostnavigation', null, true),
                get_string('setting_insertresourcescoursenode_desc', 'local_boostnavigation', null, true),
                0));

        // Create insert custom course nodes for users widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustomcoursenodesusers',
                get_string('setting_insertcustomcoursenodesusers', 'local_boostnavigation', null, true),
                get_string('setting_insertcustomcoursenodesusers_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_customnodesusageusers', 'local_boostnavigation', null, true).
                        get_string('setting_customnodesusagechildnodes', 'local_boostnavigation', null, true),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Create insert custom course nodes for admins widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustomcoursenodesadmins',
                get_string('setting_insertcustomcoursenodesadmins', 'local_boostnavigation', null, true),
                get_string('setting_insertcustomcoursenodesadmins_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_customnodesusageadmins', 'local_boostnavigation', null, true).
                        get_string('setting_customnodesusagechildnodes', 'local_boostnavigation', null, true),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Add collapse course nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/collapsecoursenodesheading',
                get_string('setting_collapsecoursenodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create course sections course node collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecoursesectionscoursenode',
                get_string('setting_collapsecoursesectionscoursenode', 'local_boostnavigation', null, true),
                get_string('setting_collapsecoursesectionscoursenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create course sections course node collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecoursesectionscoursenodedefault',
                get_string('setting_collapsecoursesectionscoursenodedefault', 'local_boostnavigation', null, true),
                get_string('setting_collapsecoursesectionscoursenodedefault_desc', 'local_boostnavigation', null, true),
                0));

        // Create activities course node collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapseactivitiescoursenode',
                get_string('setting_collapseactivitiescoursenode', 'local_boostnavigation', null, true),
                get_string('setting_collapseactivitiescoursenode_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create activities course node collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapseactivitiescoursenodedefault',
                get_string('setting_collapseactivitiescoursenodedefault', 'local_boostnavigation', null, true),
                get_string('setting_collapseactivitiescoursenodedefault_desc', 'local_boostnavigation', null, true),
                1));

        // Create custom course nodes for users collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesusers',
                get_string('setting_collapsecustomcoursenodesusers', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustomcoursenodesusers_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom course nodes for users collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesusersdefault',
                get_string('setting_collapsecustomcoursenodesusersdefault', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustomcoursenodesusersdefault_desc', 'local_boostnavigation', null, true),
                0));

        // Create custom course nodes for admins collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesadmins',
                get_string('setting_collapsecustomcoursenodesadmins', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustomcoursenodesadmins_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom course nodes for admins collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesadminsdefault',
                get_string('setting_collapsecustomcoursenodesadminsdefault', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustomcoursenodesadminsdefault_desc', 'local_boostnavigation', null, true),
                0));

        // Add settings page to the admin settings category.
        $ADMIN->add('local_boostnavigation', $page);


        // Settings page: Bottom nodes.
        $page = new admin_settingpage('local_boostnavigation_bottomnodes',
                get_string('settingspage_bottomnodes', 'local_boostnavigation', null, true));


        // Add insert bottom nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/insertbottomnodesheading',
                get_string('setting_insertbottomnodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create insert custom bottom nodes for users widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustombottomnodesusers',
                get_string('setting_insertcustombottomnodesusers', 'local_boostnavigation', null, true),
                get_string('setting_insertcustombottomnodesusers_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_customnodesusageusers', 'local_boostnavigation', null, true).
                        get_string('setting_customnodesusagechildnodes', 'local_boostnavigation', null, true),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Create insert custom bottom nodes for admins widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustombottomnodesadmins',
                get_string('setting_insertcustombottomnodesadmins', 'local_boostnavigation', null, true),
                get_string('setting_insertcustombottomnodesadmins_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_customnodesusageadmins', 'local_boostnavigation', null, true).
                        get_string('setting_customnodesusagechildnodes', 'local_boostnavigation', null, true),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Add collapse bottom nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/collapsebottomnodesheading',
                get_string('setting_collapsebottomnodesheading', 'local_boostnavigation', null, true),
                ''));

        // Create custom bottom nodes for users collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesusers',
                get_string('setting_collapsecustombottomnodesusers', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustombottomnodesusers_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));
        // Create custom bottom nodes for users collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesusersdefault',
                get_string('setting_collapsecustombottomnodesusersdefault', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustombottomnodesusersdefault_desc', 'local_boostnavigation', null, true),
                0));

        // Create custom bottom nodes for admins collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesadmins',
                get_string('setting_collapsecustombottomnodesadmins', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustombottomnodesadmins_desc', 'local_boostnavigation', null, true).'<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom bottom nodes for admins collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesadminsdefault',
                get_string('setting_collapsecustombottomnodesadminsdefault', 'local_boostnavigation', null, true),
                get_string('setting_collapsecustombottomnodesadminsdefault_desc', 'local_boostnavigation', null, true),
                0));

        // Add settings page to the admin settings category.
        $ADMIN->add('local_boostnavigation', $page);
    }
}
