<?
if (is_file('log/'.PATH_LOG)) { // проверяем есть ли файл с логами

	$flog = fopen('log/'.PATH_LOG, 'r'); // получаем дискриптор (доступ к файлу) файла с логами

	$fLines = [];                          //создаем массив и
	while ($line = fgets($flog)) {		   //циклом заносим в него строки из файла с логами	
		$fLines[] = $line;
	}
	fclose($flog);

} else {
	echo "NO log file!";
}

// echo "<pre>";         //тестил
// print_r($fLines);
// echo "</pre>";

foreach ($fLines as  $key => $value) { //циклом выводим файлы лога
	if ($key != 0) {
		echo "Посещение N <b>" . $key . "</b> было: <b>" . $value . "</b><br>";
	}
}

// var_dump($flines[1]); //тестил