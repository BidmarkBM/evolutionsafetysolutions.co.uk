<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="https://evolutionsafetysolutions.co.uk/wp-content/uploads/2025/07/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://evolutionsafetysolutions.co.uk/wp-content/uploads/2025/07/favicon-32x32-1.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://evolutionsafetysolutions.co.uk/wp-content/uploads/2025/07/favicon-16x16-1.png">
    
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>

<?php
    wp_body_open();

    /**
    *
    * Preloader
    *
    * Hook ruffer_preloader_wrap
    *
    * @Hooked ruffer_preloader_wrap_cb 10
    *
    */
    do_action( 'ruffer_preloader_wrap' );

    /**
    *
    * ruffer header
    *
    * Hook ruffer_header
    *
    * @Hooked ruffer_header_cb 10
    *
    */
    do_action( 'ruffer_header' );