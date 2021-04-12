<?php
include 'checkadminloginstatus.php';
$aid=$log_aid;
if($aid !='')
{
 header("location:admin-dashboard.php");
 exit();
}
 ?>
<!DOCTYPE html>
<html>
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="CSS/main.css">
<link href='https://fonts.googleapis.com/css?family=Allerta' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {

	background:#edc2d8ff;
}
.form{
	width:40%;
	margin-left:30%;
	margin-top:10%;
	
}
@media only screen and (max-width:550px) {
.form{
width:80%;
	margin-left:10%;
	margin-top:5%;
}
</style>
<body >
<div class="w3-bar w3-container">
  <a href="index.php" class="w3-bar-item w3-text-white w3-right w3-button"><i class="fa fa-user" aria-hidden="true"></i> user Login</a>
  <a href="user-register.html" class="w3-bar-item w3-text-white w3-right w3-button"><i class="fa fa-user-plus" aria-hidden="true"></i> User Registration</a>
</div>
<div class="w3-container form w3-row-padding">
<div class="">
<form class="w3-container w3-card-4 w3-margin w3-round-xlarge " style="background:#8ABAD3FF;" onsubmit="return false;">
  <h2 class="w3-text-white w3-center" style="font-family: 'Allerta';">Admin Login</h2>
  <p>      
  <label class="w3-text-white"><b>Admin Name</b></label>
  <input class="w3-input w3-border  w3-round " id="name" name="name" type="text"></p>
  <p>      
  <label class="w3-text-white"><b>Password</b></label>
  <input class="w3-input w3-border  w3-round" id="password" name="password" type="password"></p>
  <p>      
  <button class="w3-btn w3-white w3-round" id="btn" onclick="checkLogin()">Login <i class="fa fa-long-arrow-right" aria-hidden="true"></i> </button></p>
  <div id="error" class="w3-round w3-padding w3-text-white w3-center w3-large"></div>
</form>
</div>
</div>
<script>
function checkLogin(){
    document.getElementById("btn").innerHTML="Please wait...";
	document.getElementById("btn").disabled=true;
	var name = document.getElementById("name").value;
	var password = document.getElementById("password").value;
	if(name == "" || password == ""){
	    document.getElementById("error").innerHTML="Please Fill Details";
	    document.getElementById("btn").innerHTML = "Login";
		document.getElementById("btn").disabled=false;
	}else{
		document.getElementById("btn").innerHTML="Please wait...";
		var ajax = ajaxObj("POST", "https://azmal.ml/Havi/admin-logincheck.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				var output = JSON.parse(ajax.responseText);
				if(output[0] == "login_sucess"){
				document.getElementById("error").innerHTML="Login Sucess";
				window.location="admin-dashboard.php";
				document.getElementById("btn").disabled=false;
				}else{
				    document.getElementById("error").innerHTML="Invalid Credentials";
					document.getElementById("btn").disabled=false;
				}
			}else{
				document.getElementById("error").innerHTML="Cannot Connect To Server";
				document.getElementById("btn").innerHTML = "Login";
				document.getElementById("btn").disabled=false;
			}
		};
		ajax.send("name="+name+"&password="+password); 
	}
}
function ajaxObj( meth, url ) {
	var x = new XMLHttpRequest();
	x.open( meth, url, true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}

function ajaxReturn(x){
	if(x.readyState == 4 && x.status == 200){
	    return true;	
	}
}
</script>
</body>
</html>