moodle-local_boostnavigation
============================

[![Build Status](https://travis-ci.org/moodleuulm/moodle-local_boostnavigation.svg?branch=master)](https://travis-ci.org/moodleuulm/moodle-local_boostnavigation)

Moodle plugin which tries to overcome some fixed appearance behaviours of Boost's nav drawer in a clean way


Requirements
------------

This plugin requires Moodle 3.2+


Motivation for this plugin
--------------------------

Since the release of Moodle 3.2, Moodle core ships with a shiny new theme called "Boost". While Boost does many things right and better than the legacy theme Clean, it also has some fixed behaviours which don't make sense for all Moodle installations. One of these behaviours is the fact that the look and feel of the nav drawer (the menu which appears when you click on the hamburger menu button) is hardcoded and can hardly be configured by administrators.


Installation
------------

Install the plugin like any other plugin to folder
/local/boostnavigation

See http://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins


Usage & Settings
----------------

After installing the plugin, it does not do anything to Moodle yet.

To configure the plugin and its behaviour, please visit:
Site administration -> Appearance -> Boost navdrawer fumbling.

There, you find four sections:

### 1. Remove nodes from Boost's nav drawer

Enabling any of these settings will remove them from Boost's nav drawer. Technically, this is done by setting the node's showinflatnavigation attribute to false. Thus, the node will only be hidden from the nav drawer, but it will remain in the navigation tree and can still be accessed by other parts of Moodle.

### 2. Collapse root nodes in Boost's nav drawer

Enabling any of these settings will let users collapse root nodes in Boost's nav drawer. Technically, this is done by adding some JavaScript and CSS code to the page which will show or hide the second-level nodes as soon as the user clicks on the node. The collapse status of the node will be stored in each user's session. Thus, the nodes will only be hidden from the nav drawer at runtime, but they will remain in the navigation tree and can still be accessed by other parts of Moodle.

Please note that this feature is only working with Boost installations which have the patch from MDL-59425 (https://tracker.moodle.org/browse/MDL-59425) integrated. This patch will be part of Moodle 3.4, but can be easily backported to your local version of theme_boost if you are able and willing to add a small core hack, in this case you will find the patch on https://github.com/moodle/moodle/commit/d7d2a72faf0cc760f0f0d80402505176f9cbb8bc. The patch is also part of Ulm University's Boost child theme which you can get on https://github.com/moodleuulm/moodle-theme_boost_campus.

### 3. Remove course nodes from Boost's nav drawer

Similar to the "Remove nodes from Boost's nav drawer" section, enabling any of these settings will remove them from the course navigation section of Boost's nav drawer.

### 4. Insert course nodes to Boost's nav drawer

Enabling any of these settings will insert additional nodes to the course navigation section of Boost's nav drawer.

### 5. Collapse course nodes in Boost's nav drawer

Similar to the "Collapse root odes in Boost's nav drawer" section, enabling any of these settings will let users collapse nodes in the course navigation section of Boost's nav drawer. For these settings, the same restrictions regarding the patch from MDL-59425 apply.


How this plugin works
---------------------

Luckily, Moodle provides the *_extend_navigation() hook which allows plugin developers to fumble with Moodle's global navigation tree at runtime. This plugin leverages this hook and does its best to change some things in the nav drawer which should behave differently in our point of view.


Theme support
-------------

This plugin is designed to work with Moodle core's Boost theme or child themes of Boost.
It does not work with other themes which are not based on Boost.


Plugin repositories
-------------------

This plugin is published and regularly updated in the Moodle plugins repository:
http://moodle.org/plugins/view/local_boostnavigation

The latest development version can be found on Github:
https://github.com/moodleuulm/moodle-local_boostnavigation


Bug and problem reports / Support requests
------------------------------------------

This plugin is carefully developed and thoroughly tested, but bugs and problems can always appear.

Please report bugs and problems on Github:
https://github.com/moodleuulm/moodle-local_boostnavigation/issues

We will do our best to solve your problems, but please note that due to limited resources we can't always provide per-case support.


Feature proposals
-----------------

Due to limited resources, the functionality of this plugin is primarily implemented for our own local needs and published as-is to the community. We are aware that members of the community will have other needs and would love to see them solved by this plugin.

Please issue feature proposals on Github:
https://github.com/moodleuulm/moodle-local_boostnavigation/issues

Please create pull requests on Github:
https://github.com/moodleuulm/moodle-local_boostnavigation/pulls

We are always interested to read about your feature proposals or even get a pull request from you, but please accept that we can handle your issues only as feature _proposals_ and not as feature _requests_.


Moodle release support
----------------------

Due to limited resources, this plugin is only maintained for the most recent major release of Moodle. However, previous versions of this plugin which work in legacy major releases of Moodle are still available as-is without any further updates in the Moodle Plugins repository.

There may be several weeks after a new major release of Moodle has been published until we can do a compatibility check and fix problems if necessary. If you encounter problems with a new major release of Moodle - or can confirm that this plugin still works with a new major relase - please let us know on Github.

If you are running a legacy version of Moodle, but want or need to run the latest version of this plugin, you can get the latest version of the plugin, remove the line starting with $plugin->requires from version.php and use this latest plugin version then on your legacy Moodle. However, please note that you will run this setup completely at your own risk. We can't support this approach in any way and there is a undeniable risk for erratic behavior.


Translating this plugin
-----------------------

This Moodle plugin is shipped with an english language pack only. All translations into other languages must be managed through AMOS (https://lang.moodle.org) by what they will become part of Moodle's official language pack.

As the plugin creator, we manage the translation into german for our own local needs on AMOS. Please contribute your translation into all other languages in AMOS where they will be reviewed by the official language pack maintainers for Moodle.


Right-to-left support
---------------------

This plugin has not been tested with Moodle's support for right-to-left (RTL) languages.
If you want to use this plugin with a RTL language and it doesn't work as-is, you are free to send us a pull request on Github with modifications.


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
