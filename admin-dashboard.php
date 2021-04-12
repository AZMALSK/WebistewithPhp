<?php
include 'checkadminloginstatus.php';
$aid=$log_aid;
if($aid=='')
{
 header("location:/admin-login.php");
 exit();
}
 ?>
<!DOCTYPE html>
<html>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="CSS/main.css">
<link href='https://fonts.googleapis.com/css?family=Allerta' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    background:#edc2d8ff;
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
<body>
<div class="w3-bar w3-container w3-card-4" style="background:#8ABAD3FF;">
  <a href="admin-logout.php" class="w3-bar-item w3-large w3-text-white w3-right w3-button"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
</div>
<div class="w3-container w3-row-padding ">
<h3>Welcome Admin!!!!</h3>
<h2 style="color:white;font-weight:900" >Users Registered</h2>
<div class="w3-container w3-row">
<div id="error" class="w3-padding w3-text-red w3-center w3-large"></div>
<?php
include_once("db_conx.php");
$check_user = mysqli_query($db,"SELECT * FROM users");
$count = mysqli_num_rows($check_user);
if($count != 0){
while($row=mysqli_fetch_array($check_user)){
	$username = $row['username'];
	$mobilenumber = $row['mobilenumber'];
	$uid = $row['uid'];
	echo"
	<div class='w3-container w3-col w3-margin-bottom w3-margin-top sm6 md4 lm4 w3-round-xlarge w3-padding w3-card w3-white'>
	  <p>Username: $username</p>
	  <p>Mobilenumber: $mobilenumber</p>
	  <p><button id='$uid' class='w3-btn w3-round w3-right' onclick='Dataremove(this.id)' style='background:#edc2d8ff'>Remove</button></p>
	</div>";
}}else{
	echo"<h4>No Users Found</h4>";
	echo"<img src='images/empty.png' class='w3-image' alt='Empty'>";
}
?>
</div>

</div>
<script>
function Dataremove(id){
	var ajax = ajaxObj("POST", "https://azmal.ml/Havi/remove-user.php");
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