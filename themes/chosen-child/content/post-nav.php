<?php

global $post;

$post_id = $post->ID; // current post ID
$cat = get_the_category();
$current_cat_id = $cat[0]->cat_ID; // current category ID

$args = array(
    'category' => $current_cat_id,
    'orderby'  => 'post_date',
    'order'    => 'DESC',
    'numberposts'=> -1
);

$posts = get_posts( $args );

// get IDs of posts retrieved from get_posts
$ids = array();
foreach ( $posts as $thepost ) {
    $ids[] = $thepost->ID;
}
// get previous and next post in the same category
$thisindex = array_search( $post_id, $ids );
$previd    = isset( $ids[ $thisindex + 1 ] ) ? $ids[ $thisindex + 1 ] : 0;
$nextid    = isset( $ids[ $thisindex - 1 ] ) ? $ids[ $thisindex - 1 ] : 0;

$previous_post = get_post($previd);
$next_post     = get_post($nextid);

if ( $previous_post && $previous_post != $post ) {
	$previous_text  = esc_html__( 'Previous Post', 'chosen' );
	$previous_title = get_the_title( $previous_post ) ? get_the_title( $previous_post ) : esc_html__( "The Previous Post", 'chosen' );
	$previous_link  = get_permalink( $previous_post );
} else {
	$previous_text  = esc_html__( 'No Older Entries', 'chosen' );
	$previous_title = esc_html__( 'See All Entries', 'chosen' );
	$previous_link = get_category_link( $current_cat_id );
}

if ( $next_post && $next_post != $post ) {
	$next_text = esc_html__( 'Next Post', 'chosen' );
	$next_title = get_the_title( $next_post ) ? get_the_title( $next_post ) : esc_html__( "The Next Post", 'chosen' );
	$next_link = get_permalink( $next_post );
} else {
	$next_text  = esc_html__( 'No Newer Entries', 'chosen' );
	$next_title = esc_html__( 'See All Entries', 'chosen' );
	$next_link = get_category_link( $current_cat_id );
}

?>
<nav class="further-reading">
	<div class="previous">
		<span><?php echo esc_html( $previous_text ); ?></span>
		<a href="<?php echo esc_url( $previous_link ); ?>"><?php echo esc_html( $previous_title ); ?></a>
	</div>
	<div class="next">
		<span><?php echo esc_html( $next_text ); ?></span>
		<a href="<?php echo esc_url( $next_link ); ?>"><?php echo esc_html( $next_title ); ?></a>
	</div>
</nav>
