<?php
session_start();
include("./koneksi.php");

$nim = $_POST["nim"];
$nama = $_POST["nama"];
$jurusan = $_POST["jurusan"];

echo $nim;
echo $nama;
echo $jurusan;

$sql = "INSERT into mahasiswa VALUES(?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nim, $nama, $jurusan);
if ($stmt->execute()) {
    header("Location: ../view/admin.php");
} else {
    echo "Gagal memasukkan data";
}
$stmt->close();
$conn->close();

