<?php
/**
 * Template Name: Services Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Medical_Way
 */

get_header(); 

$service_page    = medical_way_get_option( 'services_page' );
$service_link    = medical_way_get_option( 'services_link' );
$excerpt_length  = medical_way_get_option( 'services_excerpt' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="services-wrap">
				<?php

				if ( $service_page ) { 

					$service_args = array(
									'posts_per_page' => 1,
									'page_id'	     => absint( $service_page ),
									'post_type'      => 'page',
									'post_status'  	 => 'publish',
								);

					$service_query = new WP_Query( $service_args );	

					if( $service_query->have_posts()){

						while( $service_query->have_posts()){

							$service_query->the_post(); ?>

							<div class="services-info services-top">
								<h3 class="services-info-title"><?php the_title(); ?></h3>
								<?php 
								the_content(); 

								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'medical-way' ),
									'after'  => '</div>',
								) );
								
								?>
							</div>

							<?php

						}

						wp_reset_postdata();

					} 
				}

					$query_services = array(
									    'post_type'      => 'page',
									    'posts_per_page' => 25,
									    'post_parent'    => absint( $service_page ),
									    'order'          => 'ASC',
									    'orderby'        => 'menu_order'
									);

					$all_services = new WP_Query( $query_services ); 

				 	if( $all_services->have_posts()){ ?>
						
							<div class="inner-wrapper">

								<?php while( $all_services->have_posts()){

									 $all_services->the_post(); ?>

									<div class="services-item">
						                <?php if ( has_post_thumbnail() ) :  ?>
						                  <div class="services-thumb">
						                  	<?php 
						                  	if( 1 == $service_link ){ 

						                  		the_post_thumbnail( 'medical-way-large' );
							                   
						                    } else{ ?>

												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'medical-way-large' ); ?>
							                    </a><?php
												
											} ?>
						                  </div><!-- .latest-news-thumb -->
						                <?php endif; 

										if( 1 == $service_link ){ ?>
											<h3 class="services-item-title"><?php the_title(); ?></h3><?php

										} else{ ?>

											<h3 class="services-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php
											
										} 

										$content = medical_way_get_the_excerpt( absint( $excerpt_length ), $post );
										
										echo $content ? wpautop( wp_kses_post( $content ) ) : '';
										?>
									</div><!-- .services-item -->
								<?php } 

								wp_reset_postdata(); ?>

							</div><!-- .inner-wrapper -->

					<?php } ?>
			</div><!-- .services-left -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
