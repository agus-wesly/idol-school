<?php
include("./koneksi.php");

$nim = $_POST["nim"];
$nama = $_POST["nama"];
$jurusan = $_POST["jurusan"];

$sql = "INSERT into mahasiswa VALUES(?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nim, $nama, $jurusan);
if ($stmt->execute()) {
    // success
} else {
    // fail
}
$stmt->close();
$conn->close();

