document.addEventListener('DOMContentLoaded', function() {

    // ── Header scroll effect ──────────────────────────────
    const header = document.querySelector('.main-header');
    if (header && !document.body.classList.contains('page-contacto')) {
        window.addEventListener('scroll', function() {
            header.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // ── Menú hamburguesa (móvil) ──────────────────────────
    const navToggle = document.getElementById('navToggle');
    const headerNav = document.getElementById('headerNav');

    if (navToggle && headerNav) {
        navToggle.addEventListener('click', function() {
            const isOpen = headerNav.classList.toggle('is-open');
            navToggle.classList.toggle('is-active', isOpen);
            navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        // Cerrar al hacer clic en un enlace del menú
        headerNav.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                headerNav.classList.remove('is-open');
                navToggle.classList.remove('is-active');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });

        // Cerrar al hacer clic fuera del menú
        document.addEventListener('click', function(e) {
            if (!header.contains(e.target)) {
                headerNav.classList.remove('is-open');
                navToggle.classList.remove('is-active');
                navToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ── Formulario de contacto → Zapier ──────────────────
    const form = document.getElementById('contactForm');
    if (!form) return;

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const btn      = document.getElementById('btnSubmit');
        const btnText  = btn.querySelector('.btn-text');
        const btnLoad  = btn.querySelector('.btn-loading');
        const errorBox = document.getElementById('formError');
        const success  = document.getElementById('formSuccess');

        // Limpiar errores previos
        errorBox.style.display = 'none';
        form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));

        // Validación básica
        let valid = true;
        const required = form.querySelectorAll('[required]');
        required.forEach(function(field) {
            if (field.type === 'radio') {
                const group = form.querySelectorAll('[name="' + field.name + '"]');
                const checked = Array.from(group).some(r => r.checked);
                if (!checked) {
                    valid = false;
                    group.forEach(r => r.closest('.radio-label').style.outline = '2px solid #e53e3e');
                }
            } else if (!field.value.trim()) {
                field.classList.add('error');
                valid = false;
            }
        });

        if (!valid) {
            errorBox.textContent = 'Por favor completa todos los campos obligatorios.';
            errorBox.style.display = 'block';
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            return;
        }

        // Obtener grados seleccionados
        const gradosChecked = Array.from(form.querySelectorAll('input[name="grados[]"]:checked'))
            .map(cb => cb.value);

        // Construir payload
        const payload = {
            nombre:      form.nombre.value.trim(),
            direccion:   form.direccion.value.trim(),
            telefono:    form.telefono.value.trim(),
            correo:      form.correo.value.trim(),
            grados:      gradosChecked.join(', ') || 'No seleccionó',
            open_house:  form.open_house.value,
            comentarios: form.comentarios.value.trim(),
        };

        // Estado de carga
        btn.disabled = true;
        btnText.style.display = 'none';
        btnLoad.style.display = 'inline';

        const webhookUrl = (typeof colegioData !== 'undefined') ? colegioData.zapierWebhook : '';
        const ajaxUrl = (typeof colegioData !== 'undefined') ? colegioData.ajaxUrl : '';
        const nonce = (typeof colegioData !== 'undefined') ? colegioData.nonce : '';

        if (!webhookUrl) {
            errorBox.textContent = 'El formulario aún no está configurado. Contacta al administrador.';
            errorBox.style.display = 'block';
            btn.disabled = false;
            btnText.style.display = 'inline';
            btnLoad.style.display = 'none';
            return;
        }

        if (!ajaxUrl || !nonce) {
            errorBox.textContent = 'Falta configuración interna del formulario.';
            errorBox.style.display = 'block';
            btn.disabled = false;
            btnText.style.display = 'inline';
            btnLoad.style.display = 'none';
            return;
        }

        try {
            const response = await fetch(
                ajaxUrl + '?action=colegio_enviar_contacto&nonce=' + encodeURIComponent(nonce),
                {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload),
                }
            );

            const json = await response.json();
            if (!response.ok || !json.success) {
                throw new Error('Error al enviar');
            }

            // Mostrar mensaje de éxito
            form.style.display = 'none';
            success.style.display = 'block';
            success.scrollIntoView({ behavior: 'smooth', block: 'center' });

        } catch (err) {
            errorBox.textContent = 'Ocurrió un error al enviar el formulario. Por favor intenta de nuevo.';
            errorBox.style.display = 'block';
            btn.disabled = false;
            btnText.style.display = 'inline';
            btnLoad.style.display = 'none';
        }
    });

});

/* ================================
   Slider — Sección 2 Sobre nosotros
================================ */
(function () {
    const slides = Array.from(document.querySelectorAll('.about-slide'));
    const dots   = Array.from(document.querySelectorAll('.about-dot'));
    const prev   = document.getElementById('aboutPrev');
    const next   = document.getElementById('aboutNext');

    if (!slides.length) return;

    let current = 0;

    function goTo(index) {
        slides[current].classList.remove('active');
        dots[current] && dots[current].classList.remove('active');
        current = (index + slides.length) % slides.length;
        slides[current].classList.add('active');
        dots[current] && dots[current].classList.add('active');
    }

    prev && prev.addEventListener('click', () => goTo(current - 1));
    next && next.addEventListener('click', () => goTo(current + 1));

    dots.forEach((dot, i) => dot.addEventListener('click', () => goTo(i)));
}());
