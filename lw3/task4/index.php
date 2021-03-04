<?php
header("Content-Type: text/plain");
$path = "data";
$mail = Get("email");
if ($mail === null) {
	echo "Параметр email не найден";
} else {
	
	$mail = strtolower($mail);
	if (!ValidateEmail($mail)) {
		echo "Параметр email задан не верно";
	} else {
		$firstName = Get("first_name");
		$lastName = Get("last_name");
		$age = Get("age");
		if ($age !== null && !ctype_digit($age)) {
			echo "Параметр возраст задан неверно";
			return;
		}
		if (!file_exists($path)) {
			mkdir($path);
		}
		SaveEntry($path, $mail, (string)$firstName, (string)$lastName, (string)$age);
		echo "Данные:".PHP_EOL;
		echo "email = ".$mail.PHP_EOL;
		echo "Имя = ".$firstName.PHP_EOL;
		echo "Фамилия = ".$lastName.PHP_EOL;
		echo "Возраст = ".$age.PHP_EOL;
		echo "Анкета сохранена";
	}
}

function Get(string $key) : ?string {
	return array_key_exists($key, $_GET) ? (string)$_GET[$key] : null;
}

function ValidateEmail(string $mail) {
	$findDot = false;
	$findAt = false;
	$indexDot = 0;
	$indexAt = 0;
	$len = strlen($mail);
	for ($i = 0; $i < $len; ++$i) {
		$ch = $mail[$i];
		if ($ch == "@") {
			$indexAt = $i;
			if ($indexAt == 0 || $indexAt == $len - 1) {
				return false;
			}
			$findAt = true;
		} else if ($ch == ".") {
			$indexDot = $i;
			if ($indexDot == 0 || $indexDot == $len - 1) {
				return false;
			}
			$findDot = true;
		}
	}
	return $findDot && $findAt && ($indexDot - $indexAt) > 1;
}

function SaveEntry(string $path, string $mail, string $firstName, string $lastName, string $age) {
	file_put_contents($path."/".$mail.".txt", 
		"first_name=".$firstName.PHP_EOL.
		"last_name=".$lastName.PHP_EOL.
		"age=".$age);
}