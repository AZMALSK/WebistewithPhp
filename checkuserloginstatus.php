<?php
  session_start();
include_once("db_conx.php");
// Files that inculde this file at the very top would NOT require 
// connection to database or session_start(), be careful.
// Initialize some vars
$user_ok = false;
$log_id = "";
$log_name = "";
$log_password = "";
// User Verify function
function evalLoggedUser($db,$id,$p,$q){
	$sql = "SELECT * FROM users WHERE uid='$id' AND username='$p' AND password='$q'";
    $query = mysqli_query($db, $sql);
    $numrows = mysqli_num_rows($query);
	if($numrows > 0){
		return true;
	}
}
if(isset($_SESSION["uid"]) && isset($_SESSION["name"]) && isset($_SESSION["password"])) {
	$log_id = preg_replace('#[^0-9]#', '', $_SESSION['uid']);
	$log_name = preg_replace('#[^a-z0-9]#i', '', $_SESSION['name']);
	$log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
	// Verify the user
	$user_ok = evalLoggedUser($db,$log_id,$log_name,$log_password);
} else if(isset($_COOKIE["uid"]) && isset($_COOKIE["name"]) && isset($_COOKIE["pass"])){
	$_SESSION['uid'] = preg_replace('#[^0-9]#', '', $_COOKIE['uid']);
    $_SESSION['name'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['name']);
    $_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
	$log_id = $_SESSION['uid'];
	$log_name = $_SESSION['name'];
	$log_password = $_SESSION['password'];
	// Verify the user
	$user_ok = evalLoggedUser($db,$log_id,$log_name,$log_password);
	
}
?>