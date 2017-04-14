<?php
include "db.inc.php";
$loggedIn = isset($_COOKIE['userID']);
$role = isset($_COOKIE['role']);
$canRead = false;
$canCreate = false;
$canUpdate = false;
$canDelete = false;
//If the user is not logged in make them log in :)
if (!$loggedIn) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">You do not have access to this page or you are not logged in... Redirecting to login screen.</div>";
    echo '<meta http-equiv="refresh" content="2;URL=\'login.php\'" />';
}else{
	$role = $_COOKIE['role'];
	// Create connection
    	$conn = new mysqli($servername, $username, $password, $dbname);
    	// Check connection
    	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
    	} 
    
    	$req = "SELECT * FROM `Role` WHERE `ID` = $role";
    	$result = $conn->query($req);

    	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if($row['canRead'] == 1){
			$canRead = true;
		}
		if($row['canDelete'] == 1){
			$canDelete = true;
		}
		if($row['canUpdate'] == 1){
			$canUpdate = true;
		}
		if($row['canCreate'] == 1){
			$canCreate = true;
		}	
	}
    $conn->close();
}

?>
﻿
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CSCI 4850</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
     
           
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                    </a>
                </div>
              
                 <span class="logout-spn" >
                  <a href="logout.php" style="color:#fff;">LOGOUT</a>  

                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
 		<li >
                        <a href="/" ><i class="fa fa-desktop "></i>Dashboard</a>
                    </li>

              
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2> </h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                 
                 
                 	
                 	<div class="col-lg-20">
                        <h5>Leagues</h5>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Open Leagues
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-4" style="float:left">
                        <h5>Bowler Honor Scores</h5>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#299" data-toggle="tab">299s</a>
                            </li>
                            <li class=""><a href="#300" data-toggle="tab">300s</a>
                            </li>
                            <li class=""><a href="#800" data-toggle="tab">800s</a>
                            </li>

                        </ul>
              		<div class="tab-content">
                            <div class="tab-pane fade active in" id="299">
                                <h4>299 Scores</h4>
                                <p>
                            		<table class="table table-bordered table-hover">
                            		<tr><td>First Name</td><td>Last Name</td></tr>
                                   <?php
                                   $conn = new mysqli($servername, $username, $password, $dbname);
    
    					$req = "SELECT Bowler.FirstName, Bowler.LastName, HonorScore.is299 FROM `Bowler` NATURAL JOIN `HonorScore` WHERE HonorScore.is299 = 1";					
    					$result = $conn->query($req);
    					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>" . $row['FirstName']. "</td><td>" . $row['LastName']. "</td></tr>";
						}	
					}
    					$conn->close();
                                   ?> 
                                   	</table>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="300">
                                <h4>300 Scores</h4>
                                <p>
                            		<table class="table table-bordered table-hover">
                            		<tr><td>First Name</td><td>Last Name</td></tr>
                                   <?php
                                   $conn = new mysqli($servername, $username, $password, $dbname);
    
    					$req = "SELECT Bowler.FirstName, Bowler.LastName, HonorScore.is300 FROM `Bowler` NATURAL JOIN `HonorScore` WHERE HonorScore.is300 = 1";					
    					$result = $conn->query($req);
    					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>" . $row['FirstName']. "</td><td>" . $row['LastName']. "</td></tr>";
						}	
					}
    					$conn->close();
                                   ?> 
                                   	</table>
                                </p>

                            </div>
                            <div class="tab-pane fade" id="800">
                                <h4>800 Series</h4>
                                <p>
                            		<table class="table  table-bordered table-hover">
                            		<tr><td>First Name</td><td>Last Name</td></tr>
                                   <?php
                                   $conn = new mysqli($servername, $username, $password, $dbname);
    
    					$req = "SELECT Bowler.FirstName, Bowler.LastName, HonorScore.is800 FROM `Bowler` NATURAL JOIN `HonorScore` WHERE HonorScore.is800 = 1";					
    					$result = $conn->query($req);
    					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>" . $row['FirstName']. "</td><td>" . $row['LastName']. "</td></tr>";
						}	
					}
    					$conn->close();
                                   ?> 
                                   	</table>
                                </p>

                            </div>

                            </div>
                        </div>
                            </div>
                            
                            
                            
                            
                            <div class="col-lg-20">
                        <h5>Leagues</h5>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Open Leagues
                            </div>
                            <div class="panel-body">
                                <p>
                            		<table class="table table-striped table-bordered table-hover">
                            		<tr><td>League Name</td><td>Members Per Team</td></tr>
                                   <?php
                                   $conn = new mysqli($servername, $username, $password, $dbname);
    
    					$req = "SELECT * FROM  `League` WHERE  `isFull` = 0";					
    					$result = $conn->query($req);
    					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>" . $row['Name']. "</td><td>" . $row['MembersPerTeam']. "</td></tr>";
						}	
					}
    					$conn->close();
    					
                                   ?> 
                                   	</table>
                                </p>

                            </div>
                        </div>
                            
                           
                    <div class="col-lg-20">
                        <h5>Search For A Bowler</h5>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Search
                            </div>
                            <div class="panel-body">
                                <form action="/" method="POST">
                                Bowler Last Name <input type="text" class="form-control" placeholder="Last Name" id="lastName" name="lastName"/><br/>
                                <button class="btn btn-primary">Submit</button>
                                <br /><br />
                                <p>
                            		<table class="table table-striped table-bordered table-hover">
                            		<tr><td>First Name</td><td>Last Name</td></tr>
                                   <?php
                                   
                                   if($_REQUEST['lastName'] != ""){
                                   $conn = new mysqli($servername, $username, $password, $dbname);
    
    					$req = "SELECT * FROM  `Bowler` WHERE  `LastName` LIKE '" . $_REQUEST['lastName']. "'";					
    					$result = $conn->query($req);
    					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>" . $row['FirstName']. "</td><td>" . $row['LastName']. "</td></tr>";
						}	
					}else{
						echo "<tr><td>Bowler Not Found</td></tr>";
					}
    					$conn->close();
    					}
                                   ?> 
                                   	</table>
                                </p>
                            </div> 
                        </div>
                        </div>
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            	                      
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
             <div class="row">
                <div class="col-lg-12" >
                    &copy;  2017 kjl.xyz
                </div>
        </div>
        </div>
          

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
