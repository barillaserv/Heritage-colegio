<?php get_header(); ?>

<?php
$hero_bg = get_theme_mod( 'colegio_hero_bg' );
if ( ! $hero_bg ) {
    $hero_bg = get_template_directory_uri() . '/hero-bg.jpg';
}

$admisiones_url = get_theme_mod( 'colegio_hero_admisiones_url', '#' );

$programs_bg = get_theme_mod( 'colegio_programs_bg' );
if ( ! $programs_bg ) {
    $programs_bg = get_template_directory_uri() . '/programs-bg.jpg';
}

$programs_logo = get_theme_mod( 'colegio_programs_logo' );
$info_url      = get_theme_mod( 'colegio_info_url', '#' );
?>

<!-- Sección 1: Hero -->
<section class="hero-section" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
    <div class="hero-content">
        <h1 class="hero-title">Formando líderes ciudadanos del mundo con raíces firmes y visión global.</h1>
        <a href="<?php echo esc_url( $admisiones_url ); ?>" class="btn-admisiones">ADMISIONES ABIERTAS</a>
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

<!-- Sección 3: Programas académicos -->
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

    </div>
</section>

<?php get_footer(); ?>
