<?php
    $servername = "localhost";
	$username = "hlreicha";
	$password = "Moscow34!!";
	$dbname = "Test";
	$connection = mysqli_connect($servername, $username, $password, $dbname);
	if (!$connection) {
		die("Connection failed: " . mysqli_connect_error());
	}


if(isset($_POST['ProductID'])){
	
	$ProductID = $_POST['ProductID'];
	$Quantity = $_POST['Quantity'];
	$Name = $_POST['Name'];
	$id = $_POST['id'];
     echo "The id is: " .$id . "<br>";
	  //echo "The Quantity is: " .$Quantity . "<br>";
	   //echo "The Name is: " .$Name . "<br>";
	 
	//  query to update data 
	 
	$result  = mysqli_query($connection , "UPDATE `inventory` SET `Quantity`=$Quantity,`Name`='$Name' WHERE `ProductID`=$id;") or die(mysqli_error());
	if($result){
		echo 'data updated';
	}
	//echo("Error description: " . mysqli_error($connection));
	

}

//if(isset($_POST['email'])){
	//echo "the id is: " . $id;
	//$firstName = $_POST['firstName'];
	//$lastName = $_POST['lastName'];
	//$email = $_POST['email'];
	//$id = $_POST['id'];

	//  query to update data 
	 
	//$result  = mysqli_query($connection , "UPDATE user SET firstName='$firstName' , lastName='$lastName' , email = '$email' WHERE test='$id'");
	//if($result){
		//echo 'data updated';
	//}

//}
?>