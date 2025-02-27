<?php 
include("../koneksi.php");

header("Content-Type: application/json");

$id = $_GET["id"];
$sql = "SELECT id, title, content, img_url, kategori FROM news WHERE id=(?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$id);

$response = [
    "id" => $id,
    "status" => "not-found",
    "result" => null
];

if($stmt->execute()){
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = [
            "status" => "success",
            "result" => $row
        ];
    } else {
        http_response_code(404);
    }
}
echo json_encode($response);
$stmt->close();
$conn->close();
?>
