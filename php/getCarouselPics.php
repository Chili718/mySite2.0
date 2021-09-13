<?php
/*

File for getting the random nine pictures for the carousel on the homepage

*/

 require "dbCON.php";

 //could not connect to database
 if (!$con) {
   echo "<h2 class='errorTxt'>Oops might be the internet or me!</h2>";
 }
 else
 {

   $table  = "photoshopwork";
   $result = $con->query("SELECT * FROM $table ORDER BY RAND() LIMIT 9");

   if (mysqli_num_rows($result)!=0) {
     //echo each cell with the created min path for each
     while($data = $result->fetch_assoc()){

       //print_r($data);
       $minPath = substr_replace($data['path'], "Min", strripos($data['path'],"."),0);

       $minPath = substr_replace($minPath, "/min", strripos($minPath,"/"),0);

       echo "<div class = 'carousel_cell'><img src = '{$minPath}' class='cil'></div>";

     }

   }else{
     //no images error message
     echo "<h2 class='errorTxt'>Looks like there are no images!</h2>";

   }

   $con->close();

 }

 ?>
