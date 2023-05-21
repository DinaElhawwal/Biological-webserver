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
$GeneName = $_REQUEST['GeneName'];
$RefSeqNo = $_REQUEST['RefSeqNo'];
$Genome = $_REQUEST['Genome'];


if ($GeneName === '') {
  $ref = "SELECT Gname FROM genome WHERE Genome_id= $GeneID";
  $res = $conn->query($ref);
  $row = $res->fetch_assoc();
  $text = $row['Gname'];
  $sqlN = "UPDATE genome SET Gname='$text' WHERE Genome_id= $GeneID";
} else {
  $sqlN = "UPDATE genome SET Gname='$GeneName' WHERE Genome_id= $GeneID";
}

if ($RefSeqNo === '') {
  $ref = "SELECT RefSeqNo FROM genome WHERE Genome_id= $GeneID";
  $res = $conn->query($ref);
  $row = $res->fetch_assoc();
  $text = $row['RefSeqNo'];
  $sqlR = "UPDATE genome SET RefSeqNo='$text' WHERE Genome_id= $GeneID";
} else {
  $sqlR = "UPDATE genome SET RefSeqNo='$RefSeqNo' WHERE Genome_id= $GeneID";
}
if ($Genome === '') {
  $ref = "SELECT Genome FROM genome WHERE Genome_id= $GeneID";
  $res = $conn->query($ref);
  $row = $res->fetch_assoc();
  $text = $row['Genome'];
  $sqlG = "UPDATE genome SET Genome='$Genome' WHERE Genome_id= $GeneID";

} else {
  $sqlG = "UPDATE genome SET Genome='$Genome' WHERE Genome_id= $GeneID";

}
if ($conn->query($sqlN) === TRUE && $conn->query($sqlR) === TRUE && $conn->query($sqlG) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
header('Location:/index.php');

$conn->close();

?>