=== Disable Text Selection ===
Contributors: thegulshankumar
Donate link: https://ko-fi.com/gulshan
Tags: text-selection, content protection
Requires at least: 4.5
Requires PHP: 5.6
Tested up to: 6.6.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin safeguards your valuable content by disabling text selection for regular users while allowing full access for administrators and editors.

== Description ==

This WordPress plugin controls text selection on your website by allowing users to select text only within specific HTML elements, effectively protecting your content. By preventing unauthorized copying, you can maintain the integrity of your work. Additionally, this plugin helps prevent content copying through browser extensions or by disabling JavaScript, further enhancing your content protection strategy. Administrators retain full text selection capabilities, ensuring that the functionality of your site remains intact. With a focus on enhancing user experience, this tool effectively protects your intellectual property without compromising accessibility.

=== Features ===

- **Allowed Elements**:
  - `<form>`
  - `<input>`
  - `<textarea>`
  - `<pre>`
  - `<code>`

- **Selection Control**: 
  - Text selection is disabled on normal paragraphs to prevent unauthorized copying of your content.
  - If selected text exceeds ten characters in allowed areas, it will be cleared.

- **Full Text Selection**: 
  - The `CTRL + A` (or `Command + A` on Mac) shortcut is allowed within input fields and text areas.

- **Shift-Drag Support**: 
  - Users can select text by clicking and dragging within allowed elements while holding the Shift key.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/disable-text-selection` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. The plugin will automatically start controlling text selection on your site.

== Usage ==

Once activated, the plugin will manage text selection according to the specified rules, enhancing user interaction while preventing the unauthorized copying of your content.

== Support ==

For any questions or support requests, please open an issue in the plugin's repository or contact the plugin author.

== Frequently Asked Questions ==

= How to Test if This Plugin is Working =

After activating the plugin, please follow these steps to ensure it functions correctly:

1. **Clear Your Cache**: It is essential to clear your page cache to reflect the changes made by the plugin.

2. **Use Incognito Mode**: Open your site in Incognito mode, or use a non-administrator, non-editor account to simulate the experience of a regular visitor.

3. **Check Functionality**: 
   - Visit your website and try selecting text from a paragraph. You should find that text selection is disabled as intended.
   - Additionally, disable JavaScript in your browser settings and refresh the page. You should see a prompt requesting you to enable JavaScript to access the site.

By following these steps, you can effectively verify that the plugin is working as designed.

= Does it prevent bypassing protection in noscript mode =
By default, yes. Every modern browser comes with JavaScript enabled, and there is generally no compelling reason for users to disable it. However, if a user chooses to disable JavaScript to bypass content protection, this plugin strictly enforces the requirement to enable JavaScript first to deliver its protective features. If you wish to disable this strict mode, you can do so using the following filter and clear the page cache to reflect the changes, though I do not recommend this approach:

`add_filter( 'disable_text_selection_noscript', '__return_false' );`

Protecting against text selection is a complex challenge, and significant efforts have been made to ensure this plugin works effectively in most scenarios.


== Changelog ==

= 1.0.0 =
* Initial release