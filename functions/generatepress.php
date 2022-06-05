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

//  Bootstrap css 
echo'
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
';


function amppari_contact_page(){
    global $post;
    if($post->ID == 19){
        echo "Work (".$post->ID.")";
        echo '
        <p>Responsiv map</p>
        <div class="map-responsive">
          <iframe
            src="https://www.openstreetmap.org/export/embed.html?bbox=24.963351488113407%2C60.19904589540361%2C24.967353343963627%2C60.20389775421609&amp;layer=mapnik&amp;marker=60.2014719144904%2C24.965352416038513"
            style="border: 2px solid black"></iframe><br />
        </div>';
     
      } 
     
}
function amppari_home_page(){
    global $post;
    if($post->ID == 27){
       
        echo '
        <!-- gallery test start -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               
    
                <div class="carousel-item active">
                    <img class="d-block w-100" src="../images/img_1.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Vanta GYM Club</h5>
                        <p>Enjoy your time in vanta gym club !</p>
                      </div>
                </div>
    
                <div class="carousel-item">
                    <img class="d-block w-100" src="../images/img_2.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Vanta GYM Club</h5>
                      <p>Enjoy your time in vanta gym club !</p>
                    </div>
                </div>
    
                <div class="carousel-item">
                    <img class="d-block w-100" src="../images/img_3.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Vanta GYM Club</h5>
                        <p>Enjoy your time in vanta gym club !</p>
                      </div>
                </div>
    
               
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        ';

        echo '
        <p>
        Welcome to Vantaa Gym! <br>
        Office open: <br>
        Mon 9am to 11pm and 5pm to 8pm <br>

        Tue 9: 00-11: 00 and 17: 00-20: 00 <br>
        Wed 9: 00-11: 00 and 17: 00-20: 00 <br>
        </p>
    
        
        ';


        echo'
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        ';
      } 
    
}

function amppari_blog_page(){
    global $post;
    if($post->ID == 29){
        echo "Work (".$post->ID.")";
        echo '<img class="d-block w-100" src="../images/img_1.jpg" alt="First slide">';
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
        echo '
        <p>Responsiv map</p>
        <div class="map-responsive">
          <iframe
            src="https://www.openstreetmap.org/export/embed.html?bbox=24.963351488113407%2C60.19904589540361%2C24.967353343963627%2C60.20389775421609&amp;layer=mapnik&amp;marker=60.2014719144904%2C24.965352416038513"
            style="border: 2px solid black"></iframe><br />
        </div>';
      } 
    
}


add_action( 'generate_after_content', 'amppari_contact_page' );
add_action( 'generate_after_content', 'amppari_home_page' );
add_action( 'generate_after_content', 'amppari_blog_page' );
add_action( 'generate_after_content', 'amppari_aboute_page' );
add_action( 'generate_after_content', 'amppari_info_page' );

