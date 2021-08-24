<?php

  session_start();

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
    <link rel="stylesheet" href="css/view.css">
    <!-- Front I use from Adobe -->
    <script src="https://use.typekit.net/efv3afb.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type="text/javascript" src="js/linlout.js"></script>

    <script>

    $(document).ready(function() {

      var count = $(".psW").length;
      var filter = $('input[name="filter"]:checked').val();
      //boolean for limiting how often a request for more
      //images can be sent
      var r = false;
      //getting the initial 20 images on the page
      $.ajax({

        url: 'php/view.php',
        type: 'POST',
        data: {count: count,
              filter: filter},
        success: function(response){

          $(".grid").prepend(response).show().fadeIn("slow");

        }

      });

      //console.log($(".psW").length);

      //when the ajax request on the page is made for getting more
      //images the loading element will be displayed
      //I only want this to work when the user is loading in more images
      $(document).ajaxStart(function(){
        //show the loading animation
        if(count != 0)
        {
          $('#load').toggleClass('hideGroup');
        }
        //console.log("unhide");

        }).ajaxStop(function(){
        //hide the loading animtaion after 2.5s to show the whole
        //animation as a visual for user
        if(count != 0){

          setTimeout(function(){
            $('#load').toggleClass('hideGroup');
            //console.log("hide");
          }, 2500);

        }

      });
      //when the filters are changed the page will be updated with the
      //first 20 of the clicked filter
      $('input[type=radio][name=filter]').change(function() {
        //remove the current images
        $(".grid").html('');
        //reset the count to zero instead of using jquery
        count = 0;
        //filter from the current radio selected
        filter = this.value;

        $.ajax({

          url: 'php/view.php',
          type: 'POST',
          data: {count: count,
                filter: filter},
          success: function(response){

            $(".grid").prepend(response).hide().fadeIn(1500);

          }

        });

      });

      //change opacity of the header background on scroll
      $(window).on("scroll", function(){

        if($(window).scrollTop() > 0){
          $(".navbar").addClass("nottransparent");

        }else{
          $(".navbar").removeClass("nottransparent");

        }
        //check for when the user is at the bottom of the page to load more images
        //unless a request was made to quick 
        if($(window).scrollTop() + $(window).height() > $(document).height()-50 && r == false){

          count = $(".psW").length;
          filter = $('input[name="filter"]:checked').val();

          //console.log(count);

          r = true;
          //ajax request to put another 20 or less images on the page
          $.ajax({

            url: 'php/view.php',
            type: 'POST',
            data: {count: count,
                   filter: filter},
            success: function(response){

              //timeout to display the images after the loading animation plays once
              setTimeout(function(){
                //console.log("success");
                $(".grid div").last().after(response).show().fadeIn("slow");
                //addLB();

              }, 2500);
              //timeout for allowing another request for images to be sent after 6 seconds
              setTimeout(function(){

                r = false;

              }, 6000);

            }

          });

        }

      });

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

    <a href="">
      <div class="homeIconButtons dayNightToggle">
        <ion-icon name="moon-outline"></ion-icon>
      </div>
    </a>

    <?php
      //user functions of adding images and other users if the user is signed in or not
      if(isset($_SESSION['verified']))
      {

        echo "<a href='addUser.php'><div class='homeIconButtons addUserButton'><ion-icon name='person-add-outline'></ion-icon></div></a>";
        echo "<a href='uploadPic.php'><div class='homeIconButtons addImageButton'><ion-icon name='images-outline'></ion-icon></div></a>";

      }
    ?>

    <div class="filterContainer">
      <div class="filters">

        <input type="radio" name="filter" onclick="" value="newest" id="tab-1" checked/>
        <label for="tab-1" class= "segmented-control__1">Newest</label>|

        <input type="radio" name="filter" onclick="" value="oldest" id="tab-2" />
        <label for="tab-2" class= "segmented-control__2"><p>Oldest</p></label>|

        <input type="radio" name="filter" onclick="" value="best" id="tab-3" />
        <label for="tab-3" class= "segmented-control__3">Best</label>|

        <input type="radio" name="filter" onclick="" value="worst" id="tab-4" />
        <label for="tab-4" class= "segmented-control__4">Worst</label>

        <div class="segmented-control__color"></div>
      </div>

    </div>


    <div class="contain">
      <!--<h2 id="galleryTitle">Click or tap on the image!</h2>-->
      <div class="grid">

      </div>
    </div>

    <h3 id="validateTXT"></h3>

    <div class="group hideGroup" id="load">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
    </div>


    <script type="text/javascript" src="js/mySite.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>

</html>
