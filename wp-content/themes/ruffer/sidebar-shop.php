<?php
	// Block direct access
	if( ! defined( 'ABSPATH' ) ){
		exit( );
	}
	/**
	* @Packge 	   : Ruffer
	* @Version     : 1.0
	* @Author     : Themeholy
    * @Author URI : https://www.themeholy.com/
	*
	*/

	if( ! is_active_sidebar( 'ruffer-woo-sidebar' ) ){
		return;
	}
?>
<div class="col-xxl-4 col-lg-5">
	<!-- Sidebar Begin -->
	<aside class="sidebar-area shop-sidebar">
		<?php
			dynamic_sidebar( 'ruffer-woo-sidebar' );
		?>
	</aside>
	<!-- Sidebar End -->
</div>