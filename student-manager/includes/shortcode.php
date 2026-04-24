<?php

function sm_student_list() {
    $args = [
        'post_type' => 'sinhvien',
        'posts_per_page' => -1
    ];

    $query = new WP_Query($args);

    ob_start();

    echo '<table border="1" cellpadding="10">';
    echo '<tr>
            <th>STT</th>
            <th>MSSV</th>
            <th>Họ tên</th>
            <th>Lớp</th>
            <th>Ngày sinh</th>
          </tr>';

    $stt = 1;

    while ($query->have_posts()) {
        $query->the_post();

        $mssv = get_post_meta(get_the_ID(), 'mssv', true);
        $lop = get_post_meta(get_the_ID(), 'lop', true);
        $ngaysinh = get_post_meta(get_the_ID(), 'ngaysinh', true);

        echo "<tr>
                <td>$stt</td>
                <td>$mssv</td>
                <td>" . get_the_title() . "</td>
                <td>$lop</td>
                <td>$ngaysinh</td>
              </tr>";

        $stt++;
    }

    echo '</table>';

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('danh_sach_sinh_vien', 'sm_student_list');