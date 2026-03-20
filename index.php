<?php get_header(); ?>

<?php
$hero_bg = get_theme_mod( 'colegio_hero_bg' );
if ( ! $hero_bg ) {
    $hero_bg = get_template_directory_uri() . '/hero-bg.jpg';
}

$admisiones_texto = get_theme_mod( 'colegio_hero_admisiones_texto', 'ADMISIONES ABIERTAS' );
$admisiones_url   = get_theme_mod( 'colegio_hero_admisiones_url', '#' );

$sobre_titulo      = get_theme_mod( 'colegio_sobre_titulo', 'Heritage American School' );
$sobre_descripcion = get_theme_mod( 'colegio_sobre_descripcion', 'Nuestro enfoque combina rigor académico internacional, formación deportiva de alto nivel y tecnología del futuro. Formamos líderes con carácter firme, mentalidad global y raíces profundas en sus valores.' );

$sobre_slides = array();
foreach ( range( 1, 3 ) as $n ) {
    $sobre_slides[] = array(
        'imagen'      => get_theme_mod( "colegio_sobre_slide{$n}_imagen", '' ),
        'titulo'      => get_theme_mod( "colegio_sobre_slide{$n}_titulo", '' ),
        'descripcion' => get_theme_mod( "colegio_sobre_slide{$n}_descripcion", '' ),
        'url'         => get_theme_mod( "colegio_sobre_slide{$n}_url", '#' ),
    );
}

$valores_titulo    = get_theme_mod( 'colegio_valores_titulo', 'NUESTROS VALORES' );
$valores_imagen_izq = get_theme_mod( 'colegio_valores_imagen_izq', '' );
$valores_slides = array();
foreach ( range( 1, 2 ) as $n ) {
    $valores_slides[] = array(
        'imagen'      => get_theme_mod( "colegio_valores_slide{$n}_imagen", '' ),
        'titulo'      => get_theme_mod( "colegio_valores_slide{$n}_titulo", '' ),
        'descripcion' => get_theme_mod( "colegio_valores_slide{$n}_descripcion", '' ),
    );
}

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
        <a href="<?php echo esc_url( $admisiones_url ); ?>" class="btn-admisiones"><?php echo esc_html( $admisiones_texto ); ?></a>
    </div>
</section>

<!-- Sección 2: Sobre nosotros -->
<section class="about-section">
    <div class="about-header">
        <h2 class="section-title"><?php echo esc_html( $sobre_titulo ); ?></h2>
        <p class="section-description"><?php echo esc_html( $sobre_descripcion ); ?></p>
    </div>

    <div class="about-slider-wrapper">
        <div class="about-slider" id="aboutSlider">
            <?php foreach ( $sobre_slides as $i => $slide ) :
                if ( empty( $slide['imagen'] ) && empty( $slide['titulo'] ) && empty( $slide['descripcion'] ) ) continue;
            ?>
            <div class="about-slide<?php echo $i === 0 ? ' active' : ''; ?>">
                <div class="about-slide-inner">
                    <?php if ( $slide['imagen'] ) : ?>
                    <div class="about-slide-img">
                        <img src="<?php echo esc_url( $slide['imagen'] ); ?>" alt="<?php echo esc_attr( $slide['titulo'] ); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="about-slide-card">
                        <?php if ( $slide['titulo'] ) : ?>
                        <h3 class="about-slide-title"><?php echo esc_html( $slide['titulo'] ); ?></h3>
                        <?php endif; ?>
                        <?php if ( $slide['descripcion'] ) : ?>
                        <p class="about-slide-desc"><?php echo esc_html( $slide['descripcion'] ); ?></p>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( $slide['url'] ); ?>" class="about-slide-arrow" aria-label="Ver más">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="about-controls">
            <button class="about-nav about-nav-prev" id="aboutPrev" aria-label="Anterior">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            <div class="about-dots" id="aboutDots">
                <?php foreach ( $sobre_slides as $i => $slide ) :
                    if ( empty( $slide['imagen'] ) && empty( $slide['titulo'] ) && empty( $slide['descripcion'] ) ) continue;
                ?>
                <button class="about-dot<?php echo $i === 0 ? ' active' : ''; ?>" data-index="<?php echo $i; ?>">
                    <?php echo str_pad( $i + 1, 2, '0', STR_PAD_LEFT ); ?>
                </button>
                <?php endforeach; ?>
            </div>
            <button class="about-nav about-nav-next" id="aboutNext" aria-label="Siguiente">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 6 15 12 9 18"/></svg>
            </button>
        </div>
    </div>
</section>

<!-- Sección 3: Nuestros Valores -->
<section class="valores-section">
    <h2 class="valores-titulo"><?php echo esc_html( $valores_titulo ); ?></h2>

    <div class="valores-body">
        <button class="valores-nav valores-nav-prev" id="valoresPrev" aria-label="Anterior">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
        </button>

        <div class="valores-main">
            <!-- Imagen izquierda fija -->
            <?php if ( $valores_imagen_izq ) : ?>
            <div class="valores-img-izq">
                <img src="<?php echo esc_url( $valores_imagen_izq ); ?>" alt="<?php echo esc_attr( $valores_titulo ); ?>">
            </div>
            <?php endif; ?>

            <!-- Slides -->
            <div class="valores-slider" id="valoresSlider">
                <?php foreach ( $valores_slides as $i => $slide ) : ?>
                <div class="valores-slide<?php echo $i === 0 ? ' active' : ''; ?>">
                    <div class="valores-card">
                        <?php if ( $slide['imagen'] ) : ?>
                        <div class="valores-card-img">
                            <img src="<?php echo esc_url( $slide['imagen'] ); ?>" alt="<?php echo esc_attr( $slide['titulo'] ); ?>">
                            <span class="valores-card-num"><?php echo str_pad( $i + 1, 2, '0', STR_PAD_LEFT ); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if ( $slide['titulo'] ) : ?>
                        <p class="valores-card-titulo"><?php echo esc_html( $slide['titulo'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <button class="valores-nav valores-nav-next" id="valoresNext" aria-label="Siguiente">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 6 15 12 9 18"/></svg>
        </button>
    </div>

    <!-- Descripción por slide -->
    <div class="valores-desc-wrapper" id="valoresDescWrapper">
        <?php foreach ( $valores_slides as $i => $slide ) : ?>
        <div class="valores-desc<?php echo $i === 0 ? ' active' : ''; ?>">
            <?php echo esc_html( $slide['descripcion'] ); ?>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Sección 7: Programas académicos -->
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
