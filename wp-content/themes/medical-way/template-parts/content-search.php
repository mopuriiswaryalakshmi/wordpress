<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Medical_Way
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="featured-thumb">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
	</div>
	<?php endif; ?>

	<?php $contet_class =  ( has_post_thumbnail() ) ? 'content-with-image' : 'content-no-image'; ?>

	<div class="content-wrap <?php echo $contet_class; ?>">
		<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php medical_way_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->
