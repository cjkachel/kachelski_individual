<?php
/*
 File Name   : updateextras.php
 Date        : 4/5/2015
 Project     : Individual
 Author      : Cody Kachelski
 Description : 
  updating an extras record
*/    
    require 'database.php';
 
    
    if ( !empty($_GET['ID'])) {
        $ID = $_REQUEST['ID'];
    }
     
    if ( null==$ID ) {
        header("Location: extras.php");
    }
     
    if ( !empty($_POST)) {
        // keep track valIDation errors
        $descriptionError = null;
        $priceError = null;
         
        // keep track post values
        $description = $_POST['description'];
        $price = $_POST['price'];
         
         // validate input
        $valid = true;
        if (empty($description)) {
            $descriptionError = 'Please enter a description';
            $valid = false;
        }
         
        if (empty($price)) {
            $priceError = 'Please enter a price';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE extras  set description = ?, price =? WHERE ID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($description,$price,$ID));
            Database::disconnect();
            header("Location: extras.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM extras where ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $description = $data['description'];
        $price = $data['price'];
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
                        <h3>Update an Extra Item</h3>
                    </div>
             
                    <form class="form-horizontal" action="updateextras.php?ID=<?php echo $ID?>" method="post">
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="description" type="text"  placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <input name="price" type="text" placeholder="Price" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="extras.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
