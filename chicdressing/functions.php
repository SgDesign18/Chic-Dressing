<?php 

add_action( 'wp_enqueue_scripts', 'chicdressing_enqueue_styles' );
function chicdressing_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
}

add_filter( 'big_image_size_threshold', '__return_false' );


//réduire poids des images

add_action( 'after_setup_theme', 'chicdressing_add_custom_image_size' );

function chicdressing_add_custom_image_size() {
    add_image_size( 'custom-thumbnail', 150, 150, true );
}


// Fonction personnalisée pour modifier la taille des images
function custom_ashe_get_image_src_by_url($image_url, $image_size) {
    if (!isset($image_url) || '' === $image_url) {
        return [0 => null];
    } else {
        // Taille d'image personnalisée 
        return wp_get_attachment_image_src(attachment_url_to_postid($image_url), 'medium');
    }
}

// Décharger les polices Google Fonts
function remove_google_fonts_stylesheets() {
    wp_dequeue_style('ashe-kalam-font');
    wp_dequeue_style('ashe-opensans-font');
    wp_dequeue_style('ashe-playfair-font');
}
add_action('wp_enqueue_scripts', 'remove_google_fonts_stylesheets', 999);


// Charger les polices locales
function enqueue_local_fonts() {
    wp_enqueue_style('local-kalam-font', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('local-opensans-font', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('local-playfair-font', get_stylesheet_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_local_fonts');




