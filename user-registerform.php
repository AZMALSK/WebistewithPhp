<?php
include_once("db_conx.php");
header("Access-Control-Allow-Origin: *");
if(isset($_POST['name']) && ($_POST['phone']) && ($_POST['gender']) && ($_POST['dob']) && ($_POST['country']) && ($_POST['password'])){
$name = $_POST['name'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$country = $_POST['country'];
$password = md5($_POST['password']);
$usercheck = mysqli_query($db,"SELECT * FROM users WHERE username='$name' AND password='$password'");
$count = mysqli_num_rows($usercheck);
if($count != 0){
	 $data = array();
     $data[] = "Already_Registered";
     echo json_encode($data);
}else{
$sql = "INSERT INTO users(username,mobilenumber,gender,dateofbirth,country,password) VALUES('$name','$phone','$gender','$dob','$country','$password')";
if(mysqli_query($db,$sql)){
	$data = array();
    $data[] = "Sucess";
    echo json_encode($data);
}else{
  $data = array();
  $data[] = "Failure";
  $data[] = "insertion failed .$sql".mysqli_error($db);
  echo json_encode($data);
}
}
}
?>