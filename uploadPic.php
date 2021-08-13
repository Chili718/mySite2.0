<?php

session_start();
//print_r($_SESSION);
//
if(!isset($_SESSION['verified']) || $_SESSION['verified'] !== true)
{
  header("Location: login.php");
  die();

}

 ?>
<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>All Photoshop Work</title>
    <link rel="icon" href="images/icon.ico">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/input.css">
    <!-- Front I use from Adobe -->
    <script src="https://use.typekit.net/efv3afb.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type="text/javascript" src="js/linlout.js"></script>

  </head>

  <body>

    <div class="preloader">

      <img class="ship" src="images/ship.gif">

      <div class="loadDots">

        <img class="" src="images/Loading.gif">
        <img class="" src="images/Circle.gif">

      </div>

    </div>

    <div class="navbar">
        <a class="imgLink" href="index.php#home"><img class="nav-signature" src="images/logo.png"></a>
        <ul class="nav-links" id="check">
          <li><a href="index.php#work">Developer Work</a></li>
          <li><a href="index.php#projects">Projects</a></li>
          <li><a href="index.php#photoshop">Photoshop Work</a></li>
          <li><a href="index.php#contact">Contact</a></li>
          <li><a href="downloads/TiceResume.pdf" download="JonTiceResume">Resume</a></li>

          <?php
            //display login our logout link depending on the if the users is or not
            if(!isset($_SESSION['verified']) || $_SESSION['verified'] !== true)
            {

                  echo "<li><a href='login.php'>Login</a></li>";

            }else{

                  echo "<li><a href='#' onclick='logout()'>Logout</a></li>";
                  echo "<script>activityWatcher()</script>";

            }

           ?>

        </ul>
        <div class="burger">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
    </div>

    <a href="">
      <div class="homeIconButtons dayNightToggle">
        <ion-icon name="moon-outline"></ion-icon>
      </div>
    </a>

    <?php

    if(isset($_SESSION['verified']))
    {

      echo "<a href='addUser.php'><div class='homeIconButtons addUserButton'><ion-icon name='person-add-outline'></ion-icon></div></a>";

    }

    ?>

    <div class="centerForm">
      <!--
      Handle the form submission vis JS when hitting enter "submitting the form"
      another way than clicking the button
      -->
      <form class="frm" onsubmit="checkUpload();" method="POST" enctype="multipart/form-data">

        <h1>Upload an Image</h1>

        <div class="allInp">
          <div class="inp">
            <input type="text" name="imageNme" id="imageNme" required/>
            <label>Image Name</label>
          </div>
          <div class="inp">
            <input type="text" name="imageDes" id="imageDes" required/>
            <label>Image Description</label>
          </div>
          <input type="file" name="image" id="image" value=""/>
          <input type="range" name="rating" id="rating" min="0" max="100" value="0">
        </div>

        <h3 id="errorTxt"><?php echo $dbf; ?></h3>
        <h3 id="successTxt"><?php echo $ver; echo $close; ?></h3>

        <div class="btn frmBtn" onclick="checkUpload();" tabindex="0">
          Upload Image
          <input type= "submit" style="display: none">
        </div>

      </form>

    </div>

    <script type="text/javascript" src="js/mySite.js"></script>
    <script src="js/uploadMin.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>

</html>
<script>

  $(document).ready(function(){

    $("#frm").keydown(function(e){

      if(e.which == 13){

        checkUpload();

      }

    });

    $('#insert').click(function(){

      checkUpload();
      /*
      var image = $('#image').val();
      var image_name = $('#imageNme').val();
      var image_des = $('#imageDes').val();

      if(image_name == '' || image == '' || image_des == '')
      {
        document.getElementById('validateTXT').innerHTML = 'Please complete all fields!';

        setTimeout(function(){
          document.getElementById('validateTXT').innerHTML = '';
        }, 3000);

        return false;

      }
      else
      {
        var extension = $('#image').val().split('.').pop().toLowerCase();

        if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
        {
          document.getElementById('validateTXT').innerHTML = 'Invalid File Type!';

          setTimeout(function(){
            document.getElementById('validateTXT').innerHTML = '';
          }, 3000);

          $('#image').val('');
          return false;
        }
      }

      uploadAndResizeImage();
      */
    });

  });
  //nifty js to remove confirm form resubmission
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }

</script>