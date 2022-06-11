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

//w3css.css
echo'<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">';

//  Bootstrap css 
echo'
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
';
//Lightbox Gallery
echo'
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
';



function amppari_contact_page(){
    global $post;
    if($post->ID == 19){
        echo'
        <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Contact</h4>
        <hr>

      <form action="./?page_id=19" method="post">
        <div class="form-group">
           <label for="Name">Name</label>
           <input type="text" class="form-control" id="exampleFormControlName" placeholder="Name" name="ConInputName">
        </div>
        <div class="form-row">
           <div class="col">
              <div class="form-group">
                 <label for="exampleInputEmail1">EMAIL</label>
                 <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="ConInputEmail">
              </div>
           </div>
           <div class="col">
              <div class="form-group">
                 <label for="exampleInputPassword1">SUBJECT</label>
                 <input type="text" class="form-control" placeholder="Subject" name="ConInputServices" id="exampleFormControlTSubject">
              </div>
           </div>
        </div>
        <div class="form-group">
           <label for="exampleFormControlTextarea1">MESSAGE</label>
           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Message" name="ConInputMessage"></textarea>
        </div>
     
        <button type="submit" class="btn btn-primary">Submit</button>
     </form>
        ';
   if(isset($_REQUEST["ConInputName"]) && isset($_REQUEST["ConInputEmail"]) && isset($_REQUEST["ConInputServices"])&& isset($_REQUEST["ConInputMessage"])){
       amppari_send_message();
      }
       echo'
       <div id="warning">
       <div class="shadow-sm p-3 mb-5 bg-green rounded">Thank you. Your message has been sent.</div>
       </div>
      ';
      echo'</div>';
      } 
      
}

function amppari_home_page(){
    global $post;
    if($post->ID == 27){
      
        echo '
        <!-- gallery test start -->
        <div class="alert alert-danger" role="alert">
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
                        <h5 style="color:red;"><b>Vantaa GYM Club</b></h5>
                        <p>Enjoy your time in vanta gym club !</p>
                      </div>
                </div>
    
                <div class="carousel-item">
                    <img class="d-block w-100" src="../images/img_2.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                      <h5 style="color:red;"><b>Vantaa GYM Club</b></h5>
                      <p>Enjoy your time in vanta gym club !</p>
                    </div>
                </div>
    
                <div class="carousel-item">
                    <img class="d-block w-100" src="../images/img_3.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="color:red;"><b>Vantaa GYM Club</b></h5>
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

      

        echo'
        <hr>
        <div id="accordion">
        <div class="card bg-Dark  ">
        <div class="card-header" id="headingOne">
           <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              About Vantaa Gym Club!
              </button>
           </h5>
        </div>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
           <div class="card-body  ">
              <div class="carousel-item active">
                 <img class="d-block w-100" src="https://lh3.googleusercontent.com/c0covZlYNj42KyaMHufBJV2MI33MwNOlwIL_x_G6Hg0Q_MQx-tNwbTT9DaFhGEYoUHtFxhpqe_FKlKyZISIT3HJgxKcyET6kbutgVNo=s755" alt="Third slide" alt="First slide">
                 <div class="carousel-caption d-none d-md-block">
                    <div style="background-color: #00000061;" >
                       <h5 style="color:red;"><b>About Vantaa Gym Club!</b></h5>
                       <p>
                       Vantaa Gym Club is a family business that has been operating in Havukoski, 
                       Vantaa for 20 years. Our bright and airy facilities provide fitness for all levels and ages.
                       Modern equipment and professional guidance make training safe and effective.
                       You will also find gym programs and personal training services through us.
                       The warm atmosphere and plenty of performance points guarantee a comfortable gym experience 
                       for both beginners and long-time enthusiasts.
                       </p>
                    </div>
                 </div>
              </div>
              <div class="Gallery_text">
              <h5 style="color:red;"><b>About Vantaa Gym Club!</b></h5>
              <p>
              Vantaa Gym Club is a family business that has been operating in Havukoski, 
              Vantaa for 20 years. Our bright and airy facilities provide fitness for all levels and ages.
              Modern equipment and professional guidance make training safe and effective.
              You will also find gym programs and personal training services through us.
              The warm atmosphere and plenty of performance points guarantee a comfortable gym experience 
              for both beginners and long-time enthusiasts.
              </p>
           </div>
           </div>
        </div>
        <div class="card text-white bg-secondary  ">
        <div class="card-header" id="headingTwo">
           <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Vantaa GYM Club Opening Time:
              </button>
           </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
           <div class="card-body">
              <div class="carousel-item active">
                 <img class="d-block w-100" src="https://lh3.googleusercontent.com/c0covZlYNj42KyaMHufBJV2MI33MwNOlwIL_x_G6Hg0Q_MQx-tNwbTT9DaFhGEYoUHtFxhpqe_FKlKyZISIT3HJgxKcyET6kbutgVNo=s755" alt="Third slide" alt="First slide">
                 <div class="carousel-caption d-none d-md-block">
                    <div style="background-color: #00000061;" >
                       <h5 style="color:red;"> <b>Opening time</b></h5>
                       <p>  Ma 9.00-11.00 ja 17.00-20.00    <br>
                          Ti 9.00-11.00 ja 17.00-20.00    <br>
                          Ke 9.00-11.00 ja 17.00-20.00    <br>
                       </p>
                    </div>
                 </div>
              </div>
              <div class="Gallery_text">
              <h5 style="color:red;"> <b>Opening time</b></h5>
                       <p>  Ma 9.00-11.00 ja 17.00-20.00    <br>
                          Ti 9.00-11.00 ja 17.00-20.00    <br>
                          Ke 9.00-11.00 ja 17.00-20.00    <br>
                       </p>
           </div>
           </div>
        </div>
        <div class="card text-dark bg-Light  ">
           <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                 <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                 FIND OUT ABOUT OUR FACILITIES
                 </button>
              </h5>
           </div>
           <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                 <div class="carousel-item active">
                    <img class="d-block w-100" src="https://lh3.googleusercontent.com/s-xiHFA1s7YR9-li94S0Rx6Ar1oX2Ma_88NUaNPJqmZvHe8xng31GflutB67bs3IQLqLP6V5ghjqqZ0H0zt56nhSODWmK7CYM9C2kZg=s1600" alt="Third slide" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                       <div style="background-color: #00000061;" >
                          <h5 style="color:red;"> <b>FIND OUT ABOUT OUR FACILITIES</b></h5>
                          <p> 
                             NOIN 150 TREENIPISTETTÄ <br>
                             YLI 40000  KG RAUTAA    <br>
                             YHTEENSÄ 800 NELIÖTÄ    <br>
                          </p>
                       </div>
                    </div>
                 </div>
                 <div class="Gallery_text">
                    <h5 style="color:red;"> <b>FIND OUT ABOUT OUR FACILITIES</b></h5>
                    <p> 
                       NOIN 150 TREENIPISTETTÄ <br>
                       YLI 40000  KG RAUTAA    <br>
                       YHTEENSÄ 800 NELIÖTÄ    <br>
                    </p>
                 </div>
              </div>
           </div>
        </div>
        </div>
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


function amppari_aboute_page(){
    global $post;
    if($post->ID == 31){
    echo'
    <div class="alert alert-danger" role="alert">
<h4 class="alert-heading">Office opening time:</h4>
<p>Maanantaina, tiistaina ja keskiviikkona <br>
   aamulla 9.00-11.00 ja iltapäivällä 17.00-20.00 <br>
</p>
<hr>
<p class="mb-0"> Puh. 0400 449 201</p>
<hr>
<h4 class="alert-heading">Contact address:</h4>
<p> Hosantie 2, 01360 Vantaa </p>
<div class="map-responsive">
   <iframe
      src="https://www.openstreetmap.org/export/embed.html?bbox=25.057813525199894%2C60.31679890602306%2C25.06489455699921%2C60.31835291048857&amp;layer=mapnik&amp;marker=60.31773663038606%2C25.061895847320557"
      style="border: 2px solid black"></iframe>
</div>
</div>
    ';
      } 
     
}


function amppari_gallery_page(){
    global $post;
    if($post->ID == 46){
   echo'
         <div class="alert alert-danger" role="alert">
         <h4 class="alert-heading">Vantaa Gym Club Gallery</h4>
         <hr>
         <img src="../images/gym/9.jpg" class="img-fluid" alt="...">
         <hr>
         <div class="photo-gallery">
             <div class="container">
                 <div class="row photos">
                     <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="../images/gym/1.jpg" data-lightbox="photos"><img
                                 class="img-fluid" src="../images/gym/1.jpg"></a></div>
                     <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="../images/gym/2.jpg" data-lightbox="photos"><img
                                 class="img-fluid" src="../images/gym/2.jpg"></a></div>
                     <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="../images/gym/3.jpg" data-lightbox="photos"><img
                                 class="img-fluid" src="../images/gym/3.jpg"></a></div>
                     <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="../images/gym/4.jpg" data-lightbox="photos"><img
                                 class="img-fluid" src="../images/gym/4.jpg"></a></div>
                     <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="../images/gym/5.jpg" data-lightbox="photos"><img
                                 class="img-fluid" src="../images/gym/5.jpg"></a></div>
                     <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="../images/gym/7.jpg" data-lightbox="photos"><img
                                 class="img-fluid" src="../images/gym/7.jpg"></a></div>
                     <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="../images/gym/8.jpg" data-lightbox="photos"><img
                                 class="img-fluid" src="../images/gym/8.jpg"></a></div>
                     <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="../images/gym/9.jpg" data-lightbox="photos"><img
                                 class="img-fluid" src="../images/gym/9.jpg"></a></div>
                 </div>
             </div>
         </div>
     </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    
        ';
      } 
    
}
function amppari_send_message(){
   $ConInputName =test_input($_REQUEST["ConInputName"]) ;
   $ConInputEmail = test_input($_REQUEST["ConInputEmail"]);
   $ConInputServices =test_input($_REQUEST["ConInputServices"]) ;
   $ConInputMessage =test_input($_REQUEST["ConInputMessage"]) ; 

   if($ConInputName!="" &&  $ConInputEmail!="" && $ConInputServices!="" && $ConInputMessage!="" ){
    
      // here comming requset information.
      $email_name =("Name: ". $ConInputName );
      $email_epost =("From email: ". $ConInputEmail);
      $email_services =("Subject: ". $ConInputServices);
      $email_message =("Message: ". $ConInputMessage);

      $to = "gemen18937@falkyz.com"; //"somebody@example.com";
      $subject = $email_services;
      $txt = $email_name . "\r\n" .  $email_message . "\r\n" . $email_epost;
      $headers = "From: no-reply@arcada.fi";
      
      mail($to, $subject, $txt, $headers);
   
      amppari_session_unset();
      echo'<div class="shadow-sm p-3 mb-5 bg-green rounded">Thank you. Your message has been sent.</div>';
     pageRestart();
   }
   else if($ConInputName =="" ||  $ConInputEmail == "" || $ConInputServices == "" || $ConInputMessage == ""){
      
      // echo '<script type="text/JavaScript"> 
      // location.replace("./?page_id=19");
      // </script>';
      echo '
      <div id="warningText" class="w3-panel w3-red w3-display-container  rounded">
      <span onclick="warningOn()" class="w3-button w3-large w3-display-topright rounded">&times;</span>
      Please enter your information!
      </div>';
    
      amppari_session_unset();
   }
}
function amppari_session_unset(){
   unset($_REQUEST['ConInputName']);
   unset($_REQUEST['ConInputEmail']);
   unset($_REQUEST['ConInputServices']);
   unset($_REQUEST['ConInputMessage']);
}


 
// Remove whitespaces, remove extra slashes, and convert to safe html characters
// USE FOR ALL USER INPUT

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




add_action( 'generate_after_content', 'amppari_contact_page' );
add_action( 'generate_after_content', 'amppari_home_page' );

add_action( 'generate_after_content', 'amppari_aboute_page' );
add_action( 'generate_after_content','amppari_gallery_page' );


?>
<?php
 sleep(1);
 
function pageRestart(){
   echo '<script type="text/JavaScript"> 
   location.replace("./?page_id=19");
   </script>';
}

?>

