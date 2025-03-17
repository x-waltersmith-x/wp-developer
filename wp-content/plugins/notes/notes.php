<?php
/**
* Plugin Name: Notes
* Description: Plugin for managing personal notes. Work via shortcode [notes].
* Version:     1.1.0
* Author:      Volodymyr Kovalov
* Text Domain: notes
*/

if (!defined('ABSPATH')) {
    exit;
}

// AUTOMATIC INCLUDES
$files = glob(plugin_dir_path(__FILE__) . 'inc/*.php');

if (!empty($files)) {
    foreach ($files as $file) {
        require_once $file;
    }
}

// ACTIVATION HOOKS
register_activation_hook(__FILE__, 'create_notes_db_table');

// UNINSTALL HOOKS
register_uninstall_hook(__FILE__, 'remove_notes_db_table');