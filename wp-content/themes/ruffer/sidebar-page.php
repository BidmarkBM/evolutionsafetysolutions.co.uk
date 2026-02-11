<?php
/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if (!defined('ABSPATH')) {
    exit;
}

if ( ! is_active_sidebar( 'ruffer-page-sidebar' ) ) {
    return;
}
?>

<div class="col-xxl-4 col-lg-5">
    <div class="page-sidebar">
    <?php 
        dynamic_sidebar( 'ruffer-page-sidebar' );
    ?>               
    </div>
</div>