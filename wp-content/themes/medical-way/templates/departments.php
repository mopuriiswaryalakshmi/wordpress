<?php
/**
 * Template Name: Departments Page
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

$departments_page    = medical_way_get_option( 'departments_page' );
$departments_link    = medical_way_get_option( 'departments_link' );
$excerpt_length      = medical_way_get_option( 'departments_excerpt' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="department-wrap">
				<?php

				if ( $departments_page ) { 

					$departments_args = array(
									'posts_per_page' => 1,
									'page_id'	     => absint( $departments_page ),
									'post_type'      => 'page',
									'post_status'  	 => 'publish',
								);

					$departments_query = new WP_Query( $departments_args );	

					if( $departments_query->have_posts()){

						while( $departments_query->have_posts()){

							$departments_query->the_post(); ?>

							<div class="department-info department-top">
								<h3 class="department-info-title"><?php the_title(); ?></h3>
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

					$query_departments = array(
									    'post_type'      => 'page',
									    'posts_per_page' => 25,
									    'post_parent'    => absint( $departments_page ),
									    'order'          => 'ASC',
									    'orderby'        => 'menu_order'
									);

					$all_departments = new WP_Query( $query_departments ); 

				 	if( $all_departments->have_posts()){ ?>
						
							<div class="inner-wrapper">

								<?php while( $all_departments->have_posts()){

									 $all_departments->the_post(); ?>

									<div class="department-item">
						                <?php if ( has_post_thumbnail() ) :  ?>
						                  <div class="department-thumb">
						                  	<?php 
						                  	if( 1 == $departments_link ){ 

						                  		the_post_thumbnail( 'medical-way-large' );
							                   
						                    } else{ ?>

												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'medical-way-large' ); ?>
							                    </a><?php
												
											} ?>
						                  </div><!-- .departments-thumb -->
						                <?php endif; 

										if( 1 == $departments_link ){ ?>
											<h3 class="department-item-title"><?php the_title(); ?></h3><?php

										} else{ ?>

											<h3 class="department-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php
											
										} 

										$content = medical_way_get_the_excerpt( absint( $excerpt_length ), $post );
										
										echo $content ? wpautop( wp_kses_post( $content ) ) : '';
										?>
									</div><!-- .departments-item -->
								<?php } 

								wp_reset_postdata(); ?>

							</div><!-- .inner-wrapper -->

					<?php } ?>
			</div><!-- .departments-wrap -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
