<?php

require_once 'lib/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = $telephone = "";
    $name = test_input($_POST['name']);
    $telephone = $_POST['telephone'];

    $message = '
<html>
<head>
    <title>Заявка с сайта</title>
</head>
<body>
<h2 style="margin: 0; padding: 20px; color: #ffffff; background: #4b9fc5;">Заявка с сайта</h2>
<div style="background: #fafafa; padding: 20px; color: #333333;">
    <p><b>Имя:</b> ' . $name . ' </p>
    <p><b>Телефон:</b> ' . $telephone . '</p> 
</div>                      
</body>
</html>

';
    $admin_email = '';

    $mail->setFrom('adm@' . $_SERVER['HTTP_HOST'], 'avtogas.kz'); // от кого будет уходить письмо?
    $mail->addAddress($admin_email);     // Кому будет уходить письмо

    $mail->Subject = 'Заявка с сайта avtogas.kz';
    $body = $message;
    $mail->msgHTML($body);

    $mail->send();
} else {
    header('location: /');
}
