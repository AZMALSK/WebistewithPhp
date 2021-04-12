<?php
include_once("db_conx.php");
header("Access-Control-Allow-Origin: *");
if(isset($_POST['data1']) && ($_POST['data2']) && ($_POST['uid'])){
$data1 = $_POST['data1'];
$data2 = $_POST['data2'];
$uid = $_POST['uid'];
$sql = "INSERT INTO data(data1,data2,uid) VALUES('$data1','$data2','$uid')";
if(mysqli_query($db,$sql)){
	$data = array();
    $data[] = "Sucess";
    echo json_encode($data);
}else{
  $data = array();
  $data[] = "Data Not Inserted Please Try Again";
  $data[] = "insertion failed .$sql".mysqli_error($db);
  echo json_encode($data);
}
}
?>