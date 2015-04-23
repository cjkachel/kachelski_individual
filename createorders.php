<?php
/*
 File Name   : createorders.php
 Date        : 4/5/2015
 Project     : Individual
 Author      : Cody Kachelski
 Description : 
  Adding a new order
*/         
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $customersError = null;
        $equipmentError = null;
        
         
        // keep track post values
        $customerid = $_POST['customerid'];
        $equipmentid = $_POST['equipmentid'];
        $extrasid = $_POST['extrasid'];
		
         
        // validate input
        $valid = true;
        if (empty($customerid)) {
            $customersError = 'Please choose a customer';
            $valid = false;
        }
         
        if (empty($equipmentid)) {
            $equipmentError = 'Please choose equipment';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
			$pdo5 = Database::connect();
							$pdo5->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM equipment WHERE ID = ?";
							$q = $pdo5->prepare($sql);
							$q->execute(array($equipmentid));
							$data = $q->fetch(PDO::FETCH_ASSOC);
							Database::disconnect();
			$pdo6 = Database::connect();
							$pdo6->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM extras WHERE ID = ?";
							$q = $pdo6->prepare($sql);
							$q->execute(array($extrasid));
							$data2 = $q->fetch(PDO::FETCH_ASSOC);
							Database::disconnect();
							$total = $data['price'] + $data2['price'];
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO orders (customer_id,equipment_id,extras_id,total) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($customerid,$equipmentid,$extrasid,$total));
            Database::disconnect();
            header("Location: orders.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<style>
	h3 {
	float: top;
	width: 90%;
	background: #C00000;
	color: #FFFFFF;
	text-align: center;
	}
	</style>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create an Order</h3>
                    </div>
             
                    <form class="form-horizontal" action="createorders.php" method="post">
                      <div class="control-group <?php echo !empty($customersError)?'error':'';?>">
                        <label class="control-label">Location</label>
                        <div class="controls">
							<select name="customerid">
							<?php
							$pdo2 = Database::connect();
							$pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM customers";
							foreach($pdo2->query($sql) as $row)
							{
								echo "<option value=$row[0]>$row[1]"." "."$row[2]</option>";
							}
							Database::disconnect();
							?>
							</select>
                            
                            <?php if (!empty($customersError)): ?>
                                <span class="help-inline"><?php echo $customersError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($equipmentError)?'error':'';?>">
                        <label class="control-label">Equipment</label>
                        <div class="controls">
							<select name="equipmentid">
							<?php
							$pdo3 = Database::connect();
							$pdo3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM equipment";
							foreach($pdo3->query($sql) as $row)
							{
								echo "<option value=$row[0]>$row[1]</option>";
							}
							Database::disconnect();
							?>
							</select>
                            
                            <?php if (!empty($equipmentError)): ?>
                                <span class="help-inline"><?php echo $equipmentError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group">
                         <label class="control-label">Extras</label>
                        <div class="controls">
							<select name="extrasid">
							<?php
							$pdo4 = Database::connect();
							$pdo4->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM extras";
							foreach($pdo4->query($sql) as $row)
							{
								echo "<option value=$row[0]>$row[1]</option>";
							}
							Database::disconnect();
							?>
							</select>
                            
                            
                        </div>
                      </div>
                      
					<div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="orders.php">Back</a>
                    </div>
							
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>