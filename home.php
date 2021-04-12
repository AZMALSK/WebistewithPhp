<?php
include 'checkuserloginstatus.php';
$uid=$log_id;
if($uid =='')
{
 header("location:index.php");
 exit();
}
?><!DOCTYPE html>
<html>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="CSS/main.css">
<link href='https://fonts.googleapis.com/css?family=Allerta' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    
}
.form{
	width:90%;
	margin-left:5%;
	margin-top:0%;
}
.lm4{
    width:28%;
    margin-left:3%
}
@media only screen and (max-width:900px) {
    .md4{
width:30%;
margin-left:3%
}
}
@media only screen and (max-width:550px) {
.sm6{
width:45%;
margin-left:3.3%;
}
}
</style>
<?php
include_once("db_conx.php");
$uid=$log_id;
$check_user = mysqli_query($db,"SELECT * FROM users WHERE uid='$uid'");
while($row=mysqli_fetch_array($check_user)){
	$username = $row['username'];
}
?>
<body class="w3-white">
<div class="w3-bar w3-container w3-card-4" >
  <a href="user-logout.php" class="w3-bar-item w3-large w3-text-blue w3-right w3-button"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
</div>
<div class="w3-container form w3-row-padding ">
<h2>Welcome <?php echo"$username";?>!!!!</h2>
 <form class="w3-container w3-card w3-round" onsubmit="return false;">
 <h1>Enter Data To Add Into Database</h1>
    <p>      
    <label class="w3-text-blue"><b>Data 1</b></label>
    <input class="w3-input w3-border" name="first" id="data1"  type="text" placeholder="Write Something...."></p>
	<p>      
    <label class="w3-text-blue"><b>Data 2</b></label>
    <input class="w3-input w3-border" name="first" type="text" id="data2" placeholder="Write Something...."></p>
    <p>
    <button class="w3-btn w3-blue w3-round" id="btn" onclick="addData()">Submit</button></p>
	<input type="hidden" id="uid" value="<?php echo "$uid";?>">
	<div id="error" class="w3-padding w3-text-red w3-center w3-large"></div>
  </form>
</div>
<div class="w3-container w3-row">
  <h1>Data Added</h1>
<?php
$check_user = mysqli_query($db,"SELECT * FROM data WHERE uid='$uid'");
$count  = mysqli_num_rows($check_user);
if($count !=0){
while($row=mysqli_fetch_array($check_user)){
	$data1 = $row['data1'];
	$data2 = $row['data2'];
	$did = $row['did'];
	echo"
	<div class='w3-container w3-col w3-margin-bottom w3-margin-top sm6 md4 lm4 w3-round-xlarge w3-padding w3-card w3-white'>
	  <p>Data 1: $data1</p>
	  <p>Data 2: $data2</p>
	  <p><button id='$did' class='w3-blue w3-btn w3-round w3-right' onclick='Dataremove(this.id)'>Remove</button></p>
	</div>";
}
}else{
	echo"<h4>No Data Added</h4>";
	echo"<img src='images/empty.png' class='w3-image' alt='Empty'>";
}
?>
  </div>
<script>
function addData(){
    document.getElementById("btn").innerHTML="Please wait...";
	document.getElementById("btn").disabled=true;
	var uid = document.getElementById("uid").value;
	var data1 = document.getElementById("data1").value;
	var data2 = document.getElementById("data2").value;
	if(data1 == "" || data2 == "" ){
		document.getElementById("error").innerHTML="Please Fill Details";
		document.getElementById("btn").innerHTML = "Submit";
		document.getElementById("btn").disabled=false;
	}else{
		document.getElementById("btn").innerHTML="Please wait...";
		var ajax = ajaxObj("POST", "https://azmal.ml/Havi/data-addform.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				var output = JSON.parse(ajax.responseText);
				console.log(output);
				if(output[0] == "Sucess" ){
				document.getElementById("error").innerHTML="Data Added"; 
				document.getElementById("btn").disabled=false;
				window.location.reload();
				}else{
				    document.getElementById("error").innerHTML= output[0];
				    	document.getElementById("btn").innerHTML = "Submit";
					document.getElementById("btn").disabled=false;
				}
			}else{
				document.getElementById("error").innerHTML = "Could Not Connect to Server!";
				document.getElementById("btn").innerHTML = "Submit";
				document.getElementById("btn").disabled=false;
			}
		};
		ajax.send("data1="+data1+"&data2="+data2+"&uid="+uid); 
	}
}
function Dataremove(id){
	var ajax = ajaxObj("POST", "https://azmal.ml/Havi/remove-data.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
				var output = ajax.responseText;
				if(output == "Item Removed"){
		         document.getElementById("error").innerHTML="Item Removed";
				 window.location.reload();
				}else{
				    document.getElementById("error").innerHTML="please Try Again";
				}
			}else{
				document.getElementById("error").innerHTML="Cannot connect to server!";
			}
		};
		ajax.send("id="+id); 
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