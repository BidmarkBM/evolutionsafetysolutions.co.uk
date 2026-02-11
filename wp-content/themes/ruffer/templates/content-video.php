<?php
/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

echo '<!-- Single Post -->';
?>
<div <?php post_class(); ?>>
<?php

    // Blog Post Content
    do_action( 'ruffer_blog_post_content' );


echo '</div>';
echo '<!-- End Single Post -->';