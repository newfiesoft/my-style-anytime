=== My Style Anytime ===
Contributors: NewfieSoft
Donate link: https://newfiesoft.com/donate
Tags: custom, css, style, stylesheet, user-style, admin-style, frontend-style, backend-style, rules, user-rules
Requires at least: 4.9.0
Tested up to: 6.4.2
Stable tag: 1.3.0
Requires PHP:  5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

This plugin helps you to create and customize user types of rules using <strong>CSS style sheets</strong>.

It Is very useful among Frontend Developers, who work to create many style combinations on <strong>Frontend</strong> (public/visitor/guest view).

But at the same time as you can customize the front view, ask if you can customize what and how can look your <strong>Backend</strong> (wp-admin). Of any user rules type who can access and get a different style.

At the same time, you can do responsive design on the same CSS file rule.

👉 Please visit the [Github page](https://github.com/newfiesoft/my-style-anytime "Github") for the latest code development, planned enhancements and known issues 👈

### Features

* Administrator custom style view
* Editor custom style view
* Author custom style view
* Contributor custom style view
* Subscriber custom style view
* Including Visitor/Guest custom style view style.
* Disable Gutenberg style
* Disable the meta generator.
* Remove "WordPress" from the title on any case scenario and on all available Site Language inside WordPress settings.


From now on, as part of this plugin, CSS rules will integrate other additional independent WordPress plugin user rules such as at this moment [WooCommerce](https://wordpress.org/plugins/woocommerce/), [Loco Translate](https://wordpress.org/plugins/loco-translate/), [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/), [YITH WooCommerce Affiliates](https://wordpress.org/plugins/yith-woocommerce-affiliates/), and if you have any suggestions please post inside the support topic [Suggest a plugin that adds his role inside users](https://wordpress.org/support/topic/suggest-a-plugin-that-adds-his-role-inside-users/).


== Screenshots ==

1. Welcome screen
2. Manage Style page where you can see all available styles that can be Editing
3. Code Editor where you can manage and customize your style independent of user role type
4. Customization page and his configuration options like Remove 100% WordPress from the title
5. Security page and his Information and configuration options
6. Settings where you can enable additional useful functions
7. Administrator custom style view
8. Editor custom style view
9. Author custom style view
10. Contributor custom style view
11. Subscriber custom style view
12. Visitor custom style view
13. WooCommerce Shop Manager custom style view
14. WooCommerce Customer custom style view
15. Loco Translate custom style view
16. Yoast SEO Manager custom style view
17. Yoast SEO Editor custom style view
18. YITH WooCommerce Affiliates custom style view


== Installation ==

= Simple Modern Way =
1. Go to the WordPress Dashboard, from the <strong>Plugins</strong> menu you can see Add New click on that.
2. On the right side, you can see the Search field. In that field enter <strong>my style anytime</strong>.
3. Click on <strong>Install Now</strong>, then <strong>Activate</strong>.

= Manual Old Way =

1. Unzip the downloaded zip file
2. Upload the plugin folder into the <strong>wp-content/plugins/</strong> directory of your WordPress site.
3. Go to the <strong>WordPress Dashboard</strong>, and click on <strong>Plugins</strong> on the list of plugins you will see <strong>My Style Anytime</strong> from the Plugins page.
4. Click on <strong>Activate</strong>.

= After Install =

Now on the left menu, you have new options with the name <strong>My Style Anytime</strong>, click on the name how would see all options.

On the plugin menu you have <strong>Manage Style</strong>, click on that you go on plugin style files editors.

Enjoy your work... 🥳


== Frequently Asked Questions ==

= Is this plugin free? =

Yes, this plugin version is 100% free.

= Can I show or include it in Frontend public/visitor/guest style? =

Yes, of course, in any rules style, you can find the next part of the code commented.

/* To import visitor style in this user @Rules type
@import "visitor-style.css";
 */

When you enable import visitor-style.css to need to know, you import all that is inside in visitor-style.css

= Backup important files when you upgrade to the latest version =

If you manually upload the plugin on the last version using someone files  FTP application, only just skip and not remove folder  <strong>styles</strong>, all others you can remove and all from the last version that you download.

But if you're using an upgrade inside the WordPress site plugin area, before doing that just backup folder <strong>styles</strong>, and after doing that you can upgrade to the official last version.


== Changelog ==

= 1.3.0 - 13.12.2023 =
* We complete testing on WordPress version 6.4.2
* We reorganized and optimized the code, changed the description and tags.

* Add : We Created an Independent Code Editor inside the Mnagage Style page which can only edit CSS files inside set directories, for all user rule types. Inside the Settings page, we note remove options where Disable or Allow the default WordPress File Code Editor for security reasons. And independent of that you can manage your css files for rules.

* Add : We added a Malayalam key on how to remove WordPress on the title of any page. And after testing we again cover all available Site Language inside WordPress.

* Fix : Inside the main localization file my-style-anytime.pot we fix the bugs and optimize on lines how translation can cover and work 100%

= 1.2.0 - 29.09.2023 =
* We complete testing on WordPress version 6.3.1

* Add : We optimize the .pot file as a part of the plugin, add new lines, and optimize olders.

* Add : In this version we implement [WooCommerce](https://wordpress.org/plugins/woocommerce/) user rules.
* Add : In this version we implement [Loco Translate](https://wordpress.org/plugins/loco-translate/) user rules.
* Add : In this version we implement [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) user rules.
* Add : In this version we implement [YITH WooCommerce Affiliates](https://wordpress.org/plugins/yith-woocommerce-affiliates/) user rules.

* Fix : disagreements with form-table

= 1.1.0 - 17.05.2023 =
* We reorganized the version control schematic.
* We complete testing on WordPress version 6.2.1
* Add : Functions on the Security page where you disable the meta generator.
* Add : Functions on the Customization page where you Remove "WordPress" from the title on any case.
* On this version we change the link rel='stylesheet' id=' generate line how in order to avoid a possible conflict with any other plugins with the same name as admin-style-css now it is admin-msyt-styles-css

= 1.0.4 - 24.02.2023 =
* We reorganized the directory structure and code.
* Add : Settings pages where you can enable or disable on-click file editing.
* Add : Functions on Settings page where you disable Gutenberg style anywhere & Enable classic editor.
* Add : From this version, the .pot file is a part of the plugin and is 100% optimize with the plugin. That means now we can make localization and work on multi Languages support.

= 1.0.3 - 01.10.2022 =
* Add : Ratings on the Installed Plugins list page itself.

= 1.0.2.9 - 01.10.2022 =
* Fix : the bug after the update in version 1.0.2

= 1.0.2 - 01.10.2022 =
* We optimized the code and added additional buttons on the Installed Plugins list page itself.

= 1.0.1 - 01.09.2022 =
* We add a function where visitors have the owner's custom style (visitor-style.css). With this now you do not need to use theme style.css primarily.

= 1.0.0 - 01.08.2022 =
* First release
