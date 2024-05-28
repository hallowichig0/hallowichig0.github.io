<?php
/**
 * Plugin Name: URL Path Auto
 * Plugin URI: https://wordpress.org/plugins/url-path-auto/
 * Description: URL Path Auto applies wp_make_link_relative function to links (posts, categories, pages and etc.) to convert them to relative URLs. Useful for developers when debugging local WordPress.
 * Version: 1.0.1
 * Author: Jayson Garcia (Github - hallowichig0)
 * Author URI: https://hallowichig0.github.io
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

function callback_url_path_auto($buffer) {
  // Replace normal URLs
  $home_url = esc_url(home_url('/'));
  $home_url_path_auto = wp_make_link_relative($home_url);

  // Replace URLs in inline scripts
  $home_url_escaped = str_replace('/', '\/', $home_url);
  $home_url_escaped_path_auto = str_replace('/', '\/', $home_url_path_auto);

  $buffer = str_replace($home_url, $home_url_path_auto, $buffer);
  $buffer = str_replace($home_url_escaped, $home_url_escaped_path_auto, $buffer);

  return $buffer;
}

function buffer_start_url_path_auto() { ob_start('callback_url_path_auto'); }
function buffer_end_url_path_auto() { @ob_end_flush(); }

// http://codex.wordpress.org/Plugin_API/Action_Reference
add_action('registered_taxonomy', 'buffer_start_url_path_auto');
add_action('shutdown', 'buffer_end_url_path_auto');
