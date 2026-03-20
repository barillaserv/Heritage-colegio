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
 * Personalizador — arquitectura: un panel por página + un panel Global.
 *
 * CONVENCIÓN para agregar una nueva página:
 *   1. Crear un panel:  colegio_panel_<slug>
 *   2. Crear secciones: colegio_<slug>_<seccion>
 *   3. Crear settings:  colegio_<slug>_<seccion>_<campo>
 *   4. Consumir en el template: get_theme_mod( 'colegio_<slug>_<seccion>_<campo>', 'default' )
 *
 * Ver README.md › "Cómo agregar una nueva página al Personalizador" para el patrón completo.
 */
function colegio_customize_register( $wp_customize ) {

    // ════════════════════════════════════════════════════════════════
    // PANEL: Global (Header + Footer)
    // Elementos presentes en todas las páginas del sitio.
    // ════════════════════════════════════════════════════════════════
    $wp_customize->add_panel( 'colegio_panel_global', array(
        'title'    => __( 'Global (Header / Footer)', 'colegio-theme' ),
        'priority' => 10,
    ) );

    // ── Sección: Header ─────────────────────────────────────────────
    $wp_customize->add_section( 'colegio_header', array(
        'title'       => __( 'Header', 'colegio-theme' ),
        'description' => __( 'El logo se configura en "Identidad del sitio". El menú de navegación en "Apariencia › Menús".', 'colegio-theme' ),
        'panel'       => 'colegio_panel_global',
        'priority'    => 10,
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

    // ── Sección: Footer ─────────────────────────────────────────────
    $wp_customize->add_section( 'colegio_footer', array(
        'title'       => __( 'Footer', 'colegio-theme' ),
        'description' => __( 'El logo usa el de "Identidad del sitio". El menú de enlaces se gestiona en "Apariencia › Menús".', 'colegio-theme' ),
        'panel'       => 'colegio_panel_global',
        'priority'    => 20,
    ) );

    $wp_customize->add_setting( 'colegio_footer_social_title', array(
        'default'           => 'SÍGUENOS',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_footer_social_title', array(
        'label'   => __( 'Redes — Título (ej. "SÍGUENOS")', 'colegio-theme' ),
        'section' => 'colegio_footer',
        'type'    => 'text',
    ) );

    foreach ( array(
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'youtube'   => 'YouTube',
        'whatsapp'  => 'WhatsApp',
        'linkedin'  => 'LinkedIn',
    ) as $key => $label ) {
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

    // ════════════════════════════════════════════════════════════════
    // PANEL: Página de Inicio  (template: index.php)
    // ════════════════════════════════════════════════════════════════
    $wp_customize->add_panel( 'colegio_panel_inicio', array(
        'title'    => __( 'Página de Inicio', 'colegio-theme' ),
        'priority' => 20,
    ) );

    // ── Sección: Hero ───────────────────────────────────────────────
    $wp_customize->add_section( 'colegio_inicio_hero', array(
        'title'    => __( 'Sección 1 — Hero', 'colegio-theme' ),
        'panel'    => 'colegio_panel_inicio',
        'priority' => 10,
    ) );

    $wp_customize->add_setting( 'colegio_hero_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_hero_bg_control', array(
            'label'    => __( 'Imagen de fondo', 'colegio-theme' ),
            'section'  => 'colegio_inicio_hero',
            'settings' => 'colegio_hero_bg',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_hero_admisiones_texto', array(
        'default'           => 'ADMISIONES ABIERTAS',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_hero_admisiones_texto', array(
        'label'   => __( 'Texto — Botón Admisiones', 'colegio-theme' ),
        'section' => 'colegio_inicio_hero',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_hero_admisiones_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_hero_admisiones_url', array(
        'label'   => __( 'URL — Botón Admisiones', 'colegio-theme' ),
        'section' => 'colegio_inicio_hero',
        'type'    => 'url',
    ) );

    // ── Sección: Sobre nosotros (Slider) ────────────────────────────
    $wp_customize->add_section( 'colegio_inicio_sobre', array(
        'title'    => __( 'Sección 2 — Sobre nosotros', 'colegio-theme' ),
        'panel'    => 'colegio_panel_inicio',
        'priority' => 15,
    ) );

    // Título y descripción general de la sección
    $wp_customize->add_setting( 'colegio_sobre_titulo', array(
        'default'           => 'Heritage American School',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_sobre_titulo', array(
        'label'   => __( 'Título de la sección', 'colegio-theme' ),
        'section' => 'colegio_inicio_sobre',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_sobre_descripcion', array(
        'default'           => 'Nuestro enfoque combina rigor académico internacional, formación deportiva de alto nivel y tecnología del futuro. Formamos líderes con carácter firme, mentalidad global y raíces profundas en sus valores.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'colegio_sobre_descripcion', array(
        'label'   => __( 'Descripción de la sección', 'colegio-theme' ),
        'section' => 'colegio_inicio_sobre',
        'type'    => 'textarea',
    ) );

    // Slides 1, 2 y 3
    foreach ( range( 1, 3 ) as $n ) {
        $wp_customize->add_setting( "colegio_sobre_slide{$n}_imagen", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        if ( class_exists( 'WP_Customize_Image_Control' ) ) {
            $wp_customize->add_control( new WP_Customize_Image_Control(
                $wp_customize,
                "colegio_sobre_slide{$n}_imagen_control",
                array(
                    'label'    => __( "Slide {$n} — Imagen", 'colegio-theme' ),
                    'section'  => 'colegio_inicio_sobre',
                    'settings' => "colegio_sobre_slide{$n}_imagen",
                )
            ) );
        }

        $wp_customize->add_setting( "colegio_sobre_slide{$n}_titulo", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_sobre_slide{$n}_titulo", array(
            'label'   => __( "Slide {$n} — Título", 'colegio-theme' ),
            'section' => 'colegio_inicio_sobre',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_sobre_slide{$n}_descripcion", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( "colegio_sobre_slide{$n}_descripcion", array(
            'label'   => __( "Slide {$n} — Descripción", 'colegio-theme' ),
            'section' => 'colegio_inicio_sobre',
            'type'    => 'textarea',
        ) );

        $wp_customize->add_setting( "colegio_sobre_slide{$n}_url", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "colegio_sobre_slide{$n}_url", array(
            'label'   => __( "Slide {$n} — URL de la flecha", 'colegio-theme' ),
            'section' => 'colegio_inicio_sobre',
            'type'    => 'url',
        ) );
    }

    // ── Sección: Nuestros Valores ───────────────────────────────────
    $wp_customize->add_section( 'colegio_inicio_valores', array(
        'title'    => __( 'Sección 3 — Nuestros Valores', 'colegio-theme' ),
        'panel'    => 'colegio_panel_inicio',
        'priority' => 25,
    ) );

    $wp_customize->add_setting( 'colegio_valores_titulo', array(
        'default'           => 'NUESTROS VALORES',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_valores_titulo', array(
        'label'   => __( 'Título de la sección', 'colegio-theme' ),
        'section' => 'colegio_inicio_valores',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_valores_imagen_izq', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_valores_imagen_izq_control', array(
            'label'    => __( 'Imagen izquierda (igual en todos los slides)', 'colegio-theme' ),
            'section'  => 'colegio_inicio_valores',
            'settings' => 'colegio_valores_imagen_izq',
        ) ) );
    }

    foreach ( range( 1, 2 ) as $n ) {
        $wp_customize->add_setting( "colegio_valores_slide{$n}_imagen", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        if ( class_exists( 'WP_Customize_Image_Control' ) ) {
            $wp_customize->add_control( new WP_Customize_Image_Control(
                $wp_customize,
                "colegio_valores_slide{$n}_imagen_control",
                array(
                    'label'    => __( "Slide {$n} — Imagen de la tarjeta", 'colegio-theme' ),
                    'section'  => 'colegio_inicio_valores',
                    'settings' => "colegio_valores_slide{$n}_imagen",
                )
            ) );
        }

        $wp_customize->add_setting( "colegio_valores_slide{$n}_titulo", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_valores_slide{$n}_titulo", array(
            'label'   => __( "Slide {$n} — Título", 'colegio-theme' ),
            'section' => 'colegio_inicio_valores',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_valores_slide{$n}_descripcion", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( "colegio_valores_slide{$n}_descripcion", array(
            'label'   => __( "Slide {$n} — Descripción", 'colegio-theme' ),
            'section' => 'colegio_inicio_valores',
            'type'    => 'textarea',
        ) );
    }

    // ── Sección: Modelo Educativo ───────────────────────────────────
    $wp_customize->add_section( 'colegio_inicio_modelo', array(
        'title'    => __( 'Sección 4 — Modelo Educativo', 'colegio-theme' ),
        'panel'    => 'colegio_panel_inicio',
        'priority' => 30,
    ) );

    // Título superior
    $wp_customize->add_setting( 'colegio_modelo_titulo', array(
        'default'           => 'Modelo Educativo Internacional',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_modelo_titulo', array(
        'label'   => __( 'Título de la sección', 'colegio-theme' ),
        'section' => 'colegio_inicio_modelo',
        'type'    => 'text',
    ) );

    // Banner (imagen de fondo + texto + botón)
    $wp_customize->add_setting( 'colegio_modelo_banner_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_modelo_banner_bg_control', array(
            'label'    => __( 'Banner — Imagen de fondo', 'colegio-theme' ),
            'section'  => 'colegio_inicio_modelo',
            'settings' => 'colegio_modelo_banner_bg',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_modelo_banner_texto', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'colegio_modelo_banner_texto', array(
        'label'   => __( 'Banner — Texto', 'colegio-theme' ),
        'section' => 'colegio_inicio_modelo',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'colegio_modelo_banner_btn_texto', array(
        'default'           => '¿Cómo funciona nuestro modelo?',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_modelo_banner_btn_texto', array(
        'label'   => __( 'Banner — Texto del botón', 'colegio-theme' ),
        'section' => 'colegio_inicio_modelo',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_modelo_banner_btn_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_modelo_banner_btn_url', array(
        'label'   => __( 'Banner — URL del botón', 'colegio-theme' ),
        'section' => 'colegio_inicio_modelo',
        'type'    => 'url',
    ) );

    // Barra inferior (logo + título + descripción + botón)
    $wp_customize->add_setting( 'colegio_modelo_barra_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_modelo_barra_logo_control', array(
            'label'    => __( 'Barra — Logo / ícono', 'colegio-theme' ),
            'section'  => 'colegio_inicio_modelo',
            'settings' => 'colegio_modelo_barra_logo',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_modelo_barra_titulo', array(
        'default'           => 'CIUDADANOS GLOBALES',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_modelo_barra_titulo', array(
        'label'   => __( 'Barra — Título', 'colegio-theme' ),
        'section' => 'colegio_inicio_modelo',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_modelo_barra_descripcion', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'colegio_modelo_barra_descripcion', array(
        'label'   => __( 'Barra — Descripción', 'colegio-theme' ),
        'section' => 'colegio_inicio_modelo',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'colegio_modelo_barra_btn_texto', array(
        'default'           => 'CONOCE MÁS',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_modelo_barra_btn_texto', array(
        'label'   => __( 'Barra — Texto del botón', 'colegio-theme' ),
        'section' => 'colegio_inicio_modelo',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_modelo_barra_btn_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_modelo_barra_btn_url', array(
        'label'   => __( 'Barra — URL del botón', 'colegio-theme' ),
        'section' => 'colegio_inicio_modelo',
        'type'    => 'url',
    ) );

    // ── Sección: Niveles Académicos ─────────────────────────────────
    $wp_customize->add_section( 'colegio_inicio_niveles', array(
        'title'    => __( 'Sección 5 — Niveles Académicos', 'colegio-theme' ),
        'panel'    => 'colegio_panel_inicio',
        'priority' => 35,
    ) );

    $wp_customize->add_setting( 'colegio_niveles_titulo', array(
        'default'           => 'Niveles Académicos',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_niveles_titulo', array(
        'label'   => __( 'Título de la sección', 'colegio-theme' ),
        'section' => 'colegio_inicio_niveles',
        'type'    => 'text',
    ) );

    foreach ( range( 1, 3 ) as $n ) {
        $wp_customize->add_setting( "colegio_niveles_card{$n}_imagen", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        if ( class_exists( 'WP_Customize_Image_Control' ) ) {
            $wp_customize->add_control( new WP_Customize_Image_Control(
                $wp_customize,
                "colegio_niveles_card{$n}_imagen_control",
                array(
                    'label'    => __( "Card {$n} — Imagen", 'colegio-theme' ),
                    'section'  => 'colegio_inicio_niveles',
                    'settings' => "colegio_niveles_card{$n}_imagen",
                )
            ) );
        }

        $wp_customize->add_setting( "colegio_niveles_card{$n}_titulo", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_niveles_card{$n}_titulo", array(
            'label'   => __( "Card {$n} — Título", 'colegio-theme' ),
            'section' => 'colegio_inicio_niveles',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_niveles_card{$n}_subtitulo", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_niveles_card{$n}_subtitulo", array(
            'label'   => __( "Card {$n} — Subtítulo", 'colegio-theme' ),
            'section' => 'colegio_inicio_niveles',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_niveles_card{$n}_descripcion", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( "colegio_niveles_card{$n}_descripcion", array(
            'label'   => __( "Card {$n} — Descripción", 'colegio-theme' ),
            'section' => 'colegio_inicio_niveles',
            'type'    => 'textarea',
        ) );

        $wp_customize->add_setting( "colegio_niveles_card{$n}_url", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "colegio_niveles_card{$n}_url", array(
            'label'   => __( "Card {$n} — URL de la flecha", 'colegio-theme' ),
            'section' => 'colegio_inicio_niveles',
            'type'    => 'url',
        ) );
    }

    // ── Sección: Nuestro Campus ─────────────────────────────────────
    $wp_customize->add_section( 'colegio_inicio_campus', array(
        'title'    => __( 'Sección 6 — Nuestro Campus', 'colegio-theme' ),
        'panel'    => 'colegio_panel_inicio',
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'colegio_campus_label', array(
        'default'           => 'NUESTRO CAMPUS',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_campus_label', array(
        'label'   => __( 'Etiqueta superior', 'colegio-theme' ),
        'section' => 'colegio_inicio_campus',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_campus_titulo', array(
        'default'           => 'Un entorno para la grandeza',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_campus_titulo', array(
        'label'   => __( 'Título', 'colegio-theme' ),
        'section' => 'colegio_inicio_campus',
        'type'    => 'text',
    ) );

    foreach ( range( 1, 3 ) as $n ) {
        $wp_customize->add_setting( "colegio_campus_slide{$n}_imagen", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        if ( class_exists( 'WP_Customize_Image_Control' ) ) {
            $wp_customize->add_control( new WP_Customize_Image_Control(
                $wp_customize,
                "colegio_campus_slide{$n}_imagen_control",
                array(
                    'label'    => __( "Slide {$n} — Imagen", 'colegio-theme' ),
                    'section'  => 'colegio_inicio_campus',
                    'settings' => "colegio_campus_slide{$n}_imagen",
                )
            ) );
        }

        $wp_customize->add_setting( "colegio_campus_slide{$n}_titulo", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_campus_slide{$n}_titulo", array(
            'label'   => __( "Slide {$n} — Título", 'colegio-theme' ),
            'section' => 'colegio_inicio_campus',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_campus_slide{$n}_btn_texto", array(
            'default'           => 'Más información',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_campus_slide{$n}_btn_texto", array(
            'label'   => __( "Slide {$n} — Texto del botón", 'colegio-theme' ),
            'section' => 'colegio_inicio_campus',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_campus_slide{$n}_btn_url", array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "colegio_campus_slide{$n}_btn_url", array(
            'label'   => __( "Slide {$n} — URL del botón", 'colegio-theme' ),
            'section' => 'colegio_inicio_campus',
            'type'    => 'url',
        ) );
    }

    // ── Sección: Vida estudiantil ───────────────────────────────────
    $wp_customize->add_section( 'colegio_inicio_vida_estudiantil', array(
        'title'    => __( 'Sección 7 — Vida estudiantil', 'colegio-theme' ),
        'panel'    => 'colegio_panel_inicio',
        'priority' => 42,
    ) );

    $wp_customize->add_setting( 'colegio_vida_estudiantil_titulo', array(
        'default'           => 'Vida estudiantil',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_vida_estudiantil_titulo', array(
        'label'   => __( 'Título de la sección', 'colegio-theme' ),
        'section' => 'colegio_inicio_vida_estudiantil',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_vida_estudiantil_descripcion', array(
        'default'           => 'Formación Integral en Acción. La educación en Heritage no termina al sonar el timbre. Creemos que el carácter se forja en la cancha, en el escenario y en la variedad de los clubes que se ofrecen.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'colegio_vida_estudiantil_descripcion', array(
        'label'   => __( 'Descripción de la sección', 'colegio-theme' ),
        'section' => 'colegio_inicio_vida_estudiantil',
        'type'    => 'textarea',
    ) );

    $vida_estudiantil_defaults = array(
        1 => array(
            'titulo'       => 'Deportes y Clubes',
            'descripcion'  => 'Nuestras canchas deportivas no son solo espacios de recreación; son laboratorios de liderazgo.',
            'boton_texto'  => 'Ver Más',
            'url'          => '#',
        ),
        2 => array(
            'titulo'       => 'Alianza Familia-Colegio',
            'descripcion'  => 'Socios en el Crecimiento. En Heritage American School, estamos convencidos de que el éxito de nuestros estudiantes nace de una alianza inquebrantable entre el hogar y el colegio.',
            'boton_texto'  => 'Ver Más',
            'url'          => '#',
        ),
        3 => array(
            'titulo'       => 'Salud y bienestar socio emocional',
            'descripcion'  => 'En Heritage, el éxito no se mide solo por las calificaciones, sino por la capacidad de nuestros estudiantes para aportar al mundo.',
            'boton_texto'  => 'Ver Más',
            'url'          => '#',
        ),
    );

    foreach ( range( 1, 3 ) as $n ) {
        $wp_customize->add_setting( "colegio_vida_estudiantil_card{$n}_imagen", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        if ( class_exists( 'WP_Customize_Image_Control' ) ) {
            $wp_customize->add_control( new WP_Customize_Image_Control(
                $wp_customize,
                "colegio_vida_estudiantil_card{$n}_imagen_control",
                array(
                    'label'    => __( "Card {$n} — Imagen", 'colegio-theme' ),
                    'section'  => 'colegio_inicio_vida_estudiantil',
                    'settings' => "colegio_vida_estudiantil_card{$n}_imagen",
                )
            ) );
        }

        $wp_customize->add_setting( "colegio_vida_estudiantil_card{$n}_titulo", array(
            'default'           => $vida_estudiantil_defaults[ $n ]['titulo'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_vida_estudiantil_card{$n}_titulo", array(
            'label'   => __( "Card {$n} — Título", 'colegio-theme' ),
            'section' => 'colegio_inicio_vida_estudiantil',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_vida_estudiantil_card{$n}_descripcion", array(
            'default'           => $vida_estudiantil_defaults[ $n ]['descripcion'],
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( "colegio_vida_estudiantil_card{$n}_descripcion", array(
            'label'   => __( "Card {$n} — Descripción", 'colegio-theme' ),
            'section' => 'colegio_inicio_vida_estudiantil',
            'type'    => 'textarea',
        ) );

        $wp_customize->add_setting( "colegio_vida_estudiantil_card{$n}_boton_texto", array(
            'default'           => $vida_estudiantil_defaults[ $n ]['boton_texto'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_vida_estudiantil_card{$n}_boton_texto", array(
            'label'   => __( "Card {$n} — Texto del botón", 'colegio-theme' ),
            'section' => 'colegio_inicio_vida_estudiantil',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_vida_estudiantil_card{$n}_url", array(
            'default'           => $vida_estudiantil_defaults[ $n ]['url'],
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "colegio_vida_estudiantil_card{$n}_url", array(
            'label'   => __( "Card {$n} — URL del botón", 'colegio-theme' ),
            'section' => 'colegio_inicio_vida_estudiantil',
            'type'    => 'url',
        ) );
    }

    // ── Sección: Noticias y Eventos ─────────────────────────────────
    $wp_customize->add_section( 'colegio_inicio_noticias_eventos', array(
        'title'    => __( 'Sección 8 — Noticias y Eventos', 'colegio-theme' ),
        'panel'    => 'colegio_panel_inicio',
        'priority' => 44,
    ) );

    $wp_customize->add_setting( 'colegio_noticias_eventos_titulo', array(
        'default'           => 'Noticias y Eventos',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_noticias_eventos_titulo', array(
        'label'   => __( 'Título de la sección', 'colegio-theme' ),
        'section' => 'colegio_inicio_noticias_eventos',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_noticias_etiqueta', array(
        'default'           => 'Noticias',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_noticias_etiqueta', array(
        'label'   => __( 'Etiqueta de columna izquierda', 'colegio-theme' ),
        'section' => 'colegio_inicio_noticias_eventos',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'colegio_eventos_etiqueta', array(
        'default'           => 'Eventos',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'colegio_eventos_etiqueta', array(
        'label'   => __( 'Etiqueta de columna derecha', 'colegio-theme' ),
        'section' => 'colegio_inicio_noticias_eventos',
        'type'    => 'text',
    ) );

    $noticias_defaults = array(
        1 => array(
            'titulo'      => 'Título de noticia',
            'descripcion' => 'El egresado domina el idioma inglés con precisión académica y fluidez social. Es capaz de investigar, redactar y debatir ideas complejas en dos idiomas, permitiéndole navegar con éxito en entornos educativos internacionales.',
            'boton_texto' => 'Ver Más',
            'url'         => '#',
        ),
        2 => array(
            'titulo'      => 'Título de noticia',
            'descripcion' => 'El egresado domina el idioma inglés con precisión académica y fluidez social. Es capaz de investigar, redactar y debatir ideas complejas en dos idiomas, permitiéndole navegar con éxito en entornos educativos internacionales.',
            'boton_texto' => 'Ver Más',
            'url'         => '#',
        ),
    );

    foreach ( range( 1, 2 ) as $n ) {
        $wp_customize->add_setting( "colegio_noticia{$n}_imagen", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        if ( class_exists( 'WP_Customize_Image_Control' ) ) {
            $wp_customize->add_control( new WP_Customize_Image_Control(
                $wp_customize,
                "colegio_noticia{$n}_imagen_control",
                array(
                    'label'    => __( "Noticia {$n} — Imagen", 'colegio-theme' ),
                    'section'  => 'colegio_inicio_noticias_eventos',
                    'settings' => "colegio_noticia{$n}_imagen",
                )
            ) );
        }

        $wp_customize->add_setting( "colegio_noticia{$n}_titulo", array(
            'default'           => $noticias_defaults[ $n ]['titulo'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_noticia{$n}_titulo", array(
            'label'   => __( "Noticia {$n} — Título", 'colegio-theme' ),
            'section' => 'colegio_inicio_noticias_eventos',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_noticia{$n}_descripcion", array(
            'default'           => $noticias_defaults[ $n ]['descripcion'],
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( "colegio_noticia{$n}_descripcion", array(
            'label'   => __( "Noticia {$n} — Descripción", 'colegio-theme' ),
            'section' => 'colegio_inicio_noticias_eventos',
            'type'    => 'textarea',
        ) );

        $wp_customize->add_setting( "colegio_noticia{$n}_boton_texto", array(
            'default'           => $noticias_defaults[ $n ]['boton_texto'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_noticia{$n}_boton_texto", array(
            'label'   => __( "Noticia {$n} — Texto del botón", 'colegio-theme' ),
            'section' => 'colegio_inicio_noticias_eventos',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_noticia{$n}_url", array(
            'default'           => $noticias_defaults[ $n ]['url'],
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "colegio_noticia{$n}_url", array(
            'label'   => __( "Noticia {$n} — URL del botón", 'colegio-theme' ),
            'section' => 'colegio_inicio_noticias_eventos',
            'type'    => 'url',
        ) );
    }

    $eventos_defaults = array(
        1 => array(
            'mes'         => 'mar',
            'dia'         => '12',
            'titulo'      => 'Evento 1',
            'descripcion' => 'Pequeña información del evento.',
            'url'         => '#',
        ),
        2 => array(
            'mes'         => 'mar',
            'dia'         => '12',
            'titulo'      => 'Evento 1',
            'descripcion' => 'Pequeña información del evento.',
            'url'         => '#',
        ),
        3 => array(
            'mes'         => 'mar',
            'dia'         => '12',
            'titulo'      => 'Evento 1',
            'descripcion' => 'Pequeña información del evento.',
            'url'         => '#',
        ),
    );

    foreach ( range( 1, 3 ) as $n ) {
        $wp_customize->add_setting( "colegio_evento{$n}_mes", array(
            'default'           => $eventos_defaults[ $n ]['mes'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_evento{$n}_mes", array(
            'label'   => __( "Evento {$n} — Mes corto", 'colegio-theme' ),
            'section' => 'colegio_inicio_noticias_eventos',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_evento{$n}_dia", array(
            'default'           => $eventos_defaults[ $n ]['dia'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_evento{$n}_dia", array(
            'label'   => __( "Evento {$n} — Día", 'colegio-theme' ),
            'section' => 'colegio_inicio_noticias_eventos',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_evento{$n}_titulo", array(
            'default'           => $eventos_defaults[ $n ]['titulo'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "colegio_evento{$n}_titulo", array(
            'label'   => __( "Evento {$n} — Título", 'colegio-theme' ),
            'section' => 'colegio_inicio_noticias_eventos',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "colegio_evento{$n}_descripcion", array(
            'default'           => $eventos_defaults[ $n ]['descripcion'],
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( "colegio_evento{$n}_descripcion", array(
            'label'   => __( "Evento {$n} — Descripción", 'colegio-theme' ),
            'section' => 'colegio_inicio_noticias_eventos',
            'type'    => 'textarea',
        ) );

        $wp_customize->add_setting( "colegio_evento{$n}_url", array(
            'default'           => $eventos_defaults[ $n ]['url'],
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "colegio_evento{$n}_url", array(
            'label'   => __( "Evento {$n} — URL", 'colegio-theme' ),
            'section' => 'colegio_inicio_noticias_eventos',
            'type'    => 'url',
        ) );
    }

    // ── Sección: Programas ──────────────────────────────────────────
    $wp_customize->add_section( 'colegio_inicio_programas', array(
        'title'    => __( 'Sección 9 — Programas', 'colegio-theme' ),
        'panel'    => 'colegio_panel_inicio',
        'priority' => 46,
    ) );

    $wp_customize->add_setting( 'colegio_programs_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_programs_bg_control', array(
            'label'    => __( 'Imagen de fondo', 'colegio-theme' ),
            'section'  => 'colegio_inicio_programas',
            'settings' => 'colegio_programs_bg',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_programs_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_programs_logo_control', array(
            'label'    => __( 'Logo / sello superpuesto', 'colegio-theme' ),
            'section'  => 'colegio_inicio_programas',
            'settings' => 'colegio_programs_logo',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_info_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'colegio_info_url', array(
        'label'   => __( 'URL — Botón "Solicita más información"', 'colegio-theme' ),
        'section' => 'colegio_inicio_programas',
        'type'    => 'url',
    ) );

    // ════════════════════════════════════════════════════════════════
    // PANEL: Página de Contacto  (template: page-contacto.php)
    // ════════════════════════════════════════════════════════════════
    $wp_customize->add_panel( 'colegio_panel_contacto', array(
        'title'    => __( 'Página de Contacto', 'colegio-theme' ),
        'priority' => 30,
    ) );

    // ── Sección: Formulario ─────────────────────────────────────────
    $wp_customize->add_section( 'colegio_contacto_formulario', array(
        'title'    => __( 'Sección 1 — Formulario', 'colegio-theme' ),
        'panel'    => 'colegio_panel_contacto',
        'priority' => 10,
    ) );

    $wp_customize->add_setting( 'colegio_contacto_img_superior', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_contacto_img_superior_control', array(
            'label'       => __( 'Imagen superior', 'colegio-theme' ),
            'description' => __( 'Se muestra centrada arriba del formulario.', 'colegio-theme' ),
            'section'     => 'colegio_contacto_formulario',
            'settings'    => 'colegio_contacto_img_superior',
        ) ) );
    }

    $wp_customize->add_setting( 'colegio_contacto_img_inferior', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    if ( class_exists( 'WP_Customize_Image_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'colegio_contacto_img_inferior_control', array(
            'label'       => __( 'Imagen inferior', 'colegio-theme' ),
            'description' => __( 'Se muestra centrada debajo del formulario.', 'colegio-theme' ),
            'section'     => 'colegio_contacto_formulario',
            'settings'    => 'colegio_contacto_img_inferior',
        ) ) );
    }

    // ════════════════════════════════════════════════════════════════
    // PANEL: Integraciones
    // Servicios externos conectados al sitio.
    // ════════════════════════════════════════════════════════════════
    $wp_customize->add_panel( 'colegio_panel_integraciones', array(
        'title'    => __( 'Integraciones', 'colegio-theme' ),
        'priority' => 100,
    ) );

    // ── Sección: Zapier ─────────────────────────────────────────────
    $wp_customize->add_section( 'colegio_integraciones', array(
        'title'       => __( 'Zapier', 'colegio-theme' ),
        'description' => __( 'Conecta el formulario de contacto con Zapier.', 'colegio-theme' ),
        'panel'       => 'colegio_panel_integraciones',
        'priority'    => 10,
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
