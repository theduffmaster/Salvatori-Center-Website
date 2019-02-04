<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'ct-chosen-font-awesome' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );
////////////////////////////////
// END ENQUEUE PARENT ACTION //
//////////////////////////////

/**Have featured images contain a link to the post they are in
*/
function wpb_autolink_featured_images( $html, $post_id, $post_image_id ) {
$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
return $html;
}
add_filter( 'post_thumbnail_html', 'wpb_autolink_featured_images', 10, 3 );

/** From: http://t-machine.org/index.php/2016/05/19/wordpress-plugin-insert-link-to-latest-post-in-category-on-your-menu/ 
* Make your URL to use: “http://#latestpost:category_name”
*/
if ( ! is_admin() ) {
    // Hook in early to modify the menu
    // This is before the CSS "selected" classes are calculated
    add_filter( 'wp_get_nav_menu_items', 'replace_placeholder_nav_menu_item_with_latest_post', 10, 3 );
}

// Replaces a custom URL placeholder with the URL to the latest post
function replace_placeholder_nav_menu_item_with_latest_post( $items, $menu, $args ) {

        $key = 'http://#latestpost:';

    // Loop through the menu items looking for placeholder(s)
    foreach ( $items as $item ) {
 
        // Is this the placeholder we're looking for?
        if ( 0 === strpos( $item->url, $key ) )
        {
 
        $catname = substr( $item->url, strlen($key) );
        // Get the latest post
        $latestpost = get_posts( array(
            'posts_per_page' => 1,
                'category_name' => $catname
        ) );

        if ( empty( $latestpost ) )
            continue;

        // Replace the placeholder with the real URL
        $item->url = get_permalink( $latestpost[0]->ID );
        }
    }

    // Return the modified (or maybe unmodified) menu items array
    return $items;
}

/* Script for controlling menu bar and icon shrinking
 */
add_action( 'wp_enqueue_scripts', 'shrink_script' );
function shrink_script() {
    wp_register_script(
       'menu-bar-shrink', 
       get_stylesheet_directory_uri() . '/js/menu-bar-shrink.js', 
       array('jquery') 
    );

    wp_enqueue_script('menu-bar-shrink');
}

//Accidentally (oops) deleted the 'full' image size so had to re-add it via this code.
function image_size() {
	remove_image_size('full');
	add_image_size('full', 0, 0, false);
	add_filter('jpeg_quality', function($arg){return 100;});
}
add_action( 'after_setup_theme', 'image_size', 11 );
