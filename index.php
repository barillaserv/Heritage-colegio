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

        <?php get_footer(); ?>
