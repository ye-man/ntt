<?php
function ntt_wp_customizer( $wp_customize ) {	
    
    /**
     * Entity Name, Entity Description
     */
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    
    /**
     * Selective Refresh
     */
    if ( isset( $wp_customize->selective_refresh ) ) {
        
        $wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.entity-primary-name .txt',
				'render_callback' => 'ntt_wp_customize_partial_blogname',
			)
		);
        
        $wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.entity-description .txt',
				'render_callback' => 'ntt_wp_customize_partial_blogdescription',
			)
		);
	}

    /**
     * NTT Settings
     */
	$wp_customize->add_setting( 'colorscheme', array(
		'default'           => 'default',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'ntt_wp_customize_color_scheme_sanitizer',
	) );

	$wp_customize->add_setting( 'colorscheme_hue', array(
		'default'           => 250,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'colorscheme', array(
		'type'        => 'radio',
		'label'       => __( 'Color Scheme', 'ntt' ),
		'choices'     => array(
			'default'    => __( 'Default', 'ntt' ),
			'custom'     => __( 'Custom', 'ntt' ),
		),
		'section'     => 'colors',
		'priority'    => 5,
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colorscheme_hue', array(
		'mode'        => 'hue',
		'section'     => 'colors',
		'priority'    => 6,
     ) ) );
     
    /**
     * NTT Settings
     */
    $wp_customize->add_section( 'ntt_settings', array(
        'title'         => 'NTT Settings',
        'description'   => 'Customize NTT',
    ) );
 
    /**
     * Site ID
     */
    $wp_customize->add_setting( 'ntt_settings_site_id', array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_control( 'ntt_settings_site_id', array(
        'label'         => 'Site ID',
        'section'       => 'ntt_settings',
		'priority'      => 1,
    ) );
 
    /**
     * Features
     */
    $wp_customize->add_setting( 'ntt_settings_features', array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr',
    ) );

    $wp_customize->add_control( 'ntt_settings_features', array(
        'label'         => 'Features',
        'section'       => 'ntt_settings',
		'priority'      => 2,
    ) );
}
add_action( 'customize_register', 'ntt_wp_customizer' );

/**
 * Render Entity Name for the selective refresh partial.
 *
 * @return void
 */
function ntt_wp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render Entity Description for the selective refresh partial.
 *
 * @return void
 */
function ntt_wp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function ntt_wp_customize_color_scheme_sanitizer( $input ) {
	$valid = array(
		'default',
		'custom',
	);

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'default';
}

/**
 * WP Customizer Preview Script
 */
function ntt_wp_customizer_preview_script() {
	wp_enqueue_script( 'ntt-wp-customizer-preview-script', get_theme_file_uri( '/assets/scripts/wp-customizer-preview.js' ), array( 'customize-preview', ), null, true );
}
add_action( 'customize_preview_init', 'ntt_wp_customizer_preview_script' );

/**
 * WP Customizer Controls Script
 */
function ntt_wp_customizer_controls_script() {
	wp_enqueue_script( 'ntt-wp-customizer-controls-script', get_theme_file_uri( '/assets/scripts/wp-customizer-controls.js' ), array(), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'ntt_wp_customizer_controls_script' );

/**
 * WP Customizer Edit Icon Script
 * Hide the Modify Action in WP Customizer Preview
 */
function ntt_wp_customizer_modify_action_script() {
    $js = 'wp.customize.selectiveRefresh.Partial.prototype.createEditShortcutForPlacement = function() {};';
    wp_add_inline_script( 'customize-selective-refresh', $js );
}
add_action( 'wp_enqueue_scripts', 'ntt_wp_customizer_modify_action_script' );

/**
 * WP Customizer Color Patterns
 */ 
function ntt_wp_customizer_color_patterns() {
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
	$saturation = absint( apply_filters( 'ntt_custom_colors_saturation', 50 ) ). '%';
    $css = '
    :root {
        --wp-customizer-custom-color-scheme--hue: '. $hue.';
        --wp-customizer-custom-color-scheme--saturation: '. $saturation.';
    }
    
    .wp-customizer-color-scheme--custom .entity-header {
        background-color: hsl('. $hue. ', '. $saturation. ', 50%);
    }
    ';
	return apply_filters( 'ntt_wp_customizer_color_patterns', $css, $hue, $saturation );
}

/**
 * WP Customizer Custom Color Scheme Style
 */
function ntt_wp_customizer_custom_color_scheme_style() {
    
    if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
        return;
	}
	
	ntt_wp_customizer_color_patterns();
    
    $hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
    ?>

    <style id="ntt-wp-customizer-custom-color-scheme-style"<?php if ( is_customize_preview() ) { echo ' '. 'data-hue="' . esc_attr( $hue ) . '"'; } ?>>
        <?php echo ntt_wp_customizer_color_patterns(); ?>
    </style>
    <?php
}
add_action( 'wp_head', 'ntt_wp_customizer_custom_color_scheme_style' );

/**
 * WP Customizer HTML CSS
 */
function ntt_wp_customizer_html_css( $classes ) {

    $site_id = get_theme_mod( 'ntt_settings_site_id' );
    $features = get_theme_mod( 'ntt_settings_features' );

    if ( $site_id ) {
        $classes[] = 'ntt-site-id--'. sanitize_title( $site_id );
    }

    if ( $features ) {
        $features = trim( preg_replace( '/\s+/', ' ', $features ) );
        $classes[] = $features;
    }
    
    return $classes;
}
add_filter( 'ntt_html_css_wp_filter', 'ntt_wp_customizer_html_css' );