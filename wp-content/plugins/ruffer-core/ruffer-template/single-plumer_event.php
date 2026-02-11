<?php 

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    // header
    get_header();
    echo '<section class="bg-smoke space">';
        echo '<div class="container">';
            echo '<div class="event-details">';
                while( have_posts( ) ) :
                    the_post();
                    the_content();

                endwhile;
                wp_reset_postdata();
            echo '</div>';
            echo '<div class="event-nav">';
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                if($prev_post) {
                    $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
                    echo '<a href="' . get_permalink($prev_post->ID) . '" class="nav-btn"><i class="far fa-long-arrow-left"></i> ' . $prev_title. '</a>';
                }
                if($next_post) {
                    $next_title = strip_tags(str_replace('"', '', $next_post->post_title));
                    echo '<a href="' . get_permalink($next_post->ID) . '" class="nav-btn">' . $next_title. ' <i class="far fa-long-arrow-right"></i></a>';
                }
            echo '</div>';
        echo '</div>';
    echo '</section>'; 
    get_footer();