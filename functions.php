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

    // Google Fonts: Inter
    wp_enqueue_style( 'tecotec-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap', array(), null );

    // Main Stylesheet
    wp_enqueue_style( 'tecotec-style', get_stylesheet_uri(), array(), $version );

    // Custom CSS
    wp_enqueue_style( 'tecotec-custom-css', get_template_directory_uri() . '/assets/css/main.css', array('tecotec-style'), $version );

    // GSAP Core
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
 * Load Backend Logic
 */
if ( file_exists( get_template_directory() . '/inc/package.php' ) ) {
    require_once get_template_directory() . '/inc/package.php';
}

/**
 * Disable Gutenberg CSS
 */
function tecotec_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
}
add_action( 'wp_enqueue_scripts', 'tecotec_remove_wp_block_library_css', 100 );
