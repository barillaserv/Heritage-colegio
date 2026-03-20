<?php
    $facebook_url  = get_theme_mod( 'colegio_facebook_url', '#' );
    $instagram_url = get_theme_mod( 'colegio_instagram_url', '#' );
?>
    <footer class="main-footer">
        <h4 class="footer-title">SÍGUENOS</h4>
        <div class="social-icons">
            <a href="<?php echo esc_url( $facebook_url ); ?>" class="social-icon facebook" aria-label="Facebook" target="_blank" rel="noopener">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20" height="20"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="<?php echo esc_url( $instagram_url ); ?>" class="social-icon instagram" aria-label="Instagram" target="_blank" rel="noopener">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
        </div>
    </footer>
    </div>
</section>

<?php wp_footer(); ?>
</body>
</html>
