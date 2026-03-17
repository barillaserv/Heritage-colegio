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

    $programs_bg = get_theme_mod( 'colegio_programs_bg' );
    if ( ! $programs_bg ) {
        $programs_bg = get_template_directory_uri() . '/programs-bg.jpg';
    }

    $programs_logo = get_theme_mod( 'colegio_programs_logo' );

    // URLs configurables desde el Personalizador
    $contactanos_url = get_theme_mod( 'colegio_contactanos_url', '#' );
    $info_url        = get_theme_mod( 'colegio_info_url', '#' );
    $facebook_url    = get_theme_mod( 'colegio_facebook_url', '#' );
    $instagram_url   = get_theme_mod( 'colegio_instagram_url', '#' );
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

    <!-- Sección 3: Programas académicos con imagen de fondo + footer integrado -->
    <section class="programs-section" style="background-image: url('<?php echo esc_url( $programs_bg ); ?>');">
        <div class="programs-overlay">

            <?php if ( $programs_logo ) : ?>
                <div class="programs-logo-img">
                    <img src="<?php echo esc_url( $programs_logo ); ?>" alt="Logo">
                </div>
            <?php endif; ?>

            <div class="programs-container">
                <div class="program-box">
                    <h3 class="program-title">Early Childhood</h3>
                    <p class="program-subtitle">Pre Kinder a Preparatoria</p>
                    <p class="program-description">
                        Desarrollo psicomotriz y primer contacto natural con el inglés. Sembrando curiosidad en libertad.
                    </p>
                </div>
                
                <div class="program-box">
                    <h3 class="program-title">Elementary</h3>
                    <p class="program-subtitle">Primaria 1° a 6° Grado</p>
                    <p class="program-description">
                        Excelencia en lectoescritura bilingüe y pensamiento lógico.
                    </p>
                </div>
                
                <div class="program-box">
                    <h3 class="program-title">Middle School</h3>
                    <p class="program-subtitle">Básicos 1º a 3º Básico</p>
                    <p class="program-description">
                        Investigación, debate y uso ético de la tecnología para resolver problemas reales.
                    </p>
                </div>
            </div>

            <div class="programs-cta">
                <a href="<?php echo esc_url( $info_url ); ?>" class="btn-info">SOLICITA MÁS INFORMACIÓN AQUÍ</a>
            </div>

            <footer class="main-footer">
                <h4 class="footer-title">SÍGUENOS</h4>
                <div class="social-icons">
                    <a href="<?php echo esc_url( $facebook_url ); ?>" class="social-icon facebook" aria-label="Facebook" target="_blank" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20" height="20"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="<?php echo esc_url( $instagram_url ); ?>" class="social-icon instagram" aria-label="Instagram" target="_blank" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                </div>
            </footer>

        </div>
    </section>

    <?php wp_footer(); ?>
</body>
</html>
