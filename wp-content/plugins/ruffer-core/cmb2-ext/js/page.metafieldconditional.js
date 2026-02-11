(function($){
    "use strict";
    
    let $ruffer_page_breadcrumb_area      = $("#_ruffer_page_breadcrumb_area");
    let $ruffer_page_settings             = $("#_ruffer_page_breadcrumb_settings");
    let $ruffer_page_breadcrumb_image     = $("#_ruffer_breadcumb_image");
    let $ruffer_page_title                = $("#_ruffer_page_title");
    let $ruffer_page_title_settings       = $("#_ruffer_page_title_settings");

    if( $ruffer_page_breadcrumb_area.val() == '1' ) {
        $(".cmb2-id--ruffer-page-breadcrumb-settings").show();
        if( $ruffer_page_settings.val() == 'global' ) {
            $(".cmb2-id--ruffer-breadcumb-image").hide();
            $(".cmb2-id--ruffer-page-title").hide();
            $(".cmb2-id--ruffer-page-title-settings").hide();
            $(".cmb2-id--ruffer-custom-page-title").hide();
            $(".cmb2-id--ruffer-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--ruffer-breadcumb-image").show();
            $(".cmb2-id--ruffer-page-title").show();
            $(".cmb2-id--ruffer-page-breadcrumb-trigger").show();
    
            if( $ruffer_page_title.val() == '1' ) {
                $(".cmb2-id--ruffer-page-title-settings").show();
                if( $ruffer_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--ruffer-custom-page-title").hide();
                } else {
                    $(".cmb2-id--ruffer-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--ruffer-page-title-settings").hide();
                $(".cmb2-id--ruffer-custom-page-title").hide();
    
            }
        }
    } else {
        $ruffer_page_breadcrumb_area.parents('.cmb2-id--ruffer-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $ruffer_page_breadcrumb_area.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--ruffer-page-breadcrumb-settings").show();
            if( $ruffer_page_settings.val() == 'global' ) {
                $(".cmb2-id--ruffer-breadcumb-image").hide();
                $(".cmb2-id--ruffer-page-title").hide();
                $(".cmb2-id--ruffer-page-title-settings").hide();
                $(".cmb2-id--ruffer-custom-page-title").hide();
                $(".cmb2-id--ruffer-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--ruffer-breadcumb-image").show();
                $(".cmb2-id--ruffer-page-title").show();
                $(".cmb2-id--ruffer-page-breadcrumb-trigger").show();
        
                if( $ruffer_page_title.val() == '1' ) {
                    $(".cmb2-id--ruffer-page-title-settings").show();
                    if( $ruffer_page_title_settings.val() == 'default' ) {
                        $(".cmb2-id--ruffer-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--ruffer-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--ruffer-page-title-settings").hide();
                    $(".cmb2-id--ruffer-custom-page-title").hide();
        
                }
            }
        } else {
            $(this).parents('.cmb2-id--ruffer-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $ruffer_page_title.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--ruffer-page-title-settings").show();
            if( $ruffer_page_title_settings.val() == 'default' ) {
                $(".cmb2-id--ruffer-custom-page-title").hide();
            } else {
                $(".cmb2-id--ruffer-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--ruffer-page-title-settings").hide();
            $(".cmb2-id--ruffer-custom-page-title").hide();

        }
    });

    //page settings
    $ruffer_page_settings.on("change",function(){
        if( $(this).val() == 'global' ) {
            $(".cmb2-id--ruffer-breadcumb-image").hide();
            $(".cmb2-id--ruffer-page-title").hide();
            $(".cmb2-id--ruffer-page-title-settings").hide();
            $(".cmb2-id--ruffer-custom-page-title").hide();
            $(".cmb2-id--ruffer-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--ruffer-breadcumb-image").show();
            $(".cmb2-id--ruffer-page-title").show();
            $(".cmb2-id--ruffer-page-breadcrumb-trigger").show();
    
            if( $ruffer_page_title.val() == '1' ) {
                $(".cmb2-id--ruffer-page-title-settings").show();
                if( $ruffer_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--ruffer-custom-page-title").hide();
                } else {
                    $(".cmb2-id--ruffer-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--ruffer-page-title-settings").hide();
                $(".cmb2-id--ruffer-custom-page-title").hide();
    
            }
        }
    });

    // page title settings
    $ruffer_page_title_settings.on("change",function(){
        if( $(this).val() == 'default' ) {
            $(".cmb2-id--ruffer-custom-page-title").hide();
        } else {
            $(".cmb2-id--ruffer-custom-page-title").show();
        }
    });
    
})(jQuery);