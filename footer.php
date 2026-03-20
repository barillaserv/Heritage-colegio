<?php
    $facebook_url  = get_theme_mod( 'colegio_facebook_url', '#' );
    $instagram_url = get_theme_mod( 'colegio_instagram_url', '#' );
    $youtube_url   = get_theme_mod( 'colegio_youtube_url', '#' );
    $whatsapp_url  = get_theme_mod( 'colegio_whatsapp_url', '#' );
    $linkedin_url  = get_theme_mod( 'colegio_linkedin_url', '#' );

    $social_title  = get_theme_mod( 'colegio_footer_social_title', 'SÍGUENOS' );

    $campus_label      = get_theme_mod( 'colegio_footer_nav_campus_label', 'Campus' );
    $campus_url        = get_theme_mod( 'colegio_footer_nav_campus_url', '#' );
    $admisiones_label  = get_theme_mod( 'colegio_footer_nav_admisiones_label', 'Admisiones' );
    $admisiones_url    = get_theme_mod( 'colegio_footer_nav_admisiones_url', '#' );
    $programas_label   = get_theme_mod( 'colegio_footer_nav_programas_label', 'Programas' );
    $programas_url     = get_theme_mod( 'colegio_footer_nav_programas_url', '#' );
    $galeria_label     = get_theme_mod( 'colegio_footer_nav_galeria_label', 'Galería' );
    $galeria_url       = get_theme_mod( 'colegio_footer_nav_galeria_url', '#' );

    $custom_logo_id = get_theme_mod( 'custom_logo' );
?>
    <footer class="site-footer">
        <div class="site-footer-inner">
            <div class="site-footer-logo">
                <?php
                if ( $custom_logo_id ) {
                    echo wp_get_attachment_image(
                        $custom_logo_id,
                        'full',
                        false,
                        array( 'class' => 'site-footer-logo-img' )
                    );
                } else {
                    echo '<div class="site-footer-logo-placeholder">' . esc_html( get_bloginfo( 'name' ) ) . '</div>';
                }
                ?>
            </div>

            <div class="site-footer-divider"></div>

            <nav class="site-footer-nav" aria-label="Enlaces del pie">
                <a href="<?php echo esc_url( $campus_url ); ?>" class="site-footer-nav-link"><?php echo esc_html( $campus_label ); ?></a>
                <a href="<?php echo esc_url( $admisiones_url ); ?>" class="site-footer-nav-link"><?php echo esc_html( $admisiones_label ); ?></a>
                <a href="<?php echo esc_url( $programas_url ); ?>" class="site-footer-nav-link"><?php echo esc_html( $programas_label ); ?></a>
                <a href="<?php echo esc_url( $galeria_url ); ?>" class="site-footer-nav-link"><?php echo esc_html( $galeria_label ); ?></a>
            </nav>

            <div class="site-footer-divider"></div>

            <div class="site-footer-social">
                <h4 class="site-footer-social-title"><?php echo esc_html( $social_title ); ?></h4>
                <div class="social-icons">
                    <!-- Facebook -->
                    <a href="<?php echo esc_url( $facebook_url ); ?>" class="social-icon" aria-label="Facebook" target="_blank" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#1A2F3D">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="<?php echo esc_url( $instagram_url ); ?>" class="social-icon" aria-label="Instagram" target="_blank" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#1A2F3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="3"/>
                        </svg>
                    </a>
                    <!-- YouTube -->
                    <a href="<?php echo esc_url( $youtube_url ); ?>" class="social-icon" aria-label="YouTube" target="_blank" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#1A2F3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="4"/>
                            <polygon fill="#1A2F3D" stroke="none" points="10 8.5 16 12 10 15.5 10 8.5"/>
                        </svg>
                    </a>
                    <!-- WhatsApp -->
                    <a href="<?php echo esc_url( $whatsapp_url ); ?>" class="social-icon" aria-label="WhatsApp" target="_blank" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#1A2F3D">
                            <path d="M12 2a10 10 0 0 0-8.661 15.004L2 22l5.144-1.31A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.13-1.148l-.295-.176-3.053.777.805-2.968-.196-.305A8 8 0 1 1 12 20zm4.406-5.618c-.242-.12-1.43-.705-1.652-.786-.222-.08-.384-.12-.545.121-.16.24-.623.786-.764.948-.14.161-.281.181-.522.06-.242-.12-1.021-.376-1.944-1.2-.718-.641-1.203-1.432-1.344-1.673-.14-.24-.015-.37.106-.49.109-.108.242-.281.363-.422.12-.14.16-.24.24-.4.08-.161.04-.302-.02-.422-.06-.12-.545-1.314-.748-1.795-.196-.469-.396-.405-.545-.413l-.463-.008a.888.888 0 0 0-.644.302c-.221.24-.845.826-.845 2.013s.865 2.335.985 2.496c.12.16 1.702 2.598 4.125 3.643.576.249 1.025.397 1.375.508.578.184 1.104.158 1.52.096.463-.069 1.43-.585 1.631-1.15.2-.564.2-1.047.14-1.148-.06-.1-.221-.16-.463-.28z"/>
                        </svg>
                    </a>
                    <!-- LinkedIn -->
                    <a href="<?php echo esc_url( $linkedin_url ); ?>" class="social-icon" aria-label="LinkedIn" target="_blank" rel="noopener">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#1A2F3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                            <rect x="2" y="9" width="4" height="12"/>
                            <circle cx="4" cy="4" r="2"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="site-footer-divider site-footer-divider--thin"></div>

            <div class="site-footer-developed">Desarrollado por NAFTA. 2026</div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>
