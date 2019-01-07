<?php
/*
|| --------------------------------------------------------------------------------------------
|| Metabox
|| --------------------------------------------------------------------------------------------
||
|| @package		Dilaz Metabox
|| @subpackage	Metabox
|| @version		2.2
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
	'use_type'        => 'theme',     # 'theme' if used within a theme OR 'plugin' if used within a plugin
	'default_options' => true,       # whether to load default options
	'custom_options'  => false,       # whether to load custom options
);

# Load metabox options
require_once dirname(__FILE__) .'/includes/load.php';