<?php
include 'db.php';
session_start();
extract($_POST);
if (isset($_POST)) {
   $sql = "SELECT * FROM users WHERE Email = '"."$email"."' AND password='".$password."'";
   $result = ($conn->query($sql)); 
   	$row = []; 
   	if ($result->num_rows > 0) 
   	{ 
   		$row = $result->fetch_all(MYSQLI_ASSOC); 
        $_SESSION['user_id']=$row[0]['id'];
        header(header: "Location:dashboard.php");
   	}else{
        echo"<script>alert('Please Enter Coreect Details <br> Username or Password Wrong..!!!');</script>";
        header("Location:index.php");
    }
}else{
echo "Something went wrong...";
}
?>

