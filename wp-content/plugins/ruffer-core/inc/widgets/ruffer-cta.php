<?php
/**
* @version  1.0
* @package  ruffer
*
* Websites: 
*
*/

/**************************************
* Creating CTA Widget
***************************************/

class ruffer_newslater_widget extends WP_Widget {

        function __construct() {
        
            parent::__construct(
                // Base ID of your widget
                'ruffer_newslater_widget', 
            
                // Widget name will appear in UI
                esc_html__( 'Ruffer :: Newslatter', 'ruffer' ),
            
                // Widget description
                array( 
                    'customize_selective_refresh'   => true,  
                    'description'                   => esc_html__( 'Add Subscribed Widget', 'ruffer' ),   
                    'classname'                     => 'no-class newsletter-widget',
                )
            );

        }
    
        // This is where the action happens
        public function widget( $args, $instance ) {
            
            $title      = ( !empty( $instance['title'] ) ) ? $instance['title'] : "";  
            $subtitle      = ( !empty( $instance['subtitle'] ) ) ? $instance['subtitle'] : "";  
   
            //before and after widget arguments are defined by themes
            echo $args['before_widget']; 

            echo '<h3 class="widget_title">'.esc_html( $title ).'</h3>';
            echo '<p class="footer-text">'.esc_html( $subtitle ).'</p>';
            echo '<form class="newsletter-form">';
                echo '<input class="form-control" type="email" placeholder="Enter Email" required="">';
                echo '<button type="submit" class="th-btn"><i class="far fa-paper-plane"></i></button>';
            echo '</form>';
            echo $args['after_widget'];

            echo '<!-- End of Author Widget -->';
        }
            
        // Widget Backend 
        public function form( $instance ) {
    
            //Title 
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = '';
            }
            if ( isset( $instance[ 'subtitle' ] ) ) {
                $subtitle = $instance[ 'subtitle' ];
            }else {
                $subtitle = '';
            }

            
            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'ruffer'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>  
            <p>
                <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:' ,'ruffer'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
            </p>    
            <?php 
        }
    
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            
            $instance = array();
            $instance['title']                  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['subtitle']                  = ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';
            return $instance;
        }
    } // Class ruffer_newslater_widget ends here
    

    // Register and load the widget
    function ruffer_newslater_widget() {
        register_widget( 'ruffer_newslater_widget' );
    }
    add_action( 'widgets_init', 'ruffer_newslater_widget' );