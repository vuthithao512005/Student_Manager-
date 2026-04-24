<?php

function sm_student_list_shortcode() {
    // Bắt đầu bộ đệm đầu ra (Output Buffering)
    ob_start();

    // Truy vấn tất cả sinh viên
    $args = array(
        'post_type'      => 'sinh_vien',
        'posts_per_page' => -1, // Lấy tất cả
        'post_status'    => 'publish'
    );
    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        echo '<table class="sm-student-table">';
        echo '<thead><tr><th>STT</th><th>MSSV</th><th>Họ tên</th><th>Lớp</th><th>Ngày sinh</th></tr></thead>';
        echo '<tbody>';
        
        $stt = 1;
        while ( $query->have_posts() ) {
            $query->the_post();
            
            // Lấy ID bài viết hiện tại
            $post_id = get_the_ID();
            
            // Lấy Meta Data
            $mssv = get_post_meta( $post_id, '_sm_mssv', true );
            $lop  = get_post_meta( $post_id, '_sm_lop', true );
            $ns   = get_post_meta( $post_id, '_sm_ngaysinh', true );
            
            // Format ngày sinh (tùy chọn)
            $formatted_date = !empty($ns) ? date("d/m/Y", strtotime($ns)) : '';

            echo '<tr>';
            echo '<td>' . $stt . '</td>';
            echo '<td>' . esc_html( $mssv ) . '</td>';
            echo '<td>' . esc_html( get_the_title() ) . '</td>';
            echo '<td>' . esc_html( $lop ) . '</td>';
            echo '<td>' . esc_html( $formatted_date ) . '</td>';
            echo '</tr>';
            
            $stt++;
        }
        echo '</tbody></table>';
        
        // Reset post data
        wp_reset_postdata();
    } else {
        echo '<p>Chưa có dữ liệu sinh viên.</p>';
    }

    // Trả về nội dung bộ đệm
    return ob_get_clean();
}
add_shortcode( 'danh_sach_sinh_vien', 'sm_student_list_shortcode' );