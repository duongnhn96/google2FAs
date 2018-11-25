<?php
include_once("./userDB.php");
$db= new userDB;
$email = $_POST['email'];

$resultuser = $db->checkemail($email);
if($resultuser){
	echo 'true';
}
else echo 'false';

?>
