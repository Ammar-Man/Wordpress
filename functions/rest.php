<?php

// functions/rest.php

add_action( 'rest_api_init', function () {

    // Spakar /wp-json/external/services/

    register_rest_route(

            'external',

            '/services',

            
            array(
                'permission_callback' => '__return_true',
                    'methods' => 'GET',

                    'callback' => 'output_arcada_services',

            )

    );

} );

function output_arcada_services( $data ) {

    $services = array();

    $data = get_posts( array(

            'post_type'          => 'post', // egen post type kan användas

            'posts_per_page' => - 1,

            'orderby'            => 'post_title',

            'order'              => 'ASC'

    ) );

    foreach( $data as $service ) {

            $services[] = array(

                    'id' => $service->post_name, // slug

                    'name' => $service->post_title,

                    'excerpt' => $service->post_excerpt,

                    'url' => get_permalink( $service->ID ),

            );

    }

    return $services;

}