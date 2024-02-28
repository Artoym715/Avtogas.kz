<?php

require_once 'lib/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $name = $telephone = $uslugiName = "";
    $name = test_input($_POST['name']);
	$uslugiName = test_input($_POST['uslugiName']);
    $telephone = $_POST['telephone'];

$message = '
<html>
<head>
    <title>Заказ услуги</title>
</head>
<body>
<h2 style="margin: 0; padding: 20px; color: #ffffff; background: #4b9fc5;">Заявка с сайта</h2>
<div style="background: #fafafa; padding: 20px; color: #333333;">
	<p><b>Наименование услуги:</b> '. $uslugiName.' </p>
    <p><b>Имя:</b> '. $name.' </p>
    <p><b>Телефон:</b> '.$telephone.'</p> 
</div>                      
</body>
</html>

';
    $admin_email ='Danilkorotkov87@mail.ru';

    $mail->setFrom('adm@' . $_SERVER['HTTP_HOST'], 'avtogas.kz'); // от кого будет уходить письмо?
    $mail->addAddress($admin_email);     // Кому будет уходить письмо

    $mail->Subject = 'Заявка на услуги с сайта avtogas.kz';
    $body = $message;
    $mail->msgHTML($body);

    $mail->send();

}
else{
    header('location: /');
}
