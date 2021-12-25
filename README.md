moodle-local_boostnavigation
============================

[![Moodle Plugin CI](https://github.com/moodleuulm/moodle-local_boostnavigation/workflows/Moodle%20Plugin%20CI/badge.svg?branch=master)](https://github.com/moodleuulm/moodle-local_boostnavigation/actions?query=workflow%3A%22Moodle+Plugin+CI%22+branch%3Amaster)

Moodle plugin which tries to overcome some fixed appearance behaviours of Boost's nav drawer in a clean way


Requirements
------------

This plugin requires Moodle 3.11+


Motivation for this plugin
--------------------------

Since the release of Moodle 3.2, Moodle core ships with a shiny new theme called "Boost". While Boost does many things right, it also has some fixed behaviours which don't make sense for all Moodle installations. One of these behaviours is the fact that the look and feel of the nav drawer (the menu which appears when you click on the hamburger menu button) is hardcoded and can hardly be configured by administrators.


Installation
------------

Install the plugin like any other plugin to folder
/local/boostnavigation

See http://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins


Usage & Settings
----------------

After installing the plugin, it does not do anything to Moodle yet.

To configure the plugin and its behaviour, please visit:
Site administration -> Appearance.

There, you find a section "Boost navigation fumbling" and multiple settings pages:

### 1. Root nodes

On this page, you can remove root nodes.

### 2. My courses root node

On this page, you can remove, modify and collapse the my courses root node.

### 3. Custom root nodes

On this page, you can insert and collapse custom root nodes.

### 4. Course nodes

On this page, you can remove, insert and collapse course nodes.

### 5. Custom course nodes

On this page, you can insert and collapse custom course nodes.

### 6. Custom bottom nodes

On this page, you can insert and collapse custom bottom nodes.


How this plugin works
---------------------

Luckily, Moodle provides the *_extend_navigation() hook which allows plugin developers to fumble with Moodle's global navigation tree at runtime. This plugin leverages this hook and does its best to change some things in the nav drawer which should behave differently in our point of view.


Companion plugin local_profilecohort
------------------------------------
This plugin lets you add a restriction for showing custom nodes based on a user's cohort memberships. If you don't have cohorts yet in your Moodle instance, but custom user profile fields to make the same restrictions, you might want to look at our plugin local_profilecohort as a companion plugin. local_profilecohort is published on http://moodle.org/plugins/view/local_profilecohort and on https://github.com/moodleuulm/moodle-local_profilecohort.


Theme support
-------------

This plugin is developed and tested on Moodle Core's Boost theme.
It should also work with Boost child themes. However, we can't support any other theme than Boost.


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

Due to limited resources, this plugin is only maintained for the most recent major release of Moodle as well as the most recent LTS release of Moodle. Bugfixes are backported to the LTS release. However, new features and improvements are not necessarily backported to the LTS release.

Apart from these maintained releases, previous versions of this plugin which work in legacy major releases of Moodle are still available as-is without any further updates in the Moodle Plugins repository.

There may be several weeks after a new major release of Moodle has been published until we can do a compatibility check and fix problems if necessary. If you encounter problems with a new major release of Moodle - or can confirm that this plugin still works with a new major release - please let us know on Github.

If you are running a legacy version of Moodle, but want or need to run the latest version of this plugin, you can get the latest version of the plugin, remove the line starting with $plugin->requires from version.php and use this latest plugin version then on your legacy Moodle. However, please note that you will run this setup completely at your own risk. We can't support this approach in any way and there is an undeniable risk for erratic behavior.


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

Since Moodle 3.4 core, PHP7 is mandatory. We are developing and testing this plugin for PHP7 only.


Maintainers
-----------

Ulm University\
Communication and Information Centre (kiz)\
Alexander Bias


Copyright
---------

Ulm University\
Communication and Information Centre (kiz)\
Alexander Bias
