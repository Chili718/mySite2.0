<?php
  session_start();
  //connect to database
  require 'dbCON.php';
  //if no connection is established with the database then the script will die
  if (!$con) {
    echo 'DBF';
    die();
  }//check if the username and password is set in POST
  else if (isset($_POST['userNME']) && !empty($_POST['pswrd']))
  {
    $msg = "";

    //search for Username
    //not limiting the query because the username and email are unique
    $stmt = $con->prepare("SELECT password, salt, verified FROM userst WHERE username=? OR email=? LIMIT 1");
    $stmt->bind_param("ss", $_POST['userNME'], $_POST['userNME']);

    $stmt->execute();
    $result = $stmt->get_result();
    //if nothing was returned from the users given username or email
    if($result->num_rows == 1){

      $usr = $result->fetch_assoc();
      //if the user has verfified the account from the email
      if($usr['verified'] == 1){
        //string manipulation to recreate the users hashed password
        $pep = "%^%";
        $p = $usr['password'];
        $slt = $usr['salt'];

        //if the users password matches
        if (password_verify($pep.$_POST['pswrd'].$pep.$slt, $p)) {
          //set session verified to true and return the proper response
          $_SESSION['verified'] = true;
          echo "true";
        }else{
          //invalid password
          echo "false";

        }

      }else{
        //the user must verify the account
        echo "notVer";

      }

    }else {//the user did not provide a proper username or email
      echo "false";
    }

    $stmt->close();
    $con->close();
  }
  else
  {//if username and or password is not set
    echo "false";
  }

 ?>
