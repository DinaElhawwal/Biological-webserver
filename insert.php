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
$ref = "SELECT Genome_id FROM genome ";
$res = $conn->query($ref);

$array = [];

        if ($res->num_rows > 0) {
            // output data of each row
            while ($row = $res->fetch_assoc()) {

                array_push($array, $row['Genome_id']);
            }
        }
$GeneID = $array[count($array)-1]+1;
$GeneName = $_REQUEST['GeneName'];
$RefSeqNo = $_REQUEST['RefSeqNo'];
$Genome = $_REQUEST['Genome'];


$sql = "INSERT INTO genome VALUES ('$GeneID','$GeneName','$RefSeqNo','$Genome')";

if (mysqli_query($conn, $sql)) {
    echo "<h3>data stored in a database successfully."
        . " Please browse your localhost php my admin"
        . " to view the updated data</h3>";
}
header('Location:/index.php');

$conn->close();
?>