<?php
/*
 File Name   : readorders.php
 Date        : 4/5/2015
 Project     : Individual
 Author      : Cody Kachelski
 Description : 
  viewing order info
*/    
    require 'database.php';
    $ID = null;
    if ( !empty($_GET['ID'])) {
        $ID = $_REQUEST['ID'];
    }
     
    if ( null==$ID ) {
        header("Location: orders.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM orders where ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
		$pdo2 = Database::connect();
        $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customers where ID = ?";
        $q = $pdo2->prepare($sql);
        $q->execute(array($data['customer_id']));
        $data2 = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
		$pdo3 = Database::connect();
        $pdo3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM equipment where ID = ?";
        $q = $pdo3->prepare($sql);
        $q->execute(array($data['equipment_id']));
        $data3 = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
		$pdo4 = Database::connect();
        $pdo4->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM extras where ID = ?";
        $q = $pdo4->prepare($sql);
        $q->execute(array($data['extras_id']));
        $data4 = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
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
                        <h3>View Order</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Customer:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['firstname'];
									echo " ";
									echo $data2['lastname'];
								?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Equipment:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data3['name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Extras:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data4['description'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Total:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo '$'.number_format($data['total'], 2);?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="orders.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>