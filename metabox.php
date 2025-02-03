<?php
/*
|| --------------------------------------------------------------------------------------------
|| Metabox
|| --------------------------------------------------------------------------------------------
||
|| @package     Dilaz Metabox
|| @subpackage  Metabox
|| @version     2.5.6
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

# Load config
file_exists(dirname(__FILE__) .'/config.php') ? require_once dirname(__FILE__) .'/config.php' : require_once dirname(__FILE__) .'/config-sample.php';

# Load metabox options
require_once dirname(__FILE__) .'/includes/load.php';