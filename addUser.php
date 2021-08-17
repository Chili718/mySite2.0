<?php
session_start();

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

      echo "<a href='uploadPic.php'><div class='homeIconButtons addImageButton'><ion-icon name='images-outline'></ion-icon></div></a>";

    }

    ?>

    <div class="centerForm">
      <!--
      Handle the form submission vis JS when hitting enter "submitting the form"
      another way than clicking the button
      -->
      <form class="frm" id="frm">

        <h1>Create a New User</h1>

        <div class="allInp">
          <div class="inp">
            <input type="text" name="userNME" id="userNME" required/>
            <label>Username</label>
          </div>
          <div class="inp">
            <input type="password" name="pswrd" id="pswrd" required/>
            <label>Password</label>
          </div>
          <div class="inp">
            <input type="password" name="pswrdR" id="pswrdR" required/>
            <label>Repeat Password</label>
          </div>
          <div class="inp">
            <input type="text" name="email" id="email" required/>
            <label>Email</label>
          </div>
        </div>

        <h3 id="errorTxt"></h3>
        <h3 id="successTxt"></h3>

        <div class="btn frmBtn">
          Create User
          <input type= "submit" style="display: none">
        </div>

      </form>

    </div>

    <script type="text/javascript" src="js/mySite.js"></script>
    <script type="text/javascript" src="js/createUser.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>

</html>
<script>

  $(document).ready(function(){

    $("#frm").submit(function(e) {
        e.preventDefault();
    });

    $('.frmBtn').click(function(){

      var userNme = $('#userNME').val();
      var pswrd = $('#pswrd').val();
      var pswrdR = $('#pswrdR').val();
      var email = $('#email').val();
      
      //reg expression for an email
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if(userNme == '' || pswrd == '' || pswrdR == '' || email == '')
      {
        document.getElementById('errorTxt').innerHTML = 'Please complete all fields!';

        removeSetTimeOut('errorTxt');

        return false;

      }
      else if(userNme.length < 4)
      {

        document.getElementById('errorTxt').innerHTML = 'Username must be at least 4 characters!';

        removeSetTimeOut('errorTxt');

        return false;

      }
      else if(pswrd != pswrdR)
      {

        document.getElementById('errorTxt').innerHTML = 'Passwords Do Not Match!';

        removeSetTimeOut('errorTxt');

        return false;

      }//I should make you add a special character but I don't want or need to do that for this
      else if(pswrd.length < 8 || pswrd.match(RegExp('(?=.*[0-9])+(?=.*[A-Z])')) == null)
      //regular expression checking for at least one number and capitol letter
      {

        document.getElementById('errorTxt').innerHTML = 'Password length must be at least 8 characters and contain 1 number and 1 capitol letter!';

        removeSetTimeOut('errorTxt');

        return false;


      }
      else if(!regex.test(email))
      {

        document.getElementById('errorTxt').innerHTML = 'Invalid Email Given';

        removeSetTimeOut('errorTxt');

        return false;

      }

      createUser();

    });

  });
  //nifty js to remove confirm form resubmission
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }

</script>
