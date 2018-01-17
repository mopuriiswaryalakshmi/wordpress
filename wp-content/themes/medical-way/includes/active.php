<?php
/**
 * Functions for active_callback.
 *
 * @package Medical_Way
 */

if ( ! function_exists( 'medical_way_is_featured_slider_active' ) ) :

	/**
	 * Check if featured slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function medical_way_is_featured_slider_active( $control ) {

		if ( 'disable' !== $control->manager->get_setting( 'slider_status' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;


if ( ! function_exists( 'medical_way_is_custom_background_breadcrumb' ) ) :

	/**
	 * Check if custom background is used for breadcrumb.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function medical_way_is_custom_background_breadcrumb( $control ) {

		if ( 'image-bg' == $control->manager->get_setting( 'breadcrumb_type' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;