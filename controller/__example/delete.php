<?php
include("./koneksi.php");

$nim = $_POST["nim"];

$sql = "DELETE FROM mahasiswa WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nim);

$response = ["status" => "fail"];

if ($stmt->execute() && $stmt->affected_rows > 0) {
    $response["status"] = "success";
}

header("Content-Type: application/json");
echo json_encode($response);

$stmt->close();
$conn->close();
?>