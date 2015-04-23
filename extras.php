<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN”
“http: //www.w3.org/TR/html4/strict.dtd”>
<html xmlns=”http://www.w3.org/1999/xhtml”> 
<head>
<title>Extras - Cody Kachelski</title>
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
<img src="hasek.jpg" wIDth="130" height="220" class="logo"><!-- heading of page -->
</header>
<body>
    <div class="container">
            <div class="row">
                <h3>Extras
				<a href="equipment.php" class="btn">Equipment</a>
				<a href="home.php" class="btn">Customers</a>
				<a href="orders.php" class="btn">Orders</a>
				</h3>
            </div>
            <div class="row">
                <p>
                    <a href="createextras.php" class="btn btn-success">Create</a>	
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Description</th>
                          <th>Price</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM extras ORDER BY ID DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['description'] . '</td>';
                                echo '<td>'.'$'. number_format($row['price'], 2) . '</td>';
                                echo '<td wIDth=250>';
                                echo '<a class="btn" href="readextras.php?ID='.$row['ID'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="updateextras.php?ID='.$row['ID'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteextras.php?ID='.$row['ID'].'">Delete</a>';
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