<?php
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
include("db_conx.php");
$id = $_POST['id'];
$sql = "DELETE FROM data WHERE did='$id'";
if(mysqli_query($db,$sql)){
 echo "Item Removed";
}else{
  echo "Item not removed,please try again";
}
?>