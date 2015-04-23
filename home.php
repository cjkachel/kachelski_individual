<?php
	 session_start();
	
	if($_SESSION["id"] != "loggedin"){
		header("Location: login.php");
	} 
?>	

<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN”
“http: //www.w3.org/TR/html4/strict.dtd”>
<html xmlns=”http://www.w3.org/1999/xhtml”> 
<head>
<title>Home Page - Cody Kachelski</title>
<!-- <meta http-equiv=” content-type” 
content=”text/html; charset=iso—8859-1” /> -->
 <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
<link href="midterm.css" rel="stylesheet"> <!-- link to stylesheet -->
</head>
<body>
<header>
<h1>Kachelski's Goalie Gear</h1>
<img src="mrazek.jpg" wIDth="90" height="180" class="logo"><!-- heading of page -->
</header>
<body>
    <div class="container">
            <div class="row">
                <h3>Customers
				<a href="equipment.php" class="btn">Equipment</a>
				<a href="orders.php" class="btn">Orders</a>
				<a href="extras.php" class="btn">Extras</a>
				<a href="logout.php" class="btn btn-primary offset10">Logout</a>
				</h3>
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Create</a>	
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>E-mail</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM customers ORDER BY ID DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['firstname'] . '</td>';
                                echo '<td>'. $row['lastname'] . '</td>';
                                echo '<td>'. $row['email'] . '</td>';
                                echo '<td wIDth=250>';
                                echo '<a class="btn" href="read.php?ID='.$row['ID'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?ID='.$row['ID'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?ID='.$row['ID'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div>
    </div> <!-- /container -->
</body>
</html>