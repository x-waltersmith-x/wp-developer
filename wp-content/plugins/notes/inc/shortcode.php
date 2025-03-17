<?php

/**
 * SHORTCODE 
 */

if (!defined('ABSPATH')) {
    exit;
}

function notes_form_shortcode()
{
    $user_id = get_current_user_id();

    ob_start();
?>

    <form class="form notes-form" method="post">
        <input type="hidden" name="user" value="<?php echo esc_attr($user_id); ?>" />
        <input type="hidden" name="action" value="create" />
        <input type="hidden" name="note" value="123" />
        <div class="form-input__wrapper">
            <label for="notes_title"><?php _e("Title", "notes"); ?></label>
            <input type="text" name="notes_title" id="notes_title" />
        </div>
        <div class="form-input__wrapper">
            <label for="notes_content"><?php _e("Content", "notes"); ?></label>
            <?php
            wp_editor('', 'notes_content', array(
                'textarea_name' => 'notes_content',
                'textarea_rows' => 8,
                'media_buttons' => false,
            ));
            ?>
        </div>
        <div class="form-input__wrapper">
            <button type="submit" name="save"><?php _e("Save", "notes"); ?></button>
        </div>
        <div class="error-handler">
        </div>
    </form>

<?php
    return ob_get_clean();
}
add_shortcode('notes', 'notes_form_shortcode');
