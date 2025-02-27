<?php
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Allow CORS if needed (for cross-origin requests)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$mail = new PHPMailer(true);

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $email = $data['email'];
    $message = $data['message'];

    try {
        $mail->isSMTP();
        $mail->SMTPDebug = 0; 
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'user@gmail.com';
        $mail->Password = 'password';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
    
        // Sender and recipient
        $mail->setFrom('agustchannel@gmail.com', 'Wesly');
        $mail->addAddress($email, 'User');
    
        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Message for IdolSchool';
        $mail->Body = "<h3>'$message'</h3>";
    
        // Send email
        if ($mail->send()) {
            echo 'Email sent successfully!';
        }
    } catch (Exception $e) {
    } finally {
        $response = [
            "status" => "success",
            "message" => "Email successfully send!",
        ];
    }
} else {
    $response = [
        "status" => "error",
        "message" => "No data received"
    ];
}

// Send JSON response
echo json_encode($response);
?>
