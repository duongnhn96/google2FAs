<?php
include_once("./userDB.php");
$db= new userDB;
$user = $_POST['username'];

$resultuser = $db->checkusername($user);
if($resultuser){
	echo 'true';
}
else echo 'false';

?>
