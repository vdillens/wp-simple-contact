<?php

/*
Plugin Name: Wp Simple Contact
Plugin URI: http://
Description: Simple contact form for WordPress
Version: 0.1
Author: Vincent Dillenschneider
Author URI: https://github.com/vdillens
Text Domain: wp-simple-contact
License: GPLv2
*/

define('WP_SIMPLE_CONTACT_PLUGIN', __FILE__);
define('WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN', 'wp-simple-contact');
wp_enqueue_style('wp_simple_contact_style', plugins_url('styles.css', WP_SIMPLE_CONTACT_PLUGIN), '', '0.1', false);

// In order to use a jQuery datepicker
//wp_enqueue_script('jquery-ui-datepicker');
//wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
//wp_enqueue_style('jquery-ui');

// Register a new text domain for traductions
add_action('plugins_loaded', 'wanLoadTextdomain');
function wanLoadTextdomain()
{
    load_plugin_textdomain(WP_SIMPLE_CONTACT_TRANSLATE_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/lang/');
}

// Register hooks for install/uninstall
include_once __DIR__.'/controllers/system.php';
register_activation_hook(__FILE__, array('WPSimpleContactSystem', 'install'));
register_uninstall_hook(__FILE__, array('WPSimpleContactSystem', 'uninstall'));

// Inclusion of the widget contact form
include __DIR__ . '/controllers/messages_widget.php';

// If plugin is called in administration panel, we include the admin section
if (is_admin()) {
    include __DIR__ . '/controllers/admin.php';
    $settings = new WPSimpleContactAdmin();
}
