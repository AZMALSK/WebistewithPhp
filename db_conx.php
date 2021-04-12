<?php
$db=mysqli_connect("localhost","admin_azmal","azmal123","admin_azmal");
if(!$db)
{
	die("connection failed:".mysqli_connect_error());
}
?>