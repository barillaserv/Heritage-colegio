# Colegio Theme — Heritage American School

Tema WordPress para el sitio del colegio. Diseño minimalista, responsive y totalmente configurable desde el Personalizador de WordPress.

---

## Estructura de archivos

```
colegio-theme/
├── header.php            # DOCTYPE, <head>, wp_head(), header con logo + nav + botón
├── footer.php            # Footer: logo, menú, redes sociales, wp_footer(), </body></html>
├── index.php             # Template: Página de Inicio (Hero, Sobre la escuela, Programas)
├── page-contacto.php     # Template: Página de Contacto (formulario de admisiones)
├── functions.php         # Setup del tema + Menús nativos + Customizer + proxy AJAX Zapier
├── style.css             # Todos los estilos del tema
├── script.js             # JS: scroll header, menú hamburguesa, envío formulario vía AJAX
├── hero-bg.jpg           # Imagen fallback para el fondo del Hero
└── programs-bg.jpg       # Imagen fallback para el fondo de Programas
```

---

## Arquitectura del Personalizador

El Personalizador sigue una estructura **un panel por página + un panel Global**.  
Ruta en WordPress: **Apariencia › Personalizar**

```
Global (Header / Footer)                     panel: colegio_panel_global
├── Header                                   section: colegio_header
│   └── URL — Botón "Contáctanos"            setting: colegio_contactanos_url
│
└── Footer                                   section: colegio_footer
    ├── Redes — Título                       setting: colegio_footer_social_title
    ├── Redes — URL Facebook                 setting: colegio_facebook_url
    ├── Redes — URL Instagram                setting: colegio_instagram_url
    ├── Redes — URL YouTube                  setting: colegio_youtube_url
    ├── Redes — URL WhatsApp                 setting: colegio_whatsapp_url
    └── Redes — URL LinkedIn                 setting: colegio_linkedin_url

Página de Inicio                             panel: colegio_panel_inicio
├── Sección Hero                             section: colegio_inicio_hero
│   └── Imagen de fondo                      setting: colegio_hero_bg
│
└── Sección Programas                        section: colegio_inicio_programas
    ├── Imagen de fondo                      setting: colegio_programs_bg
    ├── Logo / sello superpuesto             setting: colegio_programs_logo
    └── URL — Botón "Solicita más info"      setting: colegio_info_url

Página de Contacto                           panel: colegio_panel_contacto
└── Sección Formulario                       section: colegio_contacto_formulario
    ├── Imagen superior                      setting: colegio_contacto_img_superior
    └── Imagen inferior                      setting: colegio_contacto_img_inferior

Integraciones                                panel: colegio_panel_integraciones
└── Zapier                                   section: colegio_integraciones
    └── URL del Webhook                      setting: colegio_zapier_webhook
```

> El **logo** (header y footer) se configura en **Apariencia › Personalizar › Identidad del sitio**.  
> Los **menús de navegación** (header y footer) se gestionan en **Apariencia › Menús**.

---

## Convención de nombres

Todos los IDs siguen el patrón `colegio_<ámbito>_<campo>`:

| Elemento  | Patrón de ID                              | Ejemplo                          |
|-----------|-------------------------------------------|----------------------------------|
| Panel     | `colegio_panel_<slug>`                    | `colegio_panel_inicio`           |
| Sección   | `colegio_<slug>_<seccion>`                | `colegio_inicio_hero`            |
| Setting   | `colegio_<slug>_<seccion>_<campo>`        | `colegio_inicio_hero_bg`         |
| Control   | `colegio_<slug>_<seccion>_<campo>_control`| `colegio_inicio_hero_bg_control` |

> Los settings del panel **Global** usan `colegio_header_*` y `colegio_footer_*`.  
> Los settings de **Integraciones** usan `colegio_zapier_*`.

---

## Cómo agregar una nueva página al Personalizador

Seguir siempre estos 4 pasos en orden:

### Paso 1 — Crear el panel en `functions.php`

```php
// ════════════════════════════════════════════════════════════════
// PANEL: Página de Ejemplo  (template: page-ejemplo.php)
// ════════════════════════════════════════════════════════════════
$wp_customize->add_panel( 'colegio_panel_ejemplo', array(
    'title'    => __( 'Página de Ejemplo', 'colegio-theme' ),
    'priority' => 40,   // número mayor = más abajo en la lista
) );
```

### Paso 2 — Crear una sección por cada bloque visual de la página

```php
// ── Sección: Banner ─────────────────────────────────────────────
$wp_customize->add_section( 'colegio_ejemplo_banner', array(
    'title'    => __( 'Sección Banner', 'colegio-theme' ),
    'panel'    => 'colegio_panel_ejemplo',
    'priority' => 10,
) );
```

### Paso 3 — Registrar los settings y controles de cada sección

**Texto:**
```php
$wp_customize->add_setting( 'colegio_ejemplo_banner_titulo', array(
    'default'           => 'Título por defecto',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'colegio_ejemplo_banner_titulo', array(
    'label'   => __( 'Título del banner', 'colegio-theme' ),
    'section' => 'colegio_ejemplo_banner',
    'type'    => 'text',
) );
```

**URL:**
```php
$wp_customize->add_setting( 'colegio_ejemplo_banner_url', array(
    'default'           => '#',
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'colegio_ejemplo_banner_url', array(
    'label'   => __( 'URL del botón', 'colegio-theme' ),
    'section' => 'colegio_ejemplo_banner',
    'type'    => 'url',
) );
```

**Imagen:**
```php
$wp_customize->add_setting( 'colegio_ejemplo_banner_bg', array(
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
) );
if ( class_exists( 'WP_Customize_Image_Control' ) ) {
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'colegio_ejemplo_banner_bg_control',
        array(
            'label'    => __( 'Imagen de fondo', 'colegio-theme' ),
            'section'  => 'colegio_ejemplo_banner',
            'settings' => 'colegio_ejemplo_banner_bg',
        )
    ) );
}
```

### Paso 4 — Consumir los valores en el template `page-ejemplo.php`

```php
<?php
/**
 * Template Name: Ejemplo
 */
get_header();

$banner_titulo = get_theme_mod( 'colegio_ejemplo_banner_titulo', 'Título por defecto' );
$banner_bg     = get_theme_mod( 'colegio_ejemplo_banner_bg', '' );
$banner_url    = get_theme_mod( 'colegio_ejemplo_banner_url', '#' );
?>

<section class="ejemplo-banner" style="background-image: url('<?php echo esc_url( $banner_bg ); ?>');">
    <h1><?php echo esc_html( $banner_titulo ); ?></h1>
    <a href="<?php echo esc_url( $banner_url ); ?>">Ver más</a>
</section>

<?php get_footer(); ?>
```

---

## Menús de navegación

El tema registra dos ubicaciones de menú nativo de WordPress:

| Slug          | Nombre en admin                | Dónde se muestra          |
|---------------|-------------------------------|---------------------------|
| `header-menu` | Menú Principal (Header)        | Barra de navegación header|
| `footer-menu` | Menú Footer                    | Enlace del footer          |

Para gestionarlos: **Apariencia › Menús** → crear/editar un menú → asignar ubicación.  
Se pueden agregar tantos ítems como se quiera (páginas, enlaces, categorías, etc.).

---

## Formulario de contacto (Zapier)

El formulario en `page-contacto.php` envía datos via `fetch()` a un endpoint AJAX interno de WordPress. El handler en `functions.php` (`colegio_enviar_contacto_ajax`) reenvía el payload al webhook de Zapier configurado en **Integraciones › Zapier**. Esto evita problemas de CORS al llamar al webhook directamente desde el navegador.

```
Formulario (JS fetch) → admin-ajax.php → colegio_enviar_contacto_ajax() → Zapier Webhook
```

---

## Convenciones de código

### PHP / WordPress
- Usar siempre `get_theme_mod( 'colegio_*', 'default' )` para valores configurables.
- Escapar salidas: `esc_url()` para URLs, `esc_html()` para texto, `esc_attr()` para atributos HTML.
- Nunca escribir CSS o JS inline en los templates — todo va en `style.css` y `script.js`.
- Nuevas páginas deben declarar su template al inicio:
  ```php
  <?php
  /**
   * Template Name: Nombre del Template
   */
  ?>
  ```

### CSS
- **Responsive con `clamp()`** para tipografía y tamaños fluidos:
  ```css
  font-size: clamp(MIN, VAL_VW, MAX);
  ```
- **Full-width** fuera de contenedor:
  ```css
  width: 100vw;
  margin-left: calc(50% - 50vw);
  ```
- Organizar secciones con comentarios delimitadores:
  ```css
  /* ================================
     Nombre de la sección
  ================================ */
  ```
- Colores del tema:

  | Token           | Valor     | Uso principal                 |
  |-----------------|-----------|-------------------------------|
  | Azul oscuro     | `#1A2F3D` | Fondo footer, íconos sociales |
  | Azul medio      | `#1a365d` | Botones, títulos              |
  | Azul claro      | `#98D5E9` | Botón CTA, acentos            |
  | Azul hover icon | `#e8f0fe` | Hover íconos sociales         |

### Íconos SVG (footer)
- Todos en `viewBox="0 0 24 24"` sin `width`/`height` — el tamaño lo controla CSS.
- Íconos de trazo: Instagram, YouTube, LinkedIn → `fill="none" stroke="#1A2F3D" stroke-width="2"`.
- Íconos sólidos: Facebook, WhatsApp → `fill="#1A2F3D"`.

---

## Regla de independencia de templates

Cada archivo de template debe ser autónomo en sus etiquetas:

| Archivo               | Abre                          | Cierra                        |
|-----------------------|-------------------------------|-------------------------------|
| `header.php`          | `<html>`, `<body>`, `<header>`| `</header>`                   |
| `index.php` / páginas | Sus propias secciones         | Sus propias secciones         |
| `footer.php`          | `<footer>`                    | `</footer>`, `</body>`, `</html>` |

**Nunca** poner en `footer.php` cierres de etiquetas abiertas en otro template.

---

## Notas de diseño

- El footer siempre ocupa el 100% del ancho (`width: 100vw`) sin importar el contenedor padre.
- El texto **"Desarrollado por NAFTA. 2026"** es fijo (no editable desde el Personalizador por decisión de diseño).
- El header es transparente en la portada y se vuelve blanco (`rgba(255,255,255,0.95)`) al hacer scroll (`scrollY > 50px`).
- El menú hamburguesa se activa en pantallas ≤ 900px.
