# Colegio Theme — Heritage American School

Tema WordPress minimalista para la página principal del colegio.

---

## Estructura de archivos

```
colegio-theme/
├── header.php          # DOCTYPE, <head>, wp_head(), header nav, sección Hero, sección About
├── footer.php          # Footer con logo, menú, redes sociales, wp_footer(), </body></html>
├── index.php           # Sección de Programas académicos (usa get_header / get_footer)
├── page-contacto.php   # Template: Página de Contacto (formulario de admisiones)
├── functions.php       # Soporte del tema + Customizer + proxy AJAX para Zapier
├── style.css           # Todos los estilos del tema
├── script.js           # JS: scroll header, envío formulario a Zapier vía AJAX
├── hero-bg.jpg         # Imagen de fondo Hero (fallback si no hay una en Customizer)
└── programs-bg.jpg     # Imagen de fondo Programas (fallback)
```

---

## Convenciones de código

### PHP / WordPress
- Usar siempre `get_theme_mod( 'colegio_*', 'default' )` para valores personalizables.
- Escapar salidas: `esc_url()` para URLs, `esc_html()` para texto, `esc_attr()` para atributos.
- Nunca escribir CSS o JS directamente en los templates — todo va en `style.css` y `script.js`.
- Nuevas páginas/templates deben declarar su nombre al inicio:
  ```php
  <?php
  /**
   * Template Name: Nombre del Template
   */
  ?>
  ```

### CSS
- **Responsive con `clamp()`** — no usar valores fijos para tipografía ni tamaños de iconos:
  ```css
  font-size: clamp(MIN, VAL_VW, MAX);
  ```
- **Full-width** fuera de un contenedor con `max-width`:
  ```css
  width: 100vw;
  margin-left: calc(50% - 50vw);
  ```
- Organizar el archivo por secciones con comentarios:
  ```css
  /* ================================
     Nombre de la sección
  ================================ */
  ```
- Colores del tema:
  | Token            | Valor     | Uso                          |
  |------------------|-----------|------------------------------|
  | Azul oscuro      | `#1A2F3D` | Fondo footer, íconos sociales |
  | Azul medio       | `#1a365d` | Botones, títulos              |
  | Azul claro       | `#98D5E9` | Botón CTA "Solicita info"     |
  | Azul hover icon  | `#e8f0fe` | Hover íconos sociales         |

### Íconos SVG (footer)
- Todos en `viewBox="0 0 24 24"` sin atributos `width`/`height` — el tamaño lo controla CSS.
- Íconos de trazo (`stroke`): Instagram, YouTube, LinkedIn → `fill="none" stroke="#1A2F3D" stroke-width="2"`.
- Íconos sólidos (`fill`): Facebook, WhatsApp → `fill="#1A2F3D"`.
- YouTube: `<rect>` con stroke + `<polygon fill="#1A2F3D" stroke="none">` para el triángulo de play.

---

## Personalizador de WordPress

Ruta: **Apariencia › Personalizar › Heritage American School**

```
Heritage American School  (panel)
├── Imágenes de portada
│   ├── Fondo sección Hero
│   ├── Fondo sección Programas
│   ├── Logo/sello superpuesto en Programas
│   ├── Imagen superior — Formulario de contacto
│   └── Imagen inferior — Formulario de contacto
│
├── Header
│   ├── URL — Botón "Contáctanos"
│   └── URL — Botón "Solicita más información"
│
├── Footer
│   ├── (El logo usa el de "Identidad del sitio")
│   ├── Menú — Texto / URL "Campus"
│   ├── Menú — Texto / URL "Admisiones"
│   ├── Menú — Texto / URL "Programas"
│   ├── Menú — Texto / URL "Galería"
│   ├── Redes — Título (ej. "SÍGUENOS")
│   ├── Redes — URL Facebook
│   ├── Redes — URL Instagram
│   ├── Redes — URL YouTube
│   ├── Redes — URL WhatsApp
│   └── Redes — URL LinkedIn
│
└── Integraciones
    └── URL Webhook de Zapier
```

> El logo del header y footer se configura en **Apariencia › Personalizar › Identidad del sitio › Logo**.

---

## Cómo agregar una nueva sección personalizable

1. Registrar el `setting` y su `control` dentro de `colegio_customize_register()` en `functions.php`.
2. Usar el `id` de sección correcto según dónde aplique:
   - `colegio_home_images` → imágenes de fondo
   - `colegio_header` → header
   - `colegio_footer` → footer
   - `colegio_integraciones` → integraciones externas
3. Consumir el valor en el template con `get_theme_mod( 'colegio_mi_setting', 'valor_default' )`.

---

## Formulario de contacto (Zapier)

- El formulario en `page-contacto.php` envía los datos via `fetch()` a un endpoint AJAX de WordPress.
- El handler en `functions.php` (`colegio_enviar_contacto_ajax`) reenvía el payload al webhook de Zapier configurado en el Personalizador.
- Esto evita problemas de CORS al llamar al webhook directamente desde el browser.

Flujo:
```
Formulario (JS fetch) → admin-ajax.php → colegio_enviar_contacto_ajax() → Zapier Webhook
```

---

## Notas de diseño

- El footer **siempre ocupa el 100% del ancho** (`width: 100vw`) aunque esté renderizado dentro de la sección `.programs-section` que tiene `max-width`.
- El texto **"Desarrollado por NAFIA. 2020"** es fijo (no editable desde el Personalizador por decisión de diseño) y se alinea a la derecha.
- Los tamaños de fuente e iconos usan `clamp()` para escalar fluidamente entre móvil y escritorio sin breakpoints adicionales.
