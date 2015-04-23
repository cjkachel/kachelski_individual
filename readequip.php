<?php
/*
 File Name   : readequip.php
 Date        : 4/5/2015
 Project     : Individual
 Author      : Cody Kachelski
 Description : 
  viewing equipment info
*/    
    require 'database.php';
    $ID = null;
    if ( !empty($_GET['ID'])) {
        $ID = $_REQUEST['ID'];
    }
     
    if ( null==$ID ) {
        header("Location: equipment.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM equipment where ID = ?";
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
                        <h3>View Equipment</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Name:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Mask:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['mask'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Glove:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['glove'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Blocker:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['blocker'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Pads:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['pads'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Price:</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo '$'.number_format($data['price'], 2);?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="equipment.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>