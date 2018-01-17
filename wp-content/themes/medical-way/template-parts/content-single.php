<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Medical_Way
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $single_class =  ( has_post_thumbnail() ) ? 'single-with-image' : 'single-no-image'; ?>

	<div class="single-wrap <?php echo $single_class; ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-thumb">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>

		<div class="single-inner">
			<div class="single-inner-content">
				<header class="entry-header">
					<?php
					
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 
					?>
					<footer class="entry-footer">
						<?php medical_way_entry_footer(); ?>
					</footer><!-- .entry-footer -->
					
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php
						the_content( sprintf(
							/* translators: %s: Name of current post. */
							wp_kses( esc_html__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'medical-way' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'medical-way' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
			</div>
		</div>

	</div>
</article><!-- #post-## -->
