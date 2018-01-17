<?php
/**
 * Options.
 *
 * @package Medical_Way
 */

$default = medical_way_get_default_theme_options();

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'medical-way' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
	)
);

// Header Section.
$wp_customize->add_section( 'section_header',
	array(
		'title'      => esc_html__( 'Header Options', 'medical-way' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting show_title.
$wp_customize->add_setting( 'show_title',
	array(
		'default'           => $default['show_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_title',
	array(
		'label'    => esc_html__( 'Show Site Title', 'medical-way' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting show_tagline.
$wp_customize->add_setting( 'show_tagline',
	array(
		'default'           => $default['show_tagline'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_tagline',
	array(
		'label'    => esc_html__( 'Show Tagline', 'medical-way' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting Address.
$wp_customize->add_setting( 'top_address',
	array(
		'default'           => $default['top_address'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'top_address',
	array(
		'label'    => esc_html__( 'Top Address', 'medical-way' ),
		'section'  => 'section_header',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting Phone.
$wp_customize->add_setting( 'top_phone',
	array(
		'default'           => $default['top_phone'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'top_phone',
	array(
		'label'    => esc_html__( 'Top Phone', 'medical-way' ),
		'section'  => 'section_header',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting fax.
$wp_customize->add_setting( 'top_fax',
	array(
		'default'           => $default['top_fax'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'top_fax',
	array(
		'label'    => esc_html__( 'Top Fax', 'medical-way' ),
		'section'  => 'section_header',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting show_social_icons.
$wp_customize->add_setting( 'show_social_icons',
	array(
		'default'           => $default['show_social_icons'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_social_icons',
	array(
		'label'    => esc_html__( 'Show social icons at right', 'medical-way' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);


// Layout Section.
$wp_customize->add_section( 'section_layout',
	array(
		'title'      => esc_html__( 'Blog Layout Options', 'medical-way' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting( 'global_layout',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'medical_way_sanitize_select',
	)
);
$wp_customize->add_control( 'global_layout',
	array(
		'label'    => esc_html__( 'Global Layout', 'medical-way' ),
		'section'  => 'section_layout',
		'type'     => 'radio',
		'priority' => 100,
		'choices'  => array(
				'left-sidebar'  => esc_html__( 'Left Sidebar', 'medical-way' ),
				'right-sidebar' => esc_html__( 'Right Sidebar', 'medical-way' ),
				'no-sidebar'    => esc_html__( 'No Sidebar', 'medical-way' ),
			),
	)
);

// Setting excerpt_length.
$wp_customize->add_setting( 'excerpt_length',
	array(
		'default'           => $default['excerpt_length'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'medical_way_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'excerpt_length',
	array(
		'label'       => esc_html__( 'Excerpt Length', 'medical-way' ),
		'description' => esc_html__( 'number of words', 'medical-way' ),
		'section'     => 'section_layout',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 55px;' ),
	)
);

// Setting posted_date.
$wp_customize->add_setting( 'posted_date',
	array(
		'default'           => $default['posted_date'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'posted_date',
	array(
		'label'           => esc_html__( 'Hide Posted Date', 'medical-way' ),
		'section'         => 'section_layout',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting post_author.
$wp_customize->add_setting( 'post_author',
	array(
		'default'           => $default['post_author'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'post_author',
	array(
		'label'           => esc_html__( 'Hide Author', 'medical-way' ),
		'section'         => 'section_layout',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting post_category.
$wp_customize->add_setting( 'post_category',
	array(
		'default'           => $default['post_category'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'post_category',
	array(
		'label'           => esc_html__( 'Hide Category', 'medical-way' ),
		'section'         => 'section_layout',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting post_tag.
$wp_customize->add_setting( 'post_tag',
	array(
		'default'           => $default['post_tag'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'post_tag',
	array(
		'label'           => esc_html__( 'Hide Tags', 'medical-way' ),
		'section'         => 'section_layout',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting post_comment.
$wp_customize->add_setting( 'post_comment',
	array(
		'default'           => $default['post_comment'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'post_comment',
	array(
		'label'           => esc_html__( 'Hide Comment', 'medical-way' ),
		'section'         => 'section_layout',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Footer Section.
$wp_customize->add_section( 'section_footer',
	array(
		'title'      => esc_html__( 'Footer Options', 'medical-way' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'copyright_text',
	array(
		'default'           => $default['copyright_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'copyright_text',
	array(
		'label'    => esc_html__( 'Copyright Text', 'medical-way' ),
		'section'  => 'section_footer',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Breadcrumb Section.
$wp_customize->add_section( 'section_breadcrumb',
	array(
		'title'      => esc_html__( 'Breadcrumb Options', 'medical-way' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting( 'breadcrumb_type',
	array(
		'default'           => $default['breadcrumb_type'],
		'sanitize_callback' => 'medical_way_sanitize_select',
	)
);
$wp_customize->add_control( 'breadcrumb_type',
	array(
		'label'       => esc_html__( 'Breadcrumb Type', 'medical-way' ),
		'section'     => 'section_breadcrumb',
		'type'        => 'radio',
		'priority'    => 100,
		'choices'     => array(
			'disable' 	=> esc_html__( 'Disable', 'medical-way' ),
			'simple'  	=> esc_html__( 'Simple', 'medical-way' ),
			'image-bg'  => esc_html__( 'Custom Background', 'medical-way' ),
		),
	)
);

// Setting breadcrumb_overlay_status.
$wp_customize->add_setting( 'breadcrumb_overlay_status',
	array(
		'default'           => $default['breadcrumb_overlay_status'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'breadcrumb_overlay_status',
	array(
		'label'           => __( 'Enable Overlay', 'medical-way' ),
		'section'         => 'section_breadcrumb',
		'type'            => 'checkbox',
		'priority'        => 100,
		'active_callback' => 'medical_way_is_custom_background_breadcrumb',
	)
);

// Services Section.
$wp_customize->add_section( 'section_services',
	array(
		'title'      => esc_html__( 'Services Page Options', 'medical-way' ),
		'priority'   => 100,
		'panel'      => 'theme_option_panel',
	)
);

// Setting services page.
$wp_customize->add_setting( "services_page",
	array(
		'sanitize_callback' => 'medical_way_sanitize_dropdown_pages',
	)
);

$wp_customize->add_control( "services_page",
	array(
		'label'           => esc_html__( 'Services Page', 'medical-way' ),
		'description' 	  => __( 'Sub Pages of this page will be listed as services', 'medical-way' ),
		'section'         => 'section_services',
		'type'            => 'dropdown-pages',
		'priority'        => 100,
	)
); 

// Setting disable link to detail page.
$wp_customize->add_setting( 'services_link',
	array(
		'default'           => $default['services_link'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'services_link',
	array(
		'label'    => esc_html__( 'Disable link to services detail page', 'medical-way' ),
		'section'  => 'section_services',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting services excerpt_length.
$wp_customize->add_setting( 'services_excerpt',
	array(
		'default'           => $default['services_excerpt'],
		'sanitize_callback' => 'medical_way_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'services_excerpt',
	array(
		'label'       => esc_html__( 'Excerpt Length', 'medical-way' ),
		'description' => esc_html__( 'in words', 'medical-way' ),
		'section'     => 'section_services',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 75px;' ),
	)
);

// Department Section.
$wp_customize->add_section( 'section_departments',
	array(
		'title'      => esc_html__( 'Departments Page Options', 'medical-way' ),
		'priority'   => 100,
		'panel'      => 'theme_option_panel',
	)
);

// Setting departments page.
$wp_customize->add_setting( "departments_page",
	array(
		'sanitize_callback' => 'medical_way_sanitize_dropdown_pages',
	)
);

$wp_customize->add_control( "departments_page",
	array(
		'label'           => esc_html__( 'Departments Page', 'medical-way' ),
		'description' 	  => __( 'Sub Pages of this page will be listed as departments', 'medical-way' ),
		'section'         => 'section_departments',
		'type'            => 'dropdown-pages',
		'priority'        => 100,
	)
); 

// Setting disable link to detail page.
$wp_customize->add_setting( 'departments_link',
	array(
		'default'           => $default['departments_link'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'departments_link',
	array(
		'label'    => esc_html__( 'Disable link to department detail page', 'medical-way' ),
		'section'  => 'section_departments',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting departments excerpt_length.
$wp_customize->add_setting( 'departments_excerpt',
	array(
		'default'           => $default['departments_excerpt'],
		'sanitize_callback' => 'medical_way_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'departments_excerpt',
	array(
		'label'       => esc_html__( 'Excerpt Length', 'medical-way' ),
		'description' => esc_html__( 'in words', 'medical-way' ),
		'section'     => 'section_departments',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 75px;' ),
	)
);

// Team Section.
$wp_customize->add_section( 'section_team',
	array(
		'title'      => esc_html__( 'Team Page Options', 'medical-way' ),
		'priority'   => 100,
		'panel'      => 'theme_option_panel',
	)
);

// Setting team page.
$wp_customize->add_setting( "team_page",
	array(
		'sanitize_callback' => 'medical_way_sanitize_dropdown_pages',
	)
);

$wp_customize->add_control( "team_page",
	array(
		'label'           => esc_html__( 'Team Page', 'medical-way' ),
		'description' 	  => __( 'Sub Pages of this page will be listed as each team member', 'medical-way' ),
		'section'         => 'section_team',
		'type'            => 'dropdown-pages',
		'priority'        => 100,
	)
); 

// Setting disable link to detail page.
$wp_customize->add_setting( 'member_link',
	array(
		'default'           => $default['member_link'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'member_link',
	array(
		'label'    => esc_html__( 'Disable link to member detail page', 'medical-way' ),
		'section'  => 'section_team',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Add Slider Options Panel.
$wp_customize->add_panel( 'slider_option_panel',
	array(
		'title'      => esc_html__( 'Featured Slider Options', 'medical-way' ),
		'priority'   => 100,
	)
);

// Slider Section.
$wp_customize->add_section( 'section_slider',
	array(
		'title'      => esc_html__( 'Slider Type', 'medical-way' ),
		'priority'   => 100,
		'panel'      => 'slider_option_panel',
	)
);

// Setting slider_status.
$wp_customize->add_setting( 'slider_status',
	array(
		'default'           => $default['slider_status'],
		'sanitize_callback' => 'medical_way_sanitize_select',
	)
);
$wp_customize->add_control( 'slider_status',
	array(
		'label'       => esc_html__( 'Slider Status', 'medical-way' ),
		'section'     => 'section_slider',
		'type'        => 'radio',
		'priority'    => 100,
		'choices'     => array(
			'disable' => esc_html__( 'Disable', 'medical-way' ),
			'home'    => esc_html__( 'Multiple Slides', 'medical-way' ),
		),
	)
);

// Setting slider excerpt_length.
$wp_customize->add_setting( 'slider_excerpt_length',
	array(
		'default'           => $default['slider_excerpt_length'],
		'sanitize_callback' => 'medical_way_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'slider_excerpt_length',
	array(
		'label'       => __( 'Description Length', 'medical-way' ),
		'description' => __( 'Applied to count of words used in description of all slides', 'medical-way' ),
		'section'     => 'section_slider',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array( 'min' => 1, 'max' => 50, 'style' => 'width: 55px;' ),
		'active_callback' 	=> 'medical_way_is_featured_slider_active',
	)
);

$slider_number = 5;
for ( $i = 1; $i <= $slider_number; $i++ ) {

	//Slide Details
	$wp_customize->add_setting('slide_'.$i.'_info', 
		array(
			'sanitize_callback' => 'esc_attr',            
		)
	);

	$wp_customize->add_control( 
		new medical_way_Info( 
			$wp_customize, 
			'slide_'.$i.'_info', 
			array(
				'label' 			=> esc_html__( 'Slide ', 'medical-way' ) . ' - ' . $i,
				'section' 			=> 'section_slider',
				'priority' 			=> 100,
				'active_callback' 	=> 'medical_way_is_featured_slider_active',
			) 
		)
	);

	$wp_customize->add_setting( "slider_page_$i",
		array(
			'sanitize_callback' => 'medical_way_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control( "slider_page_$i",
		array(
			'label'           => esc_html__( 'Select Slide', 'medical-way' ),
			'section'         => 'section_slider',
			'type'            => 'dropdown-pages',
			'priority'        => 100,
			'active_callback' => 'medical_way_is_featured_slider_active',
		)
	); 

	$wp_customize->add_setting( "slider_button_$i",
		array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( "slider_button_$i",
		array(
			'label'           => esc_html__( 'Button Text', 'medical-way' ),
			'section'         => 'section_slider',
			'type'            => 'text',
			'priority'        => 100,
			'active_callback' => 'medical_way_is_featured_slider_active',
		)
	); 

	$wp_customize->add_setting( "slider_url_$i",
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( "slider_url_$i",
		array(
			'label'           => esc_html__( 'Button Link', 'medical-way' ),
			'section'         => 'section_slider',
			'type'            => 'text',
			'priority'        => 100,
			'active_callback' => 'medical_way_is_featured_slider_active',
		)
	);	
}

// Slider Options Section.
$wp_customize->add_section( 'section_slider_options',
	array(
		'title'      => esc_html__( 'Slider Options', 'medical-way' ),
		'priority'   => 100,
		'panel'      => 'slider_option_panel',
	)
);

// Setting slider_transition_effect.
$wp_customize->add_setting( 'slider_transition_effect',
	array(
		'default'           => $default['slider_transition_effect'],
		'sanitize_callback' => 'medical_way_sanitize_select',
	)
);
$wp_customize->add_control( 'slider_transition_effect',
	array(
		'label'           => __( 'Transition Effect', 'medical-way' ),
		'section'         => 'section_slider_options',
		'type'            => 'select',
		'priority'        => 100,
		'choices'         => array(
			'fade'       => esc_html__( 'fade', 'medical-way' ),
			'fadeout'    => esc_html__( 'fadeout', 'medical-way' ),
			'none'       => esc_html__( 'none', 'medical-way' ),
			'scrollHorz' => esc_html__( 'scrollHorz', 'medical-way' ),
		),
	)
);

// Setting slider_transition_delay.
$wp_customize->add_setting( 'slider_transition_delay',
	array(
		'default'           => $default['slider_transition_delay'],
		'sanitize_callback' => 'medical_way_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'slider_transition_delay',
	array(
		'label'           => __( 'Transition Delay', 'medical-way' ),
		'description'     => __( 'in seconds', 'medical-way' ),
		'section'         => 'section_slider_options',
		'type'            => 'number',
		'priority'        => 100,
		'input_attrs'     => array( 'min' => 1, 'max' => 5, 'step' => 1, 'style' => 'width: 60px;' ),
	)
);

// Setting slider_transition_duration.
$wp_customize->add_setting( 'slider_transition_duration',
	array(
		'default'           => $default['slider_transition_duration'],
		'sanitize_callback' => 'medical_way_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'slider_transition_duration',
	array(
		'label'           => __( 'Transition Duration', 'medical-way' ),
		'description'     => __( 'in seconds', 'medical-way' ),
		'section'         => 'section_slider_options',
		'type'            => 'number',
		'priority'        => 100,
		'input_attrs'     => array( 'min' => 1, 'max' => 10, 'step' => 1, 'style' => 'width: 60px;' ),
	)
);

// Setting slider_caption_status.
$wp_customize->add_setting( 'slider_caption_status',
	array(
		'default'           => $default['slider_caption_status'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_caption_status',
	array(
		'label'           => __( 'Show Caption', 'medical-way' ),
		'section'         => 'section_slider_options',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting slider_arrow_status.
$wp_customize->add_setting( 'slider_arrow_status',
	array(
		'default'           => $default['slider_arrow_status'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_arrow_status',
	array(
		'label'           => __( 'Show Arrow', 'medical-way' ),
		'section'         => 'section_slider_options',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting slider_pager_status.
$wp_customize->add_setting( 'slider_pager_status',
	array(
		'default'           => $default['slider_pager_status'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_pager_status',
	array(
		'label'           => __( 'Show Pager', 'medical-way' ),
		'section'         => 'section_slider_options',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting slider_autoplay_status.
$wp_customize->add_setting( 'slider_autoplay_status',
	array(
		'default'           => $default['slider_autoplay_status'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_autoplay_status',
	array(
		'label'           => __( 'Enable Autoplay', 'medical-way' ),
		'section'         => 'section_slider_options',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

// Setting slider_overlay_status.
$wp_customize->add_setting( 'slider_overlay_status',
	array(
		'default'           => $default['slider_overlay_status'],
		'sanitize_callback' => 'medical_way_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'slider_overlay_status',
	array(
		'label'           => __( 'Enable Overlay', 'medical-way' ),
		'section'         => 'section_slider_options',
		'type'            => 'checkbox',
		'priority'        => 100,
	)
);

class medical_way_Info extends WP_Customize_Control {
    public $type = 'info';
    public $label = '';
    public function render_content() {
    ?>
        <h2><?php echo esc_html( $this->label ); ?></h2>
    <?php
    }
}  
