<?php

function sm_add_meta_box() {
    add_meta_box(
        'sm_student_info',
        'Thông tin sinh viên',
        'sm_render_meta_box',
        'sinhvien'
    );
}
add_action('add_meta_boxes', 'sm_add_meta_box');

function sm_render_meta_box($post) {
    wp_nonce_field('sm_save_data', 'sm_nonce');

    $mssv = get_post_meta($post->ID, 'mssv', true);
    $lop = get_post_meta($post->ID, 'lop', true);
    $ngaysinh = get_post_meta($post->ID, 'ngaysinh', true);
    ?>

    <p>
        MSSV: <input type="text" name="mssv" value="<?php echo esc_attr($mssv); ?>">
    </p>

    <p>
        Lớp:
        <select name="lop">
            <option value="CNTT" <?php selected($lop, 'CNTT'); ?>>CNTT</option>
            <option value="Kinh tế" <?php selected($lop, 'Kinh tế'); ?>>Kinh tế</option>
            <option value="Marketing" <?php selected($lop, 'Marketing'); ?>>Marketing</option>
        </select>
    </p>

    <p>
        Ngày sinh:
        <input type="date" name="ngaysinh" value="<?php echo esc_attr($ngaysinh); ?>">
    </p>

    <?php
}

function sm_save_meta($post_id) {
    if (!isset($_POST['sm_nonce']) || !wp_verify_nonce($_POST['sm_nonce'], 'sm_save_data')) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, 'mssv', sanitize_text_field($_POST['mssv']));
    update_post_meta($post_id, 'lop', sanitize_text_field($_POST['lop']));
    update_post_meta($post_id, 'ngaysinh', sanitize_text_field($_POST['ngaysinh']));
}

add_action('save_post', 'sm_save_meta');