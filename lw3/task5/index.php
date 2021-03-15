<?php
header("Content-Type: text/plain");
$dirPath = "../task4/data";
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
		$firstName = "";
		$lastName = "";
		$age = "";
		$errorMessage = "";
		if (!GetEntry($dirPath, $mail, $firstName, $lastName, $age, $errorMessage))
		{
			echo $errorMessage;
		}
		else
		{
			echo "Данные:" . PHP_EOL;
			echo "email = " . $mail . PHP_EOL;
			echo "Имя = " . $firstName . PHP_EOL;
			echo "Фамилия = " . $lastName . PHP_EOL;
			echo "Возраст = " . $age . PHP_EOL;
		}
		
	}
}

function getParameter(string $key): ?string
{
	return isset($_GET[$key]) ? (string)$_GET[$key] : null;
}

function GetEntry(string $dirPath, string $mail, string& $firstName, string& $lastName, string& $age, string& $errorMessage): bool
{
	$fileName = "$dirPath/$mail.txt";
	if (!file_exists($fileName))
	{
		$errorMessage = "Не найден файл: $fileName" . PHP_EOL;
		return false;
	}
	$patternFirstName = "first_name=";
	$patternLastName = "last_name=";
	$patternAge = "age=";
	$firstName = " ";
	$lastName = " ";
	$age = " ";
	foreach (file($fileName) as $line)
	{
		$pos = strpos($line, $patternFirstName);
		 if ($pos !== false)
		 {
			 $firstName = trim(substr($line , $pos + strlen($patternFirstName)));
		 }
		 else if (($pos = strpos($line, $patternLastName)) !== false)
		 {
			 $lastName = trim(substr($line , $pos + strlen($patternLastName)));
		 }
		 else if (($pos = strpos($line, $patternAge)) !== false)
		 {
			  $age = trim(substr($line , $pos + strlen($patternAge)));
		 }
	}
	return true;
}