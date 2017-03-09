moodle-local_boostnavigation
============================

Moodle plugin which tries to overcome some fixed appearance behaviours of Boost's nav drawer in a clean way.


Requirements
------------

This plugin requires Moodle 3.2+


Installation
------------

Install the plugin like any other plugin to folder
/local/boostnavigation

See http://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins


Usage & Settings
----------------

After installing local_boostnavigation, the plugin does not do anything to Moodle yet.
To configure the plugin and its behaviour, please visit Site administration -> Appearance -> Boost navdrawer fumbling.

There, you find two sections:

### 1. Remove nodes from Boost's nav drawer

Enabling any of these settings will remove them from Boost's nav drawer. Technically, this is done by setting the node's showinflatnavigation attribute to false. Thus, the node will only be hidden from the nav drawer, but it will remain in the navigation tree and can still be accessed by other parts of Moodle.

### 2. Improve the current course's presentation in Boost's nav drawer

Enabling this setting will show the course's fullname instead of the course's shortname in Boost's nav drawer. Technically, this can currently only be done by replacing the shortname globally at runtime, thus enabling this setting might have side effects to other parts of Moodle.


Themes
------

local_boostnavigation is designed to work with theme_boost or child themes of theme_boost.
It does not work with other themes which are not based on Boost.


Motivation for this plugin
--------------------------

Since the release of Moodle 3.2, Moodle core ships with a shiny new theme called "Boost". While Boost does many things right and better than the legacy theme Clean, it also has some fixed behaviours which don't make sense for all Moodle installations. One of these behaviours is the fact that the look and feel of the nav drawer (the menu which appears when you click on the hamburger menu button) is hardcoded and can't be hardly configured by administrators.

Luckily, Moodle provides the *_extend_navigation() hook which allows plugin developers to fumble with Moodle's global navigation tree at runtime. This plugin leverages this hook and does its best to change some things in the nav drawer which should behave differently in our point of view.


Further information
-------------------

local_boostnavigation is found in the Moodle Plugins repository: http://moodle.org/plugins/view/local_boostnavigation

Report a bug or suggest an improvement: https://github.com/moodleuulm/moodle-local_boostnavigation/issues


Feature proposals to this plugin
--------------------------------

Due to limited resources, the functionality of local_boostnavigation are primarily implemented for our own local needs and published as-is to the community. We expect that members of the community will have other needs and would love to see them solved by this plugin.

We are always interested to read about your feature proposals on https://github.com/moodleuulm/moodle-local_boostnavigation/issues or even get a pull request from you on https://github.com/moodleuulm/moodle-local_boostnavigation/pulls, but please accept that we can handle your issues only as feature _proposals_ and not as feature _requests_.


Moodle release support
----------------------

Due to limited resources, local_boostnavigation is only maintained for the most recent major release of Moodle. However, previous versions of this plugin which work in legacy major releases of Moodle are still available as-is without any further updates in the Moodle Plugins repository.

There may be several weeks after a new major release of Moodle has been published until we can do a compatibility check and fix problems if necessary. If you encounter problems with a new major release of Moodle - or can confirm that local_boostnavigation still works with a new major relase - please let us know on https://github.com/moodleuulm/moodle-local_boostnavigation/issues


Right-to-left support
---------------------

This plugin has not been tested with Moodle's support for right-to-left (RTL) languages.
If you want to use this plugin with a RTL language and it doesn't work as-is, you are free to send us a pull request on
github with modifications.


PHP7 Support
------------

Since Moodle 3.0, Moodle core basically supports PHP7.
Please note that PHP7 support is on our roadmap for this plugin, but it has not yet been thoroughly tested for PHP7 support and we are still running it in production on PHP5.
If you encounter any success or failure with this plugin and PHP7, please let us know.


Copyright
---------

Ulm University
kiz - Media Department
Team Web & Teaching Support
Alexander Bias
