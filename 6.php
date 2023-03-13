<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cloud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, firstname, lastname , Englishname , email FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " ".$row["Englishname"]."".$row["email"]. " <br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>