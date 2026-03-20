<?php
/**
 * Funciones del tema
 */

// Cargar estilos y scripts
function colegio_theme_enqueue_styles() {
    wp_enqueue_style('colegio-theme-style', get_stylesheet_uri());
    wp_enqueue_script(
        'colegio-theme-script',
        get_template_directory_uri() . '/script.js',
        array(),
        filemtime( get_template_directory() . '/script.js' ),
        true
    );

    // Pasar el webhook de Zapier al JS (solo si estamos en la página de contacto)
    $zapier_webhook = get_theme_mod('colegio_zapier_webhook', '');
    wp_localize_script('colegio-theme-script', 'colegioData', array(
        'zapierWebhook' => esc_url_raw($zapier_webhook),
        'ajaxUrl'       => admin_url('admin-ajax.php'),
        'nonce'         => wp_create_nonce('colegio_contacto_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'colegio_theme_enqueue_styles');

// Soporte para características básicas (dentro del hook correcto)
function colegio_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    register_nav_menus( array(
        'header-menu' => __( 'Menú Principal (Header)', 'colegio-theme' ),
        'footer-menu' => __( 'Menú Footer', 'colegio-theme' ),
    ) );
}
add_action('after_setup_theme', 'colegio_theme_setup');

/**
 * Opciones del personalizador
 */
function colegio_customize_register( $wp_customize ) {

    // ════════════════════════════════════════════════════════════════
    // Panel principal del tema
    // ════════════════════════════════════════════════════════════════
    $wp_customize->add_panel( 'colegio_panel', array(
        'title'    => __( 'Heritage American School', 'colegio-theme' ),
        'priority' => 30,
    ) );

    // ────────────────────────────────────────────────────────────────
    // Sección 1 › Imágenes de portada
    // ────────────────────────────────────────────────────────────────
    $wp_customize->add_section( 'colegio_home_images', array(
        'title'       => __( 'Imágenes de portada', 'colegio-theme' ),
        'description' => __( 'Imágenes de fondo y elementos visuales de la página principal.', 'colegio-theme' ),
        'panel'       => 'colegio_panel',
        'priority'    => 10,
    ) );

    $wp_customize->add_setting( 'colegio_hero_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_hero_bg_control', array(
            'label'    => __( 'Fondo sección Hero', 'colegio-theme' ),
            'section'  => 'colegio_home_images',
            'settings' => 'colegio_hero_bg',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_programs_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_programs_bg_control', array(
            'label'    => __( 'Fondo sección Programas', 'colegio-theme' ),
            'section'  => 'colegio_home_images',
            'settings' => 'colegio_programs_bg',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_programs_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_programs_logo_control', array(
            'label'    => __( 'Logo/sello superpuesto en Programas', 'colegio-theme' ),
            'section'  => 'colegio_home_images',
            'settings' => 'colegio_programs_logo',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_contacto_img_superior', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_contacto_img_superior_control', array(
            'label'       => __( 'Imagen superior — Formulario de contacto', 'colegio-theme' ),
            'description' => __( 'Se muestra centrada arriba del formulario.', 'colegio-theme' ),
            'section'     => 'colegio_home_images',
            'settings'    => 'colegio_contacto_img_superior',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_contacto_img_inferior', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_contacto_img_inferior_control', array(
            'label'       => __( 'Imagen inferior — Formulario de contacto', 'colegio-theme' ),
            'description' => __( 'Se muestra centrada debajo del formulario.', 'colegio-theme' ),
            'section'     => 'colegio_home_images',
            'settings'    => 'colegio_contacto_img_inferior',
        ) ) );
    }

    // ────────────────────────────────────────────────────────────────
    // Sección 2 › Header
    // ────────────────────────────────────────────────────────────────
    $wp_customize->add_section( 'colegio_header', array(
        'title'       => __( 'Header', 'colegio-theme' ),
        'description' => __( 'El logo del header se configura en "Identidad del sitio".', 'colegio-theme' ),
        'panel'       => 'colegio_panel',
        'priority'    => 20,
    ) );

    $wp_customize->add_setting( 'colegio_contactanos_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_contactanos_url', array(
        'label'   => __( 'URL — Botón "Contáctanos"', 'colegio-theme' ),
        'section' => 'colegio_header',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'colegio_info_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_info_url', array(
        'label'   => __( 'URL — Botón "Solicita más información"', 'colegio-theme' ),
        'section' => 'colegio_header',
        'type'    => 'url',
    ) );

    // ────────────────────────────────────────────────────────────────
    // Sección 3 › Footer
    // ────────────────────────────────────────────────────────────────
    $wp_customize->add_section( 'colegio_footer', array(
        'title'       => __( 'Footer', 'colegio-theme' ),
        'description' => __( 'El logo del footer usa el mismo logo del sitio (configurable en "Identidad del sitio").', 'colegio-theme' ),
        'panel'       => 'colegio_panel',
        'priority'    => 30,
    ) );

    // — Redes sociales —
    $wp_customize->add_setting( 'colegio_footer_social_title', array(
        'default'           => 'SÍGUENOS',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_footer_social_title', array(
        'label'   => __( 'Redes — Título (ej. "SÍGUENOS")', 'colegio-theme' ),
        'section' => 'colegio_footer',
        'type'    => 'text',
    ) );

    $social_networks = array(
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'youtube'   => 'YouTube',
        'whatsapp'  => 'WhatsApp',
        'linkedin'  => 'LinkedIn',
    );

    foreach ( $social_networks as $key => $label ) {
        $wp_customize->add_setting( "colegio_{$key}_url", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "colegio_{$key}_url", array(
            'label'   => sprintf( __( 'Redes — URL %s', 'colegio-theme' ), $label ),
            'section' => 'colegio_footer',
            'type'    => 'url',
        ) );
    }

    // ────────────────────────────────────────────────────────────────
    // Sección 4 › Integraciones
    // ────────────────────────────────────────────────────────────────
    $wp_customize->add_section( 'colegio_integraciones', array(
        'title'       => __( 'Integraciones', 'colegio-theme' ),
        'description' => __( 'Conecta el formulario de contacto con servicios externos.', 'colegio-theme' ),
        'panel'       => 'colegio_panel',
        'priority'    => 40,
    ) );

    $wp_customize->add_setting( 'colegio_zapier_webhook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_zapier_webhook', array(
        'label'       => __( 'URL del Webhook de Zapier', 'colegio-theme' ),
        'description' => __( 'Pega aquí la URL del webhook de tu Zap (Catch Hook).', 'colegio-theme' ),
        'section'     => 'colegio_integraciones',
        'type'        => 'url',
    ) );
}
add_action( 'customize_register', 'colegio_customize_register' );

/**
 * Proxy server-side para enviar el formulario a Zapier sin problemas de CORS
 */
function colegio_enviar_contacto_ajax() {
    if ( ! check_ajax_referer( 'colegio_contacto_nonce', 'nonce', false ) ) {
        wp_send_json_error( array( 'message' => 'Nonce inválido.' ), 403 );
    }

    $raw_body = file_get_contents( 'php://input' );
    $data     = json_decode( $raw_body, true );

    if ( ! is_array( $data ) ) {
        wp_send_json_error( array( 'message' => 'Datos inválidos.' ), 400 );
    }

    $webhook = get_theme_mod( 'colegio_zapier_webhook', '' );
    if ( empty( $webhook ) ) {
        wp_send_json_error( array( 'message' => 'Webhook no configurado.' ), 400 );
    }

    $response = wp_remote_post(
        esc_url_raw( $webhook ),
        array(
            'method'  => 'POST',
            'timeout' => 15,
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'body'    => wp_json_encode( $data ),
        )
    );

    if ( is_wp_error( $response ) ) {
        wp_send_json_error( array( 'message' => 'No se pudo enviar al webhook.' ), 500 );
    }

    $status_code = wp_remote_retrieve_response_code( $response );
    if ( $status_code < 200 || $status_code >= 300 ) {
        wp_send_json_error( array( 'message' => 'Webhook respondió con error.' ), 502 );
    }

    wp_send_json_success( array( 'message' => 'Formulario enviado correctamente.' ) );
}
add_action( 'wp_ajax_colegio_enviar_contacto', 'colegio_enviar_contacto_ajax' );
add_action( 'wp_ajax_nopriv_colegio_enviar_contacto', 'colegio_enviar_contacto_ajax' );
