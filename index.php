<?php

  session_start();

 ?>
<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jon Tice - Designer and Full Stack Web Developer</title>
    <link rel="icon" href="images/icon.ico">

    <link rel="stylesheet" id="dayNightToggle" href="">
    <script type="text/javascript" src="js/theme.js"></script>

    <link rel="stylesheet" href="css/input.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- Front I use from Adobe -->
    <script src="https://use.typekit.net/efv3afb.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type="text/javascript" src="js/linlout.js"></script>

    <script>

      $(document).ready(function() {

        changeIcon();

      });

      //change opacity of the header background on scroll
      $(window).on("scroll", function(){

        if($(window).scrollTop() > 0){
          $(".navbar").addClass("nottransparent");

        }else{
          $(".navbar").removeClass("nottransparent");

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
        <a class="imgLink" href="#home"><img class="nav-signature" src="images/logo.png"></a>
        <ul class="nav-links" id="check">
          <li><a href="#work">Developer Work</a></li>
          <li><a href="#projects">Projects</a></li>
          <li><a href="#photoshop">Photoshop Work</a></li>
          <li><a href="#contact">Contact</a></li>
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

    <?php
      //user functions of adding images and other users if the user is signed in or not
      if(isset($_SESSION['verified']))
      {

        echo "<a href='addUser.php'><div class='homeIconButtons addUserButton'><ion-icon name='person-add-outline'></ion-icon></div></a>";
        echo "<a href='uploadPic.php'><div class='homeIconButtons addImageButton'><ion-icon name='images-outline'></ion-icon></div></a>";

      }
    ?>
    <div class="parallax" id="home">
      <!--
      <div class="image-anim">
        <svg id="name" width="518" height="107" viewBox="0 0 518 107" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M67.056 2.80801C69.648 2.80801 71.904 3.09601 73.824 3.672C75.84 4.24801 76.944 5.11201 77.136 6.26401C77.136 8.66401 75.216 17.928 71.376 34.056C67.536 50.184 63.984 64.488 60.72 76.968C58.896 83.88 55.344 89.592 50.064 94.104C44.88 98.52 38.016 100.728 29.472 100.728C22.464 100.728 16.896 99.432 12.768 96.84C8.73599 94.152 5.95199 90.984 4.41599 87.336C2.78399 83.688 1.96799 80.088 1.96799 76.536C1.96799 70.968 2.68799 66.936 4.12799 64.44C5.47199 61.848 7.87199 60.552 11.328 60.552C14.688 60.552 17.328 61.032 19.248 61.992C21.168 62.856 22.128 64.008 22.128 65.448C22.128 66.408 21.36 67.944 19.824 70.056C18.192 72.264 17.376 73.848 17.376 74.808C17.472 79.32 18.48 82.44 20.4 84.168C22.416 85.896 25.2 86.76 28.752 86.76C31.248 86.76 33.648 85.752 35.952 83.736C38.352 81.72 40.272 78.024 41.712 72.648L55.68 18.648C49.44 19.704 44.304 20.664 40.272 21.528C38.352 20.856 36.864 19.848 35.808 18.504C34.848 17.064 34.368 15.384 34.368 13.464C34.368 10.68 36.24 8.47201 39.984 6.84001C47.568 5.30401 53.088 4.29601 56.544 3.81601C60 3.24001 63.504 2.90401 67.056 2.80801Z" stroke="white" stroke-width="3"/>
        <path d="M104.028 102.024C95.58 102.024 89.004 99.144 84.3 93.384C79.596 87.624 77.244 80.28 77.244 71.352C77.244 63.864 79.02 56.808 82.572 50.184C86.22 43.56 91.164 38.232 97.404 34.2C103.644 30.168 110.508 28.152 117.996 28.152C125.388 28.152 131.436 30.6 136.14 35.496C140.94 40.296 143.34 47.4 143.34 56.808C143.34 63.432 141.516 70.296 137.868 77.4C134.22 84.504 129.324 90.408 123.18 95.112C117.132 99.72 110.748 102.024 104.028 102.024ZM106.188 90.504C109.26 90.504 112.332 88.584 115.404 84.744C118.572 80.904 121.164 76.056 123.18 70.2C125.196 64.344 126.204 58.632 126.204 53.064C126.204 44.52 122.652 40.248 115.548 40.248C111.612 40.248 108.012 42.12 104.748 45.864C101.484 49.608 98.892 54.264 96.972 59.832C95.052 65.304 94.092 70.44 94.092 75.24C94.092 78.024 94.716 80.616 95.964 83.016C97.212 85.32 98.748 87.144 100.572 88.488C102.492 89.832 104.364 90.504 106.188 90.504Z" stroke="white" stroke-width="3"/>
        <path d="M158.577 33.192C158.289 32.904 158.145 32.568 158.145 32.184C158.145 31.224 159.201 30.456 161.313 29.88C163.425 29.208 166.353 28.872 170.097 28.872C173.553 28.872 176.097 29.784 177.729 31.608C179.361 33.336 180.321 35.448 180.609 37.944L178.017 47.304C180.033 44.52 182.865 41.88 186.513 39.384C190.161 36.792 193.857 34.728 197.601 33.192C201.345 31.656 204.417 30.888 206.817 30.888C211.905 30.888 215.601 31.848 217.905 33.768C220.209 35.592 221.361 38.52 221.361 42.552C215.697 57.336 211.953 73.272 210.129 90.36L212.145 97.416C210.993 99.624 209.361 101.352 207.249 102.6C205.233 103.944 202.257 104.616 198.321 104.616C196.017 104.616 194.337 103.848 193.281 102.312C192.225 100.776 191.697 98.856 191.697 96.552C191.697 90.12 192.609 83.064 194.433 75.384C196.353 67.608 198.561 59.688 201.057 51.624C202.017 48.552 202.497 46.968 202.497 46.872C202.497 45.528 201.729 44.856 200.193 44.856C198.081 44.856 194.865 46.344 190.545 49.32C186.321 52.296 181.953 57.336 177.441 64.44C172.929 71.448 169.281 80.664 166.497 92.088C166.305 92.664 166.065 93.72 165.777 95.256C165.489 96.792 164.721 97.896 163.473 98.568C162.225 99.144 160.209 99.432 157.425 99.432C154.257 99.432 151.905 99.096 150.369 98.424C148.929 97.752 148.209 96.312 148.209 94.104C148.497 92.76 148.929 91.128 149.505 89.208C155.073 66.84 159.345 49.608 162.321 37.512L158.577 33.192Z" stroke="white" stroke-width="3"/>
        <path d="M301.112 89.64C300.344 93 299.144 95.592 297.512 97.416C295.976 99.24 293.432 100.152 289.88 100.152C286.904 100.152 284.696 99.672 283.256 98.712C281.912 97.656 281.24 95.928 281.24 93.528C281.24 92.472 281.384 91.464 281.672 90.504L298.952 21.528C298.856 21.528 295.736 21.864 289.592 22.536C282.2 23.112 277.592 23.592 275.768 23.976C273.848 23.304 272.36 22.296 271.304 20.952C270.344 19.512 269.864 17.832 269.864 15.912C269.864 14.376 270.392 12.936 271.448 11.592C272.6 10.152 273.944 9.09601 275.48 8.42401C283.16 6.88801 299.624 5.54401 324.872 4.39201C331.88 4.10401 336.68 3.81601 339.272 3.52801C340.808 4.20001 342.104 5.25602 343.16 6.69601C344.312 8.04001 344.888 9.48001 344.888 11.016C344.888 12.744 344.024 14.424 342.296 16.056C340.568 17.688 338.6 18.84 336.392 19.512L317.528 20.232L301.112 89.64Z" stroke="white" stroke-width="3"/>
        <path d="M357.596 13.464C357.596 10.488 358.508 7.84801 360.332 5.54401C362.252 3.24001 364.892 2.08801 368.252 2.08801C371.804 2.08801 374.876 3.19201 377.468 5.40001C380.156 7.60801 381.5 10.104 381.5 12.888C381.5 15.672 380.156 18.072 377.468 20.088C374.78 22.104 371.66 23.112 368.108 23.112C364.652 23.112 362.012 22.248 360.188 20.52C358.46 18.696 357.596 16.344 357.596 13.464ZM343.916 89.352C343.916 87.624 348.188 70.344 356.732 37.512L355.868 32.184C355.868 31.128 356.492 30.312 357.74 29.736C358.988 29.16 361.388 28.872 364.94 28.872C367.724 28.872 369.74 29.64 370.988 31.176C372.332 32.712 373.004 34.536 373.004 36.648C373.004 37.224 372.908 37.992 372.716 38.952L359.9 90.792L360.764 96.12C360.764 97.176 360.14 97.992 358.892 98.568C357.644 99.144 355.244 99.432 351.692 99.432C348.524 99.432 346.46 98.52 345.5 96.696C344.54 94.776 344.012 92.328 343.916 89.352Z" stroke="white" stroke-width="3"/>
        <path d="M438.577 85.896C436.849 90.792 433.441 94.728 428.353 97.704C423.265 100.584 416.161 102.024 407.041 102.024C400.705 102.024 395.473 100.92 391.345 98.712C387.217 96.504 384.193 93.624 382.273 90.072C380.353 86.52 379.393 82.68 379.393 78.552C379.393 69.336 381.217 61.128 384.865 53.928C388.513 46.632 393.649 40.968 400.273 36.936C406.993 32.808 414.769 30.744 423.601 30.744C429.169 30.744 433.969 32.376 438.001 35.64C442.033 38.904 444.049 43.224 444.049 48.6C444.049 50.712 443.281 52.488 441.745 53.928C440.305 55.272 438.193 55.944 435.409 55.944C433.105 55.944 431.473 55.368 430.513 54.216C429.553 52.968 429.073 51.528 429.073 49.896C429.073 47.784 428.353 46.104 426.913 44.856C425.473 43.608 423.649 42.984 421.441 42.984C418.561 42.984 415.105 44.52 411.073 47.592C407.137 50.664 403.729 54.936 400.849 60.408C398.065 65.784 396.673 71.832 396.673 78.552C396.673 81.528 397.777 84.072 399.985 86.184C402.193 88.296 405.265 89.352 409.201 89.352C412.465 89.352 415.105 88.728 417.121 87.48C419.137 86.232 421.297 84.456 423.601 82.152C425.041 80.712 426.241 79.656 427.201 78.984C428.161 78.312 429.169 77.976 430.225 77.976C432.529 77.976 434.401 78.648 435.841 79.992C437.281 81.24 438.193 83.208 438.577 85.896Z" stroke="white" stroke-width="3"/>
        <path d="M479.332 102.024C469.828 102.024 462.869 100.152 458.453 96.408C454.133 92.664 451.973 87.672 451.973 81.432C451.973 72.12 453.893 63.672 457.733 56.088C461.573 48.408 466.9 42.408 473.716 38.088C480.532 33.672 488.308 31.464 497.044 31.464C502.516 31.464 507.076 33 510.724 36.072C514.468 39.144 516.34 43.704 516.34 49.752C516.34 56.184 514.229 61.224 510.005 64.872C505.877 68.52 500.453 71.16 493.733 72.792C487.109 74.328 478.757 75.576 468.677 76.536C468.389 77.784 468.245 79.272 468.245 81C468.245 83.688 469.397 85.752 471.701 87.192C474.005 88.632 477.221 89.352 481.349 89.352C484.325 89.352 487.78 88.728 491.716 87.48C495.748 86.232 498.82 84.168 500.932 81.288C502.18 79.656 503.621 78.36 505.253 77.4C506.981 76.44 508.661 75.96 510.293 75.96C511.829 75.96 513.076 76.488 514.036 77.544C515.092 78.504 515.621 79.992 515.621 82.008C514.565 85.08 512.356 88.2 508.996 91.368C505.636 94.44 501.365 96.984 496.181 99C491.093 101.016 485.476 102.024 479.332 102.024ZM472.421 63.288C478.565 63.192 484.853 62.04 491.285 59.832C497.717 57.528 500.932 53.544 500.932 47.88C500.932 46.536 500.308 45.528 499.06 44.856C497.812 44.088 496.469 43.704 495.029 43.704C492.245 43.704 489.317 44.76 486.245 46.872C483.269 48.888 480.532 51.432 478.036 54.504C475.54 57.48 473.669 60.408 472.421 63.288Z" stroke="white" stroke-width="3"/>
        </svg>
        <p>Designer and Full Stack Web Developer</p>
      </div>
    -->
      <div class="downArrow">
          <a href="#about">
          <span></span>
        </a>
      </div>

    </div>

    <!-- ABOUT ME SECTION START-->

    <section class="about" id="about">

      <img class="myPicture" src="images/picofme.png">

      <div class="aboutText">

        <h1>About Me</h1>

        <p class="aboutParagraph">
          I am a programmer who focuses on website development with HTML, JavaScript(REACT & jQuery), CSS, PHP, and MySQL. My background in programming has quite the breadth of exposure from not only my <a href="https://github.com/Chili718/Course-Work" target="_blank" rel="noopener noreferrer">education</a> but my eagerness to learn and accept challenges. While I mainly stick to my full stack development, I've spent a good amount of time with other languages such as C++, C# (Unity), Java, and Python.
          The greatest thing about web development is each project I tackle is a challenge in terms of creativity and logic. The process of assessing the needs of a user and going from design to implementation never leaves you without a problem that needs a new solution. I am never not learning and am certainly never bored.
        </p>

        <div class="btn btnResume"><a class="btnLink" href="downloads/TiceResume.pdf" target="_blank">View Resume</a></div>
        <!---->

      </div>

    </section>

    <!-- ABOUT ME SECTION END-->

    <!-- FREELANCE WORK SECTION START -->

    <section class="freelanceWork" id="work">

      <h1>Freelance Work</h1>

      <div class="worksContainer">

        <div class="workContainer">
          <h2>My NC State Retirement</h2>
          <a href="https://myncsretirement.com/" target="_blank" rel="noopener noreferrer">
            <img src="images/myNCS.jpg">
          </a>
        </div>

        <div class="workContainer">
          <h2>Part of the Goodness</h2>
          <a href="https://partofthegoodness.com/" target="_blank" rel="noopener noreferrer">
            <img src="images/partofthegoodness.jpg">
          </a>
        </div>

      </div>

    </section>

    <!-- FREELANCE WORK SECTION END -->

    <!-- CODING PROJECTS SECTION START -->

    <section class="codeprojects" id="projects">

      <h1>Coding Projects</h1>

      <p class ="codeprojectsExplanation">
        Here are two of my bigger projects I've done in my free time using REACT. You can view the code on Git along with other programs I've made using a variety of other languages such as C++, C#(Unity), Python, Java. My <a href="https://github.com/Chili718?tab=repositories"  target="_blank" rel="noopener noreferrer">Git Repositories</a> are a combination of my course work and other projects I've done in my free time. You can also view the source for <a href="https://github.com/Chili718/dynamicSite"  target="_blank" rel="noopener noreferrer">This Website</a> which was made using JS, PHP, jQuery, and mySQL.
      </p>

      <p class="tapOrHover">Tap or Hover for more!</p>

      <div class="projectContainer">
        <div class="project">
          <h2>Sorting Algorithm Visualizer</h2>
          <div class="container">
            <img src="images/dummy.gif">
            <div class="org">
              <a href="">View Source</a>
              <a href="">View Live Demo</a>
            </div>
         </div>
        </div>

        <div class="project">
          <h2>Pathfinding Algorithm Visualizer</h2>
          <div class="container">
            <img src="images/dummy.gif">
            <div class="org">
              <a href="">View Source</a>
              <a href="">View Live Demo</a>
            </div>
         </div>
        </div>

      </div>

     </section>

     <!-- CODING PROJECTS SECTION END -->

     <!-- PHOTOSHOP PROJECTS SECTION START -->

     <section class="photoshop" id="photoshop">

       <h1>Photoshop Work</h1>

       <p class ="photoshopExplanation">
         In order to get better at using Photoshop I would make an image every day that would help me learn something new about the program and improve upon my design skills. After doing this for a whole year I was left with a deep understanding of Photoshop and a large body of work.
         I don't have all 365 images on here, but it's instead a selection of what I thought was at least decent to really good. This also contains other images I've done after the whole year which I've spent more than a couple hours in a day on.
         Theres a lot to look at and I can 100% guarantee you will like at least one of my images so check them out! I ended up really enjoying the experience and taking a lot from it. Anytime I want to learn a program, coding language, or anything I apply the same principle. I still make images for fun and will upload them here and on my Instagram when they are finished.
       </p>

      <div class="btn btnPhotoshop"><a class="btnLink" href="view.php" target="" >View All Images</a></div>

      </section>

      <!-- PHOTOSHOP PROJECTS SECTION END -->

      <!-- SOCIAL CONTACT SECTION START -->

      <section class="socialContact" id="contact">

          <h1>Thanks for stopping by!</h1>

          <div class="icons">

            <a href="https://github.com/Chili718?tab=repositories" target="_blank" rel="noopener noreferrer">
              <div class="iconLink">
                <ion-icon name="logo-github"></ion-icon>
              </div>
            </a>

            <a href="https://twitter.com/jon_tice_" target="_blank" rel="noopener noreferrer">
              <div class="iconLink">
                <ion-icon name="logo-twitter"></ion-icon>
              </div>
            </a>

            <a href="https://www.instagram.com/tice_jon/" target="_blank" rel="noopener noreferrer">
              <div class="iconLink">
                <ion-icon name="logo-instagram"></ion-icon>
              </div>
            </a>

            <a href="https://www.facebook.com/jon.tice.718" target="_blank" rel="noopener noreferrer">
              <div class="iconLink">
                <ion-icon name="logo-facebook"></ion-icon>
              </div>
            </a>

          </div>

          <!--
          <ul>
            <a href="https://twitter.com/jon_tice_" target="_blank" rel="noopener noreferrer"><li><img src="images/twitter.png"></li></a>
            <a href="https://github.com/Chili718?tab=repositories" target="_blank" rel="noopener noreferrer"><li><img src="images/git.png"></li></a>
            <a href="https://www.instagram.com/tice_jon/" target="_blank" rel="noopener noreferrer"><li><img src="images/insta.png"></li></a>
            <a href="https://www.facebook.com/jon.tice.718" target="_blank" rel="noopener noreferrer"><li><img src="images/facebook.png"></li></a>
          </ul>
        -->
          <div class="btn btnEmail">
            <a class="btnLink" href="mailto: ticej2@winthropalumni.com" target="_blank">Email Me</a>
            <ion-icon class="mailIcon" name="mail-outline"></ion-icon>
          </div>

          <p class="cpyrght"> &copy; 2021 Jon Tice. <p>

       </section>

      <!-- SOCIAL CONTACT SECTION END -->

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript" src="js/mySite.js"></script>
  </body>

</html>
