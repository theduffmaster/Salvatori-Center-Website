<?php
defined( 'ABSPATH' ) OR exit;

function ct_chosen_pro_get_fonts() {

	$fonts_dir = CHOSEN_PRO_PATH . "assets/fonts.json";
	$fonts     = file_get_contents( $fonts_dir );

	if ( is_string( $fonts ) && ! empty( $fonts ) ) {
		$fonts_object = json_decode( $fonts, true );
	} else {
		$fonts_object = '';
	}

	return $fonts_object;
}

// return the available fonts in a format the customizer can use
function ct_chosen_pro_prepare_fonts() {

	// get fonts array from fonts.json file
	$fonts = ct_chosen_pro_get_fonts();

	$font_families = array();

	if ( is_array( $fonts ) && ! empty( $fonts ) ) {

		// for each item in the file (which holds data for one font)
		foreach ( $fonts['items'] as $key => $value ) {

			// store current font family
			$item_family = $fonts['items'][ $key ]['family'];

			// store available weights
			$item_weights = $fonts['items'][ $key ]['variants'];

			// add current font family to font list with available weights
			$font_families[ $item_family ] = $item_weights;
		}
	}

	return $font_families;
}

function ct_chosen_pro_font_css() {

	$primary_font = 'Raleway';
	$primary_font_weight = '400';
	$heading_font = 'Playfair Display';
	$heading_font_weight = '400';
	$site_title_font = 'Playfair Display';
	$site_title_font_weight = '400';
	if ( wp_get_theme() == 'Chosen Gamer' ) {
		$primary_font = 'PT Serif';
		$primary_font_weight = '400';
		$heading_font = 'Montserrat';
		$heading_font_weight = '700';
		$site_title_font = 'Montserrat';
		$site_title_font_weight = '700';
	}

	$primary_font           = get_theme_mod( 'primary_font' );
	$primary_font_weight    = get_theme_mod( 'primary_font_weight' );
	$heading_font           = get_theme_mod( 'heading_font' );
	$heading_font_weight    = get_theme_mod( 'heading_font_weight' );
	$site_title_font        = get_theme_mod( 'site_title_font' );
	$site_title_font_weight = get_theme_mod( 'site_title_font_weight' );
	$css                    = '';

	if ( !empty( $primary_font ) ) {
		$css .= "html body, 
						body input[type='text'],
						body input[type='email'],
						body input[type='password'],
						body input[type='number'],
						body input[type='search'],
						body input[type='tel'],
						body input[type='url'], 
						body textarea, 
						.widget-title  {
			font-family: $primary_font;
		}";
	}
	if ( !empty( $primary_font_weight ) ) {
		$css .= "html body, 
						body input[type='text'],
						body input[type='email'],
						body input[type='password'],
						body input[type='number'],
						body input[type='search'],
						body input[type='tel'],
						body input[type='url'], 
						body textarea {
			font-weight: $primary_font_weight;
		}";
	}
	if ( !empty( $heading_font ) ) {
		$css .= ".main h1,
		         .site-footer h1,
		         .main h2,
		         .site-footer h2,
		         .main h3,
		         .site-footer h3,
		         .main h4,
		         .site-footer h4,
		         .main h5,
		         .site-footer h5,
		         .main h6,
		         .site-footer h6 {
							font-family: '$heading_font';
						}";
		if ( wp_get_theme() == 'Chosen Gamer' ) {
			$css .= ".post-content .more-link,
							 .pagination,
							 .sticky-status span,
							 input[type='submit'],
							 .comment-author,
							 .comment-footer,
							 .comment-respond label,
							 .design-credit,
							 .menu-primary-container,
							 .categories span,
							 .after-post-title,
							 .post-content .date,
							 .tags,
							 .further-reading span,
							 .sidebar .widget .widget-title {
								font-family: '$heading_font' !important;
							}";
		}
	}
	if ( !empty( $heading_font_weight ) ) {

		$css .= ".main h1,
		         .site-footer h1,
		         .main h2,
		         .site-footer h2,
		         .main h3,
		         .site-footer h3,
		         .main h4,
		         .site-footer h4,
		         .main h5,
		         .site-footer h5,
		         .main h6,
		         .site-footer h6 {
					font-weight: $heading_font_weight;
				 }";
	}
	if ( !empty( $site_title_font ) ) {

		$css .= ".site-title {
			font-family: '$site_title_font' !important;
		}";
	}
	if ( !empty( $site_title_font_weight ) ) {

		$css .= ".site-title {
			font-weight: $site_title_font_weight;
		}";
	}

	if ( !empty( $css ) ) {

		$css = ct_chosen_pro_sanitize_css( $css );

		wp_add_inline_style( 'ct-chosen-style', $css );
		wp_add_inline_style( 'ct-chosen-style-rtl', $css );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_chosen_pro_font_css', 99 );

function ct_chosen_pro_register_new_font() {

	$primary_font           = get_theme_mod( 'primary_font' );
	$heading_font           = get_theme_mod( 'heading_font' );
	$site_title_font        = get_theme_mod( 'site_title_font' );
	$primary_font_weight    = get_theme_mod( 'primary_font_weight' );
	$heading_font_weight    = get_theme_mod( 'heading_font_weight' );
	$site_title_font_weight = get_theme_mod( 'site_title_font_weight' );

	if ( $primary_font != "Raleway" && ! empty( $primary_font ) ) {

		$fonts_url = ct_chosen_pro_format_font_request( $primary_font );

		wp_register_style( 'ct-chosen-pro-primary-google-fonts', $fonts_url );

		wp_enqueue_style( 'ct-chosen-pro-primary-google-fonts' );
	}
	if ( $heading_font != "Playfair Display" && ! empty( $heading_font ) ) {

		$fonts_url = ct_chosen_pro_format_font_request( $heading_font );

		wp_register_style( 'ct-chosen-pro-heading-google-fonts', $fonts_url );

		wp_enqueue_style( 'ct-chosen-pro-heading-google-fonts' );
	}
	if ( $site_title_font != "Playfair Display" && ! empty( $site_title_font ) ) {

		$fonts_url = ct_chosen_pro_format_font_request( $site_title_font );

		wp_register_style( 'ct-chosen-pro-site-title-google-fonts', $fonts_url );

		wp_enqueue_style( 'ct-chosen-pro-site-title-google-fonts' );
	}
}
add_action( 'wp_enqueue_scripts', 'ct_chosen_pro_register_new_font', 30 );

// used to format GF request (ajax and non-ajax)
function ct_chosen_pro_format_font_request( $font ) {

	// get array of fonts and their weights
	$fonts     = ct_chosen_pro_prepare_fonts();
	$weights   = array();
	$fonts_url = '';

	if ( is_array( $fonts ) && ! empty( $fonts ) ) {

		// get all weights for user selected font
		foreach ( $fonts[ $font ] as $weight ) {
			$weights[ $weight ] = $weight;
		}

		// convert to comma-delimited list
		$weights = implode( ',', $weights );

		// turn 'regular' into '400'
		$weights = str_replace( 'regular', '400', $weights );

		// replace any spaces with '+'
		$font = str_replace( ' ', '+', $font );

		// format the font/weight for the request
		$font_request = $font . ':' . $weights;

		$font_args = array(
			'family' => $font_request,
			'subset' => urlencode( 'latin,latin-ext' )
		);

		$fonts_url = add_query_arg( $font_args, '//fonts.googleapis.com/css' );
		$fonts_url = esc_url_raw( $fonts_url );
	}

	return $fonts_url;
}