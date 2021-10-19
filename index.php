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
    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="stylesheet" href="css/carousel.css">
    <!-- Front I use from Adobe -->
    <script src="https://use.typekit.net/efv3afb.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script type="text/javascript" src="js/linlout.js"></script>

    <script>
    //changes the icon to fit the theme of the page when loading across the site
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

        <!--
        <svg id='name' width='340' height='70' viewBox='0 0 340 70' fill='none' xmlns='http://www.w3.org/2000/svg'>
        <path d='M17.016 68.248C13.624 68.248 10.744 67.672 8.376 66.52C6.008 65.304 4.216 63.736 3 61.816C1.848 59.896 1.272 57.88 1.272 55.768C1.272 52.888 2.232 50.424 4.152 48.376C6.136 46.264 8.856 45.208 12.312 45.208C12.824 45.208 13.208 45.304 13.464 45.496C13.784 45.688 13.944 45.912 13.944 46.168C13.944 46.424 13.528 47 12.696 47.896C11.864 48.792 11.16 49.848 10.584 51.064C10.008 52.216 9.72 53.72 9.72 55.576C9.72 57.944 10.424 59.896 11.832 61.432C13.24 62.968 15.16 63.736 17.592 63.736C23.672 63.736 26.712 59.736 26.712 51.736V16.12C26.712 13.496 26.328 11.64 25.56 10.552C24.792 9.464 23.288 8.632 21.048 8.056L19.128 7.576L20.184 4.6H39.096L40.344 5.944L39.096 7.576C37.688 9.432 36.696 11.448 36.12 13.624C35.608 15.736 35.352 18.52 35.352 21.976V46.456C35.352 54.008 33.72 59.544 30.456 63.064C27.256 66.52 22.776 68.248 17.016 68.248Z' stroke='#333333' stroke-width='2'/>
        <path d='M68.9333 68.248C62.4052 68.248 57.2213 66.2 53.3813 62.104C49.5413 57.944 47.6213 52.376 47.6213 45.4C47.6213 38.424 49.5413 32.92 53.3813 28.888C57.2213 24.792 62.4052 22.744 68.9333 22.744C73.2213 22.744 76.9653 23.672 80.1653 25.528C83.3653 27.384 85.8293 30.008 87.5573 33.4C89.2852 36.792 90.1493 40.792 90.1493 45.4C90.1493 50.008 89.2533 54.04 87.4613 57.496C85.7333 60.952 83.2693 63.608 80.0693 65.464C76.8693 67.32 73.1572 68.248 68.9333 68.248ZM68.7412 63.544C72.3892 63.544 75.3332 61.912 77.5732 58.648C79.8772 55.32 81.0293 50.968 81.0293 45.592C81.0293 42.84 80.6453 40.088 79.8773 37.336C79.1093 34.52 77.8293 32.152 76.0373 30.232C74.3093 28.248 72.0373 27.256 69.2213 27.256C65.4453 27.256 62.4053 28.92 60.1013 32.248C57.8613 35.576 56.7413 39.992 56.7413 45.496C56.7413 51 57.7973 55.384 59.9093 58.648C62.0853 61.912 65.0292 63.544 68.7412 63.544Z' stroke='#333333' stroke-width='2'/>
        <path d='M138.479 68.248C136.111 68.248 134.415 67.544 133.391 66.136C132.367 64.664 131.855 62.296 131.855 59.032V38.296C131.855 35.352 131.215 33.144 129.935 31.672C128.655 30.136 126.767 29.368 124.271 29.368C121.775 29.368 119.567 30.36 117.647 32.344C115.791 34.328 114.351 37.112 113.327 40.696C112.303 44.28 111.791 48.408 111.791 53.08C111.791 55.768 111.983 57.944 112.367 59.608C112.815 61.272 113.551 62.84 114.575 64.312L115.631 65.656L114.575 67H99.3112L98.4473 64.312L100.079 63.832C101.615 63.576 102.607 63 103.055 62.104C103.567 61.144 103.823 59.544 103.823 57.304V32.92C103.823 32.216 103.695 31.736 103.439 31.48C103.183 31.16 102.735 31 102.095 31H98.3512L97.4873 28.696C99.1513 27.16 101.071 25.912 103.247 24.952C105.423 23.992 107.343 23.512 109.007 23.512C109.839 23.512 110.511 23.768 111.023 24.28C111.535 24.792 111.791 25.432 111.791 26.2V35.704C113.263 31.928 115.503 28.824 118.511 26.392C121.519 23.96 124.687 22.744 128.015 22.744C132.047 22.744 134.991 23.992 136.847 26.488C138.767 28.984 139.727 32.92 139.727 38.296V59.32C139.727 61.304 140.591 62.296 142.319 62.296C143.727 62.296 145.167 61.688 146.639 60.472L148.271 62.68C146.799 64.344 145.167 65.688 143.375 66.712C141.583 67.736 139.951 68.248 138.479 68.248Z' stroke='#333333' stroke-width='2'/>
        <path d='M196.139 65.56L197.195 64.024C198.667 62.104 199.691 60.12 200.267 58.072C200.843 55.96 201.131 53.112 201.131 49.528V16.12C201.131 13.368 200.939 11.576 200.555 10.744C200.171 9.848 199.339 9.4 198.059 9.4H194.123C192.011 9.4 190.379 9.624 189.227 10.072C188.139 10.52 187.243 11.288 186.539 12.376C185.899 13.464 185.291 15.064 184.715 17.176L184.235 19.288L181.259 18.232V2.776L182.699 1.62399L184.235 2.776C185.771 3.992 189.035 4.6 194.027 4.6H216.779C221.835 4.6 225.099 3.992 226.571 2.776L228.107 1.62399L229.547 2.776V18.232L226.571 19.288L226.091 17.176C225.259 14.04 224.235 11.96 223.019 10.936C221.803 9.912 219.691 9.4 216.683 9.4H212.651C211.435 9.4 210.603 9.848 210.155 10.744C209.771 11.64 209.579 13.432 209.579 16.12V55.48C209.579 58.168 209.931 60.024 210.635 61.048C211.403 62.008 212.939 62.84 215.243 63.544L217.355 64.024L216.299 67H197.195L196.139 65.56Z' stroke='#333333' stroke-width='2'/>
        <path d='M239.373 15.448C238.413 15.448 237.293 14.776 236.013 13.432C234.733 12.088 234.093 10.872 234.093 9.784C234.093 8.696 234.701 7.48 235.917 6.136C237.197 4.792 238.349 4.12 239.373 4.12C240.461 4.12 241.645 4.792 242.925 6.136C244.205 7.48 244.845 8.696 244.845 9.784C244.845 10.872 244.205 12.088 242.925 13.432C241.645 14.776 240.461 15.448 239.373 15.448ZM242.253 68.248C239.885 68.248 238.157 67.544 237.069 66.136C236.045 64.664 235.533 62.296 235.533 59.032V32.152C235.533 31.384 235.405 30.84 235.149 30.52C234.893 30.2 234.445 30.04 233.805 30.04H229.869L229.197 27.928C230.861 26.392 232.749 25.144 234.861 24.184C237.037 23.224 238.925 22.744 240.525 22.744C241.357 22.744 242.029 23 242.541 23.512C243.117 23.96 243.405 24.568 243.405 25.336V59.32C243.405 61.304 244.269 62.296 245.997 62.296C247.341 62.296 248.813 61.688 250.413 60.472L252.045 62.68C250.445 64.344 248.749 65.688 246.957 66.712C245.229 67.736 243.661 68.248 242.253 68.248Z' stroke='#333333' stroke-width='2'/>
        <path d='M278.179 68.248C274.147 68.248 270.531 67.256 267.331 65.272C264.131 63.288 261.603 60.568 259.747 57.112C257.955 53.656 257.059 49.784 257.059 45.496C257.059 40.888 257.923 36.888 259.651 33.496C261.379 30.04 263.843 27.384 267.043 25.528C270.243 23.672 273.955 22.744 278.179 22.744C282.659 22.744 286.307 23.832 289.123 26.008C292.003 28.12 293.443 30.872 293.443 34.264C293.443 36.76 292.643 38.808 291.043 40.408C289.443 41.944 287.395 42.712 284.899 42.712C284.323 42.712 283.907 42.648 283.651 42.52C283.395 42.392 283.267 42.168 283.267 41.848C283.267 41.656 283.459 41.24 283.843 40.6C284.291 39.96 284.675 39.192 284.995 38.296C285.315 37.336 285.475 36.12 285.475 34.648C285.475 32.344 284.707 30.552 283.171 29.272C281.699 27.928 279.715 27.256 277.219 27.256C273.891 27.256 271.203 28.888 269.155 32.152C267.171 35.352 266.179 39.608 266.179 44.92C266.179 50.296 267.363 54.552 269.731 57.688C272.163 60.824 275.427 62.392 279.523 62.392C281.635 62.392 283.619 62.04 285.475 61.336C287.331 60.632 289.187 59.512 291.043 57.976C291.171 57.848 291.427 57.784 291.811 57.784C292.323 57.784 292.803 58.072 293.251 58.648C293.763 59.16 294.019 59.704 294.019 60.28C294.019 60.728 293.955 60.952 293.827 60.952C291.779 63.32 289.379 65.144 286.627 66.424C283.939 67.64 281.123 68.248 278.179 68.248Z' stroke='#333333' stroke-width='2'/>
        <path d='M321.279 68.248C317.247 68.248 313.727 67.32 310.719 65.464C307.711 63.608 305.375 61.016 303.711 57.688C302.047 54.296 301.215 50.392 301.215 45.976C301.215 41.368 302.143 37.304 303.999 33.784C305.855 30.264 308.479 27.544 311.871 25.624C315.327 23.704 319.295 22.744 323.775 22.744C328.511 22.744 332.159 23.992 334.719 26.488C337.343 28.984 338.655 31.992 338.655 35.512C338.655 37.944 337.983 40.28 336.639 42.52C335.359 44.76 333.439 46.584 330.879 47.992C328.383 49.4 325.439 50.104 322.047 50.104C320.127 50.104 318.047 49.784 315.807 49.144C313.567 48.44 312.447 47.416 312.447 46.072C312.447 45.56 312.575 45.112 312.831 44.728C313.087 44.344 313.375 44.152 313.695 44.152C313.887 44.152 314.463 44.344 315.423 44.728C316.447 45.048 317.759 45.208 319.359 45.208C322.879 45.208 325.599 44.248 327.519 42.328C329.439 40.408 330.399 38.104 330.399 35.416C330.399 33.112 329.631 31.128 328.095 29.464C326.623 27.8 324.639 26.968 322.143 26.968C318.367 26.968 315.423 28.632 313.311 31.96C311.263 35.224 310.239 39.896 310.239 45.976C310.239 51.16 311.327 55.224 313.503 58.168C315.743 61.048 318.943 62.488 323.103 62.488C328.223 62.488 332.447 60.824 335.775 57.496C335.967 57.304 336.223 57.208 336.543 57.208C337.055 57.208 337.567 57.464 338.079 57.976C338.655 58.488 338.943 59.032 338.943 59.608C338.943 59.8 338.879 59.992 338.751 60.184C338.623 60.312 338.559 60.408 338.559 60.472C336.383 63.032 333.791 64.984 330.783 66.328C327.839 67.608 324.671 68.248 321.279 68.248Z' stroke='#333333' stroke-width='2'/>
        </svg>
      -->
        <p>Designer and Full Stack Web Developer</p>
      </div>

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
        <div class="worksContainerInner">
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

        <div class="worksContainerInner">
          <div class="workContainer">
            <h2>Wonder Dog University</h2>
            <a href="https://www.wonderdoguniversity.com/" target="_blank" rel="noopener noreferrer">
              <img src="images/wonderdog.png">
            </a>
          </div>

          <div class="workContainer">
            <h2>The Meander</h2>
            <a href="" target="_blank" rel="noopener noreferrer">
              <img src="images/meander.png">
            </a>
          </div>
        </div>

      </div>

    </section>

    <!-- FREELANCE WORK SECTION END -->

    <!-- CODING PROJECTS SECTION START -->

    <section class="codeprojects" id="projects">

      <h1>Coding Projects</h1>

      <p class ="codeprojectsExplanation">
        Here are two of my bigger projects I've done in my free time using REACT. You can view the code on Git along with other programs I've made using a variety of other languages such as C++, C#(Unity), Python, Java. My <a href="https://github.com/Chili718?tab=repositories"  target="_blank" rel="noopener noreferrer">Git Repositories</a> are a combination of my course work and other projects I've done in my free time. You can also view the source for <a href="https://github.com/Chili718/mySite2.0"  target="_blank" rel="noopener noreferrer">This Website</a> which was made using JS, PHP, jQuery, and mySQL.
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

       <div class="swipeBox" id="swipeBox">
         <div class="scene"  id = "scene">
           <div class="carousel">
          <?php require 'php/getCarouselPics.php'; ?>
           </div>
         </div>

         <div class="options">
           <div class='carouselButtons viewPreviousCaro'><ion-icon name="arrow-back-circle-outline"></ion-icon></div>
           <div class="btn btnPhotoshop"><a class="btnLink" href="view.php" target="" >View All Images</a></div>
           <div class='carouselButtons viewNextCaro'><ion-icon name="arrow-forward-circle-outline"></ion-icon></div>
         </div>
       </div>

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

          <div class="btn btnEmail">
            <a class="btnLink" href="mailto: ticej2@winthropalumni.com" target="_blank">Email Me</a>
            <ion-icon class="mailIcon" name="mail-outline"></ion-icon>
          </div>

          <p class="cpyrght"> &copy; 2021 Jon Tice. <p>

       </section>

      <!-- SOCIAL CONTACT SECTION END -->

      <!-- Carousel Lightbox Start -->

      <div id="lightbox">
        <div class='lightboxButtons closeButton'><ion-icon name="close-circle-outline"></ion-icon></div>
        <div class='lightboxButtons viewPrevious'><ion-icon name="arrow-back-circle-outline"></ion-icon></div>
        <div class='lightboxButtons viewNext'><ion-icon name="arrow-forward-circle-outline"></ion-icon></div>
        <div class='lightboxButtons showHideButton'><ion-icon name="eye-off-outline"></ion-icon></div>
      </div>

      <!-- Carousel Lightbox End -->

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript" src="js/mySite.js"></script>
    <script type="text/javascript" src="js/swipe.js"></script>
    <script type="text/javascript" src="js/scrolling.js"></script>
    <script type="text/javascript" src="js/carousel.js"></script>
    <script type="text/javascript" src="js/carouselLightbox.js"></script>
  </body>

</html>
