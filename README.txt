=== Google AJAX Translation ===
Contributors: Libin, alquanto, monodistortion
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=libin_pan%40hotmail%2ecom&amp;item_name=Google%20Ajax%20Translation%20WP%20Plugin&amp;item_number=Support%20Open%20Source&amp;no_shipping=0&amp;no_note=1&amp;tax=0&amp;currency_code=USD&amp;lc=US&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8
Tags: google, ajax, jquery, translate, translation, language
Requires at least: 2.8
Tested up to: 2.8
Stable tag: 0.4.7

Add Google AJAX Translation to your blog. This plugin allows your readers to translate your blog posts, pages, or comments into 43 languages.

== Description ==

The Google AJAX Translation WordPress plugin provides a quick, simple, and light way to add translation to your blog.

A "Translate" button can be added to the bottom or top of posts, pages, and/or comments. When the button is clicked a popup window opens showing a list of available languages. You can choose which of the 43 languages to display in the Administration Panel. The list of languages can be shown as text (in the native language of each language), as flag icons, or as both. Flag icons can be confusing and sometimes misleading so I recommend the text option. (See this <a href="http://www.google.com/search?q=language+flags">google search for language flags.</a>)

Most formatting, font, color, etc. changes can be made in the file `google-ajax-translation.css` or you can override them with your own CSS file.

The plugin detects the browser's preferred language and shows the "Translate" button in that language if available. That language is listed first in the popup. The tooltip for each language is also translated into the browser's preferred language. If the browser's preferred language isn't English a "Translate" button is shown on the Administration Panel that translates the panel. See <a href="http://www.w3.org/International/questions/qa-lang-priorities">this page</a> for more information about setting your browser's preferred language.

Clicking the "powered by Google" link will take you to a full-page Google translation in your browser's preferred language.

Related Links:

* See the plugin in use on <a href="http://orrmarshall.com/wp/">orrmarshall.com</a>
* <a href="http://blog.libinpan.com/2008/08/04/google-ajax-translation-wordpress-plugin/">Google AJAX Translation WordPress Plugin v0.2.0</a>
* <a href="http://blog.libinpan.com/2008/03/21/introducing-the-google-ajax-translation-wordpress-plugin/">Google AJAX Translation WordPress Plugin v0.1.0</a>

== Installation ==

1. Download the plugin archive and expand it if you haven't already.
2. Put the `google-ajax-translation` folder into your `wp-content/plugins/` directory.
3. Go to the Plugins page in your Administration Panel and click "Activate" for Google AJAX Translation.
4. Change the settings from Setting -> Google Translation.
5. Have fun with your blog readers.


== Frequently Asked Questions ==

* Uses the <a href="http://code.google.com/apis/ajaxlanguage/">Google AJAX Language API</a> and the <a href="http://code.google.com/p/jquery-translate/">jquery-translate plugin</a>.
* Google Ajax Translation automatically detects your source language. If your source text changes to more than one language it can get confused.
* To exclude certain pages from displaying the "Translate" button put the page ID numbers into the field marked "Exclude pages", for example 4, 5, 21. If you use permalinks you may not know your page ID's. The page ID is the number at the end of the URL when editing a page.
* Most formatting, font, color, etc. changes can be made in `google-ajax-translation.css` or you can override them with your own CSS file
* The included ajax throbber is black on a white background. You can make your own at <a href="http://www.ajaxload.info/">http://www.ajaxload.info/</a>. 16 by 16 pixels works best.
* The "[" and "]" characters in the "Translate" button can be changed in the variables `$before_translate` and `$after_translate`
* The `google-ajax-translation.js` file is included for reference. It is minified and appended to the file `jquery.translate-1.3.9.min.js`
* Deleting the plugin from the Administration Panel (Plugins > Installed) also deletes the options from the wp_options table in the database.
* This plugin automatically uses the jQuery library supplied by your WordPress installation (version 1.3.2 as of August 2009). If your theme or another plugin has another copy of jQuery hard coded into it this plugin may not work.
* Clicking the "powered by Google" link will take you to a full-page Google translation in your browser's preferred language. (This service will refuse to translate a page into the same language though, e.g. English to English.)

== Screenshots ==

1. Translate popup with languages displayed as text (Safari 4 on Windows XP)
2. Translate popup with language flag icons (Firefox 3.5 on Windows XP)
3. Translate popup with language flag icons and text (Firefox 3.5 on Windows XP)

== Support ==

Have questions or suggestions for this plugin? 

Please ask in the forums here.

1. Please start a new thread for your question, problem, or suggestion.
2. Please include as much information as possible like:
   WordPress version, Google AJAX Translation version, a link to your web page
3. Most problems seem to be theme related so check to see if the plugin works in the default theme (Kubrick).

== Changelog ==

0.4.7 (Nick Marshall)

* Added an option to exclude certain pages from displaying the "Translate" button.
* If the browser's preferred language isn't English a "Translate" button is shown on the Administration Panel that translates the panel.
* Many tweaks to the Administration Panel
* The list of languages should be left aligned for all themes. Some theme's footers are center aligned which caused the problem.
* Fixed the Czech flag image (Thanks, maoric)

0.4.6 (Nick Marshall)

* The popup is now generated just once at the bottom of the html page and it gets moved around as needed with jQuery and JavaScript. This requires your theme to have the wp_footer() function. This speeds up page loading and improves keyword indexing by search engines. It seems like the popup works properly in Firefox 2 now.
* Added an option to put the [Translate] button at the top or bottom of posts and pages.
* Clicking the "powered by Google" link will take you to a full-page Google translation in your browser's preferred language. (This service will refuse to translate a page into the same language though, e.g. English to English.)
* The future has arrived! The popup window has a simple CSS 3 shadow in browsers such as Firefox 3.5+ and Safari 3+.
* The JavaScript loads in the footer instead of the head to speed up page loading. This requires your theme to have the wp_footer() function and WordPress 2.8+

0.4.5 (Nick Marshall)

* Updated the jquery-translate plugin to version 1.3.9 which fixes an issue with alignment of right-to-left languages.
* Fixed a bug where the [Translate] button and languages appear in `the_excerpt` if it's already 55 words or less. The function `get_the_excerpt` uses the filter `wp_trim_excerpt` which uses the filter `the_content`. (Thanks to Eiland for pointing out this problem.)

0.4.4 (Nick Marshall)

* The Google language API added <a href="http://googleblog.blogspot.com/2009/06/google-translates-persian.html">alpha support</a> for Persian (Farsi) so Persian was added.

0.4.3 (Nick Marshall)

* Added "All" and "None" buttons to Administration Panel to check and uncheck all language boxes. (Suggested by Jørn Eichner.)
* Added option to display flag icons with text.
* The popup window formats the languages into a table so CSS3 isn't used any more. The columns should work in all popular browsers. (Firefox 2 doesn't work.)
* Added sanitization callback functions for all register_setting options.
* Deleting the plugin from the Administration Panel (Plugins > Installed) also deletes the options from the wp_options table.

0.4.2 (Nick Marshall)

* Corrected the Swedish flag image (Thanks, Jørn Eichner)
* Added option to enable and disable page translation
* Fixed bug with loading default settings
* Changed options page to use register_setting function. The plugin requires WordPress version 2.7+

0.4.1 (Nick Marshall)

* Fixed php warning when plugin is first activated and default settings are ignored. (Thanks, Jørn Eichner)

0.4.0 (Nick Marshall)

* Added an option to enable and disable comment translation.
* The "Translate" buttons appear only after the document is ready and if JavaScript is enabled.
* Fixed the comment translation so that it's XHTML valid. (The problem was with the order of the default filter wpautop.)
* Added all 42 languages currently available from http://code.google.com/apis/ajaxlanguage/
* The list of languages appear in a popup window so they take up less space (42 languages is a lot!)
* The languages are displayed in their own language.
* If you hover over a language name the tooltip shows the language name in English.
* The popup window is styled with its own external CSS from `google-ajax-translation.css`.
* In Firefox the popup window is in three columns using CSS3. Safari doesn't quite format the columns correctly so I left that out.
* Added the jQuery-translate plugin to access Google translate. This plugin allows you to get around the character limit of Google translate by breaking up the object into 1000 character strings.
* The plugin detects the browser's preferred language. (See <a href="http://www.w3.org/International/questions/qa-lang-priorities">this page</a> for instructions.)
* The "Translate" buttons show up in the browser's preferred language if available.
* The browser's preferred language is put first in the list of languages in the popup.
* The first time the user clicks on a "Translate" button the tooltip language names are sent off to jQuery-translate and then inserted back into the tooltips so they can be displayed in all 42 languages also. So to the user the plugin is completely self-localized.
* Added the rest of the flags so there are flag icons for all 42 languages. (These are from <a href="http://www.famfamfam.com/lab/icons/flags/">http://www.famfamfam.com/lab/icons/flags/</a>. )
* All the flag icons are assembled into one PNG file and displayed as CSS background images sprites, which reduces the number of HTTP requests.
* Added an AJAX loading throbber image. Make your own at <a href="http://www.ajaxload.info/">http://www.ajaxload.info/</a>.
* JavaScript has been minified and moved to the end of `jquery.translate-1.3.2.min.js`. The non-minified source code is `google-ajax-translation.js`


0.3.1

* fixed some html-bugs (missing alt-Tags, etc.) (Michael Klein)

0.3.0

* encapsulate the plugin in a class. No global vars needed anymore, faster code (Michael Klein)
* Better support of capabilities-model (WP 2.6)

0.2.0 Thanks Michael Klein from alquanto.de for:

* Add Flag ICONs link style
* Add Flag ICONs

Others changes:

* Add Admin Configuration Page
* Link Style: Text and Image
* Enable/Disable Post Translation
* Choose languages from the whole list

0.1.1 Small updates:

* Working on Admin/Comments pages too
* Fixed the comment format problem found by Sean

0.1

* Initial Release