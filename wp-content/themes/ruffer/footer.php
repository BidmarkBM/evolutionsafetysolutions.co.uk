<?php
/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
    
    /**
    *
    * Hook for Footer Content
    *
    * Hook ruffer_footer_content
    *
    * @Hooked ruffer_footer_content_cb 10
    *
    */
    do_action( 'ruffer_footer_content' );

    /**
    *
    * Hook for Back to Top Button
    *
    * Hook ruffer_back_to_top
    *
    * @Hooked ruffer_back_to_top_cb 10
    *
    */
    do_action( 'ruffer_back_to_top' );

    wp_footer();
    ?>
</body>
</html>