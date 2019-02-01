<?php 
/*
|| --------------------------------------------------------------------------------------------
|| Metabox Config
|| --------------------------------------------------------------------------------------------
||
|| @package		Dilaz Metabox
|| @subpackage	Config
|| @since		Dilaz Metabox 2.5.1
|| @author		WebDilaz Team, http://webdilaz.com
|| @copyright	Copyright (C) 2017, WebDilaz LTD
|| @link		http://webdilaz.com/metaboxes
|| @license	URI	http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
|| 
|| NOTE: Rename this file from "config-sample.php" to "config.php". If you
||       don't rename it, all your config and settings will be overwritten
||       when updating Dilaz Metabox Options.
|| 
*/

defined('ABSPATH') || exit;

# Metabox parameters
$parameters = array(
	'prefix'          => 'dilaz_mb_prefix', # must be unique. Used to save settings.
	'use_type'        => 'theme', # 'theme' if used within a theme OR 'plugin' if used within a plugin
	'default_options' => true, # whether to load default options
	'custom_options'  => false, # whether to load custom options
);