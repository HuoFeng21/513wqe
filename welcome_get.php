<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cloud";
$t1 = $_GET["birthday"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM MyGuests WHERE id=$t1";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
	 echo'<a href ="index.php">'
		 <button>back</button>
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
</body>
</html>