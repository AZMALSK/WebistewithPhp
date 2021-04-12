<?php
header("Access-Control-Allow-Origin: *");
include_once("db_conx.php");
if(isset($_POST['name']) && ($_POST['password'])){
$phone = $_POST['name'];
$password = md5($_POST['password']);
$check_query=mysqli_query($db,"SELECT * FROM users WHERE username='$phone' AND password='$password'");
$query_count = mysqli_num_rows($check_query);
if($query_count > 0){
	while($row=mysqli_fetch_array($check_query))
		{
			$uid=$row['uid'];
			$username = $row['username'];
			$password = $row['password'];
			$_SESSION['uid'] = $uid;
			$_SESSION['name'] = $username;
			$_SESSION['password'] = $password;
			setcookie("uid", $uid, strtotime( '+1 days' ), "/", "", "", TRUE);
			setcookie("name", $username, strtotime( '+1 days' ), "/", "", "", TRUE);
			setcookie("pass", $password, strtotime( '+1 days' ), "/", "", "", TRUE);
            
		}
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