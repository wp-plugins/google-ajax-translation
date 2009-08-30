<?php
/*
Plugin Name: Google AJAX Translation
Plugin URI: http://wordpress.org/extend/plugins/google-ajax-translation/
Description: Add <a href="http://code.google.com/apis/ajaxlanguage/">Google AJAX Translation</a> to your blog. This plugin allows your blog readers to translate your blog posts or comments into other languages. <a href="options-general.php?page=ajaxtranslation.php">[Settings]</a>
Author: Libin Pan, Michael Klein, and Nick Marshall
Version: 0.4.6
Stable tag: 0.4.6
Author URI: http://libinpan.com/

Installation:
	1. Download the plugin and unzip it if you haven't already.
	2. Put the 'google-ajax-translation' folder into your wp-content/plugins/ directory.
	3. Go to the Plugins page in your Administration Panel and click "Activate" for Google AJAX Translation.
	4. Change the settings from Setting -> Google Translation.
	5. Have fun with your blog readers.

Notes:
	- Uses the Google AJAX Language API http://code.google.com/apis/ajaxlanguage/ and the jquery-translate plugin http://code.google.com/p/jquery-translate/
	- Google Ajax Translation automatically detects your source language. If your source text changes to more than one language it can get confused.
	- Most formatting, font, color, etc. changes can be made in google-ajax-translation.css or you can override them with your own CSS file
	- The included ajax throbber, ajax-loader.gif, is black on a white background. You can make your own at http://www.ajaxload.info/ 16 by 16 pixels works best.
	- The "[" and "]" characters in the "Translate" button can be changed in the variables $before_translate and $after_translate
	- The google-ajax-translation.js file is included for reference. It is minified and appended to the file jquery.translate-1.3.9.min.js
	- If you want to make some changes and want to share with all of us, please feel free to contact me @ libinpan@gmail.com or leave comments
	
TODO:
	- add widget?

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/

if (!class_exists('GoogleTranslation')) {
	class GoogleTranslation {

		var $optionPrefix = 'google_translation_';
		var $version      = '0.4.6';
		var $pluginUrl    = 'http://wordpress.org/extend/plugins/google-ajax-translation/';
		var $authorUrl    = 'http://blog.libinpan.com/2008/08/04/google-ajax-translation-wordpress-plugin/';

		var $languages = array(
			'ar' => 'Arabic',
			'bg' => 'Bulgarian',
			'ca' => 'Catalan',
			'cs' => 'Czech',
			'da' => 'Danish',
			'de' => 'German',
			'el' => 'Greek',
			'en' => 'English',
			'es' => 'Spanish',
			'et' => 'Estonian',
			'fa' => 'Persian',
			'fi' => 'Finnish',
			'fr' => 'French',
			'gl' => 'Galician',
			'he' => 'Hebrew',
			'hi' => 'Hindi',
			'hr' => 'Croatian',
			'hu' => 'Hungarian',
			'id' => 'Indonesian',
			'it' => 'Italian',
			'ja' => 'Japanese',
			'ko' => 'Korean',
			'lt' => 'Lithuanian',
			'lv' => 'Latvian',
			'mt' => 'Maltese',
			'nl' => 'Dutch',
			'no' => 'Norwegian',
			'pl' => 'Polish',
			'pt' => 'Portuguese',
			'ro' => 'Romanian',
			'ru' => 'Russian',
			'sk' => 'Slovak',
			'sl' => 'Slovenian',
			'sq' => 'Albanian',
			'sr' => 'Serbian',
			'sv' => 'Swedish',
			'th' => 'Thai',
			'tl' => 'Filipino',
			'tr' => 'Turkish',
			'uk' => 'Ukrainian',
			'vi' => 'Vietnamese',
			'zh-cn' => 'Chinese (Simplified)',
			'zh-tw' => 'Chinese (Traditional)'
		);
		var $target_languages = array(
			'ar',     // Arabic
			'bg',     // Bulgarian
			'ca',     // Catalan
			'cs',     // Czech
			'da',     // Danish
			'de',     // German
			'el',     // Greek
			'en',     // English
			'es',     // Spanish
			'et',     // Estonian
			'fa',     // Persian
			'fi',     // Finnish
			'fr',     // French
			'gl',     // Galician
			'he',     // Hebrew
			'hi',     // Hindi
			'hr',     // Croatian
			'hu',     // Hungarian
			'id',     // Indonesian
			'it',     // Italian
			'ja',     // Japanese
			'ko',     // Korean
			'lt',     // Lithuanian
			'lv',     // Latvian
			'mt',     // Maltese
			'nl',     // Dutch
			'no',     // Norwegian
			'pl',     // Polish
			'pt',     // Portuguese
			'ro',     // Romanian
			'ru',     // Russian
			'sk',     // Slovak
			'sl',     // Slovenian
			'sq',     // Albanian
			'sr',     // Serbian
			'sv',     // Swedish
			'th',     // Thai
			'tl',     // Filipino
			'tr',     // Turkish
			'uk',     // Ukrainian
			'vi',     // Vietnamese
			'zh-cn',  // Chinese (Simplified)
			'zh-tw'   // Chinese (Traditional)
		);
		var $display_name = array(
			'ar' => 'العربية',
			'bg' => 'български',
			'ca' => 'català',
			'cs' => 'česky',
			'da' => 'dansk',
			'de' => 'Deutsch',
			'el' => 'ελληνική',
			'en' => 'English',
			'es' => 'español',
			'et' => 'eesti',
			'fa' => 'فارسی',
			'fi' => 'suomi',
			'fr' => 'français',
			'gl' => 'galego',
			'he' => 'עברית',
			'hi' => 'हिन्दी',
			'hr' => 'hrvatski',
			'hu' => 'magyar',
			'id' => 'Indonesia',
			'it' => 'italiano',
			'ja' => '日本語',
			'ko' => '한국어',
			'lt' => 'lietuvių',
			'lv' => 'latviešu',
			'mt' => 'Malti',
			'nl' => 'Nederlands',
			'no' => 'norsk',
			'pl' => 'polski',
			'pt' => 'português',
			'ro' => 'română',
			'ru' => 'русский',
			'sk' => 'slovenčina',
			'sl' => 'slovenščina',
			'sq' => 'shqipe',
			'sr' => 'српски',
			'sv' => 'svenska',
			'th' => 'ภาษาไทย',
			'tl' => 'Filipino',
			'tr' => 'Türkçe',
			'uk' => 'українська',
			'vi' => 'tiếng Việt',
			'zh-cn' => '中文 (简体)',
			'zh-tw' => '中文 (繁體)'
		);
		var $translate_message = array(
			'ar' => 'ترجمة',
			'bg' => 'Преводач',
			'ca' => 'Traductor',
			'cs' => 'Překladač',
			'da' => 'Oversæt',
			'de' => 'Übersetzung',
			'el' => 'Μετάφραση',
			'en' => 'Translate',
			'es' => 'Traductor',
			'et' => 'Tõlkima',
			'fa' => 'ترجمه',
			'fi' => 'Kääntäjä',
			'fr' => 'Traduction',
			'gl' => 'Traducir',
			'he' => 'תרגם',
			'hi' => 'अनुवाद करें',
			'hr' => 'Prevoditelj',
			'hu' => 'Fordítás',
			'id' => 'Translate',
			'it' => 'Traduttore',
			'ja' => '翻訳',
			'ko' => '번역',
			'lt' => 'Versti',
			'lv' => 'Tulkotājs',
			'mt' => 'Traduċi',
			'nl' => 'Vertaal',
			'no' => 'Oversetter',
			'pl' => 'Tłumacz',
			'pt' => 'Tradutor',
			'ro' => 'Traducere',
			'ru' => 'Переводчик',
			'sk' => 'Prekladač',
			'sl' => 'Prevajalnik',
			'sq' => 'Përkthej',
			'sr' => 'преводилац',
			'sv' => 'Översätt',
			'th' => 'แปล',
			'tl' => 'Pagsasalin',
			'tr' => 'Tercüme etmek',
			'uk' => 'Перекладач',
			'vi' => 'Dịch',
			'zh-cn' => '翻译',
			'zh-tw' => '翻譯',
		);

		var $options = array(  // default values for options
			'linkStyle' => 'text',
			'linkPosition' => 'bottom',
			'postEnable' => true,
			'pageEnable' => true,
			'commentEnable' => false,
			'languages' => array()
		);

		var $textDomain = 'wpgt';
		var $languageFileLoaded = false;
		var $pluginRoot = '';
		
		var $before_translate = '['; // text to display before and after "Translate" link
		var $after_translate = ']';
		var $browser_lang = 'en';
		
		/*
		function getPluginUrl() {
			if ( ! defined( 'WP_CONTENT_URL' ) )
				define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
			if ( ! defined( 'WP_PLUGIN_URL' ) )
				define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );
			return trailingslashit( WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) );
		}
		*/
		
		function GoogleTranslation() {                      // Constructor
			//$this->pluginRoot = $this->getPluginUrl(); // old pluginRoot function
			$this->pluginRoot = plugins_url('google-ajax-translation/');

			/*foreach ( $this -> options as $k => $v ) {
				delete_option( $this -> optionPrefix.$k );
			}*/
			if ( false !== get_option( $this -> optionPrefix . "languages" ) ) { // if options exist in the database
				foreach ( $this -> options as $k => $v ) {              // get options from DB
					$this -> options[$k] = get_option( $this -> optionPrefix . $k );
				}
				if ( '' == $this -> options['languages'] )
					$this -> options['languages'] = array(); // options['languages'] gets saved to the database incorrectly as a string if no languages are selected
			}
			// echo var_dump($this -> options) . "<br />";

			$browser_lg = $this -> browser_lang = $this -> preferred_language( $this -> target_languages ); // find browser's preferred language
			$browser_lg_index = array_search ( $browser_lg  , $this -> options['languages'] ); // find index of preferred language in options array
			if ( FALSE !== $browser_lg_index ) { // if preferred language is in options array, move it to the first element
				array_splice  ( $this -> options['languages']  , $browser_lg_index  , 1 );
				array_unshift  ( $this -> options['languages']  , $browser_lg );
			}

			// Add action and filter hooks to WordPress
			wp_enqueue_style( 'google-ajax-translation', $this->pluginRoot . 'google-ajax-translation.css', false, '20090828', 'screen' );
			if ( is_admin() ){
				add_action( 'admin_menu', array( &$this, 'addOptionsPage' ) );
				add_action( 'admin_init', array( &$this, 'register_mysettings' ) );
			} else {
				wp_enqueue_script( 'jquery-translate', $this->pluginRoot . 'jquery.translate-1.3.9.min.js', array('jquery'), '1.3.9', true );
				//wp_enqueue_script( 'google-ajax-translation', $this->pluginRoot . 'google-ajax-translation.js', array('jquery-translate'), '20090830', true ); // Minified version is appended to jquery.translate-1.3.9.min.js (Leave this here for debugging.)
				if ( $this -> options['postEnable'] || $this -> options['pageEnable'] ) {
					add_filter( 'the_content', array( &$this, 'processContent' ), 50 );
				}
				if ( $this -> options['commentEnable'] ) {
					add_filter( 'comment_text', array( &$this, 'processComment' ), 50 );
				}
				add_filter( 'wp_footer', array( &$this, 'getLanguagePopup' ), 5 );
			}
		}
		
		function register_mysettings() { // register and sanitize options
			$p = $this -> optionPrefix;
			register_setting( 'google-ajax-translation', $p . 'linkStyle', array( &$this, 'sanitize_linkStyle' ) );
			register_setting( 'google-ajax-translation', $p . 'linkPosition', array( &$this, 'sanitize_linkPosition' ) );
			register_setting( 'google-ajax-translation', $p . 'postEnable', array( &$this, 'sanitize_checkbox' )  );
			register_setting( 'google-ajax-translation', $p . 'pageEnable', array( &$this, 'sanitize_checkbox' )  );
			register_setting( 'google-ajax-translation', $p . 'commentEnable', array( &$this, 'sanitize_checkbox' )  );
			register_setting( 'google-ajax-translation', $p . 'languages', array( &$this, 'sanitize_languages' ) );
		}

		function sanitize_linkStyle($value) { // sanitize linkStyle option value
			$possible_values = array( 'text', 'image', 'imageandtext' );
			return ( in_array( $value, $possible_values ) ) ? $value : NULL;
		}

		function sanitize_linkPosition($value) { // sanitize linkPosition option value
			$possible_values = array( 'top', 'bottom' );
			return ( in_array( $value, $possible_values ) ) ? $value : NULL;
		}

		function sanitize_checkbox($value) { // sanitize checkbox option values
			return ( 'on' == $value ) ? $value : NULL;
		}

		function sanitize_languages($value) { // sanitize languages option array
			if ( is_array($value) ) {
				$index = 0;
				foreach ( $value as $lg ) {
					if ( ! in_array( $lg, $this -> target_languages ) ) {
						array_splice( $value, $index , 1 );
						$index--;
					}
					$index++;
				}
			} else {
				$value = array(); // no languages checked sends a "" string so this sets it to an empty array
			}
			return $value;
		}

		function addOptionsPage(){
			add_options_page('Google Translation', 'Google Translation', 'manage_options', basename(__FILE__), array(&$this, 'outputOptionsPanel'));
		}

		function uninstall() { // uninstall function called by uninstall.php
			foreach ( $this -> options as $k => $v ) { // delete options from wp_options table
					delete_option( $this -> optionPrefix . $k );
				}
			// echo "<p>Deleting options</p>";
		}

		function loadLanguageFile() { // loads language files according to locale (NOT WORKING YET)
			if(!$this->languageFileLoaded) {
				load_plugin_textdomain($this->textDomain, $this->pluginRoot . 'languages', 'google-ajax-translation/languages' );
				$this->languageFileLoaded = true;
			}
		}

		function outputOptionsPanel() {
			$domain = $this -> textDomain;
			$p = $this -> optionPrefix;
			echo '<div class="wrap">';
			echo '<h2>'.__('Google Ajax Translation', $domain).'</h2> ';
			echo '<p>'.__('Version').'&nbsp;'.$this->version;
			echo ' | <a href="'.$this -> authorUrl.'" target="_blank" title="' . __('Visit author homepage', $domain) . '">Homepage</a>';
			echo ' | <a href="'.$this -> pluginUrl.'" target="_blank" title="' . __('Visit plugin homepage', $domain) . '">Plugin Homepage</a>';
			echo ' | <a target="_blank" title="Donate" href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=libin_pan%40hotmail%2ecom&amp;item_name=Google%20Ajax%20Translation%20WP%20Plugin&amp;item_number=Support%20Open%20Source&amp;no_shipping=0&amp;no_note=1&amp;tax=0&amp;currency_code=USD&amp;lc=US&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8">' . __('Donate', $domain) . '</a>';
			echo "</p>\n";
			echo '<form method="post" action="options.php">
			<table class="form-table"> 
			<tr valign="top">
				<th scope="row">' . __('Link Style', $domain) . '</th>
				<td>
					<p>
						<label><input name="' . $p . 'linkStyle" type="radio" value="text" ' . ( ( 'text' == $this -> options['linkStyle'] ) ? 'checked="checked"' : '' ) . ' /> ' . __('Language Text', $domain) . '</label><br />
						<label><input name="' . $p . 'linkStyle" type="radio" value="image" ' . ( ( 'image' == $this -> options['linkStyle'] ) ? 'checked="checked"' : '' ) . ' /> ' . __('Flag Icon', $domain) . '</label><br />
						<label><input name="' . $p . 'linkStyle" type="radio" value="imageandtext" ' . ( ( 'imageandtext' == $this -> options['linkStyle'] ) ? 'checked="checked"' : '' ) . ' /> ' . __('Flag Icon and Text', $domain) . '</label>
					</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Translate button position', $domain) . '</th>
				<td>
					<p>
						<label><input name="' . $p . 'linkPosition" type="radio" value="top" ' . ( ( 'top' == $this -> options['linkPosition'] ) ? 'checked="checked"' : '' ) . ' /> ' . __('Top', $domain) . '</label><br />
						<label><input name="' . $p . 'linkPosition" type="radio" value="bottom" ' . ( ( 'bottom' == $this -> options['linkPosition'] ) ? 'checked="checked"' : '' ) . ' /> ' . __('Bottom', $domain) . '</label><br />
					</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Enable post translation', $domain) . '</th>
				<td>
					<input name="' . $p . 'postEnable" type="checkbox" ' . ( ( $this -> options['postEnable'] ) ? 'checked="checked"' : '' ) . ' />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Enable page translation', $domain) . '</th>
				<td>
					<input name="' . $p . 'pageEnable" type="checkbox" ' . ( ( $this -> options['pageEnable'] ) ? 'checked="checked"' : '' ) . ' />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Enable comment translation', $domain) . '</th>
				<td>
					<input name="' . $p . 'commentEnable" type="checkbox" ' . ( ( $this -> options['commentEnable'] ) ? 'checked="checked"' : '' ) . ' />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Languages', $domain) . '</th>
				<td>
					<table class="translate_links"><tr><td style="padding: 0 10px 0 0;" valign="top">
					';
					$numberof_languages = count( $this -> languages );
					foreach ( $this -> languages as $lg => $v ) {
						echo '<label title="' . $this -> display_name[$lg] . '"><input type="checkbox" name="' . $p . 'languages[]" value="' . $lg . '" ';
						if ( in_array( $lg, (array) $this -> options['languages'] ) ) echo 'checked="checked"';
						echo ' /> <img class="translate_flag ' . $lg . '" src="' . $this -> pluginRoot . 'transparent.gif" alt="' . $this -> display_name[$lg] . '" width="16" height="11" /> ' . $v . '</label><br />';
						if ( ( 0 == ++$i % 15) && ( $i < $numberof_languages ) ) {
							echo '</td>
							<td style="padding: 0 10px 0 0;" valign="top">';
						}
					}
			echo '</td></tr></table>
			<p>
				<input type="button" class="button" onclick="jQuery(\'.translate_links input\').attr(\'checked\', \'checked\')" value="' . __('All', $domain) . '" />
				<input type="button" class="button" onclick="jQuery(\'.translate_links input\').removeAttr(\'checked\')" value="' . __('None', $domain) . '" />
			</p>
			</td></tr></table>
			<p class="submit">';
			echo "\n" . settings_fields('google-ajax-translation') . "\n";
			echo '<input type="submit" name="submit" class="button-primary" value="' . __('Save Changes', $domain) . '" />
			</p></form></div>';
		}

		function processContent($content = '') {
			if ( !is_feed() &&
			( "wp_trim_excerpt" != $backtrace[3]["function"] ) &&
			( ( !is_page() && $this -> options['postEnable'] ) || ( is_page() && $this -> options['pageEnable'] ) ) ) { // ignore feeds, excerpts + apply to posts or pages as chosen in the options
				global $post;
				$id = $post -> ID;
				$browser_lg = $this -> browser_lang;
				$translate_block = '<a class="translate_translate" id="translate_button_post-' . $id . '" lang="' . $browser_lg . '" xml:lang="' . $browser_lg . '" href="javascript:show_translate_popup(\'' . $browser_lg . '\', \'post\', ' . $id . ');">' . ($this -> before_translate) . ($this -> translate_message[$browser_lg]) . ($this -> after_translate) . '<img src="' . $this -> pluginRoot . 'transparent.gif" id="translate_loading_post-' . $id . '" class="translate_loading" style="display: none;" width="16" height="16" alt="" /></a>';
				switch ( $this->options['linkPosition'] ) {
					case 'top':
						$content = '<div class="translate_block" style="display: none;">
							' . $translate_block . '
							<hr class="translate_hr" />
						</div>
						' . $content;
					break;
					case 'bottom':
						$content = $content . '
						<div class="translate_block" style="display: none;">
							<hr class="translate_hr" />
							' . $translate_block . '
						</div>';
					break;
				}
			}
			return $content;
		}

		function processComment($content = '') {
			if ( !is_feed() ) { // ignore feeds
				global $comment;
				$id = $comment -> comment_ID;
				$browser_lg = $this -> browser_lang;
				$translate_block = '<div class="translate_block" style="display: none;">
					<hr class="google_translate_hr" />
					<a class="translate_translate" id="translate_button_comment-' . $id . '" lang="' . $browser_lg . '" xml:lang="' . $browser_lg . '" href="javascript:show_translate_popup(\'' . $browser_lg . '\', \'comment\', ' . $id . ');">' . ($this -> before_translate) . ($this -> translate_message[$browser_lg]) . ($this -> after_translate) . '<img src="' . $this -> pluginRoot . 'transparent.gif" id="translate_loading_comment-' . $id . '" class="translate_loading" style="display: none;" width="16" height="16" alt="" /></a>
				</div>';
				$content .= $translate_block;
			}
			return $content;
		}

		function getLanguagePopup() {
			$numberof_languages = count( $this -> options['languages'] );
			$languages_per_column = ceil( ( $numberof_languages + 2 ) / 3 );
			$s = '<div id="translate_popup" style="display: none;">
			<table class="translate_links"><tr><td valign="top">
			';
			switch ( $this->options['linkStyle'] ) {
				case 'text':
					foreach($this -> options['languages'] as $lg) {
						$s .= '<a class="languagelink" lang="' . $lg . '" xml:lang="' . $lg . '" href="#" title="' . $this -> languages[$lg] . '">' . $this -> display_name[$lg] . '</a>
							';
						if ( 0 == ++$i % $languages_per_column) {
							$s .= '</td>
							<td valign="top">
							';
						}
					}
					break;
				case 'image':
					foreach($this -> options['languages'] as $lg) {
						$s .= '<a class="languagelink" lang="' . $lg . '" xml:lang="' . $lg . '" href="#" title="' . $this -> languages[$lg] . '"><img class="translate_flag ' . $lg . '" src="' . $this -> pluginRoot . 'transparent.gif" alt="' . $this -> display_name[$lg] . '" width="16" height="11" /></a>
							';
						if ( 0 == ++$i % $languages_per_column) {
							$s .= '</td>
							<td valign="top">
							';
						}
					}
					break;
				case 'imageandtext':
					foreach($this -> options['languages'] as $lg) {
						$s .= '<a class="languagelink" lang="' . $lg . '" xml:lang="' . $lg . '" href="#" title="' . $this -> languages[$lg] . '"><img class="translate_flag ' . $lg . '" src="' . $this -> pluginRoot . 'transparent.gif" alt="' . $this -> display_name[$lg] . '" width="16" height="11" /> ' . $this -> display_name[$lg] . '</a>
							';
						if ( 0 == ++$i % $languages_per_column) {
							$s .= '</td>
							<td valign="top">
							';
						}
					}
					break;
			}
			$s .= '<a class="google_branding" href="http://translate.google.com/translate?sl=auto&amp;tl=' . $this -> browser_lang . '&amp;u=' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '" title="translate page">' . __('powered by', $this -> textDomain ) . '<img src="http://www.google.com/uds/css/small-logo.png" alt="Google" title="" width="51" height="15" /></a>
				</td></tr></table>
				</div>
				';
			echo $s;
		}

		/**
		 * function from: http://us.php.net/manual/en/function.http-negotiate-language.php
		 * determine which language out of an available set the user prefers most
		 * @param array $available_languages An array with language-tag-strings (must be lowercase) that are available
		 * @param string $http_accept_language An HTTP_ACCEPT_LANGUAGE string (read from $_SERVER['HTTP_ACCEPT_LANGUAGE'] if left out)
		 * @return string Best language chosen from $available_languages
		 */
		function preferred_language($available_languages, $http_accept_language="auto") {
			// if $http_accept_language was left out, read it from the HTTP-Header
			if ($http_accept_language == "auto")
				$http_accept_language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

			// standard  for HTTP_ACCEPT_LANGUAGE is defined under
			// http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.4
			// pattern to find is therefore something like this:
			//    1#( language-range [ ";" "q" "=" qvalue ] )
			// where:
			//    language-range  = ( ( 1*8ALPHA *( "-" 1*8ALPHA ) ) | "*" )
			//    qvalue         = ( "0" [ "." 0*3DIGIT ] )
			//            | ( "1" [ "." 0*3("0") ] )
			preg_match_all("/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?" . "(\s*;\s*q\s*=\s*(1\.0{0,3}|0\.\d{0,3}))?\s*(,|$)/i",
				$http_accept_language, $hits, PREG_SET_ORDER);

			// default language (in case of no hits) is 'en'
			$bestlang = 'en';
			$bestqval = 0;

			foreach ($hits as $arr) {
				// read data from the array of this hit
				$langprefix = strtolower ($arr[1]);
				if (!empty($arr[3])) {
					$langrange = strtolower ($arr[3]);
					$language = $langprefix . "-" . $langrange;
				}
				else $language = $langprefix;
				$qvalue = 1.0;
				if (!empty($arr[5]))
					$qvalue = floatval($arr[5]);

				// find q-maximal language 
				if (in_array($language,$available_languages) && ($qvalue > $bestqval)) {
					$bestlang = $language;
					$bestqval = $qvalue;
				}
				// if no direct hit, try the prefix only but decrease q-value by 10% (as http_negotiate_language does)
				else if (in_array($langprefix,$available_languages) && (($qvalue * 0.9) > $bestqval)) {
					$bestlang = $langprefix;
					$bestqval = $qvalue * 0.9;
				}
			}
			return $bestlang;
		}
	}
}

if (class_exists('GoogleTranslation')) {                // instantiate the class
	$GoogleTranslation = new GoogleTranslation();
}
?>