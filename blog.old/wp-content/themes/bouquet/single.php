<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Bouquet
 */

get_header(); ?>

		<div id="content-wrapper">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php bouquet_content_nav( 'nav-below' ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #content-wrapper -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>