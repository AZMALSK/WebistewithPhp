<?php
  session_start();
// Files that inculde this file at the very top would NOT require 
// connection to database or session_start(), be careful.
// Initialize some vars
$admin_ok = false;
$log_aid = "";
$log_adminemail = "";
$log_adminpassword = "";
// User Verify function
function evalLoggedUser($id,$p,$q){
    if($id == 101 && $p == "admin" && $q == "admin123"){
        return true;
    }
}
if(isset($_SESSION["aid"]) && isset($_SESSION["adminemail"]) && isset($_SESSION["adminpassword"])) {
	$log_aid = preg_replace('#[^0-9]#', '', $_SESSION['aid']);
	$log_adminemail = preg_replace('#[^a-z0-9]#i', '', $_SESSION['adminemail']);
	$log_adminpassword = preg_replace('#[^a-z0-9]#i', '', $_SESSION['adminpassword']);
	// Verify the user
	$admin_ok = evalLoggedUser($log_aid,$log_adminemail,$log_adminpassword);
} else if(isset($_COOKIE["aid"]) && isset($_COOKIE["adminemail"]) && isset($_COOKIE["adminpass"])){
	$_SESSION['aid'] = preg_replace('#[^0-9]#', '', $_COOKIE['aid']);
    $_SESSION['adminemail'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['adminemail']);
    $_SESSION['adminpassword'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['adminpass']);
	$log_aid = $_SESSION['aid'];
	$log_adminemail = $_SESSION['adminemail'];
	$log_adminpassword = $_SESSION['adminpassword'];
	// Verify the user
	$admin_ok = evalLoggedUser($log_aid,$log_adminemail,$log_adminpassword);
	
}
?>