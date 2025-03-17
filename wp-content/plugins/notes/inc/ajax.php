<?php
/**
* AJAX ACTIONS
*/

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_ajax_notes', 'notes_ajax_handler');


function notes_ajax_handler() {
    check_ajax_referer('notes_nonce', 'security'); 

    $user_id = $_POST["user"];
    $action = $_POST["action"];
    $note_id = $_POST["note"];
    $title = $_POST["title"];
    $content  = $_POST["content"];

    // CHECK USER ID
    if(empty($user_id) || $user_id === 0 || $user_id === null) {
        $response = array(
            'success' => false,
            'message' => __("You need to sign-in for leaving notes!", "notes")
        );
    }

    // CHECK IS USER EXISTS
    if(!get_user_by("ID", $user_id)) {
        $response = array(
            'success' => false,
            'message' => __("This user is not registered!", "notes")
        ); 
    }

    // CHECK ACTION
    if(empty($action)) {
        $response = array(
            'success' => false,
            'message' => __("Unknown action with note!", "notes")
        );
    }

    // CHECK TITLE
    if(empty($title)) {
        $response = array(
            'success'  => false,
            'message'  => __("Please add a title for your note!", "notes"),
            'validate' => 'title'
        );
    }

    // CHECK CONTENT
    if(empty($content)) {
        $response = array(
            'success'  => false,
            'message'  => __("Please add a content for your note!", "notes"),
            'validate' => 'content'
        );
    }

    // SWITCH ACTIONS
    switch($action) {
        case "update":
            $result = update_note($note_id, $user_id, $title, $content);
            break;
        case "delete":
            $result = delete_note($note_id, $user_id);
            break;
        case "create":
            $result = create_note($user_id, $title, $content);
            break;
        
    }

    // HANDLE RESPONSES AND ERRORS  
    switch(true) {
        case $action === "update" && empty($note_id):
        case $action === "delete" && empty($note_id):
            $response = array(
                'success'  => false,
                'message'  => __("This note is not exists", "notes"),
            );
            break;
        case $action === "create" && $result:
        case $action === "update" && $result:
            $response = array(
                'success'  => false,
                'message'  => __("Note saved!", "notes"),
            );
            break;
        case $action === "detele" && $result:
            $response = array(
                'success'  => false,
                'message'  => __("Note removed!", "notes"),
            );
            break;
        default:
            $response = array(
                'success'  => false,
                'message'  => __("Something went wrong", "notes"),
            );
            break;
    }

    wp_send_json($response);
    wp_die();
}
