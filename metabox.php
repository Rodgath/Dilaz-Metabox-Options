<?php
/*
|| --------------------------------------------------------------------------------------------
|| Metabox
|| --------------------------------------------------------------------------------------------
||
|| @package		Dilaz Metabox
|| @subpackage	Metabox
|| @version		2.0
|| @since		Dilaz Metabox 1.0
|| @author		WebDilaz Team, http://webdilaz.com
|| @copyright	Copyright (C) 2017, WebDilaz LTD
|| @link		http://webdilaz.com/metaboxes
|| @License		GPL-2.0+
|| @License URI	http://www.gnu.org/licenses/gpl-2.0.txt
|| 
*/

defined('ABSPATH') || exit;



# Metabox parameters
$parameters = array(
	'prefix'          => 'my_prefix', # must be unique. Used to save settings.
	'use_type'        => 'theme', # 'theme' if used within a theme OR 'plugin' if used within a plugin
	'default_options' => true, # whether to load default options
	'custom_options'  => true, # whether to load custom options
);



/* =================================================================================== */
/* Touch nothing beyond this point; unless you know what you are doing!!!              */
/* =================================================================================== */

# Metabox options
$dilaz_meta_boxes = array();
$prefix = rtrim($parameters['prefix'], '_') . '_';

# dir
$dilaz_mb_folder   = basename(__DIR__);
$dilaz_mb_dir      = dirname(__FILE__);
$dilaz_mb_includes = $dilaz_mb_dir .'/includes/';
$dilaz_mb_options  = $dilaz_mb_dir .'/options/';

# Metabox Files
$user_type_file  = file_exists($dilaz_mb_includes .'use-type.php') ? $dilaz_mb_includes .'use-type.php' : '';
$default_options = file_exists($dilaz_mb_options .'default-options.php') ? $dilaz_mb_options .'default-options.php' : '';
$custom_options  = file_exists($dilaz_mb_options .'custom-options.php') ? $dilaz_mb_options .'custom-options.php' : $dilaz_mb_options .'custom-options-sample.php';
$options_file    = file_exists($dilaz_mb_options .'options.php') ? $dilaz_mb_options .'options.php' : $dilaz_mb_options .'options-sample.php';

# Includes
if ($user_type_file != '') require_once $user_type_file;
if (isset($parameters['default_options']) && $parameters['default_options'] == true && $default_options != '') require_once $default_options;
if (isset($parameters['custom_options']) && $parameters['custom_options'] == true) require_once $custom_options;
require_once $options_file;

# All metabox parameters
$parameters = apply_filters('metabox_parameter_filter_'. $prefix, $parameters);

# Add metabox attributes to $dilaz_meta_boxes
array_splice($dilaz_meta_boxes, 0, 0, [['id' => 'panel-atts', 'type' => 'panel-atts', 'files' => [$default_options, $custom_options, $options_file], 'params' => $parameters]]);

# All metabox options
$dilaz_meta_boxes = apply_filters('metabox_option_filter_'. $prefix, $dilaz_meta_boxes, $prefix, $parameters);

# Metabox arguments
$metabox_args = array($parameters, $dilaz_meta_boxes);

# Initialize the panel object
$dilazMetabox = new DilazMetabox($metabox_args);






// add_filter('dilaz_metabox_parameters', '_MY_CONFIG_FUNCTION_d');
// function _MY_CONFIG_FUNCTION_d($params) {
	
	// $options_prefix = '_my_prefix_d'; # must be unique. Any time its changed, saved settings are no longer used. New settings will be saved. Set this once.
	
	// $parameters = array(
		// 'default_options' => true, # whether to load default options
		// 'custom_options'  => true, # whether to load custom options
	// );
	
	// return array_merge( $params, array( $options_prefix => $parameters ) );
// }


// add_filter('dilaz_metabox_parameters', 'MY_CONFIG_FUNCTION');
// function MY_CONFIG_FUNCTION($params) {
	
	// $options_prefix = 'my_prefix_'; # must be unique. Any time its changed, saved settings are no longer used. New settings will be saved. Set this once.
	
	// $parameters = array(
		// 'default_options' => true, # whether to load default options
		// 'custom_options'  => true, # whether to load custom options
	// );
	
	// return array_merge($params, array($options_prefix => $parameters));
// }

// # initialize the metabox object
// $dilazMetabox = new DilazMetabox('my_prefix_');

// # get metabox parameters
// $dilazMetaboxParams = $dilazMetabox->parameters();

// # load default options
// if (isset($dilazMetaboxParams['default_options']) && $dilazMetaboxParams['default_options'] == true) {
	// file_exists(dirname(__FILE__) .'/options/default-options.php') ? require_once dirname(__FILE__) .'/options/default-options.php' : '';
// }

# load custom options
// if (isset($dilazMetaboxParams['custom_options']) && $dilazMetaboxParams['custom_options'] == true) {
	// require_once file_exists(dirname(__FILE__) .'/options/custom-options.php') ? dirname(__FILE__) .'/options/custom-options.php' : '';
// }

# load main options
// require_once dirname(__FILE__) .'/options/options.php';