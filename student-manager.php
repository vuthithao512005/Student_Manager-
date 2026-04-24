<?php
/**
 * Plugin Name: Student Manager
 * Description: Plugin quản lý sinh viên với Custom Post Type, Meta Box và Shortcode.
 * Version: 1.0.0
 * Author: Tên của bạn
 */

// Ngăn chặn truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Nhúng các file xử lý logic
require_once plugin_dir_path( __FILE__ ) . 'includes/class-student-cpt.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/class-student-shortcode.php';

// Load CSS cho frontend
function sm_enqueue_scripts() {
    wp_enqueue_style( 'sm-style', plugin_dir_url( __FILE__ ) . 'assets/style.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'sm_enqueue_scripts' );