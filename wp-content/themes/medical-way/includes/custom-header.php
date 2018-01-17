<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Medical_Way
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses medical_way_header_style()
 */
function medical_way_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'medical_way_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 400,
		'flex-height'            => true,
		'header-text'   		 => false,
	) ) );
}
add_action( 'after_setup_theme', 'medical_way_custom_header_setup' );

