<?php
session_start();
// Set Session data to an empty array
$_SESSION = array();
// Expire their cookie files
if(isset($_COOKIE["uid"]) && isset($_COOKIE["name"]) && isset($_COOKIE["pass"])) {
	setcookie("id", '', strtotime( '-5 days' ), '/');
    setcookie("name", '', strtotime( '-5 days' ), '/');
	setcookie("pass", '', strtotime( '-5 days' ), '/');
}
unset($_SESSION['uid']);
unset($_SESSION['name']);
unset($_SESSION['pass']);
// Double check to see if their sessions exists
if(isset($_SESSION['email'])){
	header("location: message?msg=Error:_Logout_Failed");
} else {
	header("location: index.php");
	exit();
} 
?>