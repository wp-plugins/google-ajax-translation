<?php
// echo "WP_UNINSTALL_PLUGIN: " . WP_UNINSTALL_PLUGIN . "<br />";
// echo "plugin_basename('google-ajax-translation/ajaxtranslation.php'): " . plugin_basename('google-ajax-translation/ajaxtranslation.php') . "<br />";
if ( plugin_basename('google-ajax-translation/ajaxtranslation.php') == WP_UNINSTALL_PLUGIN ) { // 
	require_once("ajaxtranslation.php");
	$GoogleTranslation -> uninstall(); // delete options from wp_options table
}
?>