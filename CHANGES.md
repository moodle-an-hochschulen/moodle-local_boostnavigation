moodle-local_boostnavigation
============================

Changes
-------

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
