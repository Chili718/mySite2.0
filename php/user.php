<?php

//print_r($_SESSION);

require 'dbCON.php';

if (!$con) {
  echo "dbf";
}
else
{

  //next 5 variables are being stored in db
  $un = $_POST['userNME'];
  $p = $_POST['pswrd'];
  $e = $_POST['email'];
  $t = time();
  //gets the time integer to the sql timestamp
  //$ts = date('Y-m-d H:i:s',$t);

  //email verification key
  $vk = md5($t.$un);

  $slt = md5($t.$e);

  //pepper doesn't really matter for secutrity b/c this will just be on git
  //but I'm doing it anyways
  $pep = "%^%";

  $p = password_hash($pep.$p.$pep.$slt, PASSWORD_DEFAULT);

  $i = 0;

  $sql = $con->prepare("INSERT INTO userst (username, password, email, salt, vkey, verified, dateMade) VALUES (?, ?, ?, ?, ?, ?, ?)");
  //keeping the value of the time an integer and can convert when needed
  $sql->bind_param("sssssii", $un, $p, $e, $slt, $vk, $i, $t);

  if($sql->execute()){
    /*
    $to = $e;
    $subject = "Email Verification";
    $message = "<a href='https://jonticedesigns.com/login.php?vkey=$vk'>Register Account</a>";
    $header = "MIME-Version: 1.0" . "\r\n";
    $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $header .= "From: tice@jonticedesigns.com \r\n ";

    mail($to, $subject, $message, $header);
    */
    echo "true";

  }
  else
  {

    echo "false";

  }

  $sql->close();
  $con->close();

}


?>
