<?php

// Filter (lite som middleware), kan användas fär att behandla innehåll i temat
add_filter('generate_post_author_output', function($output) {
    // $output tex.  "by welandfr@arcada.fi
    return $output . " HELLO from filter!!!";
});

// Exempel: Hook, körs på ett visst ställe i temat
function arcada_content() {

    echo '<div class="arcada-content entry-content">
        <p><small>HELLO from <i>generate_after_content</i>-hook!!!!!</small></p>
        </div>';

}
// T.ex. körs vid "generate_after_content"
 //add_action( 'generate_after_content', 'arcada_content', 10, 0 );

function amppari_contact_page(){
    global $post;
    if($post->ID == 19){
        echo "Work (".$post->ID.")";
      } 
     
}
function amppari_home_page(){
    global $post;
    if($post->ID == 27){
        echo "Work (".$post->ID.")";
      } 
    
}
function amppari_blog_page(){
    global $post;
    if($post->ID == 29){
        echo "Work (".$post->ID.")";
      } 
     
}
function amppari_aboute_page(){
    global $post;
    if($post->ID == 31){
        echo "Work (".$post->ID.")";
      } 
     
}
function amppari_info_page(){
    global $post;
    if($post->ID == 46){
        echo "Work (".$post->ID.")";
      } 
    
}


 function my_favicon_link() {
}

add_action( 'generate_after_content', 'amppari_contact_page' );
add_action( 'generate_after_content', 'amppari_home_page' );
add_action( 'generate_after_content', 'amppari_blog_page' );
add_action( 'generate_after_content', 'amppari_aboute_page' );
add_action( 'generate_after_content', 'amppari_info_page' );