<?php
/**
* @version  1.0
* @package  ruffer
* @author   Ruffer <support@themeholy.com>
*
* Websites: http://www.themeholy.com
*
*/

/**************************************
* Creating About Us Widget
***************************************/

class ruffer_aboutus_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'ruffer_aboutus_widget',

                // Widget name will appear in UI
                esc_html__( 'Ruffer :: About Us Widget', 'ruffer' ),

                // Widget description
                array(
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add About Us Widget', 'ruffer' ),
                    'classname'                     => 'no-class',
                )
            );

        }

        // This is where the action happens
        public function widget( $args, $instance ) {

            $about_us   = apply_filters( 'widget_about_us', $instance['about_us'] );
            $logo_url   = apply_filters( 'widget_logo_url', $instance['logo_url'] );
            $social_icon      = isset( $instance['social_icon'] ) ? $instance['social_icon'] : false; 


            //before and after widget arguments are defined by themes
            echo $args['before_widget'];
                echo '<div class="th-widget-about">';
                    echo '<div class="about-logo">';
                        echo '<a href="'.esc_url(home_url()).'"><img src="'.esc_url($logo_url).'" alt="'.esc_attr('Ruffer', 'ruffer').'"></a>';
                    echo '</div>';
                    if( !empty( $about_us ) ){
                        echo '<p class="about-text">'.wp_kses_post( $about_us ).'</p>';
                    }                    
                    if($social_icon){
                        echo '<div class="th-social">';
                            ruffer_social_icon();
                        echo '</div>';
                    }
                echo '</div>';
            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {           
            
            if ( isset( $instance[ 'about_us' ] ) ) {
                $about_us = $instance[ 'about_us' ];
            }else {
                $about_us = '';
            }

            //button link
            if ( isset( $instance[ 'logo_url' ] ) ) {
                $logo_url = $instance[ 'logo_url' ];
            }else {
                $logo_url = '';
            }

            $social_icon = isset( $instance['social_icon'] ) ? (bool) $instance['social_icon'] : false;
            
            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'about_us' ); ?>">
                    <?php
                        _e( 'About Us:' ,'ruffer');
                    ?>
                </label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'about_us' ); ?>" name="<?php echo $this->get_field_name( 'about_us' ); ?>" rows="8" cols="80"><?php echo esc_html( $about_us ); ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'btn_text' ); ?>">
                    <?php
                        _e( 'Logo URL' ,'ruffer');
                    ?>
                </label>
                
                <input class="widefat" id="<?php echo $this->get_field_id( 'logo_url' ); ?>" name="<?php echo $this->get_field_name( 'logo_url' ); ?>" type="text" placeholder="<?php echo esc_attr__('Logo url', 'ruffer'); ?>" value="<?php echo esc_attr( $logo_url ); ?>" />
            </p>

            <p>
                <input class="checkbox" type="checkbox"<?php checked( $social_icon ); ?> id="<?php echo $this->get_field_id( 'social_icon' ); ?>" name="<?php echo $this->get_field_name( 'social_icon' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'social_icon' ); ?>"><?php _e( 'Display Social Icon?' ); ?></label>
            </p>
            
            <?php
        }


         // Updating widget replacing old instances with new
         public function update( $new_instance, $old_instance ) {

            $instance = array();          
            $instance['about_us']           = ( ! empty( $new_instance['about_us'] ) ) ? strip_tags( $new_instance['about_us'] ) : '';
            $instance['logo_url']           = ( ! empty( $new_instance['logo_url'] ) ) ? strip_tags( $new_instance['logo_url'] ) : '';

            $instance['social_icon']      = isset( $new_instance['social_icon'] ) ? (bool) $new_instance['social_icon'] : false;
            return $instance;
        }
    } // Class ruffer_aboutus_widget ends here


    // Register and load the widget
    function ruffer_aboutus_load_widget() {
        register_widget( 'ruffer_aboutus_widget' );
    }
    add_action( 'widgets_init', 'ruffer_aboutus_load_widget' );