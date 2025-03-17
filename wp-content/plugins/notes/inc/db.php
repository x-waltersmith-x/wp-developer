<?php
/**
* DATABASE FUNCTIONS
*/

if (!defined('ABSPATH')) {
    exit;
}

// CREATE NOTES DB TABLE
function create_notes_db_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "notes";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id BIGINT(20) UNSIGNED NOT NULL,
        title TEXT NOT NULL,
        content LONGTEXT NOT NULL,
        date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
        date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

// REMOVE NOTES DB TABLE
function remove_notes_db_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'notes';      // GET DATABASE TABLE
    $sql = "DROP TABLE IF EXISTS $table_name";  // PREPARE SQL QUERY

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
};

// CREATE NOTE
function create_note($user_id, $title, $content) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'notes'; // GET DATABASE TABLE
    $data = array(                         
        'user_id' => $user_id,
        'title' => $title,                 // PREPARE DATA
        'content' => $content,
    );
    $format = array('%d', '%s', '%s');     // FORMAT DATA (user_id: int, title|content: string)

    $wpdb->insert($table_name, $data, $format);
    return $wpdb->insert_id;
}

// UPDATE NOTE
function update_note($note_id, $user_id, $title, $content) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'notes';                              // GET DATABASE TABLE

    $note = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d AND user_id = %d", // CHECK IF NOTE EXIST
            $note_id,
            $user_id
        )
    );

    if (!$note) {
        return false;                                                   // CHECK PERMISSSIONS TO EDIT
    }

    $data = array(
        'title' => $title,                                              // SET NEW TITLE
        'content' => $content,                                          // SET NEW CONTENT
        'date_updated' => current_time('mysql'),                        // SET DATE UPDATED
    );

    $format = array('%s', '%s', '%s');                                  // DATA FORMAT (strings)

    $wpdb->update(
        $table_name,
        $data,
        array('id' => $note_id),                                        // UPDATE DATA
        $format,
        array('%d')
    );

    return true;                                                        // RETURN RESULT
}

// DELETE NOTE
function delete_note($note_id, $user_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'notes';                              // GET DATABASE TABLE

    $note = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d AND user_id = %d", // CHECK IF NOTE EXIST
            $note_id,
            $user_id
        )
    );

    if (!$note) {
        return false;                                                   // CHECK PERMISSSIONS TO DELETE
    }

    $wpdb->delete(
        $table_name,
        array('id' => $note_id),                                        // DELETE DATA
        array('%d') 
    );

    return true;                                                        // RETURN RESULT
}
