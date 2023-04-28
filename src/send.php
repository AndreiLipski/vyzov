<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
require 'class.HTTP.php';

// Переменные, которые отправляет пользователь
$title = 'Заявка с сайта a-studio.by';
$name = htmlspecialchars(HTTP::_GP('name', "", true));
$phone = htmlspecialchars(HTTP::_GP('phone', ""));
//$email = htmlspecialchars(HTTP::_GP('email', ""));
// $name 	= htmlspecialchars ($_POST['name']);
// $phone 	= htmlspecialchars ($_POST['phone']);
// $email 	= htmlspecialchars ($_POST['email']);
// $text 	= str_replace(array("\r\n", "\r", "\n"), '<br>', htmlspecialchars ($_POST['message']));
//$file = $_FILES['file'];

// Формирование самого письма
$body = "
<h2>Новое письмо:</h2>
<b>Имя:</b> $name<br>
<b>Почта:</b> <br><br>
<b>Номер телефона:</b><br>$phone
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
//    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'ssl://smtp.yandex.ru'; // SMTP сервера вашей почты
    $mail->Username   = 'idsemen1992@ya.ru'; // Логин на почте
    $mail->Password   = 'bwvgthataexcfqkm'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->SMTPKeepAlive = true;
    $mail->setFrom('idsemen1992@ya.ru', 'Сообщение от клиента'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('idsemen1992@ya.ru');

// Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = php_mail_html($body);

// Проверяем отравленность сообщения
    if ($mail->send()) {$result = "success";}
    else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
$status = 'status';
echo json_encode(["result" => $result, "status" => $status]);

//-- Формируем HTML тело сообщения
function php_mail_html($message)
{
    $HTML = '
		<!DOCTYPE html>
		<html>
		<head>
			<title></title>
			<meta charset="utf-8" />
			<style></style>
		</head>
		<body marginheight="0" marginwidth="0" bgcolor="#f1f1f1" style="margin: 0;">
		<div id="user-password-changed-1" style="margin: 0; padding: 0 0 50px 0; background: #f1f1f1 0 no-repeat;">
			<table align="center" width="400" style="width: 400px;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="padding-bottom: 20px;" valign="top" align="middle">&nbsp;</td>
				</tr>
	
				<tr>
					<td style="padding-bottom: 5px;" valign="top" align="middle">&nbsp;</td>
				</tr>
				<tr>
					<td>
						<div id="maindiv" style="width: 450px; padding: 20px; text-align: left; font-size: 13px; font-family: Arial, \'sans-serif\'; background: #ffffff;">
							'.$message.'
						</div>
					</td>
				</tr>
				<tr>
					<td align="center" style="padding-top: 20px; line-height: 17px; font-size: 12px; font-family: Arial, \'sans-serif\'; opacity: 0.4;">
						&copy; ВЫЗОВ
					</td>
				</tr>
			</table>
		</div>
		</body>
		</html>
	';

    return($HTML);
}