<?
$title = 'Авторизация';
$login  = '';

session_start();
header("HTTP/1.0 401 Unauthorized");
require_once 'secure.inc.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$login = trim(strip_tags($_POST['login']));
	$pw = trim(strip_tags($_POST['pw']));
	$ref = trim(strip_tags($_GET['ref']));
	if (!$ref) {
		$ref = '/eshop/admin/';
	}
	if ($login and $pw) {
		if ($result = userExists($login)) {
			list($_, $hash) = explode(':', $result);
			if (checkHash($pw, $hash)) {
				$_SESSION['admin'] = true;
				header("Location: $ref");
				exit;
			} else {
				$title = 'Неправильное имя пользователя или пароль!2';
			}
		}	else {
			$title = 'Неправильное имя пользователя или пароль!1';
		}
	} else {
		$title = 'Заполните все поля формы!';
	}
}


?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Авторизация</title>
	<meta charset="utf-8">
</head>
<body>
	<h1><?= $title?></h1><p>чтоб зайти в админку без пароля, надо закоментить уод в файле admin/secure/session.inc.php</p>
	<p>по умолчанию логин <b>root</b> пароль <b>1234</b> </p>
	<form action="<?= $_SERVER['REQUEST_URI']?>" method="post">
		<div>
			<label for="txtUser">Логин</label>
			<input id="txtUser" type="text" name="login" value="<?= $login?>" />
		</div>
		<div>
			<label for="txtString">Пароль</label>
			<input id="txtString" type="password" name="pw" />
		</div>
		<div>
			<button type="submit">Войти</button>
		</div>	
	</form>

	<?php 
// это я пытаюсь понять где ошибка
	// $login = "root";
	// $result = userExists($login);
	// list($_, $hash) = explode(':', $result);

	// var_dump($result) . "<br>";
	// echo "<hr>";
	// var_dump($_) . "<br>";
	// echo "<hr>";
	// var_dump(str_replace(array("\r\n", "\r", "\n"), '', $hash)) . "<br>";
	// echo "<hr>";
	// var_dump($login) . "<br>";
	// echo "<hr>";
	// $pass = "1234";
	// echo "<hr>";


	// var_dump(checkHash($pass, $hash));
	// echo "<hr>";
	// var_dump($_POST) . "<br>";
	// echo "<hr>";
	// var_dump($_SESSION) . "<br>";
	// echo "<hr>";
	


	 ?>
</body>
</html>