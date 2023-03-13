<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cloud";
$t1 = $_GET["fname"];
$t2 = $_GET["lname"];
$t3 = $_GET["ename"];
$t4 = $_GET["email"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO MyGuests (firstname,lastname,Englishname,email)
VALUES ('$t1','$t2','$t3','$t4')" ;
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();	
?>
</body>
</html>