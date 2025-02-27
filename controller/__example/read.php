<?php
include("./koneksi.php");

$name = isset($_GET["name"]) ? $_GET["name"] : null;

$sql = "SELECT * FROM mahasiswa WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);

$stmt->execute();
$result = $stmt->get_result();
$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

header("Content-Type: application/json");
echo json_encode(["status" => "success", "data" => $students]);

$stmt->close();
$conn->close();
?>
