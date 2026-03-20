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
}
add_action('after_setup_theme', 'colegio_theme_setup');

/**
 * Opciones del personalizador para imágenes de la portada
 */
function colegio_customize_register( $wp_customize ) {
    // Sección para imágenes de portada
    $wp_customize->add_section(
        'colegio_home_images',
        array(
            'title'       => __( 'Imágenes de portada', 'colegio-theme' ),
            'description' => __( 'Configura las imágenes de fondo de la portada.', 'colegio-theme' ),
            'priority'    => 30,
        )
    );

    // Imagen de fondo de la sección hero
    $wp_customize->add_setting(
        'colegio_hero_bg',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'colegio_hero_bg_control',
                array(
                    'label'    => __( 'Imagen de fondo - sección principal (Hero)', 'colegio-theme' ),
                    'section'  => 'colegio_home_images',
                    'settings' => 'colegio_hero_bg',
                )
            )
        );
    }

    // Imagen superpuesta (logo/sello) en la sección de programas
    $wp_customize->add_setting(
        'colegio_programs_logo',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'colegio_programs_logo_control',
                array(
                    'label'    => __( 'Imagen superpuesta (logo/sello) - sección programas', 'colegio-theme' ),
                    'section'  => 'colegio_home_images',
                    'settings' => 'colegio_programs_logo',
                )
            )
        );
    }

    // Imágenes de apoyo para el formulario de contacto
    $wp_customize->add_setting(
        'colegio_contacto_img_superior',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'colegio_contacto_img_superior_control',
                array(
                    'label'       => __( 'Imagen superior del formulario de contacto', 'colegio-theme' ),
                    'description' => __( 'Se mostrara centrada arriba del formulario en la pagina de contacto.', 'colegio-theme' ),
                    'section'     => 'colegio_home_images',
                    'settings'    => 'colegio_contacto_img_superior',
                )
            )
        );
    }

    $wp_customize->add_setting(
        'colegio_contacto_img_inferior',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'colegio_contacto_img_inferior_control',
                array(
                    'label'       => __( 'Imagen inferior del formulario de contacto', 'colegio-theme' ),
                    'description' => __( 'Se mostrara centrada debajo del formulario en la pagina de contacto.', 'colegio-theme' ),
                    'section'     => 'colegio_home_images',
                    'settings'    => 'colegio_contacto_img_inferior',
                )
            )
        );
    }

    // Imagen de fondo de la sección de programas
    $wp_customize->add_setting(
        'colegio_programs_bg',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'colegio_programs_bg_control',
                array(
                    'label'    => __( 'Imagen de fondo - sección programas', 'colegio-theme' ),
                    'section'  => 'colegio_home_images',
                    'settings' => 'colegio_programs_bg',
                )
            )
        );
    }

    // ─── Sección: Enlaces ────────────────────────────────────────────
    $wp_customize->add_section(
        'colegio_links',
        array(
            'title'       => __( 'Enlaces', 'colegio-theme' ),
            'description' => __( 'URLs del botón Contáctanos y redes sociales.', 'colegio-theme' ),
            'priority'    => 40,
        )
    );

    // Botón Contáctanos
    $wp_customize->add_setting( 'colegio_contactanos_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_contactanos_url', array(
        'label'   => __( 'URL - Botón Contáctanos', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    // Botón "Solicita más información"
    $wp_customize->add_setting( 'colegio_info_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_info_url', array(
        'label'   => __( 'URL - Botón "Solicita más información"', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    // Facebook
    $wp_customize->add_setting( 'colegio_facebook_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_facebook_url', array(
        'label'   => __( 'URL - Facebook', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    // Instagram
    $wp_customize->add_setting( 'colegio_instagram_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_instagram_url', array(
        'label'   => __( 'URL - Instagram', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    // ─── Footer (enlaces + redes) ───────────────────────────────────
    $wp_customize->add_setting( 'colegio_footer_social_title', array(
        'default'           => 'SÍGUENOS',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_footer_social_title', array(
        'label'   => __( 'Texto - Título de redes ("SÍGUENOS")', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'text',
    ) );

    // Enlaces del footer
    $wp_customize->add_setting( 'colegio_footer_nav_campus_label', array(
        'default'           => 'Campus',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_footer_nav_campus_label', array(
        'label'   => __( 'Etiqueta - Campus', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'colegio_footer_nav_campus_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_footer_nav_campus_url', array(
        'label'   => __( 'URL - Campus', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'colegio_footer_nav_admisiones_label', array(
        'default'           => 'Admisiones',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_footer_nav_admisiones_label', array(
        'label'   => __( 'Etiqueta - Admisiones', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'colegio_footer_nav_admisiones_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_footer_nav_admisiones_url', array(
        'label'   => __( 'URL - Admisiones', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'colegio_footer_nav_programas_label', array(
        'default'           => 'Programas',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_footer_nav_programas_label', array(
        'label'   => __( 'Etiqueta - Programas', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'colegio_footer_nav_programas_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_footer_nav_programas_url', array(
        'label'   => __( 'URL - Programas', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'colegio_footer_nav_galeria_label', array(
        'default'           => 'Galería',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_footer_nav_galeria_label', array(
        'label'   => __( 'Etiqueta - Galería', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'colegio_footer_nav_galeria_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_footer_nav_galeria_url', array(
        'label'   => __( 'URL - Galería', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    // Redes sociales (footer)
    $wp_customize->add_setting( 'colegio_youtube_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_youtube_url', array(
        'label'   => __( 'URL - YouTube', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'colegio_whatsapp_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_whatsapp_url', array(
        'label'   => __( 'URL - WhatsApp', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    $wp_customize->add_setting( 'colegio_linkedin_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_linkedin_url', array(
        'label'   => __( 'URL - LinkedIn', 'colegio-theme' ),
        'section' => 'colegio_links',
        'type'    => 'url',
    ) );

    // ─── Sección: Integración ────────────────────────────────────────
    $wp_customize->add_section(
        'colegio_integraciones',
        array(
            'title'       => __( 'Integraciones', 'colegio-theme' ),
            'description' => __( 'Conecta el formulario de contacto con servicios externos.', 'colegio-theme' ),
            'priority'    => 50,
        )
    );

    // Webhook de Zapier
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
