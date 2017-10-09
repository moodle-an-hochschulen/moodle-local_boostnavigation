moodle-local_boostnavigation
============================

Changes
-------

### Unreleased

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
