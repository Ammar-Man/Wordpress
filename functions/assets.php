<?php

function our_theme_assets() {

/*
    // CSS
    wp_enqueue_style(
            'arcada-theme-css',
            get_bloginfo( 'stylesheet_directory' ) . '/compiled.css',
            false, // dependencies
            filemtime( get_theme_file_path() . '/compiled.css' ),
            false // media
    );
*/

    // JavaScript
    wp_enqueue_script(
            'arcada-theme-scripts',
            get_bloginfo( 'stylesheet_directory' ) . '/scripts.js',
            array( 'jquery' ), // dependencies
            filemtime( get_theme_file_path() . '/scripts.js' ),
            true // in footer
    );

}

function ammar_Bootstrap(){
echo'

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


';
}

add_action( 'wp_enqueue_scripts', 'ammar_Bootstrap' );

add_action( 'wp_enqueue_scripts', 'our_theme_assets' );