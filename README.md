Class_WP_ezClasses_BuddyPress_Relocate_BP_Legacy_Templates_1
============================================================

Move your WordPress BuddyPress bp-legacy templates into a plugin for customizing (instead of trapping them in a specific theme).

Your plugin is just a class that extends this class. You also need to copy two methods from this class into your plugin's class.

The end result allow you to have a folder within your plugin called: buddypress. 

And then within buddypress/ the bp-legacy/ folder and it's childen. 

The only thing you can't move into your plugin is buddypress-functions.php. The best you can do it have it into your theme. 

Exploring that relocation is a TODO.  

Note: This is based on an article / set of (procedural PHP) instruction on the BuddyPress website that I can't seem to find at the moment. Once I find it, I'll be certain to give credit where credit is due. 