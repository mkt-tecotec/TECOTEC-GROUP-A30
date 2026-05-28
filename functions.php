<?php
/**
 * Tecotec Group Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Theme Setup
 */
function tecotec_group_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Switch default core markup for search form, comment form, and comments
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Register Navigation Menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'tecotec-group' ),
        'footer'  => esc_html__( 'Footer Menu', 'tecotec-group' ),
    ) );
}
add_action( 'after_setup_theme', 'tecotec_group_setup' );

/**
 * Enqueue scripts and styles.
 */
function tecotec_group_scripts() {
    $version = '1.0.0';

    wp_enqueue_style( 'tecotec-fonts', 'https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700;800;900&family=Geist+Mono:wght@400;500;700&display=swap', array(), null );
    wp_enqueue_style( 'tecotec-style', get_stylesheet_uri(), array(), $version );

    // Header CSS
    wp_enqueue_style( 'tecotec-header-css', get_template_directory_uri() . '/assets/css/header.css', array( 'tecotec-style' ), $version );

    // Main CSS
    wp_enqueue_style( 'tecotec-main-css', get_template_directory_uri() . '/assets/css/main.css', array( 'tecotec-style' ), $version );

    if ( is_page_template( array( 'template-avatar-frame.php', 'template-wallpaper.php' ) ) ) {
        wp_enqueue_style( 'tecotec-microsite-a30', get_template_directory_uri() . '/assets/css/microsite-a30.css', array( 'tecotec-main-css' ), $version );
    }

    if ( is_page_template( 'template-avatar-frame.php' ) ) {
        wp_enqueue_style( 'tecotec-avatar-frame', get_template_directory_uri() . '/assets/css/avatar-frame.css', array( 'tecotec-microsite-a30' ), $version );
        wp_enqueue_script( 'tecotec-avatar-frame', get_template_directory_uri() . '/assets/js/avatar-frame.js', array(), $version, true );
        wp_localize_script( 'tecotec-avatar-frame', 'tecotecAvatar', array(
            'assetsBase' => get_template_directory_uri() . '/assets',
        ) );
    }

    if ( is_page_template( 'template-wallpaper.php' ) ) {
        wp_enqueue_style( 'tecotec-wallpaper', get_template_directory_uri() . '/assets/css/wallpaper.css', array( 'tecotec-microsite-a30' ), $version );
        wp_enqueue_script( 'tecotec-wallpaper', get_template_directory_uri() . '/assets/js/wallpaper.js', array(), $version, true );
        wp_localize_script( 'tecotec-wallpaper', 'tecotecWallpaper', array(
            'assetsBase' => get_template_directory_uri() . '/assets',
        ) );
    }

    wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true );
    // GSAP ScrollTrigger
    wp_enqueue_script( 'gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true );

    // Custom JS
    wp_enqueue_script( 'tecotec-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery', 'gsap'), $version, true );

    // Enqueue Timeline Assets
    wp_enqueue_style( 'timeline-style', get_template_directory_uri() . '/assets/css/timeline.css', array(), $version );
    wp_enqueue_script( 'timeline-js', get_template_directory_uri() . '/assets/js/timeline.js', array('jquery', 'gsap', 'gsap-scroll-trigger'), $version, true );
}
add_action( 'wp_enqueue_scripts', 'tecotec_group_scripts' );

/**
 * Disable Gutenberg Editor
 */
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

/**
 * Disable Gutenberg CSS
 */
function tecotec_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
}
add_action( 'wp_enqueue_scripts', 'tecotec_remove_wp_block_library_css', 100 );

if ( file_exists( get_template_directory() . '/inc/sample-posts.php' ) ) {
    require_once get_template_directory() . '/inc/sample-posts.php';
}

// Temporary trigger to import dummy data
add_action( 'init', function() {
    if ( isset( $_GET['import_dummy'] ) && $_GET['import_dummy'] === '1' ) {
        if ( function_exists( 'tecotec_a30_import_sample_posts' ) ) {
            $results = tecotec_a30_import_sample_posts();
            echo '<h1>Import Complete!</h1>';
            echo '<pre>' . print_r( $results, true ) . '</pre>';
            echo '<a href="' . home_url('/') . '">Quay lại trang chủ</a>';
            exit;
        }
    }
} );
