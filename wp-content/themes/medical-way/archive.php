<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Medical_Way
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : 
			
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content' );

			endwhile;

			the_posts_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'medical_way_action_sidebar' );
get_footer();
