<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader

require 'Mail/PHPMailer/src/Exception.php';
require 'Mail/PHPMailer/src/PHPMailer.php';
require 'Mail/PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
function SendMail($email,$getname,$passwords){
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nguyenduongcode1803@gmail.com';                     //SMTP username
    $mail->Password   = 'kymlvkatoqpiknob';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('nguyenduongcode1803@gmail.com', 'Nguyen Duong');
    $mail->addAddress($email, 'you');     //Add a recipient
   //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('nguyenduongcode1803@gmail.com', 'Rep me');
    $mail->addCC('nguyenduongcode1803@gmail.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Mail Forgot your password';
    $mail->Body    = 'Tên đăng nhập của bạn là: '.$getname.' mật khẩu: '.$passwords;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Gửi thành công';
} catch (Exception $e) {
    echo "Không gửi được: {$mail->ErrorInfo}";
}
}
?>