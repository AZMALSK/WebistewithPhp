<?php
session_start();
// Set Session data to an empty array
$_SESSION = array();
// Expire their cookie files
if(isset($_COOKIE["aid"]) && isset($_COOKIE["adminemail"]) && isset($_COOKIE["adminpass"])) {
	setcookie("aid", '', strtotime( '-5 days' ), '/');
    setcookie("adminemail", '', strtotime( '-5 days' ), '/');
	setcookie("adminpass", '', strtotime( '-5 days' ), '/');
}
unset($_SESSION['aid']);
unset($_SESSION['adminemail']);
unset($_SESSION['adminpassword']);
// Double check to see if their sessions exists
if(isset($_SESSION['adminemail'])){
	header("location: message?msg=Error:_Logout_Failed");
} else {
	header("location: admin-login.php");
	exit();
} 
?>