<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Medical_Way
 */

?>
<?php
	/**
	 * Hook - medical_way_doctype.
	 *
	 * @hooked medical_way_doctype_action - 10
	 */
	do_action( 'medical_way_doctype' );
?>
<head>
	<?php
		/**
		 * Hook - medical_way_head.
		 *
		 * @hooked medical_way_head_action - 10
		 */
		do_action( 'medical_way_head' );
	?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<?php
	  /**
	   * Hook - medical_way_top_header.
	   *
	   * @hooked medical_way_top_header_action - 10
	   */
	  do_action( 'medical_way_top_header' );
	?>

	<?php
	  /**
	   * Hook - medical_way_before_header.
	   *
	   * @hooked medical_way_before_header_action - 10
	   */
	  do_action( 'medical_way_before_header' );
	?>

	<?php
		/**
		 * Hook - medical_way_header.
		 *
		 * @hooked medical_way_header_action - 10
		 */
		do_action( 'medical_way_header' );
	?>
	<?php
	  /**
	   * Hook - medical_way_after_header.
	   *
	   * @hooked medical_way_after_header_action - 10
	   */
	  do_action( 'medical_way_after_header' );
	?>

	<?php
	/**
	 * Hook - medical_way_main_content.
	 *
	 * @hooked medical_way_main_content_for_slider - 5
	 * @hooked medical_way_main_content_for_breadcrumb - 7
	 * @hooked medical_way_main_content_for_home_widgets - 9
	 */
	do_action( 'medical_way_main_content' );
	?>

	<?php
	/**
	 * Hook - medical_way_before_content.
	 *
	 * @hooked medical_way_before_content_action - 10
	 */
	do_action( 'medical_way_before_content' );
	?>
