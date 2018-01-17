<?php
/**
 * Breadcrumbs.
 *
 * @package Medical_Way
 */

// Bail if front page.
if ( is_front_page() || is_page_template( 'templates/home.php' ) ) {
	return;
}

$breadcrumb_type = medical_way_get_option( 'breadcrumb_type' );
if ( 'disable' === $breadcrumb_type ) {
	return;
}

if ( ! function_exists( 'medical_way_breadcrumb_trail' ) ) {
	require_once trailingslashit( get_template_directory() ) . '/assets/vendor/breadcrumbs/breadcrumbs.php';
}

$breadcrumb_class = '';

// Custom image.
$image_url = get_header_image();

if( !empty( $image_url ) && 'image-bg' === $breadcrumb_type ){

	$breadcrumbs_style = 'style="background: url('.esc_url( $image_url ).') top center no-repeat; background-size: cover;"';

	$breadcrumb_class = 'bg-enabled';

	$breadcrumb_overlay = medical_way_get_option( 'breadcrumb_overlay_status' );

	if( 1 == $breadcrumb_overlay ){ 
		$breadcrumb_class .= ' overlay-enabled';
	}

} else{

	$breadcrumbs_style = '';
	$breadcrumb_class = 'simple-breadcrumb';
}

?>

<div id="breadcrumb" class="<?php echo $breadcrumb_class; ?>" <?php echo $breadcrumbs_style; ?>>
	<div class="container">
		<?php
		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		medical_way_breadcrumb_trail( $breadcrumb_args );
		?>
	</div><!-- .container -->
</div><!-- #breadcrumb -->
