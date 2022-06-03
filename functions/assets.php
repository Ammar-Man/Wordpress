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

add_action( 'wp_enqueue_scripts', 'our_theme_assets' );