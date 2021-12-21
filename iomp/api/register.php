<?php
require("connect.php");
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendmail($email, $vcode)
{
    require("PHPMailer/Exception.php");
    require("PHPMailer/SMTP.php");
    require("PHPMailer/PHPMailer.php");
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'giet.election1@gmail.com';
        $mail->Password   = 'giet@123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('giet.election1@gmail.com', 'GIET ADMIN');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'E-Mail verfication from Election Office - GIET';
        $mail->Body    = "Thanks for Registration ! Click the link below to verify the email address <b><a href='http://localhost/iomp/api/auth.php?email=$email&vcode=$vcode'>VERIFY</a></b>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
$name = $_POST['name'];
$rollno = $_POST['rollno'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];

if ($password == $cpassword) {
    move_uploaded_file($tmp_name, "../uploads/$image");
    //$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $vcode = bin2hex(random_bytes(8));
    $insert = mysqli_query($connect, "INSERT INTO user (`name`,`rollno`,`email`,`password`,`photo`,`verification_code`) VALUES('$name','$rollno','$email','$password','$image','$vcode')");
    if ($insert && sendmail($_POST['email'], $vcode)) {
        echo '
        <script>
            alert("  !Registration Successful!  \nVerification link sent to your E-mail");
            window.location="../routes/signin.html";
        </script>
        ';
    } else {
        echo '<script>
    alert("Some error occured");
    window.location="../routes/signin.html";
    </script>';
    }
} else {
    echo '<script>
        alert("Password does not matched");
        window.location="../routes/signin.html";
    </script>';
}
