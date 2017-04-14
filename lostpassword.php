<?php
$loggedIn = isset($_COOKIE['userID']);
include 'db.inc.php';

$email = $_REQUEST['email'];

//If the user is already logged in just redirect them to the home page
if ($loggedIn) {
    echo "<div class=\"alert alert-success\" role=\"alert\">User is already logged in...</div>";
    echo '<meta http-equiv="refresh" content="2;URL=\'index.php\'" />';
}

//Alright they may have entered a username and password
if ($email != '') {
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $req = "SELECT * FROM `User` WHERE `Email` = '$email'";
    $result = $conn->query($req);

    if ($result->num_rows > 0) {
        // output data of each row
	$row = $result->fetch_assoc();
	$genPass = rand(100000, 999999);
	
	$conn->close();
	$conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
	$req = "UPDATE `User` SET  `Password` = " . $genPass . " WHERE  `User`.`Email` ='$email'";
    	$result = $conn->query($req);

	// the message
	$to = $email;
	$subject = "New Password";
	$txt = "Hello " . $row['FirstName'] . ", <br /> Your new password is: $genPass";
	$headers = "From: password@kjl.xyz";
	mail($to,$subject,$txt,$headers);

	 echo "<div class=\"alert alert-success\" role=\"alert\">Please check your email for your new password.  Please be sure to check the spam folder for an email from password@kjl.xyz, Thanks</div>";
    } else {
        echo "<div class=\"alert alert-success\" role=\"alert\">Please check your email for your new password.  Please be sure to check the spam folder for an email from password@kjl.xyz, Thanks</div>";
    }
    $conn->close();
}
?>
<html>
<head>
<title>Forgot Password | CSCI4850</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./js/bootstrap.min.js">
<link rel="stylesheet" href="./css/bootstrap-theme.min.css">
</head>

<body>
<form class="form-horizontal" action="/lostpassword.php" method="post">
<fieldset>

<legend>Forgot Password</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Username</label>  
  <div class="col-md-5">
  <input id="email" name="email" type="text" placeholder="j.doe@user.edu" value="<?php echo $email?>" class="form-control input-md" required="">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button id="" name="" class="btn btn-primary">Login</button><br />
    <a href="/login.php">Log In</a>
  </div>
</div>

</fieldset>
</form>

</body>
</html>