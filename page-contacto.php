<?php
/**
 * Template Name: Página de Contacto
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto – <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class('page-contacto'); ?>>
    <?php
    $contacto_img_superior = get_theme_mod( 'colegio_contacto_img_superior', '' );
    $contacto_img_inferior = get_theme_mod( 'colegio_contacto_img_inferior', '' );
    ?>

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

    <!-- Formulario de contacto -->
    <main class="contact-page">
        <div class="contact-wrapper">

            <div class="contact-header">
                <div class="contact-header-badge">Admisiones 2027</div>
                <h1 class="contact-title">Heritage American School</h1>
                <p class="contact-subtitle">
                    En el Colegio Heritage American School su hijo se sumergirá en un ambiente educativo internacional y bilingüe.
                    Sabemos que elegir el colegio adecuado para su familia es una decisión importante.
                </p>
                <p class="contact-intro">
                    Complete el formulario y nuestro equipo de admisiones le contactará a la brevedad.
                </p>
            </div>

            <!-- Mensaje de éxito -->
            <div class="form-success" id="formSuccess">
                <div class="success-icon">✓</div>
                <h3>¡Gracias por interesarte en Heritage!</h3>
                <p>Nos estaremos comunicando contigo lo antes posible para brindarte mayor información sobre nuestra institución educativa.</p>
            </div>

            <?php if ( ! empty( $contacto_img_superior ) ) : ?>
                <div class="contact-form-image contact-form-image--top">
                    <img src="<?php echo esc_url( $contacto_img_superior ); ?>" alt="Imagen superior del formulario de contacto">
                </div>
            <?php endif; ?>

            <form class="contact-form" id="contactForm" novalidate>

                <p class="form-section-title">Datos de contacto</p>

                <div class="form-group">
                    <label for="nombre">Nombre del padre, madre o tutor <span class="required">*</span></label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección <span class="required">*</span></label>
                    <input type="text" id="direccion" name="direccion" placeholder="Dirección de residencia" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telefono">Teléfono <span class="required">*</span></label>
                        <input type="tel" id="telefono" name="telefono" placeholder="+502 0000-0000" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo electrónico <span class="required">*</span></label>
                        <input type="email" id="correo" name="correo" placeholder="correo@ejemplo.com" required>
                    </div>
                </div>

                <p class="form-section-title">Grado de interés — Ciclo escolar 2027 <span class="required">*</span></p>
                <p class="form-hint">Puede seleccionar uno o varios grados.</p>

                <div class="grades-container">

                    <div class="grade-group">
                        <div class="grade-group-title">Early Childhood</div>
                        <label class="checkbox-label">
                            <input type="checkbox" name="grados[]" value="PK">
                            <span class="checkbox-inner">
                                <span class="checkbox-check"></span>
                                <span class="checkbox-text">
                                    <span class="checkbox-name">Pre-Kinder</span>
                                    <span class="checkbox-age">4 años al 30 jun. 2027</span>
                                </span>
                            </span>
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="grados[]" value="Kinder">
                            <span class="checkbox-inner">
                                <span class="checkbox-check"></span>
                                <span class="checkbox-text">
                                    <span class="checkbox-name">Kinder</span>
                                    <span class="checkbox-age">5 años al 30 jun. 2027</span>
                                </span>
                            </span>
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="grados[]" value="Preparatoria">
                            <span class="checkbox-inner">
                                <span class="checkbox-check"></span>
                                <span class="checkbox-text">
                                    <span class="checkbox-name">Preparatoria</span>
                                    <span class="checkbox-age">6 años al 30 jun. 2027</span>
                                </span>
                            </span>
                        </label>
                    </div>

                    <div class="grade-group">
                        <div class="grade-group-title">Elementary</div>
                        <?php
                        $grados_elem = ['1er Grado','2do Grado','3er Grado','4to Grado','5to Grado','6to Grado'];
                        foreach ($grados_elem as $g) : ?>
                        <label class="checkbox-label">
                            <input type="checkbox" name="grados[]" value="<?php echo esc_attr($g); ?>">
                            <span class="checkbox-inner">
                                <span class="checkbox-check"></span>
                                <span class="checkbox-text">
                                    <span class="checkbox-name"><?php echo esc_html($g); ?></span>
                                </span>
                            </span>
                        </label>
                        <?php endforeach; ?>
                    </div>

                    <div class="grade-group">
                        <div class="grade-group-title">Middle School</div>
                        <?php
                        $grados_ms = ['1ro Básico','2do Básico','3ro Básico'];
                        foreach ($grados_ms as $g) : ?>
                        <label class="checkbox-label">
                            <input type="checkbox" name="grados[]" value="<?php echo esc_attr($g); ?>">
                            <span class="checkbox-inner">
                                <span class="checkbox-check"></span>
                                <span class="checkbox-text">
                                    <span class="checkbox-name"><?php echo esc_html($g); ?></span>
                                </span>
                            </span>
                        </label>
                        <?php endforeach; ?>
                    </div>

                </div>

                <p class="form-section-title">Open House</p>

                <div class="form-group">
                    <label>¿Le gustaría asistir a nuestro Open House? <span class="required">*</span></label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="open_house" value="Sí" required>
                            <span class="radio-inner">Sí, me interesa</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="open_house" value="No">
                            <span class="radio-inner">Por ahora no</span>
                        </label>
                    </div>
                </div>

                <p class="form-section-title">Comentarios</p>

                <div class="form-group">
                    <label for="comentarios">Preguntas adicionales o comentarios</label>
                    <textarea id="comentarios" name="comentarios" rows="4" placeholder="Escribe aquí cualquier duda o comentario..."></textarea>
                </div>

                <p class="privacy-note">
                    🔒 Tus datos están protegidos bajo nuestra política de privacidad y solo serán usados para fines de admisión.
                </p>

                <div class="form-error" id="formError"></div>

                <button type="submit" class="btn-submit" id="btnSubmit">
                    <span class="btn-text">Quiero conocer más</span>
                    <span class="btn-loading" style="display:none;">Enviando...</span>
                </button>

            </form>

            <?php if ( ! empty( $contacto_img_inferior ) ) : ?>
                <div class="contact-form-image contact-form-image--bottom">
                    <img src="<?php echo esc_url( $contacto_img_inferior ); ?>" alt="Imagen inferior del formulario de contacto">
                </div>
            <?php endif; ?>

        </div>
    </main>

    <?php wp_footer(); ?>
</body>
</html>
