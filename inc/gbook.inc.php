<?php
/* Основные настройки */
define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "gbook");

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die("Ошибка " . mysqli_error($link));


/* Основные настройки */

function clearStr ($data) { // функция для фильтрации данных из формы
	global $link; // объявляем переменную глобальной чтоб ее было видно внутри функции
	$data = trim(strip_tags($data)); // trim удаляет пробелы по краям, strip_tags удаляет тэги
	return mysqli_real_escape_string($link, $data);// Экранирует специальные символы в строке
}

/* Сохранение записи в БД */

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //проверяем был ли пост
	$name = clearStr($_POST['name']);
	$email = clearStr($_POST['email']);
	$msg = clearStr($_POST['msg']);
	$dbQueryInsert = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')"; //создаем запрос в бд
}



/* Сохранение записи в БД */

/* Удаление записи из БД */


if(isset($_GET['del'])) {
	$del = abs((int)$_GET['del']); // приводим значение del к числу либо к нулю, если там не число
	if ($del) { // если $del не ноль 
		$dbDelete = "DELETE FROM msgs WHERE id = $del";
		mysqli_query($link, $dbDelete);
	}
		
}


/* Удаление записи из БД */
?>
<h3>Оставьте запись в нашей Гостевой книге</h3>
<?php
		if ($_POST['name'] == "" || $_POST['email'] == "" || $_POST['msg'] == "") {
		echo "<span class = 'myNotice'>Не все поля заполнены!</span>";
	} else {
		mysqli_query($link, $dbQueryInsert);
		header("Location: " . $_SERVER['REQUEST_URI']); // чтоб не было повторной отправки формы, но тогда нужно на странице вывода написать функцию буферизации db_start()
		exit;
	}
?>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <?php if ($_POST['name'] == "") { echo "<br><span class = 'myNotice'>Это поле обязательно для заполнения!</span>"; } ?>
 <br /><input type="text" name="name" /><br />
Email: <?php if ($_POST['email'] == "") { echo "<br><span class = 'myNotice'>Это поле обязательно для заполнения!</span>"; } ?>
 <br /><input type="text" name="email" /><br />
Сообщение: <?php if ($_POST['msg'] == "") { echo "<br><span class = 'myNotice'>Это поле обязательно для заполнения!</span>"; } ?>
 <br /><textarea name="msg"></textarea><br />

<br />

<input type="submit" value="Отправить!" />

</form>
<?php
/* Вывод записей из БД */

$dbReadQuery = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt FROM msgs ORDER BY id DESC"; // запрос в БД

$queryreadresult = mysqli_query($link, $dbReadQuery); //принимаем запрос в переменную

$resultArray = mysqli_fetch_all($queryreadresult, MYSQLI_ASSOC); // после этого записываем полученные данные из запроса в ассоциативный массив

// echo "<pre>";
// var_dump($resultArray); // тестим полученный массив
// echo "</pre>";

// echo "<pre>";
// print_r($resultArray); // тестим полученный массив
// echo "</pre>";

mysqli_close($link); // закрываем БД

$counter = 0; // создаем переменную счетчика записей в бд
foreach ($resultArray as $key => $value) { // считаем циклом кол-во записей в БД
		$counter++; //но это кустарное решение есть специальная функция mysqli_num_rows()
	}

foreach ($resultArray as $key => $value) { // перебираем массив и выводим нужные данные.
		$dtInt = $value['dt'];// преобразует дату
		$dtInt = (int)$dtInt;// из формата Unix 
		$dt = date('d M Y H:i:s', $dtInt);// в понятный формат
		?>
	<div class="postGbook">
		<p>Посетитель: 
			<a href='mailto:<?= $value['email'] ?>'><?= $value['name'] ?></a> <b><?= $dt ?></b> написал сообщение: <b><?= $value['msg'] ?></b>
		</p>
		<p>
			<a href='http://specialist2/index.php?id=gbook&del=<?= $value['id']?>'>Удалить</a>
		</p>
	</div>
	

		<?php
		//echo $dt . " Автор <b>" . $value['name'] . ",</b> пишет: <b>" . $value['msg'] . "</b><br>";
	}
/* Вывод записей из БД */
?>
<p>Количество записей в базе данных: <?= mysqli_num_rows($queryreadresult) ?></p>

