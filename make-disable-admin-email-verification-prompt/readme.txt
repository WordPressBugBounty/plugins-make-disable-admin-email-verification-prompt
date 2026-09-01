=== Make Disable Admin Email Verification Prompt ===
Contributors: aimsinfosofts, aimsankur
Author: Aims Infosoft
Tags: email, disable, adminemail, verification, admin  
Requires at least: 5.3
Tested up to: 7.1
Requires PHP: 7.0
Stable tag: 1.0.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Disable Admin Email Verification Prompt with checkbox option in General in Settings. If you want to disable prompt then tick the checkbox.
 
== Description ==

WordPress 5.3 introduced an admin email verification screen that is periodically shown after an admin has logged in, prompting administrators to verify the site’s administration email address. This plugin disables that prompt.

**NOTE : This plugin requires Wordpress 5.3 or greater.

== Installation ==

= Minimum Requirements =

* Wordpress 5.3 or greater is recommended

1. Upload `make-disable-admin-email-verification-prompt` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Does this plugin do anything if the Wordpress 5.3 or later versions is not used? =

No, this plugin not used without Wordpress 5.3 or later versions.

= Do you have a question? =

If so, please use the support forum to ask!


== Screenshots ==

1. Display in General in Settings Page.
2. Frontend Disable admin email verification prompt screen.

== Changelog ==

= 1.0.8 =
* Tested up to WordPress 7.1
* Fixed register_uninstall_hook using a non-static callback (was silently failing with a _doing_it_wrong notice)
* Added sanitize_callback to the settings field
* Fixed spelling/wording errors in plugin description and readme

= 1.0.7 =
* Tested upto latest wordpress version 6.9

= 1.0.6 =
* Tested upto latest wordpress version 6.6

= 1.0.5 =
* Tested upto latest wordpress version 6.3

= 1.0.4 =
* Change readme.txt file

= 1.0.3 =
* Tested upto latest wordpress version 6.0

= 1.0.2 =
* Tested upto latest wordpress version 5.9

= 1.0.1 =
* Tested upto latest wordpress version 5.6

= 1.0.0 =
* Initial release of the plugin

