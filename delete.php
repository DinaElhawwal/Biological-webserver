<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "genomedb";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}
$GeneID = $_REQUEST['GeneID'];
$sqlD = "DELETE FROM genome WHERE Genome_id=$GeneID";

if ($conn->query($sqlD) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

header('Location:/index.php');

$conn->close();
?>