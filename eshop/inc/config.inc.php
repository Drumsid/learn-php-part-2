<?php
	define("DB_HOST", "localhost");
	define("DB_LOGIN", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "eshop");

	define("ORDERS_LOG", "orders.log");
	
	$basket = [];
	$count = 0;


	$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die("Ошибка" . mysqli_error($link));

	basketInit();