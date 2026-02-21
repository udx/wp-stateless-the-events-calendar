<?php

/**
 * Plugin Name: WP-Stateless for The Events Calendar
 * Plugin URI: https://stateless.udx.io/addons/the-events-calendar/
 * Description: Provides compatibility between the The Events Calendar and the WP-Stateless plugins.
 * Author: UDX
 * Version: 0.0.1
 * Text Domain: wp-stateless-the-events-calendar
 * Author URI: https://udx.io
 * License: GPLv2 or later
 * 
 * Copyright 2026 UDX (email: info@udx.io)
 */

namespace SLCA\TheEventsCalendar;

defined( 'ABSPATH' ) || exit;

add_action('plugins_loaded', function () {
  if (class_exists('wpCloud\StatelessMedia\Compatibility')) {
    require_once ( dirname( __FILE__ ) . '/vendor/autoload.php' );
    // Load 
    return new TheEventsCalendar();
  }

  add_filter('plugin_row_meta', function ($plugin_meta, $plugin_file, $_, $__) {
    if ($plugin_file !== join(DIRECTORY_SEPARATOR, [basename(__DIR__), basename(__FILE__)])) return $plugin_meta;
    $plugin_meta[] = sprintf(
      '<span style="color:red;">%s</span>',
      __('This plugin requires WP-Stateless plugin version 3.4.0 or greater to be installed and active.', 'wp-stateless-the-events-calendar')
    );
    return $plugin_meta;
  }, 10, 4);
});
