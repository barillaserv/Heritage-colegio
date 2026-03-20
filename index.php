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

$modelo_titulo          = get_theme_mod( 'colegio_modelo_titulo', 'Modelo Educativo Internacional' );
$modelo_banner_bg       = get_theme_mod( 'colegio_modelo_banner_bg', '' );
$modelo_banner_texto    = get_theme_mod( 'colegio_modelo_banner_texto', '' );
$modelo_banner_btn_txt  = get_theme_mod( 'colegio_modelo_banner_btn_texto', '¿Cómo funciona nuestro modelo?' );
$modelo_banner_btn_url  = get_theme_mod( 'colegio_modelo_banner_btn_url', '#' );
$modelo_barra_logo      = get_theme_mod( 'colegio_modelo_barra_logo', '' );
$modelo_barra_titulo    = get_theme_mod( 'colegio_modelo_barra_titulo', 'CIUDADANOS GLOBALES' );
$modelo_barra_desc      = get_theme_mod( 'colegio_modelo_barra_descripcion', '' );
$modelo_barra_btn_txt   = get_theme_mod( 'colegio_modelo_barra_btn_texto', 'CONOCE MÁS' );
$modelo_barra_btn_url   = get_theme_mod( 'colegio_modelo_barra_btn_url', '#' );

$niveles_titulo = get_theme_mod( 'colegio_niveles_titulo', 'Niveles Académicos' );
$niveles_cards  = array();
foreach ( range( 1, 3 ) as $n ) {
    $niveles_cards[] = array(
        'imagen'      => get_theme_mod( "colegio_niveles_card{$n}_imagen", '' ),
        'titulo'      => get_theme_mod( "colegio_niveles_card{$n}_titulo", '' ),
        'subtitulo'   => get_theme_mod( "colegio_niveles_card{$n}_subtitulo", '' ),
        'descripcion' => get_theme_mod( "colegio_niveles_card{$n}_descripcion", '' ),
        'url'         => get_theme_mod( "colegio_niveles_card{$n}_url", '#' ),
    );
}

$campus_label  = get_theme_mod( 'colegio_campus_label', 'NUESTRO CAMPUS' );
$campus_titulo = get_theme_mod( 'colegio_campus_titulo', 'Un entorno para la grandeza' );
$campus_slides = array();
foreach ( range( 1, 3 ) as $n ) {
    $campus_slides[] = array(
        'imagen'    => get_theme_mod( "colegio_campus_slide{$n}_imagen", '' ),
        'titulo'    => get_theme_mod( "colegio_campus_slide{$n}_titulo", '' ),
        'btn_texto' => get_theme_mod( "colegio_campus_slide{$n}_btn_texto", 'Más información' ),
        'btn_url'   => get_theme_mod( "colegio_campus_slide{$n}_btn_url", '#' ),
    );
}

$vida_estudiantil_titulo = get_theme_mod( 'colegio_vida_estudiantil_titulo', 'Vida estudiantil' );
$vida_estudiantil_descripcion = get_theme_mod( 'colegio_vida_estudiantil_descripcion', 'Formación Integral en Acción. La educación en Heritage no termina al sonar el timbre. Creemos que el carácter se forja en la cancha, en el escenario y en la variedad de los clubes que se ofrecen.' );
$vida_estudiantil_defaults = array(
    1 => array(
        'titulo'      => 'Deportes y Clubes',
        'descripcion' => 'Nuestras canchas deportivas no son solo espacios de recreación; son laboratorios de liderazgo.',
        'boton_texto' => 'Ver Más',
        'url'         => '#',
    ),
    2 => array(
        'titulo'      => 'Alianza Familia-Colegio',
        'descripcion' => 'Socios en el Crecimiento. En Heritage American School, estamos convencidos de que el éxito de nuestros estudiantes nace de una alianza inquebrantable entre el hogar y el colegio.',
        'boton_texto' => 'Ver Más',
        'url'         => '#',
    ),
    3 => array(
        'titulo'      => 'Salud y bienestar socio emocional',
        'descripcion' => 'En Heritage, el éxito no se mide solo por las calificaciones, sino por la capacidad de nuestros estudiantes para aportar al mundo.',
        'boton_texto' => 'Ver Más',
        'url'         => '#',
    ),
);
$vida_estudiantil_cards = array();
foreach ( range( 1, 3 ) as $n ) {
    $vida_estudiantil_cards[] = array(
        'imagen'      => get_theme_mod( "colegio_vida_estudiantil_card{$n}_imagen", '' ),
        'titulo'      => get_theme_mod( "colegio_vida_estudiantil_card{$n}_titulo", $vida_estudiantil_defaults[ $n ]['titulo'] ),
        'descripcion' => get_theme_mod( "colegio_vida_estudiantil_card{$n}_descripcion", $vida_estudiantil_defaults[ $n ]['descripcion'] ),
        'boton_texto' => get_theme_mod( "colegio_vida_estudiantil_card{$n}_boton_texto", $vida_estudiantil_defaults[ $n ]['boton_texto'] ),
        'url'         => get_theme_mod( "colegio_vida_estudiantil_card{$n}_url", $vida_estudiantil_defaults[ $n ]['url'] ),
    );
}

$noticias_eventos_titulo   = get_theme_mod( 'colegio_noticias_eventos_titulo', 'Noticias y Eventos' );
$noticias_etiqueta         = get_theme_mod( 'colegio_noticias_etiqueta', 'Noticias' );
$eventos_etiqueta          = get_theme_mod( 'colegio_eventos_etiqueta', 'Eventos' );
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
$noticias_items = array();
foreach ( range( 1, 2 ) as $n ) {
    $noticias_items[] = array(
        'imagen'      => get_theme_mod( "colegio_noticia{$n}_imagen", '' ),
        'titulo'      => get_theme_mod( "colegio_noticia{$n}_titulo", $noticias_defaults[ $n ]['titulo'] ),
        'descripcion' => get_theme_mod( "colegio_noticia{$n}_descripcion", $noticias_defaults[ $n ]['descripcion'] ),
        'boton_texto' => get_theme_mod( "colegio_noticia{$n}_boton_texto", $noticias_defaults[ $n ]['boton_texto'] ),
        'url'         => get_theme_mod( "colegio_noticia{$n}_url", $noticias_defaults[ $n ]['url'] ),
    );
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
$eventos_items = array();
foreach ( range( 1, 3 ) as $n ) {
    $eventos_items[] = array(
        'mes'         => get_theme_mod( "colegio_evento{$n}_mes", $eventos_defaults[ $n ]['mes'] ),
        'dia'         => get_theme_mod( "colegio_evento{$n}_dia", $eventos_defaults[ $n ]['dia'] ),
        'titulo'      => get_theme_mod( "colegio_evento{$n}_titulo", $eventos_defaults[ $n ]['titulo'] ),
        'descripcion' => get_theme_mod( "colegio_evento{$n}_descripcion", $eventos_defaults[ $n ]['descripcion'] ),
        'url'         => get_theme_mod( "colegio_evento{$n}_url", $eventos_defaults[ $n ]['url'] ),
    );
}

$programs_bg = get_theme_mod( 'colegio_programs_bg' );
if ( ! $programs_bg ) {
    $programs_bg = get_template_directory_uri() . '/programs-bg.jpg';
}

$programs_titulo   = get_theme_mod( 'colegio_programs_titulo', 'Formando líderes ciudadanos del mundo con raíces firmes y visión global.' );
$programs_cta_text = get_theme_mod( 'colegio_programs_cta_texto', 'ADMISIONES ABIERTAS' );
$info_url          = get_theme_mod( 'colegio_info_url', '#' );
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

<!-- Sección 4: Modelo Educativo -->
<section class="modelo-section">

    <!-- Título superior -->
    <div class="modelo-header">
        <h2 class="modelo-titulo"><?php echo esc_html( $modelo_titulo ); ?></h2>
    </div>

    <!-- Banner con imagen de fondo -->
    <div class="modelo-banner"<?php if ( $modelo_banner_bg ) echo ' style="background-image:url(\'' . esc_url( $modelo_banner_bg ) . '\')"'; ?>>
        <div class="modelo-banner-overlay">
            <?php if ( $modelo_banner_texto ) : ?>
            <p class="modelo-banner-texto"><?php echo esc_html( $modelo_banner_texto ); ?></p>
            <?php endif; ?>
            <a href="<?php echo esc_url( $modelo_banner_btn_url ); ?>" class="modelo-banner-btn">
                <?php echo esc_html( $modelo_banner_btn_txt ); ?>
            </a>
        </div>
    </div>

    <!-- Barra inferior oscura -->
    <div class="modelo-barra">
        <?php if ( $modelo_barra_logo ) : ?>
        <div class="modelo-barra-logo">
            <img src="<?php echo esc_url( $modelo_barra_logo ); ?>" alt="<?php echo esc_attr( $modelo_barra_titulo ); ?>">
        </div>
        <?php endif; ?>
        <div class="modelo-barra-texto">
            <p class="modelo-barra-titulo"><?php echo esc_html( $modelo_barra_titulo ); ?></p>
            <?php if ( $modelo_barra_desc ) : ?>
            <p class="modelo-barra-desc"><?php echo esc_html( $modelo_barra_desc ); ?></p>
            <?php endif; ?>
        </div>
        <a href="<?php echo esc_url( $modelo_barra_btn_url ); ?>" class="modelo-barra-btn">
            <?php echo esc_html( $modelo_barra_btn_txt ); ?>
        </a>
    </div>

</section>

<!-- Sección 5: Niveles Académicos -->
<section class="niveles-section">
    <h2 class="niveles-titulo"><?php echo esc_html( $niveles_titulo ); ?></h2>

    <div class="niveles-grid">
        <?php foreach ( $niveles_cards as $card ) : ?>
        <a href="<?php echo esc_url( $card['url'] ); ?>" class="nivel-card">
            <?php if ( $card['imagen'] ) : ?>
            <div class="nivel-card-img">
                <img src="<?php echo esc_url( $card['imagen'] ); ?>" alt="<?php echo esc_attr( $card['titulo'] ); ?>">
            </div>
            <?php endif; ?>
            <div class="nivel-card-body">
                <div class="nivel-card-info">
                    <?php if ( $card['titulo'] ) : ?>
                    <p class="nivel-card-titulo"><?php echo esc_html( $card['titulo'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( $card['subtitulo'] ) : ?>
                    <p class="nivel-card-subtitulo"><?php echo esc_html( $card['subtitulo'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( $card['descripcion'] ) : ?>
                    <p class="nivel-card-desc"><?php echo esc_html( $card['descripcion'] ); ?></p>
                    <?php endif; ?>
                </div>
                <span class="nivel-card-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Sección 6: Nuestro Campus -->
<section class="campus-section">

    <!-- Cabecera oscura -->
    <div class="campus-header">
        <p class="campus-label"><?php echo esc_html( $campus_label ); ?></p>
        <h2 class="campus-titulo"><?php echo esc_html( $campus_titulo ); ?></h2>
    </div>

    <!-- Carrusel con peek lateral -->
    <div class="campus-carousel-outer">
        <div class="campus-track" id="campusTrack">
            <?php foreach ( $campus_slides as $i => $slide ) : ?>
            <div class="campus-slide" style="<?php if ( $slide['imagen'] ) echo 'background-image:url(\'' . esc_url( $slide['imagen'] ) . '\')'; ?>">
                <div class="campus-slide-content">
                    <?php if ( $slide['titulo'] ) : ?>
                    <p class="campus-slide-titulo"><?php echo esc_html( $slide['titulo'] ); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( $slide['btn_url'] ); ?>" class="campus-slide-btn">
                        <?php echo esc_html( $slide['btn_texto'] ); ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</section>

<!-- Sección 7: Vida estudiantil -->
<section class="vida-estudiantil-section">
    <div class="vida-estudiantil-header">
        <h2 class="vida-estudiantil-titulo"><?php echo esc_html( $vida_estudiantil_titulo ); ?></h2>
        <p class="vida-estudiantil-descripcion"><?php echo esc_html( $vida_estudiantil_descripcion ); ?></p>
    </div>

    <div class="vida-estudiantil-cards">
        <?php foreach ( $vida_estudiantil_cards as $card ) : ?>
            <article class="vida-estudiantil-card">
                <div class="vida-estudiantil-card-image">
                    <?php if ( $card['imagen'] ) : ?>
                        <img src="<?php echo esc_url( $card['imagen'] ); ?>" alt="<?php echo esc_attr( $card['titulo'] ); ?>">
                    <?php endif; ?>
                </div>
                <div class="vida-estudiantil-card-content">
                    <?php if ( $card['titulo'] ) : ?>
                        <h3 class="vida-estudiantil-card-titulo"><?php echo esc_html( $card['titulo'] ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $card['descripcion'] ) : ?>
                        <p class="vida-estudiantil-card-descripcion"><?php echo esc_html( $card['descripcion'] ); ?></p>
                    <?php endif; ?>
                    <a class="vida-estudiantil-card-link" href="<?php echo esc_url( $card['url'] ); ?>">
                        <?php echo esc_html( $card['boton_texto'] ); ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- Sección 8: Noticias y Eventos -->
<section class="noticias-eventos-section">
    <div class="noticias-eventos-header">
        <h2 class="noticias-eventos-titulo"><?php echo esc_html( $noticias_eventos_titulo ); ?></h2>
    </div>

    <div class="noticias-eventos-grid">
        <div class="noticias-columna">
            <p class="noticias-eventos-etiqueta"><?php echo esc_html( $noticias_etiqueta ); ?></p>

            <?php foreach ( $noticias_items as $item ) : ?>
                <article class="noticia-item">
                    <div class="noticia-item-imagen">
                        <?php if ( $item['imagen'] ) : ?>
                            <img src="<?php echo esc_url( $item['imagen'] ); ?>" alt="<?php echo esc_attr( $item['titulo'] ); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="noticia-item-contenido">
                        <h3 class="noticia-item-titulo"><?php echo esc_html( $item['titulo'] ); ?></h3>
                        <p class="noticia-item-descripcion"><?php echo esc_html( $item['descripcion'] ); ?></p>
                        <a class="noticia-item-link" href="<?php echo esc_url( $item['url'] ); ?>">
                            <?php echo esc_html( $item['boton_texto'] ); ?>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="eventos-columna">
            <p class="noticias-eventos-etiqueta"><?php echo esc_html( $eventos_etiqueta ); ?></p>

            <div class="eventos-lista">
                <?php foreach ( $eventos_items as $evento ) : ?>
                    <article class="evento-item">
                        <div class="evento-fecha">
                            <span class="evento-mes"><?php echo esc_html( $evento['mes'] ); ?></span>
                            <span class="evento-dia"><?php echo esc_html( $evento['dia'] ); ?></span>
                        </div>
                        <div class="evento-contenido">
                            <h3 class="evento-titulo"><?php echo esc_html( $evento['titulo'] ); ?></h3>
                            <p class="evento-descripcion"><?php echo esc_html( $evento['descripcion'] ); ?></p>
                        </div>
                        <a class="evento-link" href="<?php echo esc_url( $evento['url'] ); ?>" aria-label="Ver evento">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Sección 9: Cierre / CTA (fondo editable + texto y botón en HTML) -->
<section class="programs-section" aria-label="<?php echo esc_attr__( 'Llamado a la acción', 'colegio-theme' ); ?>">
    <div class="programs-section__bg" style="background-image: url('<?php echo esc_url( $programs_bg ); ?>');"></div>
    <div class="programs-section__overlay" aria-hidden="true"></div>
    <div class="programs-section__content">
        <?php if ( $programs_titulo ) : ?>
            <h2 class="programs-headline"><?php echo esc_html( $programs_titulo ); ?></h2>
        <?php endif; ?>
        <?php if ( $programs_cta_text ) : ?>
            <a href="<?php echo esc_url( $info_url ); ?>" class="programs-cta-btn"><?php echo esc_html( $programs_cta_text ); ?></a>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
