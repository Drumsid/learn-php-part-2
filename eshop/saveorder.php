<?php
	require "inc/lib.inc.php";
	require "inc/config.inc.php";

	$name = clearStr($_POST['name']);
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = clearStr($_POST['address']);
	$idOrder = $basket['orderid'];
	$timeOrder = time();


	$order = "{$name}|{$email}|{$phone}|{$address}|{$idOrder}|{$timeOrder}" . "\r\n" ;
	
	file_put_contents('admin/'.ORDERS_LOG, $order, FILE_APPEND);
			
	saveOrder($timeOrder);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
	
</body>
</html>