<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php
    // Imágenes de fondo configurables desde el Personalizador
    $hero_bg = get_theme_mod( 'colegio_hero_bg' );
    if ( ! $hero_bg ) {
        $hero_bg = get_template_directory_uri() . '/hero-bg.jpg';
    }

    $contactanos_url = get_theme_mod( 'colegio_contactanos_url', '#' );
    ?>

    <!-- Header transparente -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                if ($custom_logo_id) {
                    echo wp_get_attachment_image($custom_logo_id, 'full', false, array('class' => 'site-logo'));
                } else {
                    echo '<div class="logo-placeholder">Logo</div>';
                }
                ?>
            </div>
            <div class="header-button">
                <a href="<?php echo esc_url( $contactanos_url ); ?>" class="btn-contactanos">Contáctanos</a>
            </div>
        </div>
    </header>

    <!-- Sección 1: Hero con imagen de fondo -->
    <section class="hero-section" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
        <div class="hero-content">
            <h1 class="hero-title">Formando líderes ciudadanos del mundo con raíces firmes y visión global.</h1>
        </div>
    </section>

    <!-- Sección 2: Sobre la escuela -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">Heritage American School</h2>
            <p class="section-description">
                Nuestro enfoque combina rigor académico internacional, formación deportiva de alto nivel y tecnología del futuro. 
                Formamos líderes con carácter firme, mentalidad global y raíces profundas en sus valores.
            </p>
        </div>
    </section>
