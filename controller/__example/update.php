<?php
include("./koneksi.php");

$nim = $_POST["nim"];
$nama = $_POST["nama"];
$jurusan = $_POST["jurusan"];

$sql = "UPDATE mahasiswa SET nama = ?, jurusan = ? WHERE nim = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nama, $jurusan, $nim);

$response = ["status" => "fail"];

if ($stmt->execute() && $stmt->affected_rows > 0) {
    $response["status"] = "success";
}

header("Content-Type: application/json");
echo json_encode($response);

$stmt->close();
$conn->close();
?>
