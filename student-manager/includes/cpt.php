<?php

function sm_register_cpt() {
    register_post_type('sinhvien', [
        'labels' => [
            'name' => 'Sinh viên',
            'singular_name' => 'Sinh viên'
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title', 'editor']
    ]);
}

add_action('init', 'sm_register_cpt');