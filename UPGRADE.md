Upgrading this plugin
=====================

This is an internal documentation for plugin developers with some notes what has to be considered when updating this plugin to a new Moodle major version.

General
-------

* Generally, this is a plugin with many settings and many user stories.
* It uses and somehow abuses Moodle's Navigation API which might change between Moodle major versions.
* Thus, the upgrading effort should not be underestimated.


Upstream changes
----------------

* This plugin does not inherit or copy anything from upstream sources.


Automated tests
---------------

* The plugin has a good coverage with Behat tests which test all of the plugin's user stories.


Manual tests
------------

* There aren't any manual tests needed to upgrade this plugin.
* However, it might be advisable to have a look at the output of the nav drawer in the Moodle GUI as Moodle themes can always change small details in this area.
* Additionally, if you look at the Behat feature files, you will see that there are some scenarios still commented out. If you have time, you should test them manually or write a working Behat test for them.
