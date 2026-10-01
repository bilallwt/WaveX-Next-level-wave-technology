<?php
/**
 * Customizer settings for home page content that editors may change.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Defaults for customizer-managed text.
 *
 * @return array<string,string>
 */
function wavex_defaults() {
	return array(
		'hero_title'     => __( 'Transform your business today', 'wavex' ),
		'hero_text'      => __( 'WaveX Technology helps businesses and organizations build, improve, launch and grow their digital products and online presence.', 'wavex' ),
		'hero_cta_label' => __( 'Free Consultation', 'wavex' ),
		'cta_title'      => __( 'Have a project in mind?', 'wavex' ),
		'cta_text'       => __( 'Tell us what you need and we will talk through the options with you.', 'wavex' ),
		'footer_text'    => __( 'Technology and digital services: web, WordPress, mobile apps, custom software, SEO and digital marketing.', 'wavex' ),
		'contact_email'  => '',
		'contact_phone'  => '',
	);
}

/**
 * Get a theme option with its default.
 *
 * @param string $key Option key.
 * @return string
 */
function wavex_opt( $key ) {
	$defaults = wavex_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return (string) get_theme_mod( $key, $default );
}

/**
 * Register customizer controls.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function wavex_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'wavex_home', array(
		'title'    => __( 'WaveX: Home Page', 'wavex' ),
		'priority' => 30,
	) );

	$fields = array(
		'hero_title'     => array( __( 'Hero heading', 'wavex' ), 'text', 'sanitize_text_field' ),
		'hero_text'      => array( __( 'Hero text', 'wavex' ), 'textarea', 'sanitize_textarea_field' ),
		'hero_cta_label' => array( __( 'Hero button label', 'wavex' ), 'text', 'sanitize_text_field' ),
		'cta_title'      => array( __( 'Call-to-action heading', 'wavex' ), 'text', 'sanitize_text_field' ),
		'cta_text'       => array( __( 'Call-to-action text', 'wavex' ), 'textarea', 'sanitize_textarea_field' ),
	);

	foreach ( $fields as $key => $field ) {
		$wp_customize->add_setting( $key, array(
			'default'           => wavex_defaults()[ $key ],
			'sanitize_callback' => $field[2],
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $field[0],
			'section' => 'wavex_home',
			'type'    => $field[1],
		) );
	}

	$wp_customize->add_setting( 'hero_image', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'hero_image', array(
		'label'       => __( 'Hero image', 'wavex' ),
		'description' => __( 'Optional. Leave empty to use the built-in illustration.', 'wavex' ),
		'section'     => 'wavex_home',
		'width'       => 900,
		'height'      => 900,
	) ) );

	$wp_customize->add_section( 'wavex_footer', array(
		'title'    => __( 'WaveX: Footer & Contact', 'wavex' ),
		'priority' => 31,
	) );

	$footer_fields = array(
		'footer_text'   => array( __( 'Footer description', 'wavex' ), 'textarea', 'sanitize_textarea_field' ),
		'contact_email' => array( __( 'Contact email', 'wavex' ), 'text', 'sanitize_email' ),
		'contact_phone' => array( __( 'Contact phone', 'wavex' ), 'text', 'sanitize_text_field' ),
	);

	foreach ( $footer_fields as $key => $field ) {
		$wp_customize->add_setting( $key, array(
			'default'           => wavex_defaults()[ $key ],
			'sanitize_callback' => $field[2],
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $field[0],
			'section' => 'wavex_footer',
			'type'    => $field[1],
		) );
	}
}
add_action( 'customize_register', 'wavex_customize_register' );
