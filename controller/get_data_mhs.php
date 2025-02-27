<?php
session_start();
include("./koneksi.php");

header("Content-Type: application/json");

$sql = "SELECT id, nama, jurusan FROM mahasiswa";
$result = $conn->query($sql);
$data = array();

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} 
echo json_encode($data);
$conn->close();
?>