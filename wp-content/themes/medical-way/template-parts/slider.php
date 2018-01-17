<?php
/**
 * Helper functions.
 *
 * @package Medical_Way
 */

// Bail if no slider.
$slider_details = medical_way_get_slider_details();
if ( empty( $slider_details ) ) {
	return;
}

// Slider status.
$slider_status = medical_way_get_option( 'slider_status' );
if ( 'disable' === $slider_status ) {
	return;
}

if ( ! ( is_front_page()) && ! is_page_template( 'templates/home.php' ) ) {
    return;
} 

// Slider settings.
$slider_transition_effect 		= medical_way_get_option( 'slider_transition_effect' );
$slider_transition_delay  		= medical_way_get_option( 'slider_transition_delay' );
$slider_transition_duration  	= medical_way_get_option( 'slider_transition_duration' );
$slider_caption_status    		= medical_way_get_option( 'slider_caption_status' );
$slider_arrow_status      		= medical_way_get_option( 'slider_arrow_status' );
$slider_pager_status     		= medical_way_get_option( 'slider_pager_status' );
$slider_autoplay_status   		= medical_way_get_option( 'slider_autoplay_status' );
$slider_overlay_status   		= medical_way_get_option( 'slider_overlay_status' );

// Cycle data.
$slide_data = array(
	'fx'             => esc_attr( $slider_transition_effect ),
	'speed'          => esc_attr( $slider_transition_duration ) * 1000,
	'pause-on-hover' => 'true',
	'loader'         => 'true',
	'log'            => 'false',
	'swipe'          => 'true',
	'auto-height'    => 'container',
);

if ( true === $slider_pager_status ) {
	$slide_data['pager-template'] = '<span class="pager-box"></span>';
}
if ( true === $slider_autoplay_status ) {
	$slide_data['timeout'] = absint( $slider_transition_delay ) * 1000;
} else {
	$slide_data['timeout'] = 0;
}

$slide_data['slides'] = 'article';

$slide_attributes_text = '';
foreach ( $slide_data as $key => $item ) {

	$slide_attributes_text .= ' ';
	$slide_attributes_text .= ' data-cycle-'.esc_attr( $key );
	$slide_attributes_text .= '="'.esc_attr( $item ).'"';

}
$overlay_class = ( true === $slider_overlay_status ) ? 'overlay-enabled' : 'overlay-disabled' ;
?>
<div id="featured-slider">
	<div class="cycle-slideshow <?php echo esc_attr( $overlay_class ); ?>" id="main-slider" <?php echo $slide_attributes_text; ?>>

		<?php 
		if ( true === $slider_arrow_status ) : ?>
			<div class="cycle-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
			<div class="cycle-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
			<?php 
		endif; 

		$count = 1; 

		foreach ( $slider_details as $slide ) :

			$extra_class = ( 1 === $count ) ? 'first' : ''; 

			// For CTA Button.
			$buttons_markup = '';

			if( !empty( $slide['slider_button'] ) && !empty( $slide['slider_url'] )){ 
				
				$buttons_markup .= '<div class="slider-cta">'; 

				$buttons_markup .= '<a href="'.esc_url($slide['slider_url']).'">'.esc_attr( $slide['slider_button'] ).'</a>';

				$buttons_markup .= '</div>';
				
			} ?>
			
			<article class="<?php echo esc_attr( $extra_class ); ?>" data-cycle-title="<?php echo esc_attr( $slide['title'] ); ?>"  data-cycle-url="<?php echo esc_url( $slide['url'] ); ?>"  data-cycle-excerpt="<?php echo esc_attr( $slide['excerpt'] ); ?>" data-cycle-buttons="<?php echo esc_attr( $buttons_markup ); ?>" >

				<img src="<?php echo esc_url( $slide['image_url'] ); ?>" alt="<?php echo esc_attr( $slide['title'] ); ?>" />

				<?php if ( true === $slider_caption_status ) : ?>
					<div class="cycle-caption">
						<div class="container">
							<div class="caption-wrap">
								<h3><?php echo esc_attr( $slide['title'] ); ?></h3>
								<div class="slider-meta"><p><?php echo esc_attr( $slide['excerpt'] ); ?></p></div>
							</div>
							<?php echo wp_kses_post( $buttons_markup ); ?>
						</div><!-- .cycle-wrap -->
					</div><!-- .cycle-caption -->
				<?php endif; ?>

			</article>

		<?php $count++; ?>

		<?php endforeach; ?>

		<?php if ( true === $slider_pager_status ) : ?>
			<div class="cycle-pager"></div>
		<?php endif; ?>

	</div> <!-- #main-slider -->
</div><!-- #featured-slider -->
