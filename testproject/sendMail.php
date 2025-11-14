<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'common_include.php';

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mcbdev2023@gmail.com'; 
    $mail->Password   = 'eyrhlvjrxmjkvnrk'; // NOT your Gmail password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender
    $mail->setFrom('info@amitsriwastav.com', 'Amit Sriwastav');

    // Receiver
    $mail->addAddress('as4u.in@gmail.com', 'Receiver Name');

    // Add CC / BCC if needed
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attach file
    $mail->addAttachment('uploads/doc_6916ccf6d8d80.pdf');       // For attachment
    // $mail->addAttachment('/path/to/image.jpg', 'photo.jpg');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Email Testing Using PHPMailer';
    $mail->Body    = '
        <h3>Hello!</h3>
        <p>Your file is attached below.</p>
    ';
    $mail->AltBody = 'Your file is attached below.'; // Fallback for non-HTML email clients

    $mail->send();
    echo "Email sent successfully";
} catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
}
//var_dump(function_exists('mail'));
?>