<?php
/**
 * @Packge     : Ruffer
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */
 
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit();
    }

    if( !empty( ruffer_pagination() ) ) :
?>
<!-- Post Pagination -->
<div class="th-pagination mb-30">
    <ul class="list-style-none">
        <?php
            $prev   = '<i class="fas fa-angle-left"></i>';
            $next   = '<i class="fas fa-angle-right"></i>';
            // previous
            if( get_previous_posts_link() ){
                echo '<li>';
                previous_posts_link( $prev );
                echo '</li>';
            }

            echo ruffer_pagination();

            // next
            if( get_next_posts_link() ){
                echo '<li>';
                next_posts_link( $next );
                echo '</li>';
            }
        ?>
    </ul>
</div>
<!-- End of Post Pagination -->
<?php endif;