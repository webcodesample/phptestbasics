<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'common_include.php';

$mail = new PHPMailer(true);

try {
    $config = parse_ini_file('.env');
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = $config['SMTP_HOST']; // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['SMTP_USERNAME']; 
    $mail->Password   = $config['SMTP_PASSWORD']; // NOT your Gmail password
    $mail->SMTPSecure = $config['SMTP_SECURE'];//PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $config['SMTP_PORT'];

    // Sender
    $mail->setFrom('info@amitsriwastav.com', 'Amit Sriwastav');

    // Receiver
    $mail->addAddress('as4u.in@gmail.com', 'AS4U India');

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