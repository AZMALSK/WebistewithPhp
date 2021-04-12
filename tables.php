<?php
include_once("db_conx.php");
//users Table
$sql = "CREATE TABLE users(
uid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(70) NOT NULL,
mobilenumber VARCHAR(15) NOT NULL,
gender VARCHAR(30) NOT NULL,
dateofbirth DATE NOT NULL,
country VARCHAR(30) NOT NULL,
password VARCHAR(70) NOT NULL
)";
if (mysqli_query($db,$sql)) {
    echo "Table users created successfully<br>";
} else {
    echo "Error creating table $sql. " . mysqli_error($db);
}

//data Table

$data = "CREATE TABLE data(
did INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
uid  INT(10) NOT NULL,
data1 VARCHAR(70) NOT NULL,
data2 VARCHAR(70) NOT NULL
)";
if (mysqli_query($db,$data)) {
    echo "Table sellers created successfully<br>";
} else {
    echo "Error creating table $data. " . mysqli_error($db);
}
?>