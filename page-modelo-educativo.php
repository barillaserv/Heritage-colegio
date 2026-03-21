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

                <!-- Secciones adicionales: añadir aquí -->
                <?php
            endwhile;
            ?>
        </div>
    </main>

    <?php wp_footer(); ?>
</body>
</html>
