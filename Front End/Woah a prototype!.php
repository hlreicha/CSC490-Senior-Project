<!DOCTYPE html>

<html>
<?php
$servername = "3.15.184.45:3306";
$username = "mysql";
$password = "Moscow34";
$dbname = "Joe";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         echo "id: " . $row["Employee_ID"]. " - Name: " . $row["First_Name"]. " " . $row["Last_Name"]. "<br>";
    }
} else {
    echo "0 results";
}
?>
</html>