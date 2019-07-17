<?
require_once "secure/session.inc.php";
require_once "secure/secure.inc.php";

if (isset($_GET['logout'])) {
	logOut();
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Админка</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Администрирование магазина</h1>
	<h3>Доступные действия:</h3>
	<ul>
		<li><a href='add2cat.php'>Добавление товара в каталог</a></li>
		<li><a href='orders.php'>Просмотр готовых заказов</a></li>
		<li><a href='secure/create_user.php'>Добавить пользователя</a></li>
		<li><a href='index.php?logout'>Завершить сеанс</a></li>
	</ul>
	<?php 



	// $pswd = '1234';
	// $password = '1234';
	// $hash = password_hash($password, PASSWORD_BCRYPT);

	// $result = "denis:$2y$10$5og9sGryTNhj3GbJWdp7zOAufcwjbGXyoN7HgBEj7h9CZ1RmcDwWy";
	// list($login, $hash) = explode(':', $result);


	// echo $login . "<br>";
	// echo $hash . "<br>";

	// $pswd = "denis";
	
	// $out = checkHash($pswd, $hash);
	// echo $out;
	// $login = "denis";
	// var_dump(userExists($login));
	// //echo $result;
	// if (is_file(FILE_NAME)) {
	// 	echo "yes";
	// } else {
	// 	echo "no";
	// }

	 ?>
	

</body>
</html>