<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN”
“http: //www.w3.org/TR/html4/strict.dtd”>
<html xmlns=”http://www.w3.org/1999/xhtml”> 
<head>
<title>Equipment - Cody Kachelski</title>
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
<img src="lundqvist.jpg" wIDth="150" height="240" class="logo"><!-- heading of page -->
</header>
<body>
    <div class="container">
            <div class="row">
                <h3>Equipment
				<a href="home.php" class="btn">Customers</a>
				<a href="orders.php" class="btn">Orders</a>
				<a href="extras.php" class="btn">Extras</a>
				</h3>
            </div>
            <div class="row">
                <p>
                    <a href="createequip.php" class="btn btn-success">Create</a>	
                </p>
                 
                <table class="table table-striped table-bordered" width= "90%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Mask</th>
                          <th>Glove</th>
						  <th>Blocker</th>
						  <th>Pads</th>
						  <th>Price</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM equipment ORDER BY ID DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['mask'] . '</td>';
                                echo '<td>'. $row['glove'] . '</td>';
								echo '<td>'. $row['blocker'] . '</td>';
								echo '<td>'. $row['pads'] . '</td>';
								echo '<td>'.'$'. number_format($row['price'], 2) . '</td>';
                                echo '<td wIDth=250 nowrap=true>';
                                echo '<a class="btn" href="readequip.php?ID='.$row['ID'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="updateequip.php?ID='.$row['ID'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="deleteequip.php?ID='.$row['ID'].'">Delete</a>';
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