<?php

require 'database.php';
Database::connect();
        

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];
echo $myusername;
echo "<br>";
echo $mypassword;
echo "<br>";

		$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM members where username = ? AND password = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($myusername, $mypassword));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['username'];
        $pass = $data['password'];
        Database::disconnect();


// If result matched $myusername and $mypassword, table row must be 1 row

if($data != NULL){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_start();
$_SESSION["id"] = "loggedin";
echo "got here";
header("Location: home.php");
}
else {
echo "Wrong Username or Password";
}
?>