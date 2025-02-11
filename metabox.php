<?php
/*
|| --------------------------------------------------------------------------------------------
|| Metabox
|| --------------------------------------------------------------------------------------------
||
|| @package     Dilaz Metabox
|| @subpackage  Metabox
|| @version     2.6.1
|| @since       Dilaz Metabox 1.0
|| @author      Rodgath, https://github.com/Rodgath
|| @copyright   Copyright (C) 2017, Rodgath LTD
|| @link        https://github.com/Rodgath/Dilaz-Metabox
|| @License     GPL-2.0+
|| @License URI http://www.gnu.org/licenses/gpl-2.0.txt
|| 
|| NOTE: This metabox options panel requires "Dilaz-Metabox" to be installed. 
|| 
*/

defined('ABSPATH') || exit;

/**
 * Run this later than init but before templates are loaded.
 * @fix: Ensure all required plugins/themes are loaded first.
 * @since v2.6.1
 */
add_action('after_setup_theme', function () {

  # Load config
  file_exists(dirname(__FILE__) . '/config.php') ? require_once dirname(__FILE__) . '/config.php' : require_once dirname(__FILE__) . '/config-sample.php';

  # Load metabox options
  require_once dirname(__FILE__) . '/includes/load.php';
});