<?php
/**
 * Template Name: Team Page
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

$team_page    = medical_way_get_option( 'team_page' );
$member_link    = medical_way_get_option( 'member_link' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="mw-team" class="sec-team">

				<div class="container">
					<?php
					if ( $team_page ) { 

						$team_args = array(
										'posts_per_page' => 1,
										'page_id'	     => absint( $team_page ),
										'post_type'      => 'page',
										'post_status'  	 => 'publish',
									);

						$team_query = new WP_Query( $team_args );	

						if( $team_query->have_posts()){

							while( $team_query->have_posts()){

								$team_query->the_post(); ?>

								<div class="team-top-info">
									<h3><?php the_title(); ?></h3>
									<?php 
									the_content(); 

									wp_link_pages( array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'medical-way' ),
										'after'  => '</div>',
									) );
									?>
								</div><?php
							}

							wp_reset_postdata();
						} 

						$all_team = array(
								    'post_type'      => 'page',
								    'posts_per_page' => 25,
								    'post_parent'    => absint( $team_page ),
								    'order'          => 'ASC',
								    'orderby'        => 'menu_order'
								 );

						$team_members = new WP_Query( $all_team );

						if( $team_members->have_posts()){ ?>

							<div class="inner-wrapper"><?php

								while( $team_members->have_posts()){

									$team_members->the_post(); ?>
									<div class="team-member-item">
										<div class="team-member-wrap">
							                <?php if ( has_post_thumbnail() ) :  ?>
							                  <div class="member-image">
							                  	<?php 
							                  	if( 1 == $member_link ){

							                  		the_post_thumbnail( 'medical-way-large' ); 

							                  	}else{ ?>
								                    <a href="<?php the_permalink(); ?>">
														<?php the_post_thumbnail( 'medical-way-large' ); ?>
								                    </a>
								                <?php } ?>
							                  </div><!-- .member-image -->
							                <?php endif; ?>
							                <div class="memeber-details">
		                	                  	<?php 
		                	                  	if( 1 == $member_link ){ ?>

		                	                  		<h3><?php the_title(); ?></h3>

		                	                  		<?php

		                	                  	}else{ ?>

		                		                    <a href="<?php the_permalink(); ?>">
		                								<h3><?php the_title(); ?></h3>
		                		                    </a>

		                		                <?php } 

												$position =  get_post(get_post_thumbnail_id())->post_content;

												if( !empty( $position ) ){ ?>
												    <strong><?php echo esc_html( $position ); ?></strong>
													<?php 
												}  

												the_content();

												wp_link_pages( array(
													'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'medical-way' ),
													'after'  => '</div>',
												) ); 

												?>
											</div>
										</div>
									</div>
									<?php
								}
								wp_reset_postdata(); ?>
							
							</div>
							<?php
						} 

					} ?>
					
				</div>

			</div><!-- .contact -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
