<?php
header("Access-Control-Allow-Origin: *");
include_once("db_conx.php");
if(isset($_POST['name']) && ($_POST['password'])){
	$e=$_POST['name'];
	$p=$_POST['password'];
	   $email = "admin";
	  $pass="admin123";
 if($e == $email && $p == $pass){
	      $aid = 101;
	      $adminemail = $e;
	      $adminpassword = $email;
	      $_SESSION['aid'] = $pass;
	      $_SESSION['adminemail'] = $adminemail;
		  $_SESSION['adminpassword'] = $adminpassword;
		   setcookie("aid", $aid, strtotime( '+1 days' ), "/", "", "", TRUE);
    	   setcookie("adminemail", $adminemail, strtotime( '+1 days' ), "/", "", "", TRUE);
    	   setcookie("adminpass", $adminpassword, strtotime( '+1 days' ), "/", "", "", TRUE);
		$data = array();
        $data[] = "login_sucess";
		$data[] = "sucess";
        echo json_encode($data);
    }else{
      $data = array();
      $data[] = "login_failure";
      $data[] = "failure";
     echo json_encode($data);
}
}
?>