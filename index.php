<?php get_header(); ?>

<?php
// Imágenes de fondo configurables desde el Personalizador
$programs_bg = get_theme_mod( 'colegio_programs_bg' );
if ( ! $programs_bg ) {
    $programs_bg = get_template_directory_uri() . '/programs-bg.jpg';
}

$programs_logo = get_theme_mod( 'colegio_programs_logo' );

// URLs configurables desde el Personalizador
$info_url = get_theme_mod( 'colegio_info_url', '#' );
?>


        <?php get_footer(); ?>
