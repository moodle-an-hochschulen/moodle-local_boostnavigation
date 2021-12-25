moodle-local_boostnavigation
============================

Changes
-------

### v3.11-r1

* 2021-07-15 - Prepare compatibility for Moodle 3.11.

### v3.10-r3

* 2021-02-05 - Make codechecker fully happy
* 2021-02-05 - Move Moodle Plugin CI from Travis CI to Github actions

### v3.10-r2

* 2021-01-05 - Feature: Move the content bank node from the root nodes section to the course nodes section.
* 2021-01-05 - Bugfix: Collapsing custom course nodes had side effects to the my courses list.

### v3.10-r1

* 2020-12-07 - Prepare compatibility for Moodle 3.10.
* 2020-12-07 - Change in Moodle release support:
               For the time being, this plugin is maintained for the most recent LTS release of Moodle as well as the most recent major release of Moodle.
               Bugfixes are backported to the LTS release. However, new features and improvements are not necessarily backported to the LTS release.
* 2020-12-07 - Improvement: Declare which major stable version of Moodle this plugin supports (see MDL-59562 for details).

### v3.9-r3

* 2020-11-18 - Improvement: Show the value of the selected custom field in the filter hint node

### v3.9-r2

* 2020-11-15 - Feature: Use individual activity icons for activity course nodes.
* 2020-11-14 - Feature: Support custom CSS classes when creating custom nodes.
* 2020-11-14 - Improvement: Improve performance of the check if badges exist in the course before removing the badges course node.
* 2020-11-13 - Update README.md to reflect the latest structure of the plugin's settings.
* 2020-11-11 - Feature: Adopt the features to modify the My courses nodes list from the plugin local_boostcoc to local_boostnavigation.
               This allows admins to align the My courses list in the nav drawer with the (filteres) course list in the My Overview block on the Dashboard.
               Please don't enable these new features when you still have local_boostcoc in production.

### v3.9-r1

* 2020-11-09 - Feature: Add admin setting to remove the content bank nodes which are part of Moodle 3.9 - Credits to tblacker7 for the first draft.
* 2020-11-09 - Fix Behat tests which broke with Moodle 3.9.
* 2020-11-09 - Prepare compatibility for Moodle 3.9.

### v3.8-r2

* 2020-08-04 - Bugfix: User logs can't be viewed anymore if the participants node was set to be removed - Credits to zpottie.

### v3.8-r1

* 2020-08-03 - Improvement: Recreate the PNG + SVG fallback icons for the activities and resources nodes.
* 2020-08-03 - Feature: Add admin settings to control how to display icons within collapsible parent nodes - Credits to Adrian Perez.
               Please note: This change also makes sure that the information 'After installing the plugin, it does not do anything to Moodle yet' which is given in the README file is correct again. Up to now, the plugin removed the icon from the MyCourses parent node and changed the indent of the MyCourses child nodes even if the node was not set to be collapsed. This misbehaviour is now reverted.
               Please also note: This change also adds an icon to the section and activities parent node and a small indent to their children in non-collapsible mode which wasn't the case before but which aligns with the MyCourses node having an icon again with this plugin and having a slight indent in Moodle core for some time now.
               Please also note: This change also adds an icon to the custom parent nodes and a small indent to their children in non-collapsible mode which wasn't the case before but which aligns with MyCourses, sections and activities nodes then.
* 2020-08-03 - Bugfix: New / changed custom node icons were not shown anymore after upstream change in MDL-69109.
* 2020-06-20 - Bugfix: Collapsible nodes did not collapse under Moodle 3.8 anymore. This was fixed based on the work which was integrated into Moodle core in MDL-58964. That's why this patch raises the minimum Moodle core version to 3.8.2+ and not just 3.8.0.
               As this bugfix also replaces the practice of abusing Moodle core navigation node attributes, this solves some minor side effects of the plugin on the navigation tree and breadcrumb on-the-fly.
* 2020-06-20 - Release: Fix a Behat test which broke with changes in Moodle 3.8.
* 2020-06-20 - Prepare compatibility for Moodle 3.8.

### v3.7-r6

* 2020-04-01 - Bugfix: Prevent a fatal error when adding activity course nodes.

### v3.7-r5

* 2020-02-12 - Added Behat tests to cover the individual features of the plugin.
* 2020-02-10 - Improvement: The ID attribute for custom nodes is in fact a data-key attribute. This is now fixed in the language pack.

### v3.7-r4

* 2020-02-04 - Improvement: Support multilang strings in custom node titles - Thanks to Jean-Roch.
* 2020-02-04 - Bugfix: A fatal error could have appeared during login as sessions - Credits to Adrian Perez.
* 2019-09-04 - Fix flaws in the settings page regarding a link to other settings.

### v3.7-r3

* 2019-08-26 - Bugfix: After refactoring the language pack in v3.7-r1, the section node and activities node could not be checked / unchecked anymore in new and existing installations - Thanks to Ralf Krause.

### v3.7-r2

* 2019-06-16 - Fix flaws in the english language pack.

### v3.7-r1

* 2019-06-15 - Improvement: Make multiple usages of placeholders in custom nodes slightly more efficient.
* 2019-06-15 - Refactor, modularize and parametrize the language pack.
               This was done to ease future additions and translations and to get rid of the existing duplicated substrings.
               Unfortunately, this refactoring means that existing translations have to be done mostly by copy & paste in AMOS.
               Thanks in advance to all translators for your support and understanding.
* 2019-06-14 - Improvement: Split the mix of core and custom nodes settings onto separate settings pages.
* 2019-06-14 - Improvement: Leverage the possibility to hide admin settings based on other admin settings' values from Moodle 3.7 on.
* 2019-06-14 - Prepare compatibility for Moodle 3.7.

### v3.6-r7

* 2019-06-15 - Bugfix: Two more strings in language pack didn't work for Moodle installed in subdirectories - Credits to Tim Schroeder.

### v3.6-r6

* 2019-06-14 - Bugfix: Using calendar and privatefiles as beforenode key broke subsequent lines using beforenode keys.

### v3.6-r5

* 2019-06-13 - Improvement: Enable custom nodes positioning for some more beforenodes - Credits to Jean-Roch.
* 2019-06-13 - Bugfix: The competencies node which is added to the cog menu didn't have an icon - Credits to Sarah Cotton.
* 2019-06-13 - Bugfix: String in language pack didn't work for Moodle installed in subdirectories - Credits to Tim Schroeder.

### v3.6-r4

* 2019-04-30 - Bugfix: If you added an ID attribute to the first bottom node, the bottom nodes did not get a margin-top anymore - Credits to Jean-Roch. 
* 2019-04-30 - Add support for collapsing other custom nodes when a collapsible custom node is expanded (to produce an accordion).
* 2019-04-17 - Bugfix: Collapse nodes didn't work on IE11.
* 2019-04-12 - Add the possibility to remember the collapse status only for the current session.
* 2019-04-12 - Add option to position custom nodes - Credits to Jean-Roch.
* 2019-04-12 - Fix a wrong node example in the language pack.

### v3.6-r3

* 2019-03-29 - Bugfix: Remove debugging notices about undefined properties when running unit tests - Credits to G El-Zoghbi.

### v3.6-r2

* 2019-03-28 - Remove user preferences when being uninstalled.

### v3.6-r1

* 2019-03-13 - Check compatibility for Moodle 3.6, no functionality change.

### v3.5-r8

* 2019-03-12 - Allow participants node to be removed from the course navigation.
* 2019-03-12 - Allow grade node to be removed from the course navigation - Credits to Dan Marsden.
* 2019-03-12 - Add support for setting the node id attribute.
* 2019-03-12 - Announce undocumented parameters for custom nodes for admins.  
* 2019-03-12 - Add logical combination operator for the cohort, role and system role settings - Credits to Adrian Perez for the idea.
* 2019-03-11 - Add node with icon to example section.
* 2019-03-11 - Target link to FontAwesome icon list to FontAwesome 4.7.0 which is still used by Moodle core.

### v3.5-r7

* 2019-02-06 - Add the new custom node definition fields to the settings description.

### v3.5-r6

* 2019-02-06 - Bugfix: Get rid of a debug message which appeared when there wasn't an icon defined for a custom node.

### v3.5-r5

* 2019-02-06 - Add support for icons in custom nodes.
* 2019-02-06 - Improve processing of the language parameter - Credits to Adrian Perez.
* 2019-02-06 - Add support for system roles and site-admin on custom course nodes - Credits to Adrian Perez.
* 2019-02-05 - Improve the accessibility of the collapsible nodes, let users open / close the MyCourses node with the keyboard.

### v3.5-r4

* 2019-02-04 - Fix a flaw in the language pack for the node title placeholders.

### v3.5-r3

* 2019-02-04 - Improvement: Add placeholders for node titles.
* 2019-02-04 - Improvement: Add editingtoggle placeholder for custom nodes.
* 2019-02-04 - Improvement: Make sure that the right custom node with parameters is active and highlighted.
* 2018-12-05 - Changed travis.yml due to upstream changes.
* 2018-07-23 - Remove deprecated strings file as the strings were fully depreated before.

### v3.5-r2

* 2018-07-19 - Adapt the mechanism to de-activate collapsible custom parent nodes.
* 2018-07-19 - Cleanup: Remove a PHP notice in a forgotten edge case.
* 2018-07-19 - Split settings onto multiple settings pages.
* 2018-07-19 - Change collapse node icon to FontAwesome.

### v3.5-r1

* 2018-07-18 - Some changes after navdrawer icons have landed in core.
* 2018-07-18 - Check compatibility for Moodle 3.5, no functionality change.

### v3.4-r7

* 2018-07-18 - Support guest and non-logged-in users for role specific custom nodes.

### v3.4-r6

* 2018-06-20 - Bugfix: {pagecontextid} placeholder in custom node URLs was broken.

### v3.4-r5

* 2018-06-20 - Bugfix: Display custom nodes for multiple cohorts did not work
* 2018-06-20 - Add support for role specific custom nodes. With warm greetings from Moodle-DACH18-DevCamp - Cheers Jonathan and Christian
* 2018-06-19 - Add support for placeholders in custom node URLs.

### v3.4-r4

* 2018-05-16 - Implement Privacy API.

### v3.4-r3

* 2018-02-27 - Change the icon for custom nodes based on early adopter feedback.

### v3.4-r2

* 2018-02-27 - Fix a note in the language pack.

### v3.4-r1

* 2018-02-26 - Always set the data-isexpandable attribute of the mycourses child nodes.
* 2018-02-22 - Add icons to custom nodes to be displayed in theme_boost_campus
* 2018-02-21 - Change the icons which were added to the activity nodes to a simple indent. This will simplify our work with theme_boost_campus, thanks for understanding.
* 2018-02-21 - Bugfix: Collapsing only custom nodes did not work.
* 2018-02-21 - Fix collapsing of mycourses node in theme_boost_campus.
* 2018-02-20 - Don't highlight active collapsible custom nodes.
* 2018-02-20 - Remove all notes about the requirement for MDL-59425 for collapsing nodes as this is now part of Moodle 3.4.
* 2018-02-20 - Remove fallback for missing node key of competencies files navigation node.
* 2018-02-20 - Remove fallback for missing node key of private files navigation node.
* 2018-02-20 - Prepare compatibility for Moodle 3.4, no functionality change.

### v3.3-r1

* 2018-02-20 - Prepare compatibility for Moodle 3.3, no functionality change.

### v3.2-r18

* 2018-02-19 - Bugfix: There was a fatal error with custom course nodes which only appeared in certain plugin configurations.
* 2018-02-19 - Bugfix: There were problems / debug messages with the setting to remove the competencies node.

### v3.2-r17

* 2018-01-15 - Bugfix: Some course section edge cases produced an incorrect ordering of the "Sections" course node.
* 2017-12-15 - Add support for adding custom nodes to the nav drawer.
* 2017-12-05 - Added Workaround to travis.yml for fixing Behat tests with TravisCI.

### v3.2-r16

* 2017-11-21 - Setting to remove some course nodes - Thanks to Alain Bolli.
* 2017-11-08 - Updated travis.yml to use newer node version for fixing TravisCI error.

### v3.2-r15

* 2017-10-09 - Bugfix: Collapsing the "Sections" course node resulted in a fatal error for some non-teacher users.

### v3.2-r14

* 2017-10-09 - Bugfix: Inserting course nodes failed on pages which are not really inside a course but have a course id.

### v3.2-r13

* 2017-09-29 - Bugfix: Inserting the "Sections" course node was broken after MDL-57412 was integrated into Moodle core.

### v3.2-r12

* 2017-09-29 - Add admin setting for collapse default states.
* 2017-08-30 - Setting to insert an "Activities" and "Resources" course node.
* 2017-08-30 - Setting to insert a "Sections" course node.
* 2017-08-16 - Setting to be able to collapse nav drawer node "My courses".

### v3.2-r11

* 2017-06-30 - Improve search for privatefiles node after MDL-58165 was integrated into Moodle core 3.2 and 3.3
* 2017-05-29 - Add Travis CI support

### v3.2-r10

* 2017-05-10 - Add the possibility to remove the first Home / Dashboard node, not only the unneeded second one
* 2017-05-10 - Bugfix: If Moodle is configured with 'Default home page for users' = User preference, the plugin's 'Remove second "Home" or "Dashboard" node' setting didn't have any effect

### v3.2-r9

* 2017-05-08 - Remove currentcoursefullname setting as this is now possible with $CFG->navshowfullcoursenames in Moodle core. If currentcoursefullname was set to yes and the Moodle version is recent enough (version >= 2016120500.03), the plugin update script will set $CFG->navshowfullcoursenames = yes in Moodle core.

### v3.2-r8

* 2017-05-05 - Improve README.md

### v3.2-r7

* 2017-03-31 - Minor code improvements, no functionality change

### v3.2-r6

* 2017-03-13 - Handle the case that the admin has enabled navshowmycoursecategories when removing the My courses node; Thanks to Simon Eidenskog for spotting

### v3.2-r5

* 2017-03-09 - Rename the plugin to local_boostnavigation for multiple reasons and resubmit it to the Moodle plugin repository

### v3.2-r4 to v3.2-r2

* 2017-03-07 - Some improvements from the Moodle plungin repo prechecker results and to things which have been overlooked in the very first release

### v3.2-r1

* 2017-03-06 - Initial version
