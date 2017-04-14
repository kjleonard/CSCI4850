<?php

	setCookie('userID', 123, time() - 86400, '/');
	setCookie('role', 123, time() - 86400, '/');
    	echo '<meta http-equiv="refresh" content="0;URL=\'login.php\'" />';

?>

<html>
<head>
<title>Logout | CSCI4850</title>
<link href="./bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="./bootstrap-3.3.5-dist/js/bootstrap.min.js">
<link rel="stylesheet" href="./bootstrap-3.3.5-dist/css/bootstrap-theme.min.css">
</head>
<body>

<h2>You have successfully logged out. Redirecting to homepage...</h2>

</body>

</html>