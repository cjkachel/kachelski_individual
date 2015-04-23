<?php
/*
 File Name   : read.php
 Date        : 4/5/2015
 Project     : Individual
 Author      : Cody Kachelski
 Description : 
  viewing customer info
*/    
    require 'database.php';
    $ID = null;
    if ( !empty($_GET['ID'])) {
        $ID = $_REQUEST['ID'];
    }
     
    if ( null==$ID ) {
        header("Location: home.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customers where ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
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
                        <h3>Read a Customer</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">First Name:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['firstname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Last Name:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['lastname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Email Address:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['email'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="home.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>