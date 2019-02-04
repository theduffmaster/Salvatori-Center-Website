<?php
defined( 'ABSPATH' ) OR exit;

function ct_chosen_pro_add_body_classes( $classes ) {

	$layout = get_theme_mod( 'layout' );
	$layout = apply_filters( 'ct_chosen_pro_layout_filter', $layout );

	$classes[] = $layout;

	return $classes;
}
add_action( 'body_class', 'ct_chosen_pro_add_body_classes' );

function ct_chosen_pro_register_primary_sidebar() {

	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'chosen-pro' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'Widgets in this area will be shown in the Sidebar (based on the layout you choose in the Customizer)', 'chosen-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	) );
}
add_action( 'widgets_init', 'ct_chosen_pro_register_primary_sidebar' );

function ct_chosen_pro_add_primary_sidebar() {

	$layout = get_theme_mod( 'layout' );
	$layout = apply_filters( 'ct_chosen_pro_layout_filter', $layout );

	// don't include on WooCommerce account pages
	if ( function_exists( 'is_account_page' ) ) {
		if ( is_account_page() || is_cart() || is_checkout() ) {
			return;
		}
	}
	if ( is_customize_preview() || in_array( $layout, ct_chosen_pro_layouts( 'sidebar' ) ) ) {
		include( 'widget-areas/sidebar-primary.php' );
	}
}
add_action( 'after_main', 'ct_chosen_pro_add_primary_sidebar' );

function ct_chosen_pro_layouts( $type = '' ) {

	if ( $type == 'sidebar' ) {
		$layouts = array(
			'right-sidebar',
			'left-sidebar',
			'two-right',
			'two-left'
		);
	} elseif ( $type == 'page-layouts' ) {
		$layouts = array(
			'default',
			'one-column',
			'right-sidebar',
			'left-sidebar',
		);
	} else {
		$layouts = array(
			'two-column',
			'one-column',
			'right-sidebar',
			'left-sidebar',
			'two-right',
			'two-left',
			'three-column'
		);
	}

	return $layouts;
}