<?php
header("Content-Type: text/plain");
$path = "data";
$mail = getParameter("email");
if ($mail === null) 
{
	echo "Параметр email не найден";
} 
else 
{
	if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
	{
		echo "Параметр email задан не верно";
	} 
	else 
	{
		$firstName = getParameter("first_name");
		$lastName = getParameter("last_name");
		$age = getParameter("age");
		if ($age !== null && !ctype_digit($age))
		{
			echo "Параметр возраст задан неверно";
			return;
		}
		if (!file_exists($path))
		{
			mkdir($path);
		}
		SaveEntry($path, $mail, (string)$firstName, (string)$lastName, (string)$age);
		echo "Данные:" . PHP_EOL;
		echo "email = " . $mail . PHP_EOL;
		echo "Имя = " . $firstName . PHP_EOL;
		echo "Фамилия = " . $lastName . PHP_EOL;
		echo "Возраст = " . $age . PHP_EOL;
		echo "Анкета сохранена";
	}
}

function getParameter(string $key) : ?string
{
	return isset($_GET[$key]) ? (string)$_GET[$key] : null;
}

function SaveEntry(string $path, string $mail, string $firstName, string $lastName, string $age) 
{
	file_put_contents($path . "/" . $mail . ".txt", "first_name=" . $firstName . PHP_EOL . "last_name=" . $lastName . PHP_EOL . "age=" . $age);
}