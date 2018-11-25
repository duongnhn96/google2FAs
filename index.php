<?php
session_start();

include_once("./class/userDB.php");
require_once './class/GoogleAuthenticator.php';
$db = new userDB();
$url = "http://localhost:8081/google2FA/";
echo floor(time() / 30);
?>
<head>
    <title>Google 2FA</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/mystyle.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</head>
<?php include_once('class/sankhau.php'); ?>
