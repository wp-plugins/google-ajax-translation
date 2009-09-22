<?php
/*
Plugin Name: Google AJAX Translation
Plugin URI: http://wordpress.org/extend/plugins/google-ajax-translation/
Description: Add <a href="http://code.google.com/apis/ajaxlanguage/">Google AJAX Translation</a> to your blog. This plugin allows your blog readers to translate your blog posts or comments into other languages. <a href="options-general.php?page=ajaxtranslation.php">[Settings]</a>
Author: Libin Pan, Michael Klein, and Nick Marshall
Version: 0.4.9
Stable tag: 0.4.9
Author URI: http://libinpan.com/
	
TODO:
	- add widget?

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/

if (!class_exists('GoogleTranslation')) {
	class GoogleTranslation {

		var $optionPrefix = 'google_translation_';
		var $version      = '0.4.9';
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
			'postEnable' => true, // is stored as "1" and "0" in database or false if the option doesn't exist
			'pageEnable' => true,
			'excludePages' => array(),
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
			$this -> pluginRoot = plugins_url('google-ajax-translation/');

			/*foreach ( $this -> options as $k => $v ) {
				delete_option( $this -> optionPrefix.$k );
			}*/

				foreach ( $this -> options as $k => $v ) { // get options from database
					$current_option = get_option( $this -> optionPrefix . $k );
					if ( false !== $current_option ) // Checks to skip false options (missing from database)
						$this -> options[$k] = $current_option;
				}

			//	echo var_dump($this -> options) . "<br />\n";

			$browser_lg = $this -> browser_lang = $this -> preferred_language( $this -> target_languages ); // find browser's preferred language
			$browser_lg_index = array_search ( $browser_lg  , $this -> options['languages'] ); // find index of preferred language in options array
			if ( FALSE !== $browser_lg_index ) { // if preferred language is in options array, move it to the first element
				array_splice( $this -> options['languages']  , $browser_lg_index  , 1 );
				array_unshift( $this -> options['languages']  , $browser_lg );
			}

			// Add action and filter hooks to WordPress
			wp_register_style( 'google-ajax-translation-css', $this->pluginRoot . 'google-ajax-translation.css', false, '20090828', 'screen' );
			wp_register_script( 'jquery-translate-js', $this->pluginRoot . 'jquery.translate-1.3.9.min.js', array('jquery'), '1.3.9', true );
			//wp_enqueue_script( 'google-ajax-translation-js', $this->pluginRoot . 'google-ajax-translation.js', array('jquery-translate'), '20090830', true ); // Minified version is appended to jquery.translate-1.3.9.min.js (Leave this here for debugging.)
			if ( is_admin() ) {
				add_action( 'admin_menu', array( &$this, 'addOptionsPage' ) );
				add_action( 'admin_init', array( &$this, 'register_translation_settings' ) );
				if ( 'ajaxtranslation.php' == $_GET['page'] ) {
					wp_enqueue_style( 'google-ajax-translation-css' );
					wp_enqueue_script( 'jquery-translate-js' );
				}
			} else {
				wp_enqueue_style( 'google-ajax-translation-css' );
				wp_enqueue_script( 'jquery-translate-js' );
				if ( $this -> options['postEnable'] || $this -> options['pageEnable'] ) {
					add_filter( 'the_content', array( &$this, 'processContent' ), 50 );
				}
				if ( $this -> options['commentEnable'] ) {
					add_filter( 'comment_text', array( &$this, 'processComment' ), 50 );
				}
				add_filter( 'wp_footer', array( &$this, 'getLanguagePopup' ), 5 );
			}
		}

		function addOptionsPage(){
			$plugin_page = add_options_page('Google Translation', 'Google Translation', 'manage_options', basename(__FILE__), array(&$this, 'outputOptionsPanel'));
			if ( 'ajaxtranslation.php' == $_GET['page'] )
				add_action( 'admin_footer-'. $plugin_page, array( &$this, 'admin_js' ) );
		}

		function register_translation_settings() { // whitelist and sanitize options
			$p = $this -> optionPrefix;
			register_setting( 'google-ajax-translation', $p . 'linkStyle', array( &$this, 'sanitize_linkStyle' ) );
			register_setting( 'google-ajax-translation', $p . 'linkPosition', array( &$this, 'sanitize_linkPosition' ) );
			register_setting( 'google-ajax-translation', $p . 'postEnable', array( &$this, 'sanitize_checkbox' )  );
			register_setting( 'google-ajax-translation', $p . 'pageEnable', array( &$this, 'sanitize_checkbox' )  );
			register_setting( 'google-ajax-translation', $p . 'excludePages', array( &$this, 'sanitize_excludePages' ) );
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
			return ( $value ) ? 1 : 0;
		}

		function sanitize_excludePages($value) { // sanitize excludePages string
			$value = explode( ",", $value );
			$index = 0;
			while ( $index < sizeof( $value ) ) {
				$page_id_int = absint( $value[$index] );
				if ( $page_id_int ) {
					$value[$index] = $page_id_int;
					$index++;
				} else {
					array_splice( $value, $index, 1 );
				}
			}
			return $value;
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
				$value = array(); // no languages checked sends a null string so this sets it to an empty array
			}
			return $value;
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

		function admin_js() { // attach click events to admin buttons
			$browser_lg = $this -> browser_lang;
			if ( "he" == $browser_lg )
				$browser_lg = "iw"; // Google translate uses the wrong code for Hebrew
			?>
			<script type="text/javascript">
			//<![CDATA[
				jQuery(document).ready(function($) {
<?php
					if ( 'en' != $this -> browser_lang ) {
					?>
					$('#translate_button').click(function() { // translate panel into browser's preferred language
						$('.wrap').translate( 'en', '<?php echo $browser_lg ?>', {
							not: 'img, #translate_button',
							start: function() { $('#translate_loading_admin').show(); },
							complete: function() { $('#translate_loading_admin').hide(); },
							error: function() { $('#translate_loading_admin').hide(); }
						});
					});
<?php
					}
					?>
					$('input[name="google_translation_pageEnable"]').click(function() { // disable and enable excludePages text field
						if ( $(this).is(':checked') ) {
							$('input[name="google_translation_excludePages"]').removeAttr('disabled');
						} else {
							$('input[name="google_translation_excludePages"]').attr('disabled', 'disabled');
						}
					});
					$('#languages_all').click(function() { // check all languages
						$('.translate_links input').attr('checked', 'checked');
					});
					$('#languages_none').click(function() { // uncheck all languages
						$('.translate_links input').removeAttr('checked');
					});
				});
			//]]>
			</script>
			<?php
		}

		function outputOptionsPanel() {
			$domain = $this -> textDomain;
			$p = $this -> optionPrefix;
			$excludePages_str = implode( ", ", (array) $this -> options['excludePages'] );
			echo '<div class="wrap">
			<h2>' . __('Google Ajax Translation', $domain) . '</h2>
			<p>' . __('Version', $domain) . ' ' . $this->version . ' | <a href="' . $this -> authorUrl . '" target="_blank" title="' . __('Visit author homepage', $domain) . '">Homepage</a> | <a href="' . $this -> pluginUrl . '" target="_blank" title="' . __('Visit plugin homepage', $domain) . '">Plugin Homepage</a> | <a target="_blank" title="Donate" href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=libin_pan%40hotmail%2ecom&amp;item_name=Google%20Ajax%20Translation%20WP%20Plugin&amp;item_number=Support%20Open%20Source&amp;no_shipping=0&amp;no_note=1&amp;tax=0&amp;currency_code=USD&amp;lc=US&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8">' . __('Donate', $domain) . '</a></p>
			';
			echo '<form method="post" action="options.php">
			<table class="form-table"> 
			<tr valign="top">
				<th scope="row">' . __('Link style', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Link style', $domain) . '</span></legend>
						<label><input name="' . $p . 'linkStyle" type="radio" value="text" ' . ( ( 'text' == $this -> options['linkStyle'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Language Text', $domain) . '</span></label><br />
						<label><input name="' . $p . 'linkStyle" type="radio" value="image" ' . ( ( 'image' == $this -> options['linkStyle'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Flag Icon', $domain) . '</span></label><br />
						<label><input name="' . $p . 'linkStyle" type="radio" value="imageandtext" ' . ( ( 'imageandtext' == $this -> options['linkStyle'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Flag Icon and Text', $domain) . '</span></label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Translate button position', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Translate button position', $domain) . '</span></legend>
						<label><input name="' . $p . 'linkPosition" type="radio" value="top" ' . ( ( 'top' == $this -> options['linkPosition'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Top', $domain) . '</span></label><br />
						<label><input name="' . $p . 'linkPosition" type="radio" value="bottom" ' . ( ( 'bottom' == $this -> options['linkPosition'] ) ? 'checked="checked" ' : '' ) . '/> <span>' . __('Bottom', $domain) . '</span></label><br />
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Posts', $domain) . '</th>
				<td>
					<label>
						<input name="' . $p . 'postEnable" type="checkbox" ' . ( ( $this -> options['postEnable'] ) ? 'checked="checked"' : '' ) . ' />
						<span>' . __('Enable post translation', $domain) . '</span>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Pages', $domain) . '</th>
				<td>
					<label>
						<input name="' . $p . 'pageEnable" type="checkbox" ' . ( ( $this -> options['pageEnable'] ) ? 'checked="checked"' : '' ) . ' />
						<span>' . __('Enable page translation', $domain) . '</span>
					<label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Exclude pages', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Exclude pages', $domain) . '</span></legend>
						<input name="' . $p . 'excludePages" type="text" value="' . $excludePages_str . '" ' . ( ( $this -> options['pageEnable'] ) ? '' : 'disabled="disabled"' ) . ' />
						<span class="description">' . __('A comma separated list of page ID’s', $domain) . '</span>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Comments', $domain) . '</th>
				<td>
					<label>
						<input name="' . $p . 'commentEnable" type="checkbox" ' . ( ( $this -> options['commentEnable'] ) ? 'checked="checked"' : '' ) . ' />
						<span>' . __('Enable comment translation', $domain) . '</span>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">' . __('Languages', $domain) . '</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span>' . __('Languages', $domain) . '</span></legend>
						<table class="translate_links"><tr><td style="padding: 0 10px 0 0;" valign="top">
						';
						$numberof_languages = count( $this -> languages );
						foreach ( $this -> languages as $lg => $v ) {
							echo '<label title="' . $this -> display_name[$lg] . '"><input type="checkbox" name="' . $p . 'languages[]" value="' . $lg . '" ';
							if ( in_array( $lg, (array) $this -> options['languages'] ) ) echo 'checked="checked"';
							echo ' /> <img class="translate_flag ' . $lg . '" src="' . $this -> pluginRoot . 'transparent.gif" alt="' . $this -> display_name[$lg] . '" width="16" height="11" /> <span>' . $v . '</span></label><br />
							';
							if ( ( 0 == ++$i % 15) && ( $i < $numberof_languages ) ) {
								echo '</td>
								<td valign="top">';
							}
						}
				echo '</td></tr>
						</table>
						<p>
							<input type="button" class="button" id="languages_all" value="' . __('All', $domain) . '" />
							<input type="button" class="button" id="languages_none" value="' . __('None', $domain) . '" />
						</p>
					</fieldset>
				</td></tr>
			</table>
			';
			if ( 'en' != $this -> browser_lang ) {
				echo '<input type="button" class="button" id="translate_button" value="' . $this -> translate_message[$this -> browser_lang] . '" /> <img src="' . $this -> pluginRoot . 'transparent.gif" id="translate_loading_admin" class="translate_loading" style="display: none;" width="16" height="16" alt="" />
			';
			}
			echo '<p class="submit">
				' , settings_fields('google-ajax-translation') , '
				<input type="submit" name="submit" class="button-primary" value="' . __('Save Changes', $domain) . '" />
			</p></form></div>';
		}

		function processContent($content = '') {
			$backtrace = debug_backtrace();
			if ( !is_feed() && // ignore feeds
			( "the_excerpt" != $backtrace[7]["function"] ) && // ignore excerpts
			( ( !is_page() && $this -> options['postEnable'] ) || ( is_page() && $this -> options['pageEnable'] ) ) && // apply to posts or pages
			! ( ( array() !== $this -> options['excludePages'] ) && is_page( $this -> options['excludePages'] ) ) ) { // exclude certain pages 
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