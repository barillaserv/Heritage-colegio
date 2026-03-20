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
    $custom_logo_id  = get_theme_mod( 'custom_logo' );
    $contactanos_url = get_theme_mod( 'colegio_contactanos_url', '#' );
    ?>

    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <?php
                if ( $custom_logo_id ) {
                    echo wp_get_attachment_image( $custom_logo_id, 'full', false, array( 'class' => 'site-logo' ) );
                } else {
                    echo '<div class="logo-placeholder">Logo</div>';
                }
                ?>
            </div>

            <?php
            wp_nav_menu( array(
                'theme_location' => 'header-menu',
                'container'      => 'nav',
                'container_class'=> 'header-nav',
                'container_id'   => 'headerNav',
                'menu_class'     => 'header-nav-list',
                'fallback_cb'    => false,
                'depth'          => 1,
            ) );
            ?>

            <div class="header-right">
                <button class="nav-toggle" id="navToggle" aria-label="<?php esc_attr_e( 'Abrir menú', 'colegio-theme' ); ?>" aria-expanded="false" aria-controls="headerNav">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <a href="<?php echo esc_url( $contactanos_url ); ?>" class="btn-contactanos">Contáctanos</a>
            </div>
        </div>
    </header>
