<?php 
/*
|| --------------------------------------------------------------------------------------------
|| Metabox Load
|| --------------------------------------------------------------------------------------------
||
|| @package    Dilaz Metabox
|| @subpackage Load
|| @since      Dilaz Metabox 2.0
|| @author     Rodgath, https://github.com/Rodgath
|| @copyright  Copyright (C) 2017, Rodgath LTD
|| @link       https://github.com/Rodgath/Dilaz-Metabox-Plugin
|| @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
|| 
*/

defined('ABSPATH') || exit;

# dir
$dilaz_mb_folder   = basename(dirname(__DIR__));
$dilaz_mb_dir      = dirname(__DIR__);
$dilaz_mb_includes = $dilaz_mb_dir .'/includes/';
$dilaz_mb_options  = $dilaz_mb_dir .'/options/';

# Dilaz Metabox plugin file constant
defined('DILAZ_METABOX_PLUGIN_FILE') || define('DILAZ_METABOX_PLUGIN_FILE', 'dilaz-metabox/dilaz-metabox.php');

# Check if DilazMetabox plugin is installed and/or activated
if (!function_exists('is_plugin_active')) include_once ABSPATH . 'wp-admin/includes/plugin.php';
if (!is_plugin_active(DILAZ_METABOX_PLUGIN_FILE)) {
	add_action('admin_notices', function() {
		
		# check if its plugin when in theme use type
		if (FALSE !== strpos(dirname(__FILE__), '\plugins\\') || FALSE !== strpos(dirname(__FILE__), '/plugins/')) {
			
			if (!function_exists('get_plugin_data')) require_once ABSPATH . 'wp-admin/includes/plugin.php';
			
			$plugin_data = [];
			
			$plugins_dir     = ABSPATH . 'wp-content/plugins/'; 
			$plugin_basename = plugin_basename(__FILE__);
			$plugin_folder   = strtok($plugin_basename, '/');
			
			# use glob to check plugin data from all PHP files within plugin main folder
			foreach (glob(trailingslashit($plugins_dir . $plugin_folder) . '*.php') as $file) {
				$plugin_data = get_plugin_data($file);
				
				# lets ensure we don't return empty plugin data
				if (empty($plugin_data['Name'])) continue; else break;
			}
			
			$item_name = $plugin_data['Name'];
			$item_type = 'plugin';
			
		# check if its theme when in plugin use type
		} else if (FALSE !== strpos(dirname(__FILE__), '\themes\\') || FALSE !== strpos(dirname(__FILE__), '/themes/')) {
			$theme_object = wp_get_theme();
			$item_name    = is_child_theme() ? $theme_object['Template'] : $theme_object['Name'];
			$item_type    = 'theme';
		}
		
		$plugins = get_plugins();
		if (isset($plugins[DILAZ_METABOX_PLUGIN_FILE])) {
			$activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin='. urlencode(DILAZ_METABOX_PLUGIN_FILE), 'activate-plugin_'. DILAZ_METABOX_PLUGIN_FILE);
			echo '<div id="message" class="dilaz-metabox-notice notice notice-warning"><p><strong>'. sprintf(__('Please %1$sactivate%2$s <em>Dilaz Metabox</em> plugin. It is required by "<em>%3$s</em>" %4$s.', 'dilaz-metabox'), '<a href="'. $activation_url .'">', '</a>', $item_name, $item_type) .'</strong></p></div>';
		} else {
			echo '<div id="message" class="dilaz-metabox-notice notice notice-warning"><p><strong>'. sprintf(__('Please %1$sinstall%2$s <em>Dilaz Metabox</em> plugin. It is required by "<em>%3$s</em>" %4$s.', 'dilaz-metabox'), '<a href="'. admin_url('plugin-install.php') .'">', '</a>', $item_name, $item_type) .'</strong></p></div>';
		}
	});
	
	return;
}

# Lets ensure the DilazMetabox class is loaded
if (!class_exists('DilazMetabox')) {
	if (file_exists(ABSPATH .'wp-content/plugins/dilaz-metabox/dilaz-metabox.php')) {
		require_once ABSPATH .'wp-content/plugins/dilaz-metabox/dilaz-metabox.php';
	} else {
		return;
	}
}

# Metabox options
$dilaz_meta_boxes = array();
$prefix = DilazMetaboxFunction::preparePrefix($parameters['prefix']);

# Metabox Files
$user_type_file  = file_exists($dilaz_mb_includes .'use-type.php') ? $dilaz_mb_includes .'use-type.php' : '';
$default_options = file_exists($dilaz_mb_options .'default-options.php') ? $dilaz_mb_options .'default-options.php' : '';
$custom_options  = file_exists($dilaz_mb_options .'custom-options.php') ? $dilaz_mb_options .'custom-options.php' : $dilaz_mb_options .'custom-options-sample.php';
$options_file    = file_exists($dilaz_mb_options .'options.php') ? $dilaz_mb_options .'options.php' : $dilaz_mb_options .'options-sample.php';

# Includes
if ($user_type_file != '') require_once $user_type_file;
if (isset($parameters['default_options']) && $parameters['default_options'] && $default_options != '' && !$parameters['use_type_error']) require_once $default_options;
if (isset($parameters['custom_options']) && $parameters['custom_options'] && !$parameters['use_type_error']) require_once $custom_options;
if (!$parameters['use_type_error']) require_once $options_file;

# Add files to parameters
$parameters['files'] = [$default_options, $custom_options, $options_file];

# All metabox parameters
$parameters = apply_filters('metabox_parameter_filter_'. $prefix, $parameters);

# All metabox options
$dilaz_meta_boxes = apply_filters('metabox_option_filter_'. $prefix, $dilaz_meta_boxes, $prefix, $parameters);

# Metabox arguments
$metabox_args = array($parameters, $dilaz_meta_boxes);

# Initialize the metabox object
if (!$parameters['use_type_error']) new DilazMetabox($metabox_args);