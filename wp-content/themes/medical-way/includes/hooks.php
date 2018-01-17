<?php
/**
 * Load hooks.
 *
 * @package Medical_Way
 */

//=============================================================
// Doctype hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_doctype_action' ) ) :
    /**
     * Doctype declaration of the theme.
     *
     * @since 1.0.0
     */
    function medical_way_doctype_action() {
    ?><!DOCTYPE html> <html <?php language_attributes(); ?>><?php
    }
endif;

add_action( 'medical_way_doctype', 'medical_way_doctype_action', 10 );

//=============================================================
// Head hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_head_action' ) ) :
    /**
     * Header hook of the theme.
     *
     * @since 1.0.0
     */
    function medical_way_head_action() {
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
    }
endif;

add_action( 'medical_way_head', 'medical_way_head_action', 10 );

//=============================================================
// Top header hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_top_header_action' ) ) :
    /**
     * Header Start.
     *
     * @since 1.0.0
     */
    function medical_way_top_header_action() {

        // Top Items.
        $top_address    = medical_way_get_option( 'top_address' );
        $top_phone      = medical_way_get_option( 'top_phone' );
        $top_fax        = medical_way_get_option( 'top_fax' );
        $social_icons   = medical_way_get_option( 'show_social_icons' );

        ?>
        <div id="top-bar" class="top-header">
            <div class="container">
                <?php 
                if( !empty( $top_address ) || !empty( $top_phone ) || !empty( $top_fax ) ){ ?>
                    <div class="top-left">
                        <?php if( !empty( $top_address ) ){ ?>
                            <span class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( $top_address ); ?></span>
                        <?php } ?>

                        <?php if( !empty( $top_phone ) ){ ?>
                            <span class="phone"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $top_phone ); ?></span>
                        <?php } ?>

                        <?php if( !empty( $top_fax ) ){ ?>
                            <span class="fax"><i class="fa fa-fax" aria-hidden="true"></i> <?php echo esc_html( $top_fax ); ?></span>
                        <?php } ?>
                        
                    </div><?php 
                } ?>

                <?php 
                if( ( 1 == $social_icons && has_nav_menu( 'social' )) ||  has_nav_menu( 'top' ) ){ ?>
                    <div class="top-right">
                        <?php 
                        if( has_nav_menu( 'top' ) ){ ?>
                            <div class="top-menu-content">
                                <?php
                                wp_nav_menu(
                                    array(
                                    'theme_location' => 'top',
                                    'menu_id'        => 'top-menu',
                                    'depth'          => 1,                                   
                                    )
                                ); ?>
                            </div><!-- .menu-content -->
                            <?php
                        } 

                        if( 1 == $social_icons && has_nav_menu( 'social' ) ){ ?>

                            <div class="top-social-menu menu-social-menu-container"> 

                                <?php the_widget( 'Medical_Way_Social_Widget' ); ?>

                            </div>
                            <?php
                        } ?>

                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
endif;

add_action( 'medical_way_top_header', 'medical_way_top_header_action' );

//=============================================================
// Before header hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_before_header_action' ) ) :
    /**
     * Header Start.
     *
     * @since 1.0.0
     */
    function medical_way_before_header_action() {

        // Slider status.
        $slider_status  = medical_way_get_option( 'slider_status' );
        $header_class   = ( 'disable' === $slider_status ) ? 'slider-disabled' : 'slider-enabled';
        ?><header id="masthead" class="site-header <?php echo $header_class; ?>" role="banner"><div class="container"><?php
    }
endif;

add_action( 'medical_way_before_header', 'medical_way_before_header_action' );

//=============================================================
// Header main hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_header_action' ) ) :

    /**
     * Site Header.
     *
     * @since 1.0.0
     */
    function medical_way_header_action() {
        ?>
    	<div class="site-branding">
    		<?php medical_way_the_custom_logo(); ?>

    		<?php $show_title = medical_way_get_option( 'show_title' ); ?>

    		<?php if ( true === $show_title ) : ?>
    			<?php if ( is_front_page() && is_home() ) : ?>
    				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    			<?php else : ?>
    				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
    			<?php endif; ?>
    		<?php endif; ?>

    		<?php
    		$description  = get_bloginfo( 'description', 'display' );
    		$show_tagline = medical_way_get_option( 'show_tagline' );
    		?>
    		<?php if ( true === $show_tagline ) : ?>
    			<?php if ( $description || is_customize_preview() ) : ?>
    				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
    			<?php endif; ?>
    		<?php endif; ?>
    	</div><!-- .site-branding -->
        <div id="main-nav" class="clear-fix">
            <!-- <nav id="site-navigation" class="main-navigation" role="navigation">
                <div class="wrap-menu-content">
    				<?php
    				wp_nav_menu(
    					array(
    					'theme_location' => 'primary',
    					'menu_id'        => 'primary-menu',
    					'fallback_cb'    => 'medical_way_primary_navigation_fallback',
    					)
    				);
    				?>
                </div><!-- .menu-content -->
            </nav><!-- #site-navigation --> -->
        </div> <!-- #main-nav -->
        <?php
    }

endif;

add_action( 'medical_way_header', 'medical_way_header_action' );

//=============================================================
// After header hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_after_header_action' ) ) :
    /**
     * Header End.
     *
     * @since 1.0.0
     */
    function medical_way_after_header_action() {
       
    ?></div><!-- .container --></header><!-- #masthead --><?php
    }
endif;
add_action( 'medical_way_after_header', 'medical_way_after_header_action' );

//=============================================================
// Slider hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_main_content_for_slider' ) ) :

    /**
     * Add slider.
     *
     * @since 1.0.0
     */
    function medical_way_main_content_for_slider() {

        get_template_part( 'template-parts/slider' );

    }

endif;

add_action( 'medical_way_main_content', 'medical_way_main_content_for_slider' , 5 );

//=============================================================
// Breadcrumb hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_main_content_for_breadcrumb' ) ) :

    /**
     * Add breadcrumb.
     *
     * @since 1.0.0
     */
    function medical_way_main_content_for_breadcrumb() {

        get_template_part( 'template-parts/breadcrumbs' );

    }

endif;

add_action( 'medical_way_main_content', 'medical_way_main_content_for_breadcrumb' , 7 );

//=============================================================
// Home widget hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_main_content_for_home_widgets' ) ) :

    /**
     * Add home widgets.
     *
     * @since 1.0.0
     */
    function medical_way_main_content_for_home_widgets() {

        get_template_part( 'template-parts/home-widgets' );

    }

endif;

add_action( 'medical_way_main_content', 'medical_way_main_content_for_home_widgets' , 9 );

//=============================================================
// Before content hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_before_content_action' ) ) :
    /**
     * Content Start.
     *
     * @since 1.0.0
     */
    function medical_way_before_content_action() {
    ?><div id="content" class="site-content"><div class="container"><div class="inner-wrapper"><?php
    }
endif;
add_action( 'medical_way_before_content', 'medical_way_before_content_action' );

//=============================================================
// After content hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_after_content_action' ) ) :
    /**
     * Content End.
     *
     * @since 1.0.0
     */
    function medical_way_after_content_action() {
    ?></div><!-- .inner-wrapper --></div><!-- .container --></div><!-- #content --><?php    
    }
endif;
add_action( 'medical_way_after_content', 'medical_way_after_content_action' );

//=============================================================
// Credit info hook of the theme
//=============================================================
if ( ! function_exists( 'medical_way_credit_info' ) ) :

    function medical_way_credit_info(){ ?>

        <div class="site-info">
            <?php printf( esc_html__( '%1$s by %2$s', 'medical-way' ), 'Medical Way', '<a href="https://promenadethemes.com" rel="designer">Promenade Themes</a>' ); ?>
        </div><!-- .site-info -->

        <?php
    }

endif;

add_action( 'medical_way_credit', 'medical_way_credit_info', 10 );

