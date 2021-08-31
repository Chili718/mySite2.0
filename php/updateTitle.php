<?php
//
//
//File for updating the title of the image
//
//
  session_start();
  //connect to database
  require 'dbCON.php';

  if (!$con) {
    echo 'Could not Connect to DB';
    die();
  }

  if(isset($_POST['path']) && isset($_POST['name'])){

    $sql = $con->prepare("Update photoshopwork SET name = ? WHERE path = ?");
    $sql->bind_param("ss", $_POST['name'], $_POST['path']);

    $sql->execute();

    if($sql->affected_rows == 1)
    {

      echo "The title has been successfully updated!";

    }
    else {
      echo "Title could not be updated!";
    }

  }

  $sql->close();
  $con->close();

 ?>
