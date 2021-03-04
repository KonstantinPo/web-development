<?php
header("Content-Type: text/plain");
$param = "password";
$value = getParameter($param);
if ($value === null)
{
	echo "Параметр " . $param . " не найден";
}
else
{
	GetPasswordStrength($value);
}

function GetPasswordStrength(string $password) : void
{
	$reliability = 0;
	$len = strlen($password);
	$reliability += 4 * $len;
	echo "Количество символов пароля: " . $len . ". Надежность: +" . $reliability . PHP_EOL;
	$digits = getCountOfDigitsInString($password);
	$reliability += 4 * $digits;
	echo "Количество цифр в пароле: " . $digits . ". Надежность: +" . (4 * $digits) . PHP_EOL;
	$upperCaseSymbols = getCountUpperCaseSymbolsInString($password);
	$reliability += 2 * ($len - $upperCaseSymbols);
	echo "Количество символов в верхнем регистре: " . $upperCaseSymbols . ". Надежность: +" . (($len - $upperCaseSymbols) * 2) . PHP_EOL;
	$lowerCaseSymbols = getCountLowerCaseSymbolsInString($password);
	$reliability += 2 * ($len - $upperCaseSymbols);
	echo "Количество символов в нижнем регистре: " . $lowerCaseSymbols . ". Надежность: +" . (($len - $lowerCaseSymbols) * 2) . PHP_EOL;
	if (ctype_alpha($password))
	{
		$reliability -= $len;
		echo "В строке все символы буквы. Надежность: -" . $len . PHP_EOL;
	} 
	else if (ctype_digit($password))
	{
		$reliability -= $len;
		echo "В строке все символы цифры. Надежность: -" . $len . PHP_EOL;
	}
	$str = "";
	foreach (count_chars($password, 1) as $i => $val)
	{
		if ($val > 1)
		{
			$str = $str . "\"" . chr($i) . "\" встречается в строке $val раз(а). Надежность: -" . $val . PHP_EOL;
			$reliability -= $val;
		}
	}
	if (strlen($str) > 0)
	{
		echo "В строке встречаются следующие символы больше 2-х раз:" . PHP_EOL.$str;
	}
	echo "Общая надежность: " . $reliability; 
}

function getCountOfDigitsInString(string $string) : int
{
	$res = 0;
	foreach (str_split($string) as $ch)
	{
		if (is_numeric($ch))
		{
			++$res;
		}
	}
	return $res;
}

function getCountUpperCaseSymbolsInString(string $string) : int
{
	$res = 0;
	foreach (str_split($string) as $ch)
	{
		if (ctype_upper($ch))
		{
			++$res;
		}
	}
	return $res;
}

function getCountLowerCaseSymbolsInString(string $string) : int
{
	$res = 0;
	foreach (str_split($string) as $ch)
	{
		if (ctype_lower($ch))
		{
			++$res;
		}
	}
	return $res;
}

function getParameter(string $key) : ?string
{
	return isset($_GET[$key]) ? (string)$_GET[$key] : null;
}