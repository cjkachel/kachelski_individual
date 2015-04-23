<?php
/*
 File Name   : updateequip.php
 Date        : 4/5/2015
 Project     : Individual
 Author      : Cody Kachelski
 Description : 
  updating an equipment record
*/    
    require 'database.php';
 
    
    if ( !empty($_GET['ID'])) {
        $ID = $_REQUEST['ID'];
    }
     
    if ( null==$ID ) {
        header("Location: equipment.php");
    }
     
    if ( !empty($_POST)) {
        // keep track valIDation errors
        $nameError = null;
        $maskError = null;
        $gloveError = null;
		$blockerError = null;
		$padsError = null;
		$priceError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $mask = $_POST['mask'];
        $glove = $_POST['glove'];
		$blocker = $_POST['blocker'];
		$pads = $_POST['pads'];
		$price = $_POST['price'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($mask)) {
            $maskError = 'Please enter a mask';
            $valid = false;
        }
         
        if (empty($glove)) {
            $gloveError = 'Please enter a glove';
            $valid = false;
        }
		
		if (empty($blocker)) {
            $gloveError = 'Please enter a blocker';
            $valid = false;
        }
		
		if (empty($pads)) {
            $gloveError = 'Please enter leg pads';
            $valid = false;
        }
		
		if (empty($price)) {
            $gloveError = 'Please enter a price';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE equipment  set name = ?, mask = ?, glove = ?, blocker = ?, pads = ?, price =? WHERE ID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$mask,$glove,$blocker,$pads,$price,$ID));
            Database::disconnect();
            header("Location: equipment.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM equipment where ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $mask = $data['mask'];
        $glove = $data['glove'];
		$blocker = $data['blocker'];
		$pads = $data['pads'];
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
                        <h3>Update Equipment</h3>
                    </div>
             
                     <form class="form-horizontal" action="updateequip.php?ID=<?php echo $ID?>" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($maskError)?'error':'';?>">
                        <label class="control-label">Mask</label>
                        <div class="controls">
                            <input name="mask" type="text" placeholder="Mask" value="<?php echo !empty($mask)?$mask:'';?>">
                            <?php if (!empty($maskError)): ?>
                                <span class="help-inline"><?php echo $maskError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($gloveError)?'error':'';?>">
                        <label class="control-label">Glove</label>
                        <div class="controls">
                            <input name="glove" type="text"  placeholder="Glove" value="<?php echo !empty($glove)?$glove:'';?>">
                            <?php if (!empty($gloveError)): ?>
                                <span class="help-inline"><?php echo $gloveError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($blockerError)?'error':'';?>">
                        <label class="control-label">Blocker</label>
                        <div class="controls">
                            <input name="blocker" type="text"  placeholder="blocker" value="<?php echo !empty($blocker)?$blocker:'';?>">
                            <?php if (!empty($blockerError)): ?>
                                <span class="help-inline"><?php echo $blockerError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($padsError)?'error':'';?>">
                        <label class="control-label">Pads</label>
                        <div class="controls">
                            <input name="pads" type="text"  placeholder="Leg Pads" value="<?php echo !empty($pads)?$pads:'';?>">
                            <?php if (!empty($padsError)): ?>
                                <span class="help-inline"><?php echo $padsError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <input name="price" type="text"  placeholder="Price" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="equipment.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>