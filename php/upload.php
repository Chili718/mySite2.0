<?php

require 'dbCON.php';

if (!$con) {
  echo 'dbf';
  //die();
}
else
{
  $table = 'photoshopwork';
  $stmt = "";
  $stmtB = "";
  $close = "";


    //print_r($_FILES);
    //print_r($_POST);
    $picnim = $_POST['imageNme'];
    $picdes = $_POST['imageDes'];
    $rating = $_POST['rating'];

    //echo $picnim;
    //echo $picdes;

    $dir = 'photoshopWork/'.$_FILES['image']['name'];
    $sql = $con->prepare("INSERT INTO photoshopwork (name, description, rating, path) VALUES (?, ?, ?, ?)");

    $sql->bind_param("ssis", $picnim, $picdes, $rating, $dir);

    //"INSERT INTO $table (name, description, path) VALUES ('$picnim','$picdes','$imDir')";

    //$con->query($sql) or die($con->error);

    if($sql->execute())
    {
      $imDir = '../photoshopWork/'.$_FILES['image']['name'];
      $minDir = '../photoshopWork/min/'.$_FILES['min']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], $imDir);
      move_uploaded_file($_FILES['min']['tmp_name'], $minDir);
      echo "success";
    }
    else {

      echo "fail";

    }

    //mysql_close($con);
    $sql->close();
    $con->close();
}



 ?>
