<?php

// 1. Đăng ký Custom Post Type "Sinh viên"
function sm_register_student_cpt() {
    $labels = array(
        'name'               => 'Sinh viên',
        'singular_name'      => 'Sinh viên',
        'menu_name'          => 'Sinh viên',
        'add_new'            => 'Thêm mới',
        'add_new_item'       => 'Thêm Sinh viên mới',
        'edit_item'          => 'Sửa thông tin Sinh viên',
        'all_items'          => 'Tất cả Sinh viên',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => array( 'title', 'editor' ), // Hỗ trợ Họ tên (title) và Tiểu sử (editor)
    );

    register_post_type( 'sinh_vien', $args );
}
add_action( 'init', 'sm_register_student_cpt' );

// 2. Tạo Custom Meta Box
function sm_add_student_meta_boxes() {
    add_meta_box(
        'sm_student_info',
        'Thông tin chi tiết Sinh viên',
        'sm_render_student_meta_box',
        'sinh_vien',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'sm_add_student_meta_boxes' );

// 3. Hiển thị form nhập liệu trong Meta Box
function sm_render_student_meta_box( $post ) {
    // Tạo Nonce để bảo mật
    wp_nonce_field( 'sm_save_student_data', 'sm_student_meta_box_nonce' );

    // Lấy dữ liệu cũ (nếu có)
    $mssv = get_post_meta( $post->ID, '_sm_mssv', true );
    $lop  = get_post_meta( $post->ID, '_sm_lop', true );
    $ns   = get_post_meta( $post->ID, '_sm_ngaysinh', true );
    ?>
    <p>
        <label for="sm_mssv"><strong>Mã số sinh viên (MSSV):</strong></label><br>
        <input type="text" id="sm_mssv" name="sm_mssv" value="<?php echo esc_attr( $mssv ); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="sm_lop"><strong>Lớp/Chuyên ngành:</strong></label><br>
        <select id="sm_lop" name="sm_lop" style="width: 100%;">
            <option value="CNTT" <?php selected( $lop, 'CNTT' ); ?>>Công nghệ thông tin</option>
            <option value="Kinh tế" <?php selected( $lop, 'Kinh tế' ); ?>>Kinh tế</option>
            <option value="Marketing" <?php selected( $lop, 'Marketing' ); ?>>Marketing</option>
        </select>
    </p>
    <p>
        <label for="sm_ngaysinh"><strong>Ngày sinh:</strong></label><br>
        <input type="date" id="sm_ngaysinh" name="sm_ngaysinh" value="<?php echo esc_attr( $ns ); ?>" style="width: 100%;" />
    </p>
    <?php
}

// 4. Xử lý lưu dữ liệu (Có kiểm tra Nonce và Sanitize)
function sm_save_student_meta_box_data( $post_id ) {
    // Kiểm tra Nonce
    if ( ! isset( $_POST['sm_student_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['sm_student_meta_box_nonce'], 'sm_save_student_data' ) ) {
        return;
    }

    // Bỏ qua nếu là autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Kiểm tra quyền người dùng
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Sanitize và lưu MSSV
    if ( isset( $_POST['sm_mssv'] ) ) {
        update_post_meta( $post_id, '_sm_mssv', sanitize_text_field( $_POST['sm_mssv'] ) );
    }

    // Sanitize và lưu Lớp
    if ( isset( $_POST['sm_lop'] ) ) {
        update_post_meta( $post_id, '_sm_lop', sanitize_text_field( $_POST['sm_lop'] ) );
    }

    // Sanitize và lưu Ngày sinh
    if ( isset( $_POST['sm_ngaysinh'] ) ) {
        update_post_meta( $post_id, '_sm_ngaysinh', sanitize_text_field( $_POST['sm_ngaysinh'] ) );
    }
}
add_action( 'save_post', 'sm_save_student_meta_box_data' );