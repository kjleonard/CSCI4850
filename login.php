<?php
$loggedIn = isset($_COOKIE['userID']);
include 'db.inc.php';

$email = $_REQUEST['email'];
$subPass = $_REQUEST['pass'];

//If the user is already logged in just redirect them to the home page
if ($loggedIn) {
    echo "<div class=\"alert alert-success\" role=\"alert\">User is already logged in...</div>";
    echo '<meta http-equiv="refresh" content="2;URL=\'index.php\'" />';
}

//Alright they may have entered a username and password
if ($email != '' && subPass != '') {
    
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
	if ($row['Password'] == $subPass) {
	    setCookie('userID', $row['ID'], time() + 86400, '/');
	    setCookie('role', $row['Role_ID'], time() + 86400, '/');
            echo '<meta http-equiv="refresh" content="0;URL=\'index.php\'" />';
	} else {
	    echo "<div class=\"alert alert-danger\" role=\"alert\">Username/Password is incorrect.</div>";
	}
    } else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Username/Password is incorrect.</div>";
    }
    $conn->close();
}
?>
<html>
<head>
<title>Log in | CSCI4850</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./js/bootstrap.min.js">
<link rel="stylesheet" href="./css/bootstrap-theme.min.css">
</head>

<body>
<form class="form-horizontal" action="/login.php" method="post">
<fieldset>

<legend>Login</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Username</label>  
  <div class="col-md-5">
  <input id="email" name="email" type="text" placeholder="j.doe@user.edu" value="<?php echo $email?>" class="form-control input-md" required="">
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="pass">Password</label>
  <div class="col-md-5">
    <input id="pass" name="pass" type="password" placeholder="password" class="form-control input-md glyphicon glyphicon-lock" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button id="" name="" class="btn btn-primary">Login</button><br />
    <a href="/lostpassword.php">Forgot Password</a>
  </div>
</div>

</fieldset>
</form>

</body>
</html>