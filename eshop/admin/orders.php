<?php
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
	require "../inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Поступившие заказы</title>
	<meta charset="utf-8">
</head>
<body>

<h1>Поступившие заказы:</h1>
<a href="http://specialist2/eshop/admin/">adminka</a>
<?php 

	$allOrders = getOrders();

	if(!$allOrders) {
		echo "Заказов нет!";
		exit;
	}

	foreach ($allOrders as $order) { 			
?>
			

<hr>
<h2>Заказ номер: <?= $order['orderid']?> </h2>
<p><b>Заказчик</b>: <?= $order['name']?> </p>
<p><b>Email</b>: <?= $order['email']?></p>
<p><b>Телефон</b>: <?= $order['phone']?></p>
<p><b>Адрес доставки</b>: <?= $order['address']?></p>
<p><b>Дата размещения заказа</b>: <?= date('d M Y H:i:s', $order['date'])?></p>

<h3>Купленные товары:</h3>
<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
</tr>
<?php 
	$i = 1;
	$sum = 0;
	foreach ($order['goods'] as $value) { 
		
?>
	<tr>
		<td><?= $i++?></td>
		<td><?= $value['title']?></td>
		<td><?= $value['author']?></td>
		<td><?= $value['pubyear']?></td>
		<td><?= $value['price']?></td>
		<td><?= $value['quantity'] ?></td>
	</tr>
<?php
	$sum += (int)$value['price'] * $value['quantity'];

	}
?>

</table>

<p>Всего товаров в заказе на сумму: <?= $sum;?> руб.</p>
<?php 	
	}
?>

</body>
</html>

<?php 



// echo "<pre>";
// print_r($allOrders);
// echo "</pre>";



