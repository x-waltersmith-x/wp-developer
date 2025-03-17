<?php

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('notes', get_template_directory_uri() . '/assets/js/custom-ajax.js', [], false, true);
    wp_localize_script('notes', 'notes_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('notes_nonce')
    ]);
});