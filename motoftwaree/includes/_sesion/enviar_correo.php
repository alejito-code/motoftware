<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';
require './PHPMailer/Exception.php';
require_once('../db.php');

$email = $_POST['email'];
$query = "SELECT * FROM user WHERE correo = '$email';";
$result = $conexion->query($query);
$row = $result->fetch_assoc();

//Create an instance; passing `true` enables exceptions
if($result->num_rows > 0) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = false;                                   //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'motoftware@gmail.com';                 //SMTP username
        $mail->Password   = 'dnjrfyytbnjuqfkm';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('motoftware@gmail.com', 'Motoftware');
        $mail->addAddress($email, 'Tu usuario');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperacion contraseña';
        $mail->Body    = 'Hola, hemos recibido tu solicitud para restablecer tu contraseña:
        Entra al siguiente enlace: <a href="localhost/motoftware/motoftwaree/includes/_sesion/cambiar_contraseña.php?id='.$row['id'].'">Click Aqui</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->CharSet = 'UTF-8';

        $mail->send();
        header("Location:  ./index.html");
    } catch (Exception $e) {
        echo $e->getMessage();
        header("Location:  ./index.html");
    }
} else {
    header("Location:  ./index.html");
}
?>