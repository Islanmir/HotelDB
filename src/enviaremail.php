<?php
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
 
 
function enviar_email($destinatario,$nome_destinatario, $assunto, $mensagem)
{   
    require __DIR__ . '/../PHPMailer/src/Exception.php';
    require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
    require __DIR__ . '/../PHPMailer/src/SMTP.php';
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
 
    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.sapo.pt';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'teresamon@sapo.pt';                     //SMTP username
        $mail->Password   = 'Trplm_1980';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->setFrom('teresamon@sapo.pt', 'Teresa');
        $mail->addAddress($destinatario, $nome_destinatario);     //Add a recipient
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject =  $assunto;
        $mail->Body    =  $mensagem;
 
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
 
//enviar_email("joao.monge13@gmail.com", "Joao Monge", "Teste assunto", "Teste mensagem");