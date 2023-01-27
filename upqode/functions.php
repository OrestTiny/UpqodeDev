<?php

/**
 * Upqode functions and definitions
 *
 * @package WordPress*
 * @package Upqode
 * @since Sapid 1.0
 */

defined('UPQODE_T_URI') or define('UPQODE_T_URI', get_template_directory_uri());
defined('UPQODE_T_PATH') or define('UPQODE_T_PATH', get_template_directory());

require_once ABSPATH . 'wp-admin/includes/plugin.php';

require_once UPQODE_T_PATH . '/include/config-actions.php';
require_once UPQODE_T_PATH . '/include/customizer.php';

require_once UPQODE_T_PATH . '/include/function-helper.php';
require_once UPQODE_T_PATH . '/include/function-action.php';
require_once UPQODE_T_PATH . '/include/optimization-html.php';
