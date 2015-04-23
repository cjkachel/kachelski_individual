<?php
/*
 File Name   : deleteextras.php
 Date        : 4/5/2015
 Project     : Individual
 Author      : Cody Kachelski
 Description : 
  deleting an extras record
*/    
    require 'database.php';
    
    $ID = null; 
    if ( !empty($_GET['ID'])) {
        $ID = $_REQUEST['ID'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $ID = $_POST['ID'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM extras  WHERE ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID));
        Database::disconnect();
        header("Location: extras.php");
         
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
                        <h3>Delete an Extra Item</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deleteextras.php" method="post">
                      <input type="hidden" name="ID" value="<?php echo $ID;?>"/>
                      <p class="alert alert-error">Are you sure you want to delete?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="extras.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
