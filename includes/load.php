<?php 
/*
|| --------------------------------------------------------------------------------------------
|| Metabox Load
|| --------------------------------------------------------------------------------------------
||
|| @package		Dilaz Metabox
|| @subpackage	Load
|| @since		Dilaz Metabox 2.0
|| @author		WebDilaz Team, http://webdilaz.com
|| @copyright	Copyright (C) 2017, WebDilaz LTD
|| @link		http://webdilaz.com/metaboxes
|| @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
|| 
*/

defined('ABSPATH') || exit;

# Check if DilazMetabox plugin is installed/activated
require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!is_plugin_active('dilaz-metabox/dilaz-metabox.php')) {
	add_action('admin_notices', function() {
		$plugins = get_plugins();
		if (isset($plugins['dilaz-metabox/dilaz-metabox.php'])) {
			echo '<div id="message" class="notice notice-warning"><p><strong>'. sprintf(__('Please %1$sactivate%2$s <em>Dilaz Metabox</em> plugin. It is required in "<em>%3$s</em>".', 'dilaz-metabox'), '<a href="'. admin_url('plugins.php') .'">', '</a>', 'wp-content'. wp_normalize_path(explode('wp-content', dirname(__DIR__))[1]) .'/metabox.php') .'</strong></p></div>';
		} else {
			echo '<div id="message" class="notice notice-warning"><p><strong>'. sprintf(__('Please %1$sinstall%2$s <em>Dilaz Metabox</em> plugin. It is required in "<em>%3$s</em>".', 'dilaz-metabox'), '<a href="'. admin_url('plugin-install.php') .'">', '</a>', 'wp-content'. wp_normalize_path(explode('wp-content', dirname(__DIR__))[1]) .'/metabox.php') .'</strong></p></div>';
		}
	});
	
	return;
}

# Lets ensure the DilazMetabox class is loaded
if (!class_exists('DilazMetabox') && file_exists(ABSPATH .'wp-content/plugins/dilaz-metabox/dilaz-metabox.php')) {
	require_once ABSPATH .'wp-content/plugins/dilaz-metabox/dilaz-metabox.php';
}

# Metabox options
$dilaz_meta_boxes = array();
$prefix = DilazMetaboxFunction::preparePrefix($parameters['prefix']);

# dir
$dilaz_mb_folder   = basename(dirname(__DIR__));
$dilaz_mb_dir      = dirname(__DIR__);
$dilaz_mb_includes = $dilaz_mb_dir .'/includes/';
$dilaz_mb_options  = $dilaz_mb_dir .'/options/';

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