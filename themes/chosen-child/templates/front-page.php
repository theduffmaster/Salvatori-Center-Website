<?php
/**
 * Template Name: Front Page w/ posts
 *
 * @package WordPress
 * @subpackage Chosen child
 * @since Chosen child 1.0
 */

 get_header(); ?>
 <div id="loop-container" class="loop-container">
 	<?php
 	if ( have_posts() ) :
 		while ( have_posts() ) :
 			the_post(); ?>
 			<div <?php post_class(); ?>>
 				<?php do_action( 'page_before' ); ?>
 				<article>
 					<?php ct_chosen_featured_image(); ?>
 					<div class='post-header'>
 						<h1 class='post-title'><?php the_title(); ?></h1>
 					</div>
 					<div class="post-content">
 						<?php the_content(); ?>
 						<?php wp_link_pages( array(
 							'before' => '<p class="singular-pagination">' . esc_html__( 'Pages:', 'chosen' ),
 							'after'  => '</p>',
 						) ); ?>
 						<?php do_action( 'page_after' ); ?>
 					</div>
 				</article>
 				<?php comments_template(); ?>
 			</div>
 		<?php endwhile;
 	endif; ?>
 </div>
 <div class="sidebar sidebar-after-main-content active-1" id="sidebar-after-main-content"></div>
 <p class="loop-title recent-work-title">RECENT WORK</p>
 <div id="loop-container-recent-work" class="home-posts loop-container-recent-work archive">
	 <?php
   //Find all posts labeled with the category slug work and display the most recent two
	 $the_query = new WP_Query(array(
		'post_type' => array('any'),
    'posts_per_page' => 2,
    'category_name' => 'work',
		));
	 	if ( $the_query->have_posts() ) {
	 		while ( $the_query->have_posts() ) :
	 			$the_query->the_post();
	 			get_template_part( 'content', 'archive' );
	 		endwhile;
    } else {
      //If there are no recent work posts to show display this message
      echo '<p class="recent-work-empty"color="#545454" style="font-size: 1.5em; text-align:center; color:#cccccc">Currently no recent work. Please check back soon!<br><br></p>';
    }
	 	?>
	 </div>
	 <div class="sidebar sidebar-after-main-content active-2" id="sidebar-after-main-content"></div>
 <p class="loop-title upcoming-events-title">UPCOMING EVENTS</p>
 <div id="loop-container-upcoming-events" class="home-posts loop-container-upcoming-events archive">
	 <?php
	 $the_query = new WP_Query(array(
     //Find all posts labeled with the category slug events and display the most recent two
		'post_type' => array('any'),
    'posts_per_page' => 2,
    'category_name' => 'event',
		));
	 	if ( $the_query->have_posts() ) {
	 		while ( $the_query->have_posts() ) :
	 			$the_query->the_post();
	 			get_template_part( 'content', 'archive' );
	 		endwhile;
    } else {
      //If there are no upcoming event posts to show display this message
      echo '<p class="upcoming-events-empty" style="font-size: 1.5em; text-align:center; color:#cccccc;">Currently No upcoming events. Please check back soon!<br><br></p>';
    }
	 	?>
	 </div>
 <?php get_footer();
