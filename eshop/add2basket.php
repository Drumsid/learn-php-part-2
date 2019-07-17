<?php
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";

	$id = clearInt($_GET['id']);
	add2Basket($id);
	header("Location: catalog.php");


		// if ($id) {
		// 	add2Basket($id);
		// 	header("Location: catalog.php");
		// 	exit;
		// }
	
