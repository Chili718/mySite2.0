<?php

require 'dbCON.php';

if (!$con) {
  echo "dbf";
}
else
{

  if(isset($_POST['count']) && isset($_POST['filter']))
  {

    $filter = "";
    $table  = "photoshopwork";
    //will be used for changing filters or when the page initially loads
    if($_POST['count'] == 0){

      switch($_POST['filter']){

        case 'newest':
          $stmt = $con->prepare("SELECT * FROM $table ORDER BY dateUploaded DESC LIMIT 20");
          break;
        case 'oldest':
          $stmt = $con->prepare("SELECT * FROM $table ORDER BY dateUploaded ASC LIMIT 20");
          break;
        case 'best':
          $stmt = $con->prepare("SELECT * FROM $table ORDER BY rating DESC LIMIT 20");
          break;
        case 'worst':
          $stmt = $con->prepare("SELECT * FROM $table ORDER BY rating ASC LIMIT 20");
          break;

      }

      $stmt->execute();
      $result = $stmt->get_result();
      //this will be the response for the ajax request
      echo printHtml($result);

    }//for loading more images of the same filter on the page
    else if($_POST['count'] > 0)
    {

      $result = $con->query("SELECT count(*) as allCount FROM $table");
      $row = $result->fetch_assoc();

      //if all of the images have not been displayed
      if($row["allCount"] > $_POST["count"] && $_POST["count"] != 0){

        switch($_POST['filter']){

          case 'newest':
            $stmt = $con->prepare("SELECT * FROM $table ORDER BY dateUploaded DESC LIMIT ?, 10");
            break;
          case 'oldest':
            $stmt = $con->prepare("SELECT * FROM $table ORDER BY dateUploaded ASC LIMIT ?, 10");
            break;
          case 'best':
            $stmt = $con->prepare("SELECT * FROM $table ORDER BY rating DESC LIMIT ?, 10");
            break;
          case 'worst':
            $stmt = $con->prepare("SELECT * FROM $table ORDER BY rating ASC LIMIT ?, 10");
            break;

        }

        $stmt->bind_param("s", $_POST['count']);
        $stmt->execute();
        $result = $stmt->get_result();
        //this will be the response for the ajax request
        echo printHtml($result);
      }

    }

  }
  else
  {
    echo "fail";
  }

  $con->close();

}

//
//Function for taking the result of the query from the ps table and creating the icon
//blocks for the display grid with the min version of the image
//
function printHtml($result){
   $htmlR = "";

  if (mysqli_num_rows($result)!=0) {

    while($data = $result->fetch_assoc()){

      //create the correct path to get the min version of the image for the preview square
      //which give significantly faster loading times
      $minPath = substr_replace($data['path'], "Min", strripos($data['path'],"."),0);

      $minPath = substr_replace($minPath, "/min", strripos($minPath,"/"),0);
      //appending all of the blocks to the return string to be dumped onto the page
      $htmlR .= "<div><h2>".$data["name"]."</h2><img class='psW' src = ".$minPath."></div>";
      //echo "<div><img src = ".$data["path"]."><h2>".$data["name"]."</h2></div>";
    }

  }else{//there is a very high likely this will never be reached due to the conditional
      //that is before this function is called

    $htmlR = "fail";

  }

  return $htmlR;

}

 ?>
