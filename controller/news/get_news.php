<?php 
include("../koneksi.php");

header("Content-Type: application/json");

$sql = "SELECT id, title, content, img_url, kategori FROM news";
$result = $conn->query($sql);
$data = array();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = array();
}
echo json_encode($data);
$conn->close();
?>
