<?php
/**
 * Template Name: Modelo Educativo
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo Educativo – <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class('page-modelo-educativo'); ?>>

    <!-- Header transparente -->
    <header class="main-header scrolled">
        <div class="header-container">
            <div class="logo-container">
                <?php
                $custom_logo_id = get_theme_mod('custom_logo');
                if ($custom_logo_id) {
                    echo wp_get_attachment_image($custom_logo_id, 'full', false, array('class' => 'site-logo'));
                } else {
                    echo '<div class="logo-placeholder" style="color:#1a365d;">Logo</div>';
                }
                ?>
            </div>
            <div class="header-button">
                <a href="<?php echo esc_url( home_url('/') ); ?>" class="btn-back">← Volver al inicio</a>
            </div>
        </div>
    </header>

    <main class="modelo-educativo-page">
        <div class="modelo-educativo-wrapper">
            <?php
            while ( have_posts() ) :
                the_post();

                // ── Sección 1: Hero ──────────────────────────────────
                $me_s1_imagen    = get_theme_mod( 'colegio_me_s1_imagen', '' );
                $me_s1_titulo    = get_theme_mod( 'colegio_me_s1_titulo', 'Nuestro Modelo Educativo Internacional' );
                $me_s1_subtitulo = get_theme_mod( 'colegio_me_s1_subtitulo', 'Para asegurar un desarrollo cognitivo integral, distribuimos nuestra carga académica de la siguiente manera:' );
                ?>
                <section class="me-hero">
                    <?php if ( $me_s1_imagen ) : ?>
                        <img
                            class="me-hero__img"
                            src="<?php echo esc_url( $me_s1_imagen ); ?>"
                            alt="<?php echo esc_attr( $me_s1_titulo ); ?>"
                        >
                    <?php endif; ?>
                    <div class="me-hero__card">
                        <?php if ( $me_s1_titulo ) : ?>
                            <h1 class="me-hero__titulo"><?php echo esc_html( $me_s1_titulo ); ?></h1>
                        <?php endif; ?>
                        <?php if ( $me_s1_subtitulo ) : ?>
                            <p class="me-hero__subtitulo"><?php echo esc_html( $me_s1_subtitulo ); ?></p>
                        <?php endif; ?>
                    </div>
                </section>

                <?php if ( get_the_content() ) : ?>
                <div class="me-content">
                    <?php the_content(); ?>
                </div>
                <?php endif; ?>

                <?php
                // ── Sección 2: Sobre nosotros (tarjeta única) ───────
                $me_s2_titulo      = get_theme_mod( 'colegio_me_s2_titulo', 'Heritage American School' );
                $me_s2_descripcion = get_theme_mod( 'colegio_me_s2_descripcion', '' );
                $me_s2_card        = array(
                    'imagen'      => get_theme_mod( 'colegio_me_s2_slide1_imagen', '' ),
                    'titulo'      => get_theme_mod( 'colegio_me_s2_slide1_titulo', '' ),
                    'descripcion' => get_theme_mod( 'colegio_me_s2_slide1_descripcion', '' ),
                    'url'         => get_theme_mod( 'colegio_me_s2_slide1_url', '#' ),
                );
                $me_s2_card_visible = ! empty( $me_s2_card['imagen'] ) || ! empty( $me_s2_card['titulo'] ) || ! empty( $me_s2_card['descripcion'] );
                if ( $me_s2_titulo || $me_s2_descripcion || $me_s2_card_visible ) :
                ?>
                <section class="about-section me-s2-single">
                    <div class="about-header">
                        <?php if ( $me_s2_titulo ) : ?>
                        <h2 class="section-title"><?php echo esc_html( $me_s2_titulo ); ?></h2>
                        <?php endif; ?>
                        <?php if ( $me_s2_descripcion ) : ?>
                        <p class="section-description"><?php echo esc_html( $me_s2_descripcion ); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if ( $me_s2_card_visible ) : ?>
                    <div class="about-slider-wrapper">
                        <div class="about-slider">
                            <div class="about-slide active">
                                <div class="about-slide-inner">
                                    <?php if ( $me_s2_card['imagen'] ) : ?>
                                    <div class="about-slide-img">
                                        <img src="<?php echo esc_url( $me_s2_card['imagen'] ); ?>" alt="<?php echo esc_attr( $me_s2_card['titulo'] ); ?>">
                                    </div>
                                    <?php endif; ?>
                                    <div class="about-slide-card">
                                        <?php if ( $me_s2_card['titulo'] ) : ?>
                                        <h3 class="about-slide-title"><?php echo esc_html( $me_s2_card['titulo'] ); ?></h3>
                                        <?php endif; ?>
                                        <?php if ( $me_s2_card['descripcion'] ) : ?>
                                        <p class="about-slide-desc"><?php echo esc_html( $me_s2_card['descripcion'] ); ?></p>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( $me_s2_card['url'] ); ?>" class="about-slide-arrow" aria-label="Ver más">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </section>
                <?php endif; ?>
                <?php
            endwhile;
            ?>
        </div>
    </main>

    <?php get_footer(); ?>
