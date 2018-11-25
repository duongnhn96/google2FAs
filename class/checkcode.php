<?php

   include_once("./userDB.php");
   $db= new userDB;
   if($_POST['code'])
   {
   $code=$_POST['code'];
   $ga = new GoogleAuthenticator();
   $secret = $db->getSecret($_SESSION['user']);
   $secret_code="";
    while( $row = mysqli_fetch_array($secret)) {
            $secret_code = $row[0];
    }
   $ga = new GoogleAuthenticator();
   $checkResult = $ga->verifyCode($secret_code, $code, 2);    // 2 = 2*30sec clock tolerance
   if ($checkResult) {
        $_SESSION['googleCode']=$code;
        echo 'true';
    } 
    else 
    {
        echo 'false';
    }
    }   
?>