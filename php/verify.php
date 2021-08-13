<?php

if(isset($_GET['vkey'])){

  //?vkey=852e9650ab350b95c7b5bbd2ec7c4d31
  //session_start();
  //connect to database
  require 'dbCON.php';

  if (!$con) {
    $dbf = "Oh no, looks like its the internet or me.";
  }else{

    $stmt = $con->prepare("SELECT vkey, verified FROM userst WHERE verified = 0 AND vkey=? LIMIT 1");
    $stmt->bind_param("s", $_GET['vkey']);

    $stmt->execute();

    $result = $stmt->get_result();
    //check for a vkey that has not been verified
    if($result->num_rows == 1){

      $stmt = $con->prepare("UPDATE userst SET verified = 1 WHERE vkey = ? LIMIT 1");
      $stmt->bind_param("s", $_GET['vkey']);

      $stmt->execute();
      //update the users data to verify their account
      if($stmt->affected_rows >= 1)
      {
        $ver =  "Your account has now been verified! You may now login.";
        $close = "<script>setTimeout(function(){document.getElementById('ver').innerHTML = '';}, 10000);</script>";
      }
      else
      {
        $dbf = "Looks like its the internet or me!";
        $close = "<script>setTimeout(function(){document.getElementById('validateTXT').innerHTML = '';}, 10000);</script>";
      }

    }
    else
    {
      $dbf = "This account is invalid or has already been verified.";
      $close = "<script>setTimeout(function(){document.getElementById('validateTXT').innerHTML = '';}, 10000);</script>";
    }

    $stmt->close();
    $con->close();

  }

}

?>
