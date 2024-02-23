=== My Style Anytime ===
Contributors: NewfieSoft
Donate link: https://newfiesoft.com/donate
Tags: css, custom, responsive, customize, style
Requires at least: 4.9.0
Tested up to: 6.4.3
Stable tag: 1.4.1
Requires PHP:  5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Short Description: Customize public frontend or admin backend wp-admin with responsive using the same CSS stylesheets file based on user roles type

== Description ==

Revolutionize your WordPress development with our innovative plugin role-based CSS customization feature. Seamlessly customize both the public frontend and admin backend (wp-admin) using a single CSS file, intelligently tailored to different user roles.

This powerful tool empowers developers to create unique style combinations for each user role, ensuring a personalized experience for administrators, editors, authors, contributors, subscribers, and even visitors/guests.

The simplicity of using one CSS file for both frontend and backend eliminates redundancy and enhances consistency in design. Efficiency meets flexibility as you effortlessly manage updates, bug fixes, and improvements through a centralized CSS file. Say goodbye to the hassle of duplicating efforts – our feature simplifies the development process, making it easy to maintain and adapt styles across your entire WordPress site.

👉 For the latest code development, planned enhancements, and known issues, visit our [Github page](https://github.com/newfiesoft/my-style-anytime "Github"). 👈

### Features

* Administrator custom style view
* Editor custom style view
* Author custom style view
* Contributor custom style view
* Subscriber custom style view
* Including Visitor/Guest custom style view style.
* Disable Gutenberg style
* Disable the meta generator.
* Remove "WordPress" from the title on any case scenario and on all available Site languages inside WordPress settings.


To test our plugin with different user roles and [WordPress](https://wordpress.org/documentation/article/roles-and-capabilities/#roles) basic user types, we've integrated it seamlessly with independent and widely-used WordPress plugins, each having its set of user roles. Currently, our plugin supports popular plugins like [WooCommerce](https://wordpress.org/plugins/woocommerce/), [Loco Translate](https://wordpress.org/plugins/loco-translate/), [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/), and [YITH WooCommerce Affiliates](https://wordpress.org/plugins/yith-woocommerce-affiliates/).


If you have any suggestions for additional plugins or want to discuss compatibility with a specific plugin, please share your thoughts in our [support topic](https://wordpress.org/support/topic/suggest-a-plugin-that-adds-his-role-inside-users/). We welcome your input and are eager to ensure compatibility with a wide range of plugins.


== Screenshots ==

1. Welcome screen
2. Manage Style page where you can see all available styles and their status and who can be Editing
3. Code Editor where you can manage and customize your style independent of user role type
4. Customization page and his configuration options like Remove 100% WordPress from the title
5. Security page and his Information and configuration options
6. Settings page where you can enable additional useful functions
7. Backup / Restore page so now you can on click create Backup for all your styles and restore anytime.
8. Administrator custom style view
9. Editor custom style view
10. Author custom style view
11. Contributor custom style view
12. Subscriber custom style view
13. Visitor custom style view
14. WooCommerce Shop Manager custom style view
15. WooCommerce Customer custom style view
16. Loco Translate custom style view
17. Yoast SEO Manager custom style view
18. Yoast SEO Editor custom style view
19. YITH WooCommerce Affiliates custom style view


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

Now on the left menu, you have new options with the name <strong>My Style Anytime</strong>, click on the name how see all the options.

On the plugin menu you have <strong>Manage Style</strong>, click on that you go on plugin style files editors.

Enjoy your work... 🥳


== Frequently Asked Questions ==

= Is this plugin free? =

Yes, this plugin version is 100% free.

= Can I show or include it in Frontend public/visitor/guest style? =

Yes, of course, in any role style, you can find the next part of the code commented.

/* To import visitor style in this user @Roles type
@import "visitor-style.css";
 */

When you enable import visitor-style.css to need to know, you import all that is inside in visitor-style.css

= Backup important files when you upgrade to the latest version =

If you manually upload the plugin on the last version using someone files  FTP application, only just skip and not remove folder  <strong>styles</strong>, all others you can remove and all from the last version that you download.

But if you're using an upgrade inside the WordPress site plugin area, before doing that just backup folder <strong>styles</strong>, and after doing that you can upgrade to the official last version.

<strong>From version 1.4.0 we created a backup page so now you can click create Backup for all your styles and Restore anytime.</strong>


== Changelog ==

= 1.4.1 - 23.02.2024 =
* Reorganized <strong>readme.txt</strong> file, optimized content for all available localization language support at this moment, description, and tags

* <strong>Fix:</strong> some lines on the main plugin file <strong>my-style-anytime.php</strong>


= 1.4.0 - 22.02.2024 =
* <strong>We</strong> complete testing on WordPress version 6.4.3

* <strong>We</strong> reorganized and optimized the code, and changed the description, tags, and icons.

* <strong>Add:</strong> Create a backup page so now you can on click create Backup for all your styles, and restore anytime.

* <strong>Add:</strong> From this version in every subsequent one, we use [Font Awesome | Free Icons ](https://fontawesome.com/)

* <strong>Add:</strong> From this version, any user roles css style has been checked in the background and returned status inside Manage Style. In that case, you can say do you want to create custom CSS for that user role type or not.

* <strong>Add:</strong> Now inside any part of the plugin, where have options to make changes or any other type of action, you have different types of information before action confirmation or after action confirmation.

* <strong>Add:</strong> We use the AI and create Locales for plugins on all who have used 1% plus on global information taken from official [WordPress Statistics](https://wordpress.org/about/stats/)

* <strong>Remove:</strong> From this version does not have any more inside Settings page options Allow File Code Editor. Because from version 1.3.0 we have an independent style code editor.

* <strong>Remove:</strong> From this version does not have any more help pages. Because from version 1.3.0 we have an independent style code editor.


= 1.3.0 - 13.12.2023 =
* <strong>We</strong> complete testing on WordPress version 6.4.2

* <strong>We</strong> reorganized and optimized the code, and changed the description and tags.

* <strong>Add:</strong> We Created an Independent Code Editor inside the Mnagage Style page which can only edit CSS files inside set directories, for all user role types. Inside the Settings page, we note remove options where Disable or Allow the default WordPress File Code Editor for security reasons. And independent of that you can manage your css files for roles.

* <strong>Add:</strong> We added a Malayalam key on how to remove WordPress from the title of any page. And after testing we again cover all available Site Language inside WordPress.

* <strong>Fix:</strong> Inside the main localization file my-style-anytime.pot we fix the bugs and optimize on lines how translation can cover and work 100%


= 1.2.0 - 29.09.2023 =
* <strong>We</strong> complete testing on WordPress version 6.3.1

* <strong>Add:</strong> We optimize the .pot file as a part of the plugin, add new lines, and optimize olders.

* <strong>Add:</strong> In this version, we implement [WooCommerce](https://wordpress.org/plugins/woocommerce/) user roles.

* <strong>Add:</strong> In this version, we implement [Loco Translate](https://wordpress.org/plugins/loco-translate/) user roles.

* <strong>Add:</strong> In this version, we implement [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) user roles.

* <strong>Add:</strong> In this version, we implement [YITH WooCommerce Affiliates](https://wordpress.org/plugins/yith-woocommerce-affiliates/) user roles.

* <strong>Fix:</strong> disagreements with form-table


= 1.1.0 - 17.05.2023 =
* <strong>We</strong> reorganized the version control schematic.

* <strong>We</strong> complete testing on WordPress version 6.2.1

* <strong>Add:</strong> Functions on the Security page where you disable the meta generator.

* <strong>Add:</strong> Functions on the Customization page where you Remove "WordPress" from the title on any case.

* On this version we changed the link rel='stylesheet' id=' generate line how to avoid a possible conflict with any other plugins with the same name as admin-style-css now it is admin-msyt-styles-css


= 1.0.4 - 24.02.2023 =
* <strong>We</strong> reorganized the directory structure and code.

* <strong>Add:</strong> Settings pages where you can enable or disable on-click file editing.

* <strong>Add:</strong> Functions on the Settings page where you disable Gutenberg style anywhere & Enable classic editor.

* <strong>Add:</strong> From this version, the .pot file is a part of the plugin and is 100% optimized with the plugin. That means now we can make localization and work on multi-language support.


= 1.0.3 - 01.10.2022 =
* <strong>Add:</strong> Ratings on the Installed Plugins list page itself.


= 1.0.2.9 - 01.10.2022 =
* <strong>Fix:</strong> the bug after the update in version 1.0.2


= 1.0.2 - 01.10.2022 =
* <strong>We</strong> optimized the code and added additional buttons on the Installed Plugins list page itself.


= 1.0.1 - 01.09.2022 =
* <strong>We</strong> add a function where visitors have the owner's custom style (visitor-style.css). With this now you do not need to use theme style.css primarily.


= 1.0.0 - 01.08.2022 =
* First release


== Upgrade Notice ==

= 1.4.1 - 23.02.2024 =
<strong>We</strong> optimized content, localization, description, and tags and fixed some lines