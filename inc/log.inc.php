<? 
$dt = date('d-m-Y G:i:s'); //пишем переменную время посещения

//$page = $_SERVER['REQUEST_URI']; // URI, который был предоставлен для доступа к этой странице.
$page = $_GET["id"] ?? "index"; // второй вариант записи данных в переменную $page он удобнее для чтения чем предыдущий

$ref = $_SERVER['HTTP_REFERER']; // Адрес страницы (если есть), с которой браузер пользователя перешёл на эту страницу
$ref = pathinfo($ref, PATHINFO_BASENAME); //делает короче и удобнее адресс для чтения в логе

$path = $dt . " | " . $page . " | " . $ref . "\n"; // пишем все в одну переменную

$f = fopen("log/".PATH_LOG, "a"); //записываем данные в файл лога
fputs($f, $path);
fclose($f);



// echo $dt . "<br>";
// echo $page . "<br>";
// echo $ref . "<br>";
// echo $path . "<br>";
