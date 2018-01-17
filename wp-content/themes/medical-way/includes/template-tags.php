<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Medical_Way
 */

if ( ! function_exists( 'medical_way_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function medical_way_entry_footer() {

	$posted_date 	= medical_way_get_option( 'posted_date' );
	$post_author 	= medical_way_get_option( 'post_author' );
	$post_category 	= medical_way_get_option( 'post_category' );
	$post_tag 		= medical_way_get_option( 'post_tag' );
	$post_comment 	= medical_way_get_option( 'post_comment' );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'%s',
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		'%s',
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	if( 1 != $posted_date ){

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}

	if( 1 != $post_author ){

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && ( 1 != $post_category ) ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ', ');
		if ( $categories_list && medical_way_categorized_blog() ) {
			printf( '<span class="cat-links">%s</span>', $categories_list ); // WPCS: XSS OK.
		}
	}

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && ( 1 != $post_tag ) ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'medical-way' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">%s</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( (! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) && ( 1 != $post_comment ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'No Comment<span class="screen-reader-text"> on %s</span>', 'medical-way' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'medical-way' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function medical_way_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'medical_way_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'medical_way_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so medical_way_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so medical_way_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in medical_way_categorized_blog.
 */
function medical_way_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Like, beat it. Dig?
	delete_transient( 'medical_way_categories' );
}
add_action( 'edit_category', 'medical_way_category_transient_flusher' );
add_action( 'save_post',     'medical_way_category_transient_flusher' );

if ( ! function_exists( 'medical_way_the_custom_logo' ) ) :

	/**
	 * Displays custom logo.
	 *
	 * @since 1.0.0
	 */
	function medical_way_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;

if ( ! function_exists( 'medical_way_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function medical_way_primary_navigation_fallback() {
		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'medical-way' ) . '</a></li>';
		$args = array(
			'number'       => 4,
			'hierarchical' => false,
			);
		$pages = get_pages( $args );
		if ( is_array( $pages ) && ! empty( $pages ) ) {
			foreach ( $pages as $page ) {
				echo '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a></li>';
			}
		}
		echo '</ul>';

	}

endif;
