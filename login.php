<?php
session_start();


$dbf = "";
$ver = "";
//print_r($_SESSION);
if(isset($_SESSION['verified']))
{
  header("Location: index.php");
  die();
//the vkey will only be set if the user clicks the verify link in the verification email
//and the script will run to verify the account
}else if(isset($_GET['vkey'])){

  require 'php/verify.php';

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

    <link rel="stylesheet" id="dayNightToggle" href="css/variablesDay.css">
    <script type="text/javascript" src="js/theme.js"></script>

    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/input.css">
    <!-- Front I use from Adobe -->
    <script src="https://use.typekit.net/efv3afb.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type="text/javascript" src="js/linlout.js"></script>

    <script>

    $(document).ready(function() {

      changeIcon();

      $(".preloader").height(window.innerHeight);
      $(".centerForm").height(window.innerHeight);
      if($(window).width() < 921){
        $(".nav-links").height(window.innerHeight + 25);
      }else{
        $('.nav-links').css('height', '');
        if($('.nav-links').hasClass('open'))
          toggleMenu();
      }

    });

    $( window ).resize(function() {
      $(".preloader").height(window.innerHeight);
      $(".centerForm").height(window.innerHeight);
      if($(window).width() < 921){
        $(".nav-links").height(window.innerHeight + 25);
      }else{
        $('.nav-links').css('height', '');
        if($('.nav-links').hasClass('open'))
          toggleMenu();
      }
    });

    </script>

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

    <div class="homeIconButtons dayNightToggle" onclick="changeTheme(); changeIcon();">
      <ion-icon name="moon-outline"></ion-icon>
    </div>

    <div class="centerForm">
      <!--
      Handle the form submission vis JS when hitting enter "submitting the form"
      another way than clicking the button
      -->
      <form class="frm"id="frm">

        <h1>Account Login</h1>

        <div class="allInp">
          <div class="inp">
            <input type="text" name="userNME" id="userNME" required/>
            <label>Username</label>
          </div>
          <div class="inp">
            <input type="password" name="pswrd" id="pswrd" required/>
            <label>Password</label>
          </div>
        </div>

        <h3 id="errorTxt"><?php echo $dbf; ?></h3>
        <h3 id="successTxt"><?php echo $ver; ?></h3>

        <div class="btn frmBtn" onclick="login()" tabindex="0">
          Sign In
          <input type= "submit" style="display: none">
        </div>

      </form>

    </div>

    <p class="cpyrght"> &copy; 2021 Jon Tice. <p>

    <script>
      //preventing the page from reloading after hitting enter
      $("#frm").submit(function(e) {
          e.preventDefault();
      });
    </script>
    <script type="text/javascript" src="js/mySite.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>

</html>
