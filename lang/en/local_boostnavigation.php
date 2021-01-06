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
 * Local plugin "Boost navigation fumbling" - Language pack
 *
 * @package    local_boostnavigation
 * @copyright  2017 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Boost navigation fumbling';
$string['inc_bottomnodes'] = 'bottom nodes';
$string['inc_bottomnodeslocation'] = 'below the main section in the nav drawer (similar to the "site administration" node)';
$string['inc_coursenode'] = 'course node';
$string['inc_coursenodes'] = 'course nodes';
$string['inc_coursenodeslocation'] = 'to the course section in the nav drawer (where the nodes for the course topics are located)';
$string['inc_custombottomnodes'] = 'custom bottom nodes';
$string['inc_customcoursenodes'] = 'custom course nodes';
$string['inc_customrootnodes'] = 'custom root nodes';
$string['inc_customwhousers'] = 'all users';
$string['inc_customwhoadmins'] = 'admins';
$string['inc_mycoursesrootnode'] = 'my courses root node';
$string['inc_notselectedhomenode'] = 'not selected Home / Dashboard';
$string['inc_rootnode'] = 'root node';
$string['inc_rootnodes'] = 'root nodes';
$string['inc_rootnodeslocation'] = 'to the main section in the nav drawer (where the "My courses" node and others are located)';
$string['inc_selectedhomenode'] = 'selected Home / Dashboard';
$string['mycoursesrootnodefilterhintenabledcurrentfilter'] = 'Current course filter:';
$string['mycoursesrootnodefilterhintenabledcourselist'] = 'Course list filtered by:';
$string['mycoursesrootnodefilterlink'] = 'Change filter';
$string['privacy:metadata:preference:collapse'] = 'The collapse status of a navigation node in the nav drawer.';
$string['privacy:request:preference:collapse'] = 'The collapse status of the navigation node "{$a->nodename}" in the nav drawer is {$a->collapse}';
$string['setting_collapsecustomnodes'] = 'Collapse {$a->what} for {$a->who}';
$string['setting_collapsecustomnodes_desc'] = 'Enabling this setting will let users collapse the {$a->what} for {$a->who}.<br /><em>This setting is only processed when the corresponding custom node setting has at least one custom node with at least one child node added.</em>';
$string['setting_collapsecustomnodesicon'] = 'Display parent node icons in {$a->what} for {$a->who}';
$string['setting_collapsecustomnodesicon_desc'] = 'With this setting, you control if parent node icons will be displayed in the {$a->what} for {$a->who} and / or if the parent nodes will be indented.';
$string['setting_collapsecustomnodesaccordion'] = 'Collapse {$a->what} for {$a->who} as accordion';
$string['setting_collapsecustomnodesaccordion_desc'] = 'Enabling this setting will collapse the {$a->what} for {$a->who} as accordion.';
$string['setting_collapsecustomnodesdefault'] = 'Collapse {$a->what} for {$a->who} by default';
$string['setting_collapsecustomnodesdefault_desc'] = 'Enabling this setting will collapse the {$a->what} for {$a->who} by default.';
$string['setting_collapsecustomnodessession'] = 'Remember collapse status of {$a->what} for {$a->who} for current session only';
$string['setting_collapsecustomnodessession_desc'] = 'Enabling this setting will remember the collapse status of the {$a->what} for {$a->who} only for a user\'s current session.';
$string['setting_collapsemycoursesnodeperformancehint'] = 'Please note: This feature will only work if the setting <a href="{$a->url}">navshowmycoursecategories</a> is not active. If you enabled navshowmycoursecategories, this setting will be ignored and won\'t do anything.';
$string['setting_collapsenode'] = 'Collapse {$a->what} "{$a->which}"';
$string['setting_collapsenode_desc'] = 'Enabling this setting will let users collapse the {$a->what} "{$a->which}".';
$string['setting_collapsenodedefault'] = 'Collapse {$a->what} "{$a->which}" by default';
$string['setting_collapsenodedefault_desc'] = 'Enabling this setting will collapse the {$a->what} "{$a->which}" by default.';
$string['setting_collapsenodeicon'] = 'Display parent node icon in {$a->what} "{$a->which}"';
$string['setting_collapsenodeicon_desc'] = 'With this setting, you control if a parent node icon will be displayed in the {$a->what} "{$a->which}" and / or if this parent node will be indented.';
$string['setting_collapsenodeicon_justindent'] = 'Don\'t display an icon, but indent the collapsible parent node';
$string['setting_collapsenodeicon_none'] = 'Don\'t display an icon and don\'t indent the collapsible parent node';
$string['setting_collapsenodeicon_yes'] = 'Display an icon and indent the collapsible parent node';
$string['setting_collapsenodeaccordionexplanation'] = 'This means that only one parent node can be expanded at a time. If a second parent node is expanded, the currently expanded parent node is collapsed automatically. If this setting is disabled, multiple parent nodes can be expanded at a time.';
$string['setting_collapsenodesdefaultexplanation'] = 'Otherwise, they will be expanded by default. This setting just controls the default for each user when the nodes are rendered for him for the first time.';
$string['setting_collapsenodesession'] = 'Remember collapse status of {$a->what} "{$a->which}" for current session only';
$string['setting_collapsenodesession_desc'] = 'Enabling this setting will remember the collapse status of the {$a->what} "{$a->which}" only for a user\'s current session.';
$string['setting_collapsenodesheading'] = 'Collapse {$a->what} in Boost\'s nav drawer';
$string['setting_collapsenodessessionexplanation'] = 'After the next logout and login of a particular user, the collapse status will be reset to the value which is defined as default above. If this setting is disabled, the collapse status for these nodes will be remembered beyond the end of a user\'s session.';
$string['setting_collapsenodestechnicalhint'] = 'Technical background: This is done by adding some JavaScript and CSS code to the page which will show or hide the second-level nodes as soon as the user clicks on the node. The collapse status of the node will be processed in each user\'s session and stored in each user\'s user preferences. Thus, the nodes will only be hidden from the nav drawer at runtime, but they will remain in the navigation tree and can still be accessed by other parts of Moodle.';
$string['setting_customnodesusageadminsexample'] = 'Moodle.org website|http://www.moodle.org|en,de<br />
List of Moodle users|/admin/user.php';
$string['setting_customnodesusageadminsintro'] = 'Each line consists of a link title, a link URL and supported language(s) (optional) - separated by pipe characters. Each custom node needs to be written in a new line.';
$string['setting_customnodesusageadminsparameternote'] = 'Custom nodes for admins are processed by the same function as custom nodes for users are. Thus, in addition to the parameters which are given above, the same list of parameters that custom nodes for users support are also supported here. Feel free to use them here if you really need them for any special scenario even if they are not documented here once more for the sake of simplicity.';
$string['setting_customnodesusagechildnodes'] = 'Custom nodes can be nested with one hierarchy level, i.e. a custom node can have children nodes. The create a child node instead of a parent node, just prefix the custom node title with a hyphen.';
$string['setting_customnodesusagechildnodesexample'] = 'Administration|/admin/index.php<br />
-List of Moodle users|/admin/user.php<br />
-Manage courses|/course/management.php';
$string['setting_customnodesusagechildnodespleasenoteurl'] = 'For technical reasons, a parent node always needs a valid URL, even if the node will be made collapsible afterwards.';
$string['setting_customnodesusagechildnodespleasenoterecursive'] = 'If a parent node is not shown because a (language, cohort, role...) restriction applies, its children nodes also won\'t be shown.';
$string['setting_customnodesusageexamples'] = 'Examples:';
$string['setting_customnodesusageparameters'] = 'Further information to the parameters:';
$string['setting_customnodesusageparametertitledt'] = 'Title:';
$string['setting_customnodesusageparametertitledd'] = 'This text will be shown as the clickable text / label of the custom node.';
$string['setting_customnodesusageparameterlinkdt'] = 'Link:';
$string['setting_customnodesusageparameterlinkdd'] = 'The link target can be defined by a full web URL (e.g. https://moodle.org) or a relative path within your Moodle instance (e.g. /login/logout.php).';
$string['setting_customnodesusageparameterlanguagedt'] = 'Supported language(s) (optional):';
$string['setting_customnodesusageparameterlanguagedd'] = 'This setting can be used for displaying the custom node to users of the specified language only. Separate more than one supported language with commas. If the custom node should be displayed in all languages, then leave this field empty.';
$string['setting_customnodesusageparametercohortdt'] = 'Supported cohort(s) (optional):';
$string['setting_customnodesusageparametercohortdd'] = 'This setting can be used for displaying the custom node to members of the specified cohort only. Use the cohort\'s ID, not the cohort\'s name, for this setting. Separate more than one supported cohort with commas. If the custom node should be displayed for users regardless of any cohort membership, then leave this field empty.';
$string['setting_customnodesusageparameterroledt'] = 'Supported role(s) (optional):';
$string['setting_customnodesusageparameterroledd'] = 'This setting can be used for displaying the custom node only to members with the specified role in each context. Use the role\'s shortname for this setting. Separate more than one supported role with commas. If the custom node should be displayed for users regardless of any role, then leave this field empty.';
$string['setting_customnodesusageparametersystemroledt'] = 'Supported system role(s) (optional):';
$string['setting_customnodesusageparametersystemroledd'] = 'This setting can be used for displaying the custom node only to users with the specified role in system context. Use the role\'s shortname for this setting. The shortname \'admin\' is supported to check if the user is a site admin. Separate more than one supported role with commas. If the custom node should be displayed for users regardless of any system role, then leave this field empty.';
$string['setting_customnodesusageparameterlogicaldt'] = 'Logical combination operator (optional):';
$string['setting_customnodesusageparameterlogicaldd'] = 'This setting can be used to change the logical combination of the optional parameters for cohort, role and system role. If you set this setting to AND or leave this setting empty, the optional parameters for cohort, role and system role will be logically combined with AND and the custom node will only be shown if ALL parameters apply. If you set this setting to OR, the optional parameters for cohort, role and system role will be logically combined with OR and the custom node will be shown if ANY of the parameters apply. This gives you the flexibility to create, for example, a node which is shown to users with a given course role as well as to users with a given system role as shown in our example above.';
$string['setting_customnodesusageparametericondt'] = 'Icon (optional):';
$string['setting_customnodesusageparametericondd'] = 'This icon will be used as icon for the custom node, for example fa-flag. Use a Font Awesome icon identifier (<a href="https://fontawesome.com/v4.7.0/icons/">See the icon list on fontawesome.com</a>) to identify which icon should be used. Font Awesome is included in Boost, classic Moodle pix icons are not supported here. If you just want to use a standard bullet icon for the custom node, then leave this field empty. Custom nodes which don\'t get a standard bullet icon automatically also can\'t get a custom icon currently.';
$string['setting_customnodesusageparameteriddt'] = 'Data-key attribute (optional):';
$string['setting_customnodesusageparameteriddd'] = 'This setting can be used for setting the data-key attribute of the custom node to the given fixed value. The given data-key value is cleaned for alphanumeric characters only and prefixed by the particular custom node area, for example setting the data-key of a node in the bottom nodes for admins area to \'my_node\' will result in a data-key attribute filled with \'localboostnavigationcustombottomadminsmynode\'. This setting gives you the ability to reference a custom node in CSS selectors or even in custom JavaScript code. Setting the same data-key to multiple nodes is not forbidden here, but please note that duplicate data-key attributes can create trouble in the long run. If this field is empty, the custom node will get an automatically generated data-key which is not really suitable for referencing.';
$string['setting_customnodesusageparameterbeforenodedt'] = 'Before node key (optional):';
$string['setting_customnodesusageparameterbeforenodedd'] = 'This setting can be used to specify the node key above which the custom node should be placed. You find the node key in the \'data-key\' HTML attribute of the node you want to reference here. In case of a set of nodes made of a parent and one or more children, this setting must be given to each node of the set.<br/>Please note that you can only use before node keys from the node context you are adding the node to. For example, you can use \'privatefiles\' or \'calendar\' or \'contentbank\' in the root node context or you can use \'participants\' or \'grades\' in the course node context. If the before node key is unknown or cannot be processed for some unknown reason, the node will be added to the end of the node context.<br />Please also note that this setting is considered partly experimental as is might still not be possible to use some nodes as before nodes with this setting.';
$string['setting_customnodesusageparameterclassdt'] = ' CSS classes (optional):';
$string['setting_customnodesusageparameterclassdd'] = 'This setting can be used for setting an additional CSS class or multiple classes to the custom node.';
$string['setting_customnodesusagepleasenote'] = 'Please note:';
$string['setting_customnodesusagepleasenotecss'] = 'Due to the way how Boost\'s nav drawer is built in Moodle core, custom nodes can\'t be build 100% freely. Adding custom HTML element ids or a target attribute to open the link in a new window is impossible.';
$string['setting_customnodesusagepleasenotecheck'] = 'If the custom node does not show up in Boost\'s nav drawer, please check if all mandatory params are set correctly, if the optional language setting fits to your current Moodle user language and if your other optional parameters apply to your user.';
$string['setting_customnodesusagepleasenotelink'] = 'The link parameter can contain placeholders, for example /course/edit.php?id={courseid} to create a node linking to the current course\'s settings page.';
$string['setting_customnodesusagepleasenotemultilang'] = 'The title parameter can contain <a href="https://docs.moodle.org/en/Multi-language_content_filter">multilanguage strings</a> to create a node with a label depending on the user\'s current language.';
$string['setting_customnodesusagepleasenotetitle'] = 'The title parameter can contain placeholders, for example {coursefullname} to create a node labeled with the current course\'s full name.';
$string['setting_customnodesusagepleasenotephavailable'] = 'Available placeholders are:';
$string['setting_customnodesusagepleasenotephcourseiddt'] = '{courseid}:';
$string['setting_customnodesusagepleasenotephcourseiddd'] = 'The course\'s (internal) ID';
$string['setting_customnodesusagepleasenotephcoursefullnamedt'] = '{coursefullname}:';
$string['setting_customnodesusagepleasenotephcoursefullnamedd'] = 'The course\'s full name';
$string['setting_customnodesusagepleasenotephcourseshortnamedt'] = '{courseshortname}:';
$string['setting_customnodesusagepleasenotephcourseshortnamedd'] = 'The course\'s shortname';
$string['setting_customnodesusagepleasenotepheditinglinkdt'] = '{editingtoggle}:';
$string['setting_customnodesusagepleasenotepheditinglinkdd'] = 'The value \'on\' or \'off\' which is needed to toggle edit mode';
$string['setting_customnodesusagepleasenotepheditingtitledt'] = '{editingtoggle}:';
$string['setting_customnodesusagepleasenotepheditingtitledd'] = 'The value \'Turn editing on\' or \'Turn editing off\' from the currently used language pack';
$string['setting_customnodesusagepleasenotephexplanation'] = 'Placeholders are encapsulated in curly brackets and will be replaced automatically when the custom node is created.';
$string['setting_customnodesusagepleasenotephpagecontextiddt'] = '{pagecontextid}:';
$string['setting_customnodesusagepleasenotephpagecontextiddd'] = 'The current page\'s context ID';
$string['setting_customnodesusagepleasenotephpagepathdt'] = '{pagepath}:';
$string['setting_customnodesusagepleasenotephpagepathdd'] = 'The current page\'s URL path';
$string['setting_customnodesusagepleasenotephsesskeydt'] = '{sesskey}:';
$string['setting_customnodesusagepleasenotephsesskeydd'] = 'The sesskey to use in secured URLs';
$string['setting_customnodesusagepleasenotephuserfullnamedt'] = '{userfullname}:';
$string['setting_customnodesusagepleasenotephuserfullnamedd'] = 'The logged in user\'s full name';
$string['setting_customnodesusagepleasenotephuseriddt'] = '{userid}:';
$string['setting_customnodesusagepleasenotephuseriddd'] = 'The logged in user\'s (internal) ID';
$string['setting_customnodesusagepleasenotephuserusernamedt'] = '{userusername}:';
$string['setting_customnodesusagepleasenotephuserusernamedd'] = 'The logged in user\'s username';
$string['setting_customnodesusagepleasenotepipes'] = 'Pipe dividing for optional parameters is always needed if they are located between other options. This means that you have to separate params with the pipe character although they are empty. Also see the example for the Faculty of mathematics custom node above.';
$string['setting_customnodesusageusersexample'] = 'Moodle.org website|http://www.moodle.org|en,de<br />
Our university|http://www.our-university.edu<br />
Faculty of mathematics|http://www.our-university.edu/math||math<br />
Teachers\' handbook|http://www.our-university.edu/teacher-handbook|||editingteacher,teacher<br />
Student information course|/course/view.php?id=1234||||||fa-graduation-cap<br />
{editingtoggle}|/course/view.php?id={courseid}&sesskey={sesskey}&edit={editingtoggle}|||editingteacher|admin,manager|OR|fa-pencil|editing|participants';
$string['setting_customnodesusageusersintro'] = 'Each line consists of a link title, a link URL, supported language(s) (optional), supported cohort(s) (optional), supported role(s) (optional), supported global roles(s) (optional), the logical combination operator (optional), an icon (optional), the data-key attribute (optional) and a \'before node key\' (optional) - separated by pipe characters. Each custom node needs to be written in a new line.';
$string['setting_insertactivitiescoursenoderealicons'] = 'Use individual activity icons';
$string['setting_insertactivitiescoursenoderealicons_desc'] = 'Enabling this setting will use Moodle core\'s individual activity icons for the activity course nodes. These icons are colored and more detailed than the FontAwesome icons of the rest of Boost\'s nav drawer. Disabling this setting will use a one-fits-all FontAwesome icon for the activity course nodes';
$string['setting_insertactivitiescoursenodeexplanation'] = 'This node will hold nodes linking to the activity overview pages. It basically brings the existing functionality of the "Activities" block to Boost\'s nav drawer.';
$string['setting_insertcoursesectionscoursenodeexplanation'] = 'This node will be placed above the first section of the current course.';
$string['setting_insertcoursesectionscoursenodecorehint'] = 'Please note: This feature will only work if the setting <a href="{$a->url}">linkcoursesections</a> is active. If you disabled linkcoursesections, this setting will be ignored and won\'t do anything.';
$string['setting_insertcustomnodes'] = 'Insert {$a->what} for {$a->who}';
$string['setting_insertcustomnodes_desc'] = 'With this setting, you can insert {$a->what} to Boost\'s nav drawer which will be added {$a->where} and which will be shown to {$a->who}.';
$string['setting_insertnode'] = 'Insert {$a->what} "{$a->which}"';
$string['setting_insertnode_desc'] = 'Enabling this setting will insert a {$a->what} "{$a->which}" to Boost\'s nav drawer.';
$string['setting_insertnodescollapsehint'] = 'Please note: The inserted node has an action link which leads to the course home page because Boost does not support adding nodes without an action link. The action link will be overridden as soon as you also enable the setting to collapse the node at the same time.';
$string['setting_insertnodesheading'] = 'Insert {$a->what} to Boost\'s nav drawer';
$string['setting_insertresourcescoursenodeexplanation'] = 'This node will link to the resources overview page.<br /><em>This setting is associated to the "Inserting node \'Activities\'" setting. If you enable both settings, you wil get an "Activities" and a "Resources" node as requested. If you only enable the "Activities" setting, the "Activities" node will also hold a node linking to the resources overview page.</em>';
$string['setting_modifynodesheading'] = 'Modify {$a->what} in Boost\'s nav drawer';
$string['setting_modifymycoursesrootnodefilterhint'] = 'Add course filter hint node';
$string['setting_modifymycoursesrootnodefilterhint_desc'] = 'Enabling this setting will add a node to the end of the My courses list in Boost\'s nav drawer telling the user why the My courses list is filled as it is (i.e. which course filter produced the current My courses list).';
$string['setting_modifymycoursesrootnodefilterlink'] = 'Add course filter link node';
$string['setting_modifymycoursesrootnodefilterlink_desc'] = 'Enabling this setting will add a node to the end of the My courses list in Boost\'s nav drawer telling the user where to change the current course filter (i.e. it shows a link to the Dashboard).<br /><em>This setting is associated to the "Add course filter hint node" setting. If you enable both settings, then a combined node will be added instead of two.</em>';
$string['setting_modifymycoursesrootnodeshowfiltered'] = 'Show filtered courses';
$string['setting_modifymycoursesrootnodeshowfiltered_desc'] = 'Enabling this setting will change the My courses list in Boost\'s nav drawer to show the courses which are currently filtered in the Course overview block. If this setting is disabled, the My courses list in Boost\'s nav drawer will all courses which are classified as \'In progress\' which is Moodle\'s default behaviour.';
$string['setting_modifymycoursesrootnodeshowfilterednavcourselimit'] = 'Please note: Enabling this setting will change the value of the setting <a href="{$a->url}">navcourselimit</a> to 100,000 during every page load. Setting this value that high is necessary to avoid that the course list is shortened in any way which would break the filtering mechanisms.';
$string['setting_movecontentbanknodeincoursecontext'] = 'Move {$a->rootnode} "{$a->contentbank}" in course context';
$string['setting_movecontentbanknodeincoursecontext_desc'] = 'Enabling this setting will move the {$a->rootnode} "{$a->contentbank}" to the {$a->coursenode} section within Boost\'s nav drawer when viewing a Moodle page which is located inside a course.';
$string['setting_movecontentbanknodeincoursecontextbefore'] = 'Move {$a->rootnode} "{$a->contentbank}" before this {$a->coursenode}';
$string['setting_movecontentbanknodeincoursecontextbefore_desc'] = 'With this setting you can define before which {$a->coursenode} the {$a->rootnode} "{$a->contentbank}" will be moved. Please note that it\'s up to you to make sure that the configured {$a->coursenode} is shown to the same group of users who are seeing the "{$a->contentbank}" {$a->rootnode}. If the configured {$a->coursenode} is not shown for a particular user, the "{$a->contentbank}" {$a->rootnode} is added to the end of the {$a->coursenode} section and a debug warning is shown / added to the logs.';
$string['setting_movenodesheading'] = 'Move {$a->what} in Boost\'s nav drawer';
$string['setting_movenodestechnicalhint'] = 'Technical background: This is done by removing the node at the original location in Boost\'s nav drawer and adding the same node again at another location. As a result, it will only be moved within the nav drawer, but remains basically unchained and can still be accessed by other parts of Moodle.';
$string['setting_removebadgescoursenodeexplanation'] = 'The node is only removed if there are no badges in the course. Teachers can still always access the badges management page in the course menu (cog menu).<br /><em>This setting is only processed when the badges subsystem is enabled in Moodle.</em>';
$string['setting_removecompetenciescoursenodeexplanation'] = 'The node is only removed if there are no competencies in the course. For teachers, there will be another "Competencies" node added to the course menu (cog menu).<br /><em>This setting is only processed when the competencies subsystem is enabled in Moodle.</em>';
$string['setting_removecoursenodestechnicalhint'] = 'Technical background: This is done by removing the node from the navigation tree. Thus, the node cannot be accessed by other parts of Moodle anymore. In normal Moodle setups, this should hopefully not cause any trouble.';
$string['setting_removegradescoursenodeexplanation'] = 'The node is removed for all users, regardless of a users capabilities and regardless of the setting \'Show gradebook to students\' in the course settings.';
$string['setting_removemycoursesnodeperformancehint'] = 'Please note: If you enable this setting and have also enabled the setting <a href="{$a->url}">navshowmycoursecategories</a>, removing the "My courses" node takes more time and you should consider disabling the navshowmycoursecategories setting.';
$string['setting_removenode'] = 'Remove {$a->what} "{$a->which}"';
$string['setting_removenode_desc'] = 'Enabling this setting will remove the {$a->what} "{$a->which}" from Boost\'s nav drawer.';
$string['setting_removenodesheading'] = 'Remove {$a->what} from Boost\'s nav drawer';
$string['setting_removenodeincoursecontext'] = 'Remove {$a->what} "{$a->which}" in course context';
$string['setting_removenodeincoursecontext_desc'] = 'Enabling this setting will remove the {$a->what} "{$a->which}" from Boost\'s nav drawer when viewing a Moodle page which is located within a course.';
$string['setting_removenodeinnoncoursecontext'] = 'Remove {$a->what} "{$a->which}" in non-course context';
$string['setting_removenodeinnoncoursecontext_desc'] = 'Enabling this setting will remove the {$a->what} "{$a->which}" from Boost\'s nav drawer when viewing a Moodle page which is located outside a course.';
$string['setting_removenotselectedhomerootnodeexplanation'] = 'The not selected Home / Dashboard node is defined by what the user chose not to be his home page.';
$string['setting_removeparticipantscoursenodeexplanation'] = 'The node is removed for all users, regardless of a users capabilities.';
$string['setting_removerootnodestechnicalhint'] = 'Technical background: This is done by setting the node\'s showinflatnavigation attribute to false. Thus, the node will only be hidden from the nav drawer, but it will remain in the navigation tree and can still be accessed by other parts of Moodle.';
$string['setting_removeselectedhomerootnodeexplanation'] = 'The selected Home / Dashboard node is defined by what the user chose to be his home page.';
$string['settingspage_bottomnodes'] = 'Bottom nodes';
$string['settingspage_coursenodes'] = 'Course nodes';
$string['settingspage_custombottomnodes'] = 'Custom bottom nodes';
$string['settingspage_customcoursenodes'] = 'Custom course nodes';
$string['settingspage_customrootnodes'] = 'Custom root nodes';
$string['settingspage_mycoursesrootnode'] = 'My courses root node';
$string['settingspage_rootnodes'] = 'Root nodes';
