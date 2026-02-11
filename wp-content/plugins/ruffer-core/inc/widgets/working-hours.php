<?php
/**
* @version  1.0
* @package  ruffer
* @author   Ruffer <support@ruffer.com>
*
* Websites: http://www.vecurosoft.com
*
*/

/**************************************
* Creating Working Hours Widget
***************************************/

class ruffer_working_hours_widget extends WP_Widget {

        function __construct() {
        
            parent::__construct(
                // Base ID of your widget
                'ruffer_working_hours_widget', 
            
                // Widget name will appear in UI
                esc_html__( 'Ruffer :: Working Hours', 'ruffer' ),
            
                // Widget description
                array( 
                    'classname'   					=> 'widget_admin',
                    'customize_selective_refresh' 	=> true,  
                    'description' 					=> esc_html__( 'Add Working Hours Widget', 'ruffer' ),   
                )
            );

        }
    
        // This is where the action happens
        public function widget( $args, $instance ) {
            
            $about_img  	= ( !empty( $instance['about_img'] ) ) ? $instance['about_img'] : "";
            $label  	= ( !empty( $instance['label'] ) ) ? $instance['label'] : "";  
            $desc  			= ( !empty( $instance['desc'] ) ) ? $instance['desc'] : "";
            
            //before and after widget arguments are defined by themes
            echo '<!-- Author Widget -->';
            echo $args['before_widget']; 


            echo '<div class="about-logo">';
                if( !empty( $about_img ) ) {
                    echo '<a href="'.esc_url( home_url() ).'"><img src="'.esc_url( $about_img ).'" alt="Ruffer"></a>';
                }
            echo '</div>';
            echo '<div class="themeholy-widget-schedule">';
                if( !empty( $label ) ) {
                    echo '<h4 class="title">'.esc_html( $label ).'</h4>';
                }
                if( !empty( $desc ) ) {
                    echo wp_kses_post( $desc );
                }
            echo '</div>';
            echo $args['after_widget']; 
        }
            
        // Widget Backend 
        public function form( $instance ) {
    
            // Label	
            if ( isset( $instance[ 'label' ] ) ) {
                $label = $instance[ 'label' ];
            }else {
                $label = '';
            }
			
            // Description
            if ( isset( $instance[ 'desc' ] ) ) {
                $desc = $instance[ 'desc' ];
            }else {
                $desc = '';
            }
            
            //Image
            if ( isset( $instance[ 'about_img' ] ) ) {
                $about_img = $instance[ 'about_img' ];
            }else {
                $about_img = '';
            }

            // Widget admin form
            ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'label' ); ?>"><?php _e( 'Label:' ,'ruffer'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'label' ); ?>" name="<?php echo $this->get_field_name( 'label' ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>" />
            </p>
            <input class="widefat" id="<?php echo $this->get_field_id( 'about_img' ); ?>" name="<?php echo $this->get_field_name( 'about_img' ); ?>" type="text" placeholder="<?php echo esc_attr__('Image url', 'ruffer'); ?>" value="<?php echo esc_attr( $about_img ); ?>" />

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php _e( 'Description:' ,'ruffer'); ?></label> 
                <textarea class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" cols="30" rows="10"><?php echo wp_kses_post( $desc ); ?></textarea>
            </p>
            <p>
               <?php echo __( 'Add Social link from ','ruffer') . '<a href="'.esc_url( admin_url('admin.php?page=Ruffer&tab=17') ).'">'.__('Here','ruffer').'</a>'; ?>
            </p>
			
            <?php 
        }
    
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            
            $instance = array();     
            $instance['label'] 	= ( ! empty( $new_instance['label'] ) ) ? strip_tags( $new_instance['label'] ) : '';      
            $instance['desc'] 	        = ( ! empty( $new_instance['desc'] ) ) ? wp_kses_post( $new_instance['desc'] ) : '';        
            $instance['about_img'] 	    = ( ! empty( $new_instance['about_img'] ) ) ? strip_tags( $new_instance['about_img'] ) : '';
            return $instance;
        }
    } // Class ruffer_working_hours_widget ends here
    

    // Register and load the widget
    function ruffer_working_hours_load_widget() {
        register_widget( 'ruffer_working_hours_widget' );
    }
    add_action( 'widgets_init', 'ruffer_working_hours_load_widget' );