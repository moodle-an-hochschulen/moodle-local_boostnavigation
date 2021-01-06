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
require_once(__DIR__ . '/locallib.php');

global $CFG;

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

        // Settings page: Mycourses root nodes.
        $page = new admin_settingpage('local_boostnavigation_mycoursesrootnode',
                get_string('settingspage_mycoursesrootnode', 'local_boostnavigation', null, true));
        $ADMIN->add('local_boostnavigation', $page);

        // Settings page: Custom root nodes.
        $page = new admin_settingpage('local_boostnavigation_customrootnodes',
                get_string('settingspage_customrootnodes', 'local_boostnavigation', null, true));
        $ADMIN->add('local_boostnavigation', $page);

        // Settings page: Course nodes.
        $page = new admin_settingpage('local_boostnavigation_coursenodes',
                get_string('settingspage_coursenodes', 'local_boostnavigation', null, true));
        $ADMIN->add('local_boostnavigation', $page);

        // Settings page: Custom course nodes.
        $page = new admin_settingpage('local_boostnavigation_customcoursenodes',
                get_string('settingspage_customcoursenodes', 'local_boostnavigation', null, true));
        $ADMIN->add('local_boostnavigation', $page);

        // Settings page: Custom bottom nodes.
        $page = new admin_settingpage('local_boostnavigation_custombottomnodes',
                get_string('settingspage_custombottomnodes', 'local_boostnavigation', null, true));
        $ADMIN->add('local_boostnavigation', $page);
    }


    // Create full settings page structure.
    // @codingStandardsIgnoreLine
    else if ($ADMIN->fulltree) {
        // Define options which are used multiple times within this plugin's settings.
        $collapseiconoptions = array(
            // Don't use string lazy loading because the string will be directly used
            // and would produce a PHP warning otherwise.
            LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE => get_string('setting_collapsenodeicon_none', 'local_boostnavigation'),
            LOCAL_BOOSTNAVIGATION_COLLAPSEICON_JUSTINDENT => get_string('setting_collapsenodeicon_justindent',
                    'local_boostnavigation'),
            LOCAL_BOOSTNAVIGATION_COLLAPSEICON_YES => get_string('setting_collapsenodeicon_yes', 'local_boostnavigation'),
        );

        // Settings page: Root nodes.
        $page = new admin_settingpage('local_boostnavigation_rootnodes',
                get_string('settingspage_rootnodes', 'local_boostnavigation', null, true));

        // Add remove root nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/removerootnodesheading',
                get_string('setting_removenodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create remove myhome node control widget (switch label and description depending on what will really happen on the site).
        if (get_config('core', 'defaulthomepage') == HOMEPAGE_SITE) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removenode', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('home', 'moodle')),
                            true),
                    get_string('setting_removenode_desc', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('home', 'moodle')),
                            true).
                            '<br /><br />'.
                            get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_MY) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removenode', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('myhome', 'moodle')),
                            true),
                    get_string('setting_removenode_desc', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('myhome', 'moodle')),
                            true).
                            '<br /><br />'.
                            get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_USER) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removenode', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('inc_selectedhomenode', 'local_boostnavigation')),
                            true),
                    get_string('setting_removenode_desc', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('inc_selectedhomenode', 'local_boostnavigation')),
                            true).
                            '<br />'.
                            get_string('setting_removeselectedhomerootnodeexplanation', 'local_boostnavigation', null, true).
                            '<br /><br />'.
                            get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else { // This should not happen.
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemyhomenode',
                    get_string('setting_removenode', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('home', 'moodle')),
                            true),
                    get_string('setting_removenode_desc', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('home', 'moodle')),
                            true).
                            '<br /><br />'.
                            get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        }

        // Create remove home node control widget (switch label and description depending on what will really happen on the site).
        if (get_config('core', 'defaulthomepage') == HOMEPAGE_SITE) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removenode', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('myhome', 'moodle')),
                            true),
                    get_string('setting_removenode_desc', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('myhome', 'moodle')),
                            true).
                            '<br /><br />'.
                            get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_MY) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removenode', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('home', 'moodle')),
                            true),
                    get_string('setting_removenode_desc', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('home', 'moodle')),
                            true).
                            '<br /><br />'.
                            get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else if (get_config('core', 'defaulthomepage') == HOMEPAGE_USER) {
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removenode', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('inc_notselectedhomenode', 'local_boostnavigation')),
                            true),
                    get_string('setting_removenode_desc', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('inc_notselectedhomenode', 'local_boostnavigation')),
                            true).
                            '<br />'.
                            get_string('setting_removenotselectedhomerootnodeexplanation', 'local_boostnavigation', null, true).
                            '<br /><br />'.
                            get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        } else { // This should not happen.
            $page->add(new admin_setting_configcheckbox('local_boostnavigation/removehomenode',
                    get_string('setting_removenode', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('home', 'moodle')),
                            true),
                    get_string('setting_removenode_desc', 'local_boostnavigation',
                            array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                  'which' => get_string('home', 'moodle')),
                            true).
                            '<br /><br />'.
                            get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                    0));
        }

        // Create remove calendar node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removecalendarnode',
                get_string('setting_removenode', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('calendar', 'calendar')),
                        true),
                get_string('setting_removenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('calendar', 'calendar')),
                        true).
                        '<br /><br />'.
                        get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove privatefiles node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removeprivatefilesnode',
                get_string('setting_removenode', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('privatefiles', 'moodle')),
                        true),
                get_string('setting_removenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('privatefiles', 'moodle')),
                        true).
                        '<br /><br />'.
                        get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove contentbank node in course context control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removecontentbankcoursenode',
                get_string('setting_removenodeincoursecontext', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('contentbank', 'contentbank')),
                        true),
                get_string('setting_removenodeincoursecontext_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('contentbank', 'contentbank')),
                        true).
                        '<br /><br />'.
                        get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove contentbank node in non-course context control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removecontentbanknoncoursenode',
                get_string('setting_removenodeinnoncoursecontext', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('contentbank', 'contentbank')),
                        true),
                get_string('setting_removenodeinnoncoursecontext_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('contentbank', 'contentbank')),
                        true).
                        '<br /><br />'.
                        get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Add move root nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/moverootnodesheading',
                get_string('setting_movenodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create move contentbank node in course context control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/movecontentbankcoursenode',
                get_string('setting_movecontentbanknodeincoursecontext', 'local_boostnavigation',
                        array('rootnode' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'contentbank' => get_string('contentbank', 'contentbank')),
                true),
                get_string('setting_movecontentbanknodeincoursecontext_desc', 'local_boostnavigation',
                        array('rootnode' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'contentbank' => get_string('contentbank', 'contentbank')),
                        true).
                '<br /><br />'.
                get_string('setting_movenodestechnicalhint', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/movecontentbankcoursenode',
                'local_boostnavigation/removecontentbankcoursenode', 'checked');

        // Create move contentbank node in course context beforenode control widget.
        $movebeforeoptions = array(
                // Don't use string lazy loading because the string will be directly used
                // and would produce a PHP warning otherwise.
                LOCAL_BOOSTNAVIGATION_MOVEBEFORE_GRADES => get_string('grades', 'moodle'),
                LOCAL_BOOSTNAVIGATION_MOVEBEFORE_BADGES => get_string('badges', 'moodle'),
                LOCAL_BOOSTNAVIGATION_MOVEBEFORE_COMPETENCIES => get_string('competencies', 'core_competency'),
        );
        $page->add(new admin_setting_configselect('local_boostnavigation/movecontentbankcoursenodebefore',
                get_string('setting_movecontentbanknodeincoursecontextbefore', 'local_boostnavigation',
                        array('rootnode' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'coursenode' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'contentbank' => get_string('contentbank', 'contentbank')),
                        true),
                get_string('setting_movecontentbanknodeincoursecontextbefore_desc', 'local_boostnavigation',
                        array('rootnode' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'coursenode' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'contentbank' => get_string('contentbank', 'contentbank')),
                        true),
                LOCAL_BOOSTNAVIGATION_MOVEBEFORE_GRADES,
                $movebeforeoptions));
        unset($movebeforeoptions);
        $page->hide_if('local_boostnavigation/movecontentbankcoursenodebefore',
                'local_boostnavigation/removecontentbankcoursenode', 'checked');
        $page->hide_if('local_boostnavigation/movecontentbankcoursenodebefore',
                'local_boostnavigation/movecontentbankcoursenode', 'notchecked');

        // Add settings page to the admin settings category.
        $ADMIN->add('local_boostnavigation', $page);



        // Settings page: Mycourses root node.
        $page = new admin_settingpage('local_boostnavigation_mycoursesrootnode',
                get_string('settingspage_mycoursesrootnode', 'local_boostnavigation', null, true));

        // Add remove mycourses root node heading.
        $page->add(new admin_setting_heading('local_boostnavigation/removerootnodesheading',
                get_string('setting_removenodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_mycoursesrootnode', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create remove mycourses root node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removemycoursesnode',
                get_string('setting_removenode', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('mycourses', 'moodle')),
                        true),
                get_string('setting_removenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('mycourses', 'moodle')),
                        true).
                        '<br /><br />'.
                        get_string('setting_removerootnodestechnicalhint', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_removemycoursesnodeperformancehint', 'local_boostnavigation',
                                array('url' => $CFG->wwwroot.'/admin/search.php?query=navshowmycoursecategories'),
                                true),
                0));

        // Add modify mycourses root nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/modifymycoursesrootnodeheading',
                get_string('setting_modifynodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_mycoursesrootnode', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create show filtered mycourses root nodes widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/modifymycoursesrootnodeshowfiltered',
                get_string('setting_modifymycoursesrootnodeshowfiltered', 'local_boostnavigation', null, true),
                get_string('setting_modifymycoursesrootnodeshowfiltered_desc', 'local_boostnavigation', null, true).
                '<br /><br />'.
                get_string('setting_modifymycoursesrootnodeshowfilterednavcourselimit', 'local_boostnavigation',
                        array('url' => $CFG->wwwroot.'/admin/search.php?query=navcourselimit'),
                        true).
                '<br /><br />'.
                get_string('setting_collapsemycoursesnodeperformancehint', 'local_boostnavigation',
                        array('url' => $CFG->wwwroot.'/admin/search.php?query=navshowmycoursecategories'),
                        true),
                0));
        $page->hide_if('local_boostnavigation/modifymycoursesrootnodeshowfiltered',
                'local_boostnavigation/removemycoursesnode', 'checked');

        // Create add active filters hint root node widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/modifymycoursesrootnodefilterhint',
                get_string('setting_modifymycoursesrootnodefilterhint', 'local_boostnavigation', null, true),
                get_string('setting_modifymycoursesrootnodefilterhint_desc', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/modifymycoursesrootnodefilterhint',
                'local_boostnavigation/removemycoursesnode', 'checked');

        // Create add change filter link root node widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/modifymycoursesrootnodefilterlink',
                get_string('setting_modifymycoursesrootnodefilterlink', 'local_boostnavigation', null, true),
                get_string('setting_modifymycoursesrootnodefilterlink_desc', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/modifymycoursesrootnodefilterlink',
                'local_boostnavigation/removemycoursesnode', 'checked');
        $page->hide_if('local_boostnavigation/modifymycoursesrootnodefilterlink',
                'local_boostnavigation/modifymycoursesrootnodeshowfiltered', 'notchecked');

        // Add collapse my courses root node heading.
        $page->add(new admin_setting_heading('local_boostnavigation/collapsenodesheading',
                get_string('setting_collapsenodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_mycoursesrootnode', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create my courses root node collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsemycoursesnode',
                get_string('setting_collapsenode', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('mycourses', 'moodle')),
                        true),
                get_string('setting_collapsenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('mycourses', 'moodle')),
                        true).
                        '<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_collapsemycoursesnodeperformancehint', 'local_boostnavigation',
                                array('url' => $CFG->wwwroot.'/admin/search.php?query=navshowmycoursecategories'),
                                true),
                0));
        $page->hide_if('local_boostnavigation/collapsemycoursesnode',
                'local_boostnavigation/removemycoursesnode', 'checked');

        // Create my courses root node collapse icon widget.
        $page->add(new admin_setting_configselect('local_boostnavigation/collapsemycoursesnodeicon',
                get_string('setting_collapsenodeicon', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                'which' => get_string('mycourses', 'moodle')),
                        true),
                get_string('setting_collapsenodeicon_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                                'which' => get_string('mycourses', 'moodle')),
                        true),
                LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE,
                $collapseiconoptions));
        $page->hide_if('local_boostnavigation/collapsemycoursesnodeicon',
                'local_boostnavigation/removemycoursesnode', 'checked');
        $page->hide_if('local_boostnavigation/collapsemycoursesnodeicon',
                'local_boostnavigation/collapsemycoursesnode', 'notchecked');

        // Create my courses root node collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsemycoursesnodedefault',
                get_string('setting_collapsenodedefault', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('mycourses', 'moodle')),
                        true),
                get_string('setting_collapsenodedefault_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('mycourses', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodesdefaultexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsemycoursesnodedefault',
                'local_boostnavigation/removemycoursesnode', 'checked');
        $page->hide_if('local_boostnavigation/collapsemycoursesnodedefault',
                'local_boostnavigation/collapsemycoursesnode', 'notchecked');

        // Create my courses root node collapse session widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsemycoursesnodesession',
                get_string('setting_collapsenodesession', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('mycourses', 'moodle')),
                        true),
                get_string('setting_collapsenodesession_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_rootnode', 'local_boostnavigation', null, true),
                              'which' => get_string('mycourses', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodessessionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsemycoursesnodesession',
                'local_boostnavigation/removemycoursesnode', 'checked');
        $page->hide_if('local_boostnavigation/collapsemycoursesnodesession',
                'local_boostnavigation/collapsemycoursesnode', 'notchecked');

        // Add settings page to the admin settings category.
        $ADMIN->add('local_boostnavigation', $page);



        // Settings page: Custom root nodes.
        $page = new admin_settingpage('local_boostnavigation_customrootnodes',
                get_string('settingspage_customrootnodes', 'local_boostnavigation', null, true));

        // Add insert custom root nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/insertcustomnodesheading',
                get_string('setting_insertnodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create insert custom root nodes for users widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustomnodesusers',
                get_string('setting_insertcustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_insertcustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'where' => get_string('inc_rootnodeslocation', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        local_boostnavigation_customnodesusageusers(),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Create insert custom root nodes for admins widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustomnodesadmins',
                get_string('setting_insertcustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_insertcustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'where' => get_string('inc_rootnodeslocation', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        local_boostnavigation_customnodesusageadmins(),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Add collapse custom root nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/collapsecustomnodesheading',
                get_string('setting_collapsenodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create custom root nodes for users collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesusers',
                get_string('setting_collapsecustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom root nodes for users collapase icon widget.
        $page->add(new admin_setting_configselect('local_boostnavigation/collapsecustomnodesusersicon',
                get_string('setting_collapsecustomnodesicon', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesicon_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE,
                $collapseiconoptions));
        $page->hide_if('local_boostnavigation/collapsecustomnodesusersicon',
                'local_boostnavigation/collapsecustomnodesusers', 'notchecked');

        // Create custom root nodes for users collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesusersdefault',
                get_string('setting_collapsecustomnodesdefault', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesdefault_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                         get_string('setting_collapsenodesdefaultexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomnodesusersdefault',
                'local_boostnavigation/collapsecustomnodesusers', 'notchecked');

        // Create custom root nodes for users collapse session widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesuserssession',
                get_string('setting_collapsecustomnodessession', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodessession_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodessessionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomnodesuserssession',
                'local_boostnavigation/collapsecustomnodesusers', 'notchecked');

        // Create custom root nodes for users collapse accordion widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesusersaccordion',
                get_string('setting_collapsecustomnodesaccordion', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesaccordion_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodeaccordionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomnodesusersaccordion',
                'local_boostnavigation/collapsecustomnodesusers', 'notchecked');

        // Create custom root nodes for admins collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesadmins',
                get_string('setting_collapsecustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom root nodes for admins collapse icon widget.
        $page->add(new admin_setting_configselect('local_boostnavigation/collapsecustomnodesadminsicon',
                get_string('setting_collapsecustomnodesicon', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesicon_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE,
                $collapseiconoptions));
        $page->hide_if('local_boostnavigation/collapsecustomnodesadminsicon',
                'local_boostnavigation/collapsecustomnodesadmins', 'notchecked');

        // Create custom root nodes for admins collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesadminsdefault',
                get_string('setting_collapsecustomnodesdefault', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesdefault_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodesdefaultexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomnodesadminsdefault',
                'local_boostnavigation/collapsecustomnodesadmins', 'notchecked');

        // Create custom root nodes for admins collapse session widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesadminssession',
                get_string('setting_collapsecustomnodessession', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodessession_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodessessionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomnodesadminssession',
                'local_boostnavigation/collapsecustomnodesadmins', 'notchecked');

        // Create custom root nodes for admins collapse accordion widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomnodesadminsaccordion',
                get_string('setting_collapsecustomnodesaccordion', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesaccordion_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customrootnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodeaccordionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomnodesadminsaccordion',
                'local_boostnavigation/collapsecustomnodesadmins', 'notchecked');

        // Add settings page to the admin settings category.
        $ADMIN->add('local_boostnavigation', $page);



        // Settings page: Course nodes.
        $page = new admin_settingpage('local_boostnavigation_coursenodes',
                get_string('settingspage_coursenodes', 'local_boostnavigation', null, true));

        // Add remove course nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/removecoursenodesheading',
                get_string('setting_removenodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create remove badges course node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removebadgescoursenode',
                get_string('setting_removenode', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('badges', 'moodle')),
                        true),
                get_string('setting_removenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('badges', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_removebadgescoursenodeexplanation', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_removecoursenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove competencies course node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removecompetenciescoursenode',
                get_string('setting_removenode', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('competencies', 'core_competency')),
                        true),
                get_string('setting_removenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('competencies', 'core_competency')),
                        true).
                        '<br />'.
                        get_string('setting_removecompetenciescoursenodeexplanation', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_removecoursenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove grades course node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removegradescoursenode',
                get_string('setting_removenode', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('grades', 'moodle')),
                        true),
                get_string('setting_removenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('grades', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_removegradescoursenodeexplanation', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_removecoursenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create remove participants course node control widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/removeparticipantscoursenode',
                get_string('setting_removenode', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('participants', 'moodle')),
                        true),
                get_string('setting_removenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('participants', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_removeparticipantscoursenodeexplanation', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_removecoursenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Add insert course nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/insertcoursenodesheading',
                get_string('setting_insertnodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create insert course sections course node widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/insertcoursesectionscoursenode',
                get_string('setting_insertnode', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('sections', 'moodle')),
                        true),
                get_string('setting_insertnode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('sections', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_insertcoursesectionscoursenodeexplanation', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_insertcoursesectionscoursenodecorehint', 'local_boostnavigation',
                                array('url' => $CFG->wwwroot.'/admin/search.php?query=linkcoursesections'),
                                true).
                        '<br /><br />'.
                        get_string('setting_insertnodescollapsehint', 'local_boostnavigation', null, true),
                0));

        // Create insert activities course node widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/insertactivitiescoursenode',
                get_string('setting_insertnode', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('activities', 'moodle')),
                        true),
                get_string('setting_insertnode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('activities', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_insertactivitiescoursenodeexplanation', 'local_boostnavigation', null, true).
                        '<br /><br />'.
                        get_string('setting_insertnodescollapsehint', 'local_boostnavigation', null, true),
                0));

        // Create insert activities course node real icons widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/insertactivitiescoursenoderealicons',
                get_string('setting_insertactivitiescoursenoderealicons', 'local_boostnavigation', null, true),
                get_string('setting_insertactivitiescoursenoderealicons_desc', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/insertactivitiescoursenoderealicons',
                'local_boostnavigation/insertactivitiescoursenode', 'notchecked');

        // Create insert resources course node widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/insertresourcescoursenode',
                get_string('setting_insertnode', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('resources')),
                        true),
                get_string('setting_insertnode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('resources')),
                        true).
                        '<br />'.
                        get_string('setting_insertresourcescoursenodeexplanation', 'local_boostnavigation', null, true),
                0));

        // Add collapse course nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/collapsecoursenodesheading',
                get_string('setting_collapsenodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create course sections course node collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecoursesectionscoursenode',
                get_string('setting_collapsenode', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('sections', 'moodle')),
                        true),
                get_string('setting_collapsenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('sections', 'moodle')),
                        true).
                        '<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecoursesectionscoursenode',
                'local_boostnavigation/insertcoursesectionscoursenode', 'notchecked');

        // Create course sections course node collapse icon widget.
        $page->add(new admin_setting_configselect('local_boostnavigation/collapsecoursesectionscoursenodeicon',
                get_string('setting_collapsenodeicon', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                                'which' => get_string('sections', 'moodle')),
                        true),
                get_string('setting_collapsenodeicon_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                                'which' => get_string('sections', 'moodle')),
                        true),
                LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE,
                $collapseiconoptions));
        $page->hide_if('local_boostnavigation/collapsecoursesectionscoursenodeicon',
                'local_boostnavigation/collapsecoursesectionscoursenode', 'notchecked');

        // Create course sections course node collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecoursesectionscoursenodedefault',
                get_string('setting_collapsenodedefault', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('sections', 'moodle')),
                        true),
                get_string('setting_collapsenodedefault_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('sections', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodesdefaultexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecoursesectionscoursenodedefault',
                'local_boostnavigation/insertcoursesectionscoursenode', 'notchecked');
        $page->hide_if('local_boostnavigation/collapsecoursesectionscoursenodedefault',
                'local_boostnavigation/collapsecoursesectionscoursenode', 'notchecked');

        // Create course sections course node collapse session widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecoursesectionscoursenodesession',
                get_string('setting_collapsenodesession', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('sections', 'moodle')),
                        true),
                get_string('setting_collapsenodesession_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('sections', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodessessionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecoursesectionscoursenodesession',
                'local_boostnavigation/insertcoursesectionscoursenode', 'notchecked');
        $page->hide_if('local_boostnavigation/collapsecoursesectionscoursenodesession',
                'local_boostnavigation/collapsecoursesectionscoursenode', 'notchecked');

        // Create activities course node collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapseactivitiescoursenode',
                get_string('setting_collapsenode', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('activities', 'moodle')),
                        true),
                get_string('setting_collapsenode_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('activities', 'moodle')),
                        true).
                        '<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapseactivitiescoursenode',
                'local_boostnavigation/insertactivitiescoursenode', 'notchecked');

        // Create activities course node collapse icon widget.
        $page->add(new admin_setting_configselect('local_boostnavigation/collapseactivitiescoursenodeicon',
                get_string('setting_collapsenodeicon', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                                'which' => get_string('activities', 'moodle')),
                        true),
                get_string('setting_collapsenodeicon_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                                'which' => get_string('activities', 'moodle')),
                        true),
                LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE,
                $collapseiconoptions));
        $page->hide_if('local_boostnavigation/collapseactivitiescoursenodeicon',
                'local_boostnavigation/collapseactivitiescoursenode', 'notchecked');

        // Create activities course node collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapseactivitiescoursenodedefault',
                get_string('setting_collapsenodedefault', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('activities', 'moodle')),
                        true),
                get_string('setting_collapsenodedefault_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('activities', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodesdefaultexplanation', 'local_boostnavigation', null, true),
                1));
        $page->hide_if('local_boostnavigation/collapseactivitiescoursenodedefault',
                'local_boostnavigation/insertactivitiescoursenode', 'notchecked');
        $page->hide_if('local_boostnavigation/collapseactivitiescoursenodedefault',
                'local_boostnavigation/collapseactivitiescoursenode', 'notchecked');

        // Create activities course node collapse session widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapseactivitiescoursenodesession',
                get_string('setting_collapsenodesession', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('activities', 'moodle')),
                        true),
                get_string('setting_collapsenodesession_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_coursenode', 'local_boostnavigation', null, true),
                              'which' => get_string('activities', 'moodle')),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodessessionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapseactivitiescoursenodesession',
                'local_boostnavigation/insertactivitiescoursenode', 'notchecked');
        $page->hide_if('local_boostnavigation/collapseactivitiescoursenodesession',
                'local_boostnavigation/collapseactivitiescoursenode', 'notchecked');

        // Add settings page to the admin settings category.
        $ADMIN->add('local_boostnavigation', $page);



        // Settings page: Custom course nodes.
        $page = new admin_settingpage('local_boostnavigation_customcoursenodes',
                get_string('settingspage_customcoursenodes', 'local_boostnavigation', null, true));

        // Add insert custom course nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/insertcustomcoursenodesheading',
                get_string('setting_insertnodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create insert custom course nodes for users widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustomcoursenodesusers',
                get_string('setting_insertcustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_insertcustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'where' => get_string('inc_coursenodeslocation', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        local_boostnavigation_customnodesusageusers(),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Create insert custom course nodes for admins widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustomcoursenodesadmins',
                get_string('setting_insertcustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_insertcustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'where' => get_string('inc_coursenodeslocation', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        local_boostnavigation_customnodesusageadmins(),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Add collapse custom course nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/collapsecustomcoursenodesheading',
                get_string('setting_collapsenodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create custom course nodes for users collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesusers',
                get_string('setting_collapsecustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom course nodes for users collapse icon widget.
        $page->add(new admin_setting_configselect('local_boostnavigation/collapsecustomcoursenodesusersicon',
                get_string('setting_collapsecustomnodesicon', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhousers', 'local_boostnavigation')),
                        true),
                get_string('setting_collapsecustomnodesicon_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhousers', 'local_boostnavigation')),
                        true),
                LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE,
                $collapseiconoptions));
        $page->hide_if('local_boostnavigation/collapsecustomcoursenodesusersicon',
                'local_boostnavigation/collapsecustomcoursenodesusers', 'notchecked');

        // Create custom course nodes for users collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesusersdefault',
                get_string('setting_collapsecustomnodesdefault', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesdefault_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodesdefaultexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomcoursenodesusersdefault',
                'local_boostnavigation/collapsecustomcoursenodesusers', 'notchecked');

        // Create custom course nodes for users collapse session widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesuserssession',
                get_string('setting_collapsecustomnodessession', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodessession_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodessessionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomcoursenodesuserssession',
                'local_boostnavigation/collapsecustomcoursenodesusers', 'notchecked');

        // Create custom course nodes for users collapse accordion widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesusersaccordion',
                get_string('setting_collapsecustomnodesaccordion', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesaccordion_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodeaccordionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomcoursenodesusersaccordion',
                'local_boostnavigation/collapsecustomcoursenodesusers', 'notchecked');

        // Create custom course nodes for admins collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesadmins',
                get_string('setting_collapsecustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom course nodes for admins collapse icon widget.
        $page->add(new admin_setting_configselect('local_boostnavigation/collapsecustomcoursenodesadminsicon',
                get_string('setting_collapsecustomnodesicon', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesicon_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE,
                $collapseiconoptions));
        $page->hide_if('local_boostnavigation/collapsecustomcoursenodesadminsicon',
                'local_boostnavigation/collapsecustomcoursenodesadmins', 'notchecked');

        // Create custom course nodes for admins collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesadminsdefault',
                get_string('setting_collapsecustomnodesdefault', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesdefault_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodesdefaultexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomcoursenodesadminsdefault',
                'local_boostnavigation/collapsecustomcoursenodesadmins', 'notchecked');

        // Create custom course nodes for admins collapse session widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesadminssession',
                get_string('setting_collapsecustomnodessession', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodessession_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodessessionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomcoursenodesadminssession',
                'local_boostnavigation/collapsecustomcoursenodesadmins', 'notchecked');

        // Create custom course nodes for admins collapse accordion widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustomcoursenodesadminsaccordion',
                get_string('setting_collapsecustomnodesaccordion', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesaccordion_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_customcoursenodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodeaccordionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustomcoursenodesadminsaccordion',
                'local_boostnavigation/collapsecustomcoursenodesadmins', 'notchecked');

        // Add settings page to the admin settings category.
        $ADMIN->add('local_boostnavigation', $page);


        // Settings page: Custom bottom nodes.
        $page = new admin_settingpage('local_boostnavigation_custombottomnodes',
                get_string('settingspage_custombottomnodes', 'local_boostnavigation', null, true));


        // Add insert custom bottom nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/insertcustombottomnodesheading',
                get_string('setting_insertnodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create insert custom bottom nodes for users widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustombottomnodesusers',
                get_string('setting_insertcustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_insertcustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'where' => get_string('inc_bottomnodeslocation', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        local_boostnavigation_customnodesusageusers(),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Create insert custom bottom nodes for admins widget.
        $setting = new admin_setting_configtextarea('local_boostnavigation/insertcustombottomnodesadmins',
                get_string('setting_insertcustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_insertcustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'where' => get_string('inc_bottomnodeslocation', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        local_boostnavigation_customnodesusageadmins(),
                '',
                PARAM_RAW);
        $setting->set_updatedcallback('local_boostnavigation_reset_fontawesome_icon_map');
        $page->add($setting);

        // Add collapse custom bottom nodes heading.
        $page->add(new admin_setting_heading('local_boostnavigation/collapsecustombottomnodesheading',
                get_string('setting_collapsenodesheading', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true)),
                        true),
                ''));

        // Create custom bottom nodes for users collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesusers',
                get_string('setting_collapsecustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom bottom nodes for users collapse icon widget.
        $page->add(new admin_setting_configselect('local_boostnavigation/collapsecustombottomnodesusersicon',
                get_string('setting_collapsecustomnodesicon', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesicon_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE,
                $collapseiconoptions));
        $page->hide_if('local_boostnavigation/collapsecustombottomnodesusersicon',
                'local_boostnavigation/collapsecustombottomnodesusers', 'notchecked');

        // Create custom bottom nodes for users collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesusersdefault',
                get_string('setting_collapsecustomnodesdefault', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesdefault_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodesdefaultexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustombottomnodesusersdefault',
                'local_boostnavigation/collapsecustombottomnodesusers', 'notchecked');

        // Create custom bottom nodes for users collapse session widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesuserssession',
                get_string('setting_collapsecustomnodessession', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodessession_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodessessionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustombottomnodesuserssession',
                'local_boostnavigation/collapsecustombottomnodesusers', 'notchecked');

        // Create custom bottom nodes for users collapse accordion widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesusersaccordion',
                get_string('setting_collapsecustomnodesaccordion', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesaccordion_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhousers', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodeaccordionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustombottomnodesusersaccordion',
                'local_boostnavigation/collapsecustombottomnodesusers', 'notchecked');

        // Create custom bottom nodes for admins collapse widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesadmins',
                get_string('setting_collapsecustomnodes', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodes_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br /><br />'.
                        get_string('setting_collapsenodestechnicalhint', 'local_boostnavigation', null, true),
                0));

        // Create custom bottom nodes for admins collapse icon widget.
        $page->add(new admin_setting_configselect('local_boostnavigation/collapsecustombottomnodesadminsicon',
                get_string('setting_collapsecustomnodesicon', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesicon_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                                'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                LOCAL_BOOSTNAVIGATION_COLLAPSEICON_NONE,
                $collapseiconoptions));
        $page->hide_if('local_boostnavigation/collapsecustombottomnodesadminsicon',
                'local_boostnavigation/collapsecustombottomnodesadmins', 'notchecked');

        // Create custom bottom nodes for admins collapse default widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesadminsdefault',
                get_string('setting_collapsecustomnodesdefault', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesdefault_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodesdefaultexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustombottomnodesadminsdefault',
                'local_boostnavigation/collapsecustombottomnodesadmins', 'notchecked');

        // Create custom bottom nodes for admins collapse session widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesadminssession',
                get_string('setting_collapsecustomnodessession', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodessession_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodessessionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustombottomnodesadminssession',
                'local_boostnavigation/collapsecustombottomnodesadmins', 'notchecked');

        // Create custom bottom nodes for admins collapse accordion widget.
        $page->add(new admin_setting_configcheckbox('local_boostnavigation/collapsecustombottomnodesadminsaccordion',
                get_string('setting_collapsecustomnodesaccordion', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true),
                get_string('setting_collapsecustomnodesaccordion_desc', 'local_boostnavigation',
                        array('what' => get_string('inc_custombottomnodes', 'local_boostnavigation', null, true),
                              'who' => get_string('inc_customwhoadmins', 'local_boostnavigation', null, true)),
                        true).
                        '<br />'.
                        get_string('setting_collapsenodeaccordionexplanation', 'local_boostnavigation', null, true),
                0));
        $page->hide_if('local_boostnavigation/collapsecustombottomnodesadminsaccordion',
                'local_boostnavigation/collapsecustombottomnodesadmins', 'notchecked');

        // Add settings page to the admin settings category.
        $ADMIN->add('local_boostnavigation', $page);
    }
}
