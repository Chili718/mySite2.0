<?php
//
//File for removing the image from the database if nothing goes wrong
//

  session_start();
  //connect to database
  require 'dbCON.php';

  if (!$con) {
    echo 'Could not Connect to DB';
    die();
  }

  if(isset($_POST['path'])){

    $sql = $con->prepare("DELETE FROM photoshopwork WHERE path = ?");
    $sql->bind_param("s", $_POST['path']);

    $sql->execute();

    if($sql->affected_rows >= 1)
    {
      $rem = "../".$_POST['path'];
      //remove the normal image from the file system
      if(!unlink($rem))
      {
        echo "Could not remove file from local system...";
      }
      else
      {
        //creating the min version of the path
        $minPath = substr_replace($_POST['path'], "Min", strripos($_POST['path'],"."),0);
        $minPath = substr_replace($minPath, "/min", strripos($minPath,"/"),0);
        $minPath = "../".$minPath;

        //removing the min version of the image from the file system
        if(!unlink($minPath))
        {
          echo "Could not remove file from local system...";
        }
        else
        {
          echo "The Image was Deleted Successfully!";
        }

      }


    }
    else {
      echo "The Image could not be Deleted.";
    }

  }

  $sql->close();
  $con->close();

 ?>
