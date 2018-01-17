<?php
/**
 * Custom widgets.
 *
 * @package Medical_Way
 */

if ( ! function_exists( 'medical_way_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function medical_way_load_widgets() {

		// Social.
		register_widget( 'Medical_Way_Social_Widget' );

		// Latest news.
		register_widget( 'Medical_Way_Latest_News_Widget' );

		// CTA widget.
		register_widget( 'Medical_Way_CTA_Widget' );

		// Services widget.
		register_widget( 'Medical_Way_Services_Widget' );

		// Departments widget.
		register_widget( 'Medical_Way_Departments_Widget' );

		// Facts widget.
		register_widget( 'Medical_Way_Facts_Widget' );

		// Contact widget.
		register_widget( 'Medical_Way_Contact_Widget' );

		// Team widget.
		register_widget( 'Medical_Way_Team_Widget' );

		// Testimonial widget.
		register_widget( 'Medical_Way_Testimonial_Widget' );

	}

endif;

add_action( 'widgets_init', 'medical_way_load_widgets' );


if ( ! class_exists( 'Medical_Way_Social_Widget' ) ) :

	/**
	 * Social widget class.
	 *
	 * @since 1.0.0
	 */
	class Medical_Way_Social_Widget extends WP_Widget {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'   => 'medical_way_widget_social',
				'description' => esc_html__( 'Social Icons Widget', 'medical-way' ),
			);
			parent::__construct( 'medical-way-social', esc_html__( 'MW: Social', 'medical-way' ), $opts );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			if ( ! empty( $title ) ) {
				echo $args['before_title'] . esc_html( $title ). $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'social',
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			}

			echo $args['after_widget'];

		}

		/**
		 * Update widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            {@see WP_Widget::form()}.
		 * @param array $old_instance Old settings for this instance.
		 * @return array Settings to save or bool false to cancel saving.
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] = sanitize_text_field( $new_instance['title'] );

			return $instance;
		}

		/**
		 * Output the settings update form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance Current settings.
		 * @return void
		 */
		function form( $instance ) {

			$instance = wp_parse_args( (array) $instance, array(
				'title' => '',
			) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'medical-way' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<?php if ( ! has_nav_menu( 'social' ) ) : ?>
	        <p>
				<?php esc_html_e( 'Social menu is not set. Please create menu and assign it to Social Theme Location.', 'medical-way' ); ?>
	        </p>
	        <?php endif; ?>
			<?php
		}
	}

endif;


if ( ! class_exists( 'Medical_Way_Latest_News_Widget' ) ) :

	/**
	 * Latest News widget class.
	 *
	 * @since 1.0.0
	 */
	class Medical_Way_Latest_News_Widget extends WP_Widget {

	    function __construct() {
	    	$opts = array(
				'classname'   => 'medical_way_widget_latest_news',
				'description' => esc_html__( 'Latest News Widget', 'medical-way' ),
    		);

			parent::__construct( 'medical-way-latest-news', esc_html__( 'MW: Latest News', 'medical-way' ), $opts );
	    }


	    function widget( $args, $instance ) {

			$title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$post_category     = ! empty( $instance['post_category'] ) ? $instance['post_category'] : 0;
			$exclude_categories = !empty( $instance[ 'exclude_categories' ] ) ? esc_attr( $instance[ 'exclude_categories' ] ) : '';
			$post_column       = ! empty( $instance['post_column'] ) ? $instance['post_column'] : 4;
			$post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 4;

			$excerpt_length	   = !empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 20;

			$disable_excerpt   = ! empty( $instance['disable_excerpt'] ) ? $instance['disable_excerpt'] : 0;

			$disable_button   = ! empty( $instance['disable_button'] ) ? $instance['disable_button'] : 0;

	        echo $args['before_widget']; ?>

	        <div id="mw-latest-news" class="latest-news-widget latest-news-col-<?php echo esc_attr( $post_column ); ?>">

	        	<div class="container">

			        <?php 

			        if ( $title ) {
			        	echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
			        }

			        ?>
			        <?php
			        $query_args = array(
			        	'posts_per_page' 		=> esc_attr( $post_number ),
			        	'no_found_rows'  		=> true,
			        	'post__not_in'          => get_option( 'sticky_posts' ),
			        	'ignore_sticky_posts'   => true,
			        	);
			        if ( absint( $post_category ) > 0 ) {
			        	$query_args['category'] = absint( $post_category );
			        }

			        if ( !empty( $exclude_categories ) ) {

			        	$exclude_ids = explode(',', $exclude_categories);

			        	$query_args['category__not_in'] = $exclude_ids;

			        }

			        $all_posts = new WP_Query( $query_args );

			        if ( $all_posts->have_posts() ) :?>

				        <div class="inner-wrapper">

							<?php while ( $all_posts->have_posts() ) :

                                $all_posts->the_post(); ?>

			                <div class="latest-news-item">
				                <div class="latest-news-wrapper">
					                <?php if ( has_post_thumbnail() ) :  ?>
					                  <div class="latest-news-thumb">
					                    <a href="<?php the_permalink(); ?>">
											<?php
					                        $img_attributes = array( 'class' => 'aligncenter' );
					                        the_post_thumbnail( 'medical-way-large', $img_attributes );
											?>
					                    </a>
					                  </div><!-- .latest-news-thumb -->
					                <?php endif; ?>
					                <div class="latest-news-text-wrap">
										<h3 class="latest-news-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3><!-- .latest-news-title -->
										<?php if( 1 != $disable_excerpt ){ ?>
											<div class="latest-news-excerpt">
												<?php $content = medical_way_get_the_excerpt( absint( $excerpt_length ) );
												echo $content ? wpautop( wp_kses_post( $content ) ) : '';  ?>
											</div>
										<?php } ?>

										<?php if( 1 != $disable_button ){ ?>
											<a href="<?php the_permalink(); ?>" class="button cta-button cta-button-primary"><?php esc_html_e( 'Read More', 'medical-way' ); ?></a>
										<?php } ?>
					                </div><!-- .latest-news-text-wrap -->
				                </div>
			                </div>

							<?php endwhile; 

                            wp_reset_postdata(); ?>

				        <div><!-- .row -->

			        <?php endif; ?>

	        	</div>

	         </div><!-- .latest-news-widget -->

	        <?php
	        echo $args['after_widget'];

	    }

	    function update( $new_instance, $old_instance ) {
	        $instance = $old_instance;
			$instance['title']          	= sanitize_text_field( $new_instance['title'] );
			$instance['post_category']  	= absint( $new_instance['post_category'] );
			$instance['exclude_categories'] = sanitize_text_field( $new_instance['exclude_categories'] );
			$instance['post_number']    	= absint( $new_instance['post_number'] );
			$instance['post_column']    	= absint( $new_instance['post_column'] );
			$instance['excerpt_length'] 	= absint( $new_instance['excerpt_length'] );
			$instance['disable_excerpt']    = (bool) $new_instance['disable_excerpt'] ? 1 : 0;
			$instance['disable_button']     = (bool) $new_instance['disable_button'] ? 1 : 0;

	        return $instance;
	    }

	    function form( $instance ) {

	        $instance = wp_parse_args( (array) $instance, array(
				'title'          		=> '',
				'post_category'  		=> '',
				'exclude_categories' 	=> '',
				'post_column'    		=> 3,
				'post_number'    		=> 3,
				'excerpt_length'		=> 20,
				'disable_excerpt'   	=> 0,
				'disable_button'   		=> 0,

	        ) );
	        ?>
	        <p>
	          <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'medical-way' ); ?></strong></label>
	          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	        </p>
	        <p>
	          <label for="<?php echo  esc_attr( $this->get_field_id( 'post_category' ) ); ?>"><strong><?php esc_html_e( 'Select Category:', 'medical-way' ); ?></strong></label>
				<?php
	            $cat_args = array(
	                'orderby'         => 'name',
	                'hide_empty'      => 0,
	                'class' 		  => 'widefat',
	                'taxonomy'        => 'category',
	                'name'            => $this->get_field_name( 'post_category' ),
	                'id'              => $this->get_field_id( 'post_category' ),
	                'selected'        => absint( $instance['post_category'] ),
	                'show_option_all' => esc_html__( 'All Categories','medical-way' ),
	              );
	            wp_dropdown_categories( $cat_args );
				?>
	        </p>
	        <p>
	          <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>"><strong><?php esc_html_e( 'Number of Posts:', 'medical-way' ); ?></strong></label>
	          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo  esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['post_number'] ); ?>" min="1" />
	        </p>
            <p>
            	<label for="<?php echo esc_attr( $this->get_field_id( 'exclude_categories' ) ); ?>"><strong><?php esc_html_e( 'Exclude Categories:', 'medical-way' ); ?></strong></label>
            	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_categories' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['exclude_categories'] ); ?>" />
    	        <small>
    	        	<?php esc_html_e('Enter category id seperated with comma. Posts from these categories will be excluded from latest post listing.', 'medical-way'); ?>	
    	        </small>
            </p>
	        <p>
	          <label for="<?php echo esc_attr( $this->get_field_id( 'post_column' ) ); ?>"><strong><?php esc_html_e( 'Number of Columns:', 'medical-way' ); ?></strong></label>
				<?php
	            $this->dropdown_post_columns( array(
					'id'       => $this->get_field_id( 'post_column' ),
					'name'     => $this->get_field_name( 'post_column' ),
					'selected' => absint( $instance['post_column'] ),
					)
	            );
				?>
	        </p>
	        <p>
	        	<label for="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>">
	        		<?php esc_html_e('Excerpt Length:', 'medical-way'); ?>
	        	</label>
	        	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('excerpt_length') ); ?>" name="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>" type="number" value="<?php echo absint( $instance['excerpt_length'] ); ?>" />
	        </p>
	        <p>
	            <input class="checkbox" type="checkbox" <?php checked( $instance['disable_excerpt'] ); ?> id="<?php echo $this->get_field_id( 'disable_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'disable_excerpt' ); ?>" />
	            <label for="<?php echo $this->get_field_id( 'disable_excerpt' ); ?>"><?php esc_html_e( 'Hide Excerpt', 'medical-way' ); ?></label>
	        </p>
	        <p>
	            <input class="checkbox" type="checkbox" <?php checked( $instance['disable_button'] ); ?> id="<?php echo $this->get_field_id( 'disable_button' ); ?>" name="<?php echo $this->get_field_name( 'disable_button' ); ?>" />
	            <label for="<?php echo $this->get_field_id( 'disable_button' ); ?>"><?php esc_html_e( 'Hide Read More Button', 'medical-way' ); ?></label>
	        </p>
	        <?php
	    }

	    function dropdown_post_columns( $args ) {
			$defaults = array(
		        'id'       => '',
		        'name'     => '',
		        'selected' => 0,
			);

			$r = wp_parse_args( $args, $defaults );
			$output = '';

			$choices = array(
				'2' => 2,
				'3' => 3,
				'4' => 4,
			);

			if ( ! empty( $choices ) ) {

				$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
				$output .= "</select>\n";
			}

			echo $output;
	    }

	}

endif;

if ( ! class_exists( 'Medical_Way_CTA_Widget' ) ) :

	/**
	 * CTA widget class.
	 *
	 * @since 1.0.0
	 */
	class Medical_Way_CTA_Widget extends WP_Widget {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'   => 'medical_way_widget_call_to_action',
				'description' => esc_html__( 'Call To Action Widget', 'medical-way' ),
			);
			parent::__construct( 'medical-way-cta', esc_html__( 'MW: CTA', 'medical-way' ), $opts );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$cta_page    = !empty( $instance['cta_page'] ) ? $instance['cta_page'] : ''; 

			$button_text = ! empty( $instance['button_text'] ) ? esc_html( $instance['button_text'] ) : '';

			$button_url  = ! empty( $instance['button_url'] ) ? esc_url( $instance['button_url'] ) : '';

			echo $args['before_widget']; ?>

			<div id="mw-cta-page" class="cta-widget">

				<div class="container">

					<?php

					if ( ! empty( $title ) ) {
						echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
					}  

					if ( $cta_page ) { 

						$cta_args = array(
										'posts_per_page' => 1,
										'page_id'	     => absint( $cta_page ),
										'post_type'      => 'page',
										'post_status'  	 => 'publish',
									);

						$cta_query = new WP_Query( $cta_args );	

						if( $cta_query->have_posts()){

							while( $cta_query->have_posts()){

								$cta_query->the_post(); ?>

								<div class="call-to-action-content cta-left">
									<h3><?php the_title(); ?></h3>
									<?php the_content();

									if ( ! empty( $button_text ) ) : ?>
										<div class="call-to-action-buttons">
											<a href="<?php echo esc_url( $button_url ); ?>" class="button cta-button cta-button-primary"><?php echo esc_attr( $button_text ); ?></a>
										</div><!-- .call-to-action-buttons -->
									<?php endif; ?>
								</div>

								<?php 
								if ( has_post_thumbnail() ){ ?>
					                <div class="cta-right">
					                    <?php the_post_thumbnail(); ?>
					                 </div><!-- .cta-right -->
									<?php
								}

							}

							wp_reset_postdata();

						} ?>
						
					<?php } ?>

				</div>

			</div><!-- .cta-widget -->

			<?php
			echo $args['after_widget'];

		}

		/**
		 * Update widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            {@see WP_Widget::form()}.
		 * @param array $old_instance Old settings for this instance.
		 * @return array Settings to save or bool false to cancel saving.
		 */
		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['cta_page'] 	 	= absint( $new_instance['cta_page'] );

			$instance['button_text'] 	= sanitize_text_field( $new_instance['button_text'] );
			
			$instance['button_url']  	= esc_url_raw( $new_instance['button_url'] );

			return $instance;
		}

		/**
		 * Output the settings update form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance Current settings.
		 */
		function form( $instance ) {

			$instance = wp_parse_args( (array) $instance, array(
				'cta_page'    => '',
				'button_text' => esc_html__( 'Find More', 'medical-way' ),
				'button_url'  => '',
			) ); ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'cta_page' ); ?>">
					<strong><?php esc_html_e( 'CTA Page:', 'medical-way' ); ?></strong>
				</label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'cta_page' ),
					'class'            => 'widefat',
					'name'             => $this->get_field_name( 'cta_page' ),
					'selected'         => $instance[ 'cta_page' ],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'medical-way' ),
					)
				);
				?>
				<small>
		        	<?php esc_html_e('Title, Content and Featured Image of this page will be used here', 'medical-way'); ?>	
		        </small>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><strong><?php esc_html_e( 'Button Text:', 'medical-way' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['button_text'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><strong><?php esc_html_e( 'Button URL:', 'medical-way' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_url( $instance['button_url'] ); ?>" />
			</p>
		<?php
		} 
	
	}

endif;

if ( ! class_exists( 'Medical_Way_Services_Widget' ) ) :

	/**
	 * Service widget class.
	 *
	 * @since 1.0.0
	 */
	class Medical_Way_Services_Widget extends WP_Widget {

		function __construct() {
			$opts = array(
					'classname'   => 'medical_way_widget_services',
					'description' => esc_html__( 'Display services.', 'medical-way' ),
			);
			parent::__construct( 'medical-way-services', esc_html__( 'MW: Services', 'medical-way' ), $opts );
		}

		function widget( $args, $instance ) {

			$service_page 	= !empty( $instance['service_page'] ) ? $instance['service_page'] : '';

			$excerpt_length	= !empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 20;

			$detail_link 	= ! empty( $instance['detail_link'] ) ? $instance['detail_link'] : 0;

			$services_ids 	= array();

			$item_number 	= 6;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				if ( ! empty( $instance["item_id_$i"] ) && absint( $instance["item_id_$i"] ) > 0 ) {
					$id = absint( $instance["item_id_$i"] );
					$services_ids[ $id ]['id']   = $id;
				}
			}

			$appointment 	= !empty( $instance['appointment'] ) ? $instance['appointment'] : '';

			echo $args['before_widget']; ?>

			<div id="mw-services" class="services-list">

				<div class="container">
					<?php 
					if( !empty( $appointment ) ){ 
						$service_left = 'services-left';
					} else{
						$service_left = 'services-full';
					}
						
						?>
					<div class="<?php echo $service_left; ?>">
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
										<?php the_content(); ?>
									</div>

									<?php

								}

								wp_reset_postdata();

							} 
						}

						if ( ! empty( $services_ids ) ) {
							$query_args = array(
								'posts_per_page' => count( $services_ids ),
								'post__in'       => wp_list_pluck( $services_ids, 'id' ),
								'orderby'        => 'post__in',
								'post_type'      => 'page',
								'no_found_rows'  => true,
							);
							$all_services = get_posts( $query_args ); ?>

							<?php if ( ! empty( $all_services ) ) : ?>
								<?php global $post; ?>
								
									<div class="inner-wrapper">

										<?php foreach ( $all_services as $post ) : ?>
											<?php setup_postdata( $post ); ?>
											<div class="services-item">
												<?php 
												if( 1 == $detail_link ){ ?>
													<h3 class="services-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php

												} else{ ?>
													<h3 class="services-item-title"><?php the_title(); ?></h3><?php
												} 

												$content = medical_way_get_the_excerpt( absint( $excerpt_length ), $post );
												
												echo $content ? wpautop( wp_kses_post( $content ) ) : '';
												?>
											</div><!-- .services-item -->
										<?php endforeach; ?>

									</div><!-- .inner-wrapper -->

								<?php wp_reset_postdata(); ?>

							<?php endif;
						} ?>
					</div><!-- .services-left -->

					<?php 
					if( !empty( $appointment ) ){ ?>
						<div class="services-right">
							<?php echo do_shortcode( wp_kses_post( $appointment ) ); ?>
						</div><!-- .services-right -->
					<?php } ?>
				</div><!-- .container -->

			</div><!-- .services-list -->

			<?php

			echo $args['after_widget'];

		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['service_page'] 	= absint( $new_instance['service_page'] );

			$instance['excerpt_length'] = absint( $new_instance['excerpt_length'] );

			$instance['detail_link']    = (bool) $new_instance['detail_link'] ? 1 : 0;


			$item_number = 6;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				$instance["item_id_$i"] = absint( $new_instance["item_id_$i"] );
			}

			$instance['appointment'] 	= sanitize_text_field( $new_instance['appointment'] );

			return $instance;
		}

		function form( $instance ) {

			// Defaults.
			$defaults = array(
							'service_page' 		=> '',
							'excerpt_length'	=> 20,
							'detail_link'   	=> 0,
							'appointment' 		=> '',
						);

			$item_number = 6;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				$defaults["item_id_$i"]   = '';
			}

			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'service_page' ); ?>">
					<strong><?php esc_html_e( 'Service Page:', 'medical-way' ); ?></strong>
				</label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'service_page' ),
					'class'            => 'widefat',
					'name'             => $this->get_field_name( 'service_page' ),
					'selected'         => $instance[ 'service_page' ],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'medical-way' ),
					)
				);
				?>
				<small>
		        	<?php esc_html_e('Title and Content of this page will be used in left side of services section with form', 'medical-way'); ?>	
		        </small>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>">
					<?php esc_html_e('Excerpt Length:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('excerpt_length') ); ?>" name="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>" type="number" value="<?php echo absint( $instance['excerpt_length'] ); ?>" />
			</p>

			<p>
			    <input class="checkbox" type="checkbox" <?php checked( $instance['detail_link'] ); ?> id="<?php echo $this->get_field_id( 'detail_link' ); ?>" name="<?php echo $this->get_field_name( 'detail_link' ); ?>" />
			    <label for="<?php echo $this->get_field_id( 'detail_link' ); ?>"><?php esc_html_e( 'Enable link to detail page', 'medical-way' ); ?></label>
			</p>

			<hr>
					
			<?php
				for ( $i = 1; $i <= $item_number; $i++ ) {
					?>
					<p>
						<label for="<?php echo $this->get_field_id( "item_id_$i" ); ?>"><strong><?php esc_html_e( 'Page:', 'medical-way' ); ?>&nbsp;<?php echo $i; ?></strong></label>
						<?php
						wp_dropdown_pages( array(
							'id'               => $this->get_field_id( "item_id_$i" ),
							'class'            => 'widefat',
							'name'             => $this->get_field_name( "item_id_$i" ),
							'selected'         => $instance["item_id_$i"],
							'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'medical-way' ),
							)
						);
						?>
					</p>
					
					<?php
				} ?>

				<hr>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_name('appointment') ); ?>">
						<?php esc_html_e('Appointment Form:', 'medical-way'); ?>
					</label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('appointment') ); ?>" name="<?php echo esc_attr( $this->get_field_name('appointment') ); ?>" type="text" value="<?php echo esc_attr( $instance['appointment'] ); ?>" />	
					<small>
			        	<?php esc_html_e('Shortcode of Contact Form 7, Gravity From, Wufoo Form and other form is supproted.', 'medical-way'); ?>	
			        </small>	
				</p>

				<?php
		}
	}

endif;

if ( ! class_exists( 'Medical_Way_Departments_Widget' ) ) :

	/**
	 * Departments widget class.
	 *
	 * @since 1.0.0
	 */
	class Medical_Way_Departments_Widget extends WP_Widget {

		function __construct() {
			$opts = array(
					'classname'   => 'medical_way_widget_departments',
					'description' => esc_html__( 'Display Departments, Description and Image.', 'medical-way' ),
			);
			parent::__construct( 'medical-way-departments', esc_html__( 'MW: Departments', 'medical-way' ), $opts );
		}

		function widget( $args, $instance ) {

			$department_page = !empty( $instance['department_page'] ) ? $instance['department_page'] : '';

			$image_alignment = !empty( $instance['image_alignment'] ) ? $instance['image_alignment'] : '';

			$excerpt_length	= !empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 20;

			$detail_link 	= ! empty( $instance['detail_link'] ) ? $instance['detail_link'] : 0;

			$department_ids 	= array();

			$item_number 	= 6;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				if ( ! empty( $instance["item_id_$i"] ) && absint( $instance["item_id_$i"] ) > 0 ) {
					$id = absint( $instance["item_id_$i"] );
					$department_ids[ $id ]['id']   = $id;
				}
			}

			echo $args['before_widget']; ?>

			<div id="mw-departments" class="departments-list departments-column-3">

				<div class="container">
				<?php 
					$department_src = wp_get_attachment_image_src( get_post_thumbnail_id( absint( $department_page ) ), 'full' ); 

					if( 'left' == $image_alignment && !empty( $department_src ) ){

						$department_left_class 	= 'department-left department-image-wrap';
						$department_right_class = 'department-right department-info-wrap';

					}elseif( 'right' == $image_alignment && !empty( $department_src ) ){

						$department_left_class 	= 'department-right department-image-wrap';
						$department_right_class = 'department-left department-info-wrap';

					}else{

						$department_right_class = 'department-full department-info-wrap';
					}
				?>
					<div class="<?php echo $department_right_class; ?>">
					<?php

					if ( $department_page ) { 

						$department_args = array(
											'posts_per_page' => 1,
											'page_id'	     => absint( $department_page ),
											'post_type'      => 'page',
											'post_status'  	 => 'publish',
										);

						$department_query = new WP_Query( $department_args );	

						if( $department_query->have_posts()){

							while( $department_query->have_posts()){

								$department_query->the_post(); ?>

								<div class="department-info department-top">
									<h3 class="department-info-title"><?php the_title(); ?></h3>
									<?php the_content(); ?>
								</div>

								<?php

							}

							wp_reset_postdata();

						} 
					}

					if ( ! empty( $department_ids ) ) {
						$query_args = array(
							'posts_per_page' => count( $department_ids ),
							'post__in'       => wp_list_pluck( $department_ids, 'id' ),
							'orderby'        => 'post__in',
							'post_type'      => 'page',
							'no_found_rows'  => true,
						);
						$all_departments = get_posts( $query_args ); ?>

						<?php if ( ! empty( $all_departments ) ) : ?>
							<?php global $post; ?>
							
								<div class="inner-wrapper">

									<?php foreach ( $all_departments as $post ) : ?>
										<?php setup_postdata( $post ); ?>
										<div class="department-item">
											<h3 class="department-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<?php 
											$content = medical_way_get_the_excerpt( absint( $excerpt_length ), $post );
											
											echo $content ? wpautop( wp_kses_post( $content ) ) : '';
											?>
										</div><!-- .services-item -->
									<?php endforeach; ?>

								</div><!-- .inner-wrapper -->

							<?php wp_reset_postdata(); ?>

						<?php endif;
					} ?>
					</div>

					<?php

	                if ( !empty( $department_src[0] ) ) :  ?>
	                  <div class="<?php echo $department_left_class; ?>">
	                  	<img src="<?php echo esc_url( $department_src[0] ); ?>">
	                  </div><!-- .latest-news-thumb -->
	                <?php endif; ?>

				</div>

			</div><!-- .services-list -->

			<?php

			echo $args['after_widget'];

		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['department_page'] 	= absint( $new_instance['department_page'] );

			$instance['excerpt_length'] 	= absint( $new_instance['excerpt_length'] );

			$instance['detail_link']    	= (bool) $new_instance['detail_link'] ? 1 : 0;

			$instance['image_alignment'] 	= $new_instance['image_alignment'];


			$item_number = 6;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				$instance["item_id_$i"] = absint( $new_instance["item_id_$i"] );
			}

			return $instance;
		}

		function form( $instance ) {

			// Defaults.
			$defaults = array(
							'department_page' 	=> '',
							'excerpt_length'	=> 20,
							'detail_link'   	=> 0,
							'image_alignment'   => 'left',
						);

			$item_number = 6;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				$defaults["item_id_$i"]   = '';
			}

			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'department_page' ); ?>">
					<strong><?php esc_html_e( 'Department Page:', 'medical-way' ); ?></strong>
				</label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'department_page' ),
					'class'            => 'widefat',
					'name'             => $this->get_field_name( 'department_page' ),
					'selected'         => $instance[ 'department_page' ],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'medical-way' ),
					)
				);
				?>
				<small>
		        	<?php esc_html_e('Title, Content and Featured Image of this page will be used in this section', 'medical-way'); ?>	
		        </small>
			</p>

            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'image_alignment' ) ); ?>"><strong><?php _e( 'Select Image Position:', 'medical-way' ); ?></strong></label>
    			<?php
                $this->dropdown_image_alignment( array(
    				'id'       => $this->get_field_id( 'image_alignment' ),
    				'name'     => $this->get_field_name( 'image_alignment' ),
    				'selected' => esc_attr( $instance['image_alignment'] ),
    				)
                );
    			?>
            </p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>">
					<?php esc_html_e('Excerpt Length:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('excerpt_length') ); ?>" name="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>" type="number" value="<?php echo absint( $instance['excerpt_length'] ); ?>" />
			</p>

			<p>
			    <input class="checkbox" type="checkbox" <?php checked( $instance['detail_link'] ); ?> id="<?php echo $this->get_field_id( 'detail_link' ); ?>" name="<?php echo $this->get_field_name( 'detail_link' ); ?>" />
			    <label for="<?php echo $this->get_field_id( 'detail_link' ); ?>"><?php esc_html_e( 'Enable link to detail page', 'medical-way' ); ?></label>
			</p>

			<hr>
					
			<?php
			for ( $i = 1; $i <= $item_number; $i++ ) {
				?>
				<p>
					<label for="<?php echo $this->get_field_id( "item_id_$i" ); ?>"><strong><?php esc_html_e( 'Page:', 'medical-way' ); ?>&nbsp;<?php echo $i; ?></strong></label>
					<?php
					wp_dropdown_pages( array(
						'id'               => $this->get_field_id( "item_id_$i" ),
						'class'            => 'widefat',
						'name'             => $this->get_field_name( "item_id_$i" ),
						'selected'         => $instance["item_id_$i"],
						'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'medical-way' ),
						)
					);
					?>
				</p>
				
				<?php
			}  

		}

	    function dropdown_image_alignment( $args ) {
			$defaults = array(
		        'id'       => '',
		        'class'    => 'widefat',
		        'name'     => '',
		        'selected' => 'left',
			);

			$r = wp_parse_args( $args, $defaults );
			$output = '';

			$choices = array(
				'left' 		=> esc_html__( 'Left', 'medical-way' ),
				'right' 	=> esc_html__( 'Right', 'medical-way' ),
			);

			if ( ! empty( $choices ) ) {

				$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "' class='" . esc_attr( $r['class'] ) . "'>\n";
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
				$output .= "</select>\n";
			}

			echo $output;
	    }
	}

endif;

if ( ! class_exists( 'Medical_Way_Facts_Widget' ) ) :

	/**
	 * Facts widget class.
	 *
	 * @since 1.0.0
	 */
	class Medical_Way_Facts_Widget extends WP_Widget {

		function __construct() {
			$opts = array(
					'classname'   => 'medical_way_widget_facts',
					'description' => esc_html__( 'Display Fact counters.', 'medical-way' ),
			);
			parent::__construct( 'medical-way-facts', esc_html__( 'MW: Facts', 'medical-way' ), $opts );
		}

		function widget( $args, $instance ) {

			$title 				= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$count_one			= !empty( $instance['count_one'] ) ? $instance['count_one'] : '';

			$count_two			= !empty( $instance['count_two'] ) ? $instance['count_two'] : '';

			$count_three 		= !empty( $instance['count_three'] ) ? $instance['count_three'] : '';

			$count_four			= !empty( $instance['count_four'] ) ? $instance['count_four'] : '';

			$bg_pic  	 		= ! empty( $instance['bg_pic'] ) ? esc_url( $instance['bg_pic'] ) : '';

			// Add background image.
			if ( ! empty( $bg_pic ) ) {
				$background_style = '';
				$background_style .= ' style="background-image:url(' . esc_url( $bg_pic ) . ');" ';
				$args['before_widget'] = implode( $background_style . ' ' . 'class="bg_enabled ', explode( 'class="', $args['before_widget'], 2 ) );
			}
		
			echo $args['before_widget']; ?>

			<div id="mw-facts" class="some-facts">

				<div class="container">

					<?php 

					if ( $title ) {
						echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
					} ?>

					<?php 
					$fact_count = medical_way_is_count_active( $count_one, $count_two, $count_three, $count_four );

					$fact_class = '';

					if( 2 == $fact_count ){

						$fact_class = 'fact-half';

					} elseif( 3 == $fact_count ){

						$fact_class = 'fact-third';

					} elseif( 4 == $fact_count ){

						$fact_class = 'fact-fourth';

					}else{

						$fact_class = 'fact-full';

					} ?>


					<div class="counter-wrapper <?php echo esc_attr( $fact_class ); ?>">
						<?php 

						$facts = array( 'one', 'two', 'three', 'four'); 

						foreach ($facts as $fact) {

							$counter_item 	= 'counter-'.$fact;
							
							$fact_item 		= !empty( $instance['count_'.$fact] ) ? $instance['count_'.$fact] : '';

							$fact_icon 		= !empty( $instance['icon_'.$fact] ) ? $instance['icon_'.$fact] : '';

							$fact_text 		= !empty( $instance['text_'.$fact] ) ? $instance['text_'.$fact] : '';  

							if( !empty( $fact_item ) ){ ?>

								<div class="counter-item <?php echo esc_attr( $counter_item ); ?>">
									<?php 
									if( !empty( $fact_icon ) ){ ?>
										<span class="count-icon">
											<i class="fa <?php echo esc_html( $fact_icon ); ?>"></i>
										</span>
										<?php 
									} ?>

									<?php 
									if( !empty( $fact_item ) ){ ?>
										<span class="count"><?php echo absint( $fact_item ); ?></span>
										<?php 
									} ?>

									<?php 
									if( !empty( $fact_text ) ){ ?>
										<span class="count-text"><?php echo esc_html( $fact_text ); ?></span>
										<?php 
									} ?>
								</div><!-- .counter-item -->

								<?php 

							}
						} ?>
					</div><!-- .counter-wrapper -->

				</div>

			</div><!-- .some-facts -->

			<?php 

			echo $args['after_widget'];

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] 				= sanitize_text_field( $new_instance['title'] );

			$instance['icon_one'] 			= sanitize_text_field( $new_instance['icon_one'] );
			$instance['count_one'] 			= absint( $new_instance['count_one'] );
			$instance['text_one'] 			= sanitize_text_field( $new_instance['text_one'] );

			$instance['icon_two'] 			= sanitize_text_field( $new_instance['icon_two'] );
			$instance['count_two'] 			= absint( $new_instance['count_two'] );
			$instance['text_two'] 			= sanitize_text_field( $new_instance['text_two'] );

			$instance['icon_three'] 		= sanitize_text_field( $new_instance['icon_three'] );
			$instance['count_three'] 		= absint( $new_instance['count_three'] );
			$instance['text_three'] 		= sanitize_text_field( $new_instance['text_three'] );
			
			$instance['icon_four'] 			= sanitize_text_field( $new_instance['icon_four'] );
			$instance['count_four'] 		= absint( $new_instance['count_four'] );
			$instance['text_four'] 			= sanitize_text_field( $new_instance['text_four'] );

			$instance['bg_pic']  	 		= esc_url_raw( $new_instance['bg_pic'] );


			return $instance;
		}

		function form( $instance ) {

			// Defaults.
			$defaults = array(
				'title' 			=> '',
				'icon_one'      	=> 'fa-folder-open-o',
				'count_one'			=> '',
				'text_one' 			=> '',
				'icon_two'      	=> 'fa-clock-o',
				'count_two'			=> '',
				'text_two' 			=> '',
				'icon_three'    	=> 'fa-users',
				'count_three'		=> '',
				'text_three' 		=> '',
				'icon_four'     	=> 'fa-trophy',
				'count_four'		=> '',
				'text_four' 		=> '',
				'bg_pic'      		=> '',
			);

			$instance = wp_parse_args( (array) $instance, $defaults );


			$icon_one			= !empty( $instance['icon_one'] ) ? $instance['icon_one'] : '';
			$count_one			= !empty( $instance['count_one'] ) ? $instance['count_one'] : '';
			$text_one			= !empty( $instance['text_one'] ) ? $instance['text_one'] : '';

			$icon_two			= !empty( $instance['icon_two'] ) ? $instance['icon_two'] : '';
			$count_two			= !empty( $instance['count_two'] ) ? $instance['count_two'] : '';
			$text_two			= !empty( $instance['text_two'] ) ? $instance['text_two'] : ''; 

			$icon_three 		= !empty( $instance['icon_three'] ) ? $instance['icon_three'] : '';
			$count_three 		= !empty( $instance['count_three'] ) ? $instance['count_three'] : '';
			$text_three 		= !empty( $instance['text_three'] ) ? $instance['text_three'] : ''; 

			$icon_four			= !empty( $instance['icon_four'] ) ? $instance['icon_four'] : '';
			$count_four			= !empty( $instance['count_four'] ) ? $instance['count_four'] : '';
			$text_four			= !empty( $instance['text_four'] ) ? $instance['text_four'] : '';

			$bg_pic = '';

            if ( ! empty( $instance['bg_pic'] ) ) {

                $bg_pic = $instance['bg_pic'];

            }

            $wrap_style = '';

            if ( empty( $bg_pic ) ) {

                $wrap_style = ' style="display:none;" ';
            }

            $image_status = false;

            if ( ! empty( $bg_pic ) ) {
                $image_status = true;
            }

            $delete_button = 'display:none;';

            if ( true === $image_status ) {
                $delete_button = 'display:inline-block;';
            }
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'medical-way' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<hr>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( "icon_one" ) ); ?>"><strong><?php esc_html_e( 'Icon One:', 'medical-way' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon_one" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon_one" ) ); ?>" type="text" value="<?php echo esc_attr( $icon_one ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('count_one') ); ?>">
					<?php esc_html_e('Count One:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('count_one') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count_one') ); ?>" type="number" value="<?php echo absint( $count_one ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('text_one') ); ?>">
					<?php esc_html_e('Text One:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_one') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_one') ); ?>" type="text" value="<?php echo esc_attr( $text_one ); ?>" />		
			</p>

			<hr>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( "icon_two" ) ); ?>"><strong><?php esc_html_e( 'Icon Two:', 'medical-way' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon_two" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon_two" ) ); ?>" type="text" value="<?php echo esc_attr( $icon_two ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('count_two') ); ?>">
					<?php esc_html_e('Count Two:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('count_two') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count_two') ); ?>" type="number" value="<?php echo absint( $count_two ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('text_two') ); ?>">
					<?php esc_html_e('Text Two:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_two') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_two') ); ?>" type="text" value="<?php echo esc_attr( $text_two ); ?>" />		
			</p>

			<hr>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( "icon_three" ) ); ?>"><strong><?php esc_html_e( 'Icon Three:', 'medical-way' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon_three" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon_three" ) ); ?>" type="text" value="<?php echo esc_attr( $icon_three ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('count_three') ); ?>">
					<?php esc_html_e('Count Three:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('count_three') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count_three') ); ?>" type="number" value="<?php echo absint( $count_three ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('text_three') ); ?>">
					<?php esc_html_e('Text Three:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_three') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_three') ); ?>" type="text" value="<?php echo esc_attr( $text_three ); ?>" />		
			</p>

			<hr>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( "icon_four" ) ); ?>"><strong><?php esc_html_e( 'Icon Four:', 'medical-way' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon_four" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon_four" ) ); ?>" type="text" value="<?php echo esc_attr( $icon_four ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('count_four') ); ?>">
					<?php esc_html_e('Count Four:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('count_four') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count_four') ); ?>" type="number" value="<?php echo absint( $count_four ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('text_four') ); ?>">
					<?php esc_html_e('Text Four:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('text_four') ); ?>" name="<?php echo esc_attr( $this->get_field_name('text_four') ); ?>" type="text" value="<?php echo esc_attr( $text_four ); ?>" />		
			</p>

			<div class="cover-image">
                <label for="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>">
                    <strong><?php esc_html_e( 'Background Image:', 'medical-way' ); ?></strong>
                </label>
                <input type="text" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'bg_pic' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>" value="<?php echo esc_url( $instance['bg_pic'] ); ?>" />
                <div class="rtam-preview-wrap" <?php echo $wrap_style; ?>>
                    <img src="<?php echo esc_url( $bg_pic ); ?>" alt="<?php esc_attr_e( 'Preview', 'medical-way' ); ?>" />
                </div><!-- .rtam-preview-wrap -->
                <input type="button" class="select-img button button-primary" value="<?php esc_html_e( 'Upload', 'medical-way' ); ?>" data-uploader_title="<?php esc_html_e( 'Select Background Image', 'medical-way' ); ?>" data-uploader_button_text="<?php esc_html_e( 'Choose Image', 'medical-way' ); ?>" />
                <input type="button" value="<?php echo esc_attr_x( 'X', 'Remove Button', 'medical-way' ); ?>" class="button button-secondary btn-image-remove" style="<?php echo esc_attr( $delete_button ); ?>" />
            </div>
					
		<?php
				
		}
	}

endif;

if ( ! class_exists( 'Medical_Way_Contact_Widget' ) ) :

	/**
	 * Contact widget class.
	 *
	 * @since 1.0.0
	 */
	class Medical_Way_Contact_Widget extends WP_Widget {

		function __construct() {
			$opts = array(
					'classname'   => 'medical_way_widget_contact',
					'description' => esc_html__( 'Display Contact Us section.', 'medical-way' ),
			);
			parent::__construct( 'medical-way-contact', esc_html__( 'MW: Contact', 'medical-way' ), $opts );
		}

		function widget( $args, $instance ) {

			$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$contact_shortcode = !empty( $instance['contact_shortcode'] ) ? $instance['contact_shortcode'] : ''; 

			$contact_page 	= !empty( $instance['contact_page'] ) ? $instance['contact_page'] : ''; 

			$bg_pic  	 	= ! empty( $instance['bg_pic'] ) ? esc_url( $instance['bg_pic'] ) : '';

			// Add background image.
			if ( ! empty( $bg_pic ) ) {
				$background_style = '';
				$background_style .= ' style="background-image:url(' . esc_url( $bg_pic ) . ');" ';
				$args['before_widget'] = implode( $background_style . ' ' . 'class="bg_enabled ', explode( 'class="', $args['before_widget'], 2 ) );
			}
		
			echo $args['before_widget']; ?>

			<div id="mw-contact" class="sec-contact">

				<div class="container">

					<?php 

					if ( $title ) {
						echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
					} ?>
					
					<div class="contact-wrapper">

						<?php if ( $contact_page ) { 

							$contact_args = array(
											'posts_per_page' => 1,
											'page_id'	     => absint( $contact_page ),
											'post_type'      => 'page',
											'post_status'  	 => 'publish',
										);

							$contact_query = new WP_Query( $contact_args );	

							if( $contact_query->have_posts()){

								while( $contact_query->have_posts()){

									$contact_query->the_post(); ?>

									<div class="info-part contact-left">
										<?php the_content(); ?>
									</div>

									<?php

								}

								wp_reset_postdata();

							} ?>
							
						<?php } ?>

						<?php if ( $contact_shortcode ) { ?>

							<div class="form-part contact-right">

								<?php echo do_shortcode( wp_kses_post( $contact_shortcode ) ); ?>

							</div>

						<?php } ?>

					</div><!-- .contact-wrapper -->

				</div>

			</div><!-- .contact -->

			<?php 

			echo $args['after_widget'];

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] 			= sanitize_text_field( $new_instance['title'] );

			$instance['contact_shortcode'] = sanitize_text_field( $new_instance['contact_shortcode'] );
			$instance['contact_page'] 	= absint( $new_instance['contact_page'] );

			$instance['bg_pic']  	 	= esc_url_raw( $new_instance['bg_pic'] );


			return $instance;
		}

		function form( $instance ) {

			// Defaults.
			$defaults = array(
				'title' 			=> '',
				'contact_shortcode' => '',
				'contact_page' 		=> '',
				'bg_pic'      		=> '',
			);

			$instance = wp_parse_args( (array) $instance, $defaults );


			$contact_shortcode = !empty( $instance['contact_shortcode'] ) ? $instance['contact_shortcode'] : '';

			$bg_pic = '';

			if ( ! empty( $instance['bg_pic'] ) ) {

			    $bg_pic = $instance['bg_pic'];

			}

			$wrap_style = '';

			if ( empty( $bg_pic ) ) {

			    $wrap_style = ' style="display:none;" ';
			}

			$image_status = false;

			if ( ! empty( $bg_pic ) ) {
			    $image_status = true;
			}

			$delete_button = 'display:none;';

			if ( true === $image_status ) {
			    $delete_button = 'display:inline-block;';
			}

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'medical-way' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<hr>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('contact_shortcode') ); ?>">
					<?php esc_html_e('Form Shortcode:', 'medical-way'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('contact_shortcode') ); ?>" name="<?php echo esc_attr( $this->get_field_name('contact_shortcode') ); ?>" type="text" value="<?php echo esc_attr( $contact_shortcode ); ?>" />	
				<small>
		        	<?php esc_html_e('Shortcode of Contact Form 7, Gravity From, Wufoo Form and other form is supproted.', 'medical-way'); ?>	
		        </small>	
			</p>

			<hr></hr>

			<p>
				<label for="<?php echo $this->get_field_id( 'contact_page' ); ?>">
					<strong><?php esc_html_e( 'Contact Page:', 'medical-way' ); ?></strong>
				</label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'contact_page' ),
					'class'            => 'widefat',
					'name'             => $this->get_field_name( 'contact_page' ),
					'selected'         => $instance[ 'contact_page' ],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'medical-way' ),
					)
				);
				?>
				<small>
		        	<?php esc_html_e('Content of this page will be used in right side of form', 'medical-way'); ?>	
		        </small>
			</p>

			<hr>

			<div class="cover-image">
                <label for="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>">
                    <strong><?php esc_html_e( 'Background Image:', 'medical-way' ); ?></strong>
                </label>
                <input type="text" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'bg_pic' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>" value="<?php echo esc_url( $instance['bg_pic'] ); ?>" />
                <div class="rtam-preview-wrap" <?php echo $wrap_style; ?>>
                    <img src="<?php echo esc_url( $bg_pic ); ?>" alt="<?php esc_attr_e( 'Preview', 'medical-way' ); ?>" />
                </div><!-- .rtam-preview-wrap -->
                <input type="button" class="select-img button button-primary" value="<?php esc_html_e( 'Upload', 'medical-way' ); ?>" data-uploader_title="<?php esc_html_e( 'Select Background Image', 'medical-way' ); ?>" data-uploader_button_text="<?php esc_html_e( 'Choose Image', 'medical-way' ); ?>" />
                <input type="button" value="<?php echo esc_attr_x( 'X', 'Remove Button', 'medical-way' ); ?>" class="button button-secondary btn-image-remove" style="<?php echo esc_attr( $delete_button ); ?>" />
            </div>
					
		<?php
				
		}
	}

endif;

if ( ! class_exists( 'Medical_Way_Team_Widget' ) ) :

	/**
	 * Team widget class.
	 *
	 * @since 1.0.0
	 */
	class Medical_Way_Team_Widget extends WP_Widget {

		function __construct() {
			$opts = array(
					'classname'   => 'medical_way_widget_team',
					'description' => esc_html__( 'Display team section.', 'medical-way' ),
			);
			parent::__construct( 'medical-way-team', esc_html__( 'MW: Team', 'medical-way' ), $opts );
		}

		function widget( $args, $instance ) {

			$team_page 		= !empty( $instance['team_page'] ) ? $instance['team_page'] : '';

			$post_number    = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 3; 
		
			echo $args['before_widget']; ?>

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
									<?php the_content(); ?>
								</div><?php
							}

							wp_reset_postdata();
						} 

						$all_team = array(
								    'post_type'      => 'page',
								    'posts_per_page' => absint( $post_number ),
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
							                    <a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'medical-way-large' ); ?>
							                    </a>
							                  </div><!-- .member-image -->
							                <?php endif; ?>
							                <div class="memeber-details">
												<h3><?php the_title(); ?></h3>
												<?php 
												$position =  get_post(get_post_thumbnail_id())->post_content;
												if( !empty( $position ) ){ ?>
												    <strong><?php echo esc_html( $position ); ?></strong>
												<?php } ?>
												<?php the_content(); ?>
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

			<?php 

			echo $args['after_widget'];

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['team_page'] 		= absint( $new_instance['team_page'] );

			$instance['post_number']    = absint( $new_instance['post_number'] );

			return $instance;
		}

		function form( $instance ) {

			// Defaults.
			$defaults = array(
				'team_page' 		=> '',
				'post_number'    	=> 3,
			);

			$instance = wp_parse_args( (array) $instance, $defaults );

			?>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'team_page' ); ?>">
					<strong><?php esc_html_e( 'Team Page:', 'medical-way' ); ?></strong>
				</label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'team_page' ),
					'class'            => 'widefat',
					'name'             => $this->get_field_name( 'team_page' ),
					'selected'         => $instance[ 'team_page' ],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'medical-way' ),
					)
				);
				?>
				<small>
		        	<?php esc_html_e('Sub Pages of this page will be listed as each team member', 'medical-way'); ?>	
		        </small>
			</p>

			<p>
			  <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>"><strong><?php esc_html_e( 'Number of Posts:', 'medical-way' ); ?></strong></label>
			  <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo  esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['post_number'] ); ?>" min="1" />
			</p>
					
		<?php
				
		}
	}

endif;

if ( ! class_exists( 'Medical_Way_Testimonial_Widget' ) ) :

	/**
	 * Testimonial widget class.
	 *
	 * @since 1.0.0
	 */
	class Medical_Way_Testimonial_Widget extends WP_Widget {

		function __construct() {
			$opts = array(
					'classname'   => 'medical_way_widget_testimonial',
					'description' => esc_html__( 'Display testimonial section.', 'medical-way' ),
			);
			parent::__construct( 'medical-way-testimonial', esc_html__( 'MW: Testimonial', 'medical-way' ), $opts );
		}

		function widget( $args, $instance ) {

			$title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$testimonial_page 	= !empty( $instance['testimonial_page'] ) ? $instance['testimonial_page'] : '';

			$transition_effects = !empty( $instance['transition_effects'] )? $instance['transition_effects'] : '';

			$transition_delay   = !empty( $instance['transition_delay'] )? $instance['transition_delay'] : 3;

			$transition_duration = !empty( $instance['transition_duration'] )? $instance['transition_duration'] : 3;

			$show_arrow         = ! empty( $instance['show_arrow'] ) ? $instance['show_arrow'] : 0;

			$show_pager         = ! empty( $instance['show_pager'] ) ? $instance['show_pager'] : 0;

			$enable_autoplay    = ! empty( $instance['enable_autoplay'] ) ? $instance['enable_autoplay'] : 0;

			$bg_pic  	 		= ! empty( $instance['bg_pic'] ) ? esc_url( $instance['bg_pic'] ) : '';

			// Add background image.
			if ( ! empty( $bg_pic ) ) {

				$background_style = '';

				$background_style .= ' style="background-image:url(' . esc_url( $bg_pic ) . ');" ';

				$args['before_widget'] = implode( $background_style . ' ' . 'class="bg_enabled ', explode( 'class="', $args['before_widget'], 2 ) );
			}
		
			echo $args['before_widget']; ?>

			<div id="mw-testimonial" class="sec-testimonial">

				<div class="container">
					
					<div class="inner-wrapper">

						<?php
						if ( $testimonial_page ) { 

							$testimonial_args = array(
													'posts_per_page' => 1,
													'page_id'	     => absint( $testimonial_page ),
													'post_type'      => 'page',
													'post_status'  	 => 'publish',
												);

							$testimonial_query = new WP_Query( $testimonial_args );	

							if( $testimonial_query->have_posts()){

								while( $testimonial_query->have_posts()){

									$testimonial_query->the_post(); ?>

									<div class="testimonial-info testimonial-top">
										<h3 class="testimonial-info-title"><?php the_title(); ?></h3>
										<?php the_content(); ?>
									</div><?php
								}

								wp_reset_postdata();
							} 

						$all_testi = array(
								    'post_type'      => 'page',
								    'posts_per_page' => 10,
								    'post_parent'    => absint( $testimonial_page ),
								    'order'          => 'ASC',
								    'orderby'        => 'menu_order'
								 );

						$testimonials_query = new WP_Query( $all_testi ); ?>

						<div id="testimonials-slider">  

							<?php 

							// Cycle data.
							$slide_data = array(
								'fx'             => esc_attr( $transition_effects ),
								'speed'          => esc_attr( $transition_duration ) * 1000,
								'pause-on-hover' => 'true',
								'loader'         => 'true',
								'log'            => 'false',
								'swipe'          => 'true',
								'auto-height'    => 'container',
							);

							if ( 1 === $show_pager ) {
								$slide_data['pager-template'] = '<span class="pager-box"></span>';
							}
							if ( 1 === $enable_autoplay ) {
								$slide_data['timeout'] = absint( $transition_delay ) * 1000;
							} else {
								$slide_data['timeout'] = 0;
							}

							$slide_data['slides'] = 'article';

							$slide_attributes_text = '';
							foreach ( $slide_data as $key => $item ) {

								$slide_attributes_text .= ' ';
								$slide_attributes_text .= ' data-cycle-'.esc_attr( $key );
								$slide_attributes_text .= '="'.esc_attr( $item ).'"';

							} ?>     

							<div class="cycle-slideshow" id="testimonial-slider" <?php echo $slide_attributes_text; ?>>
							   
							   <?php 
							    if ( 1 === $show_arrow ) : ?>
							            <div class="cycle-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
							            <div class="cycle-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
							    <?php endif; ?>

							    <?php while ( $testimonials_query->have_posts() ) : 

							            $testimonials_query->the_post(); ?>

							            <article data-cycle-title="<?php the_title(); ?>" data-cycle-url="<?php the_permalink(); ?>" data-cycle-excerpt="<?php echo get_the_content(); ?>">
							                <div class="testimonials-wrap">
							                    <?php
							                  
							                    if( has_post_thumbnail() ){ ?>
							                        <figure>
							                          <?php the_post_thumbnail( 'thumbnail' ); ?>  
							                        </figure>
							                    <?php } ?>

						                        <div class="testimonials-caption">
						                            <?php the_content(); ?>
						                        </div> 
							                        
							                    <div class="testimonials-meta">
							                        <span class="testimonial-title"><?php the_title(); ?></span>
							                        <?php 
													$position =  get_post(get_post_thumbnail_id())->post_content;

													if( !empty( $position ) ){ ?>
													    <strong><?php echo esc_html( $position ); ?></strong>
														<?php 
													} ?>
							                    </div>
							                </div>
							            </article>

							    <?php endwhile; 

							    wp_reset_postdata();

							    if ( 1 === $show_pager ) : ?>
							        <div class="cycle-pager"></div>
							    <?php endif; ?>

							</div>

						</div> <!-- testimonials-slider -->

						<?php } ?>

					</div><!-- .inner-wrapper -->

				</div>

			</div><!-- .sec-testimonial -->

			<?php 

			echo $args['after_widget'];

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']          	= sanitize_text_field( $new_instance['title'] );
			$instance['testimonial_page'] 	= absint( $new_instance['testimonial_page'] );
			$instance['transition_effects'] = esc_attr( $new_instance['transition_effects'] );
			$instance['transition_delay']   = absint( $new_instance['transition_delay'] );
			$instance['transition_duration']= absint( $new_instance['transition_duration'] );
			$instance['show_arrow']         = (bool) $new_instance['show_arrow'] ? 1 : 0;
			$instance['show_pager']         = (bool) $new_instance['show_pager'] ? 1 : 0;
			$instance['enable_autoplay']    = (bool) $new_instance['enable_autoplay'] ? 1 : 0;
			$instance['bg_pic']  	 		= esc_url_raw( $new_instance['bg_pic'] );

			return $instance;
		}

		function form( $instance ) {

			// Defaults.
			$defaults = array(
				'title'             	=> '',
				'testimonial_page'  	=> '',
				'transition_effects'    => 'scrollHorz',
				'transition_delay'      => 3,
				'transition_duration'   => 3,
				'show_arrow'            => 1,
				'show_pager'            => 1,
				'enable_autoplay'       => 1,
				'bg_pic'      			=> '',
			);

			$show_arrow        = isset( $instance['show_arrow'] ) ? (bool) $instance['show_arrow'] : 1;
			$show_pager        = isset( $instance['show_pager'] ) ? (bool) $instance['show_pager'] : 1;
			$enable_autoplay   = isset( $instance['enable_autoplay'] ) ? (bool) $instance['enable_autoplay'] : 1;

			$bg_pic = '';

            if ( ! empty( $instance['bg_pic'] ) ) {

                $bg_pic = $instance['bg_pic'];

            }

            $wrap_style = '';

            if ( empty( $bg_pic ) ) {

                $wrap_style = ' style="display:none;" ';
            }

            $image_status = false;

            if ( ! empty( $bg_pic ) ) {
                $image_status = true;
            }

            $delete_button = 'display:none;';

            if ( true === $image_status ) {
                $delete_button = 'display:inline-block;';
            }

			$instance = wp_parse_args( (array) $instance, $defaults );

			?>
	        <p>
	          <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'medical-way' ); ?></strong></label>
	          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	        </p>
			<p>
				<label for="<?php echo $this->get_field_id( 'testimonial_page' ); ?>">
					<strong><?php esc_html_e( 'Testimonial Page:', 'medical-way' ); ?></strong>
				</label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'testimonial_page' ),
					'class'            => 'widefat',
					'name'             => $this->get_field_name( 'testimonial_page' ),
					'selected'         => $instance[ 'testimonial_page' ],
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'medical-way' ),
					)
				);
				?>
				<small>
		        	<?php esc_html_e('Sub Pages of this page will be listed as testimonials', 'medical-way'); ?>	
		        </small>
			</p>

			<p>
			  <label for="<?php echo esc_attr( $this->get_field_id( 'transition_effects' ) ); ?>"><strong><?php _e( 'Transition Effect:', 'medical-way' ); ?></strong></label>
			    <?php
			    $this->dropdown_transition_effect( array(
			        'id'       => $this->get_field_id( 'transition_effects' ),
			        'name'     => $this->get_field_name( 'transition_effects' ),
			        'selected' => esc_attr( $instance['transition_effects'] ),
			        )
			    );
			    ?>
			</p>

			<p>
			    <label for="<?php echo esc_attr( $this->get_field_id( 'transition_delay' ) ); ?>"><strong><?php _e( 'Transition Delay:', 'medical-way' ); ?></strong></label>
			    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'transition_delay' ) ); ?>" name="<?php echo  esc_attr( $this->get_field_name( 'transition_delay' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['transition_delay'] ); ?>" min="1" />
			    <small><?php _e( 'in seconds', 'medical-way' ); ?></small>
			</p>

			<p>
			    <label for="<?php echo esc_attr( $this->get_field_id( 'transition_duration' ) ); ?>"><strong><?php _e( 'Transition Duration:', 'medical-way' ); ?></strong></label>
			    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'transition_duration' ) ); ?>" name="<?php echo  esc_attr( $this->get_field_name( 'transition_duration' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['transition_duration'] ); ?>" min="1" />
			    <small><?php _e( 'in seconds', 'medical-way' ); ?></small>
			</p>
			
			<p>
			    <input class="checkbox" type="checkbox" <?php checked( $show_arrow ); ?> id="<?php echo $this->get_field_id( 'show_arrow' ); ?>" name="<?php echo $this->get_field_name( 'show_arrow' ); ?>" />
			    <label for="<?php echo $this->get_field_id( 'show_arrow' ); ?>"><?php _e( 'Show Arrow', 'medical-way' ); ?></label>
			</p>

			<p>
			    <input class="checkbox" type="checkbox" <?php checked( $show_pager ); ?> id="<?php echo $this->get_field_id( 'show_pager' ); ?>" name="<?php echo $this->get_field_name( 'show_pager' ); ?>" />
			    <label for="<?php echo $this->get_field_id( 'show_pager' ); ?>"><?php _e( 'Show Pager', 'medical-way' ); ?></label>
			</p>

			<p>
			    <input class="checkbox" type="checkbox" <?php checked( $enable_autoplay ); ?> id="<?php echo $this->get_field_id( 'enable_autoplay' ); ?>" name="<?php echo $this->get_field_name( 'enable_autoplay' ); ?>" />
			    <label for="<?php echo $this->get_field_id( 'enable_autoplay' ); ?>"><?php _e( 'Enable Autoplay', 'medical-way' ); ?></label>
			</p>

			<div class="cover-image">
                <label for="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>">
                    <strong><?php esc_html_e( 'Background Image:', 'medical-way' ); ?></strong>
                </label>
                <input type="text" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'bg_pic' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>" value="<?php echo esc_url( $instance['bg_pic'] ); ?>" />
                <div class="rtam-preview-wrap" <?php echo $wrap_style; ?>>
                    <img src="<?php echo esc_url( $bg_pic ); ?>" alt="<?php esc_attr_e( 'Preview', 'medical-way' ); ?>" />
                </div><!-- .rtam-preview-wrap -->
                <input type="button" class="select-img button button-primary" value="<?php esc_html_e( 'Upload', 'medical-way' ); ?>" data-uploader_title="<?php esc_html_e( 'Select Background Image', 'medical-way' ); ?>" data-uploader_button_text="<?php esc_html_e( 'Choose Image', 'medical-way' ); ?>" />
                <input type="button" value="<?php echo esc_attr_x( 'X', 'Remove Button', 'medical-way' ); ?>" class="button button-secondary btn-image-remove" style="<?php echo esc_attr( $delete_button ); ?>" />
            </div>
					
		<?php
				
		}

		function dropdown_transition_effect( $args ) {
		    $defaults = array(
		        'id'       => '',
		        'class'    => 'widefat',
		        'name'     => '',
		        'selected' => 0,
		    );

		    $r = wp_parse_args( $args, $defaults );
		    $output = '';

		    $choices = array(
		        'fade'       => esc_html__( 'fade', 'medical-way' ),
		        'fadeout'    => esc_html__( 'fadeout', 'medical-way' ),
		        'none'       => esc_html__( 'none', 'medical-way' ),
		        'scrollHorz' => esc_html__( 'scrollHorz', 'medical-way' ),
		    );

		    if ( ! empty( $choices ) ) {

		        $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "' class='" . esc_attr( $r['class'] ) . "'>\n";
		        foreach ( $choices as $key => $choice ) {
		            $output .= '<option value="' . esc_attr( $key ) . '" ';
		            $output .= selected( $r['selected'], $key, false );
		            $output .= '>' . esc_html( $choice ) . '</option>\n';
		        }
		        $output .= "</select>\n";
		    }

		    echo $output;
		}
	}

endif;

if ( ! function_exists( 'medical_way_is_count_active' ) ) :

	/**
	 * Check if fact counter count is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function medical_way_is_count_active( $count_one, $count_two, $count_three, $count_four ) {

		$total_count = 0; 

		if ( 0 < $count_one ) {

			$total_count += 1; 

		} 

		if( 0 < $count_two ) {

			$total_count += 1; 

		}

		if( 0 < $count_three ) {

			$total_count += 1; 

		}

		if( 0 < $count_four ) {

			$total_count += 1; 

		}

		return $total_count;

	}

endif;