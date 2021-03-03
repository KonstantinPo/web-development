<?php
header("Content-Type: text/plain");
$param = "identifier";
$value = Get($param);
if ($value === null) {
	echo "Параметр ".$param." не найден";
} else {
	echo IsSr3Identifier($value);
}

function Get(string $key) : ?string {
	return array_key_exists($key, $_GET) ? (string)$_GET[$key] : null;
}

function IsSr3Identifier(string $identifier) : string {
	for ($i = 0; $i < strlen($identifier); ++$i) {
		$ch = $identifier[$i];
		if ($i == 0 && ctype_digit($ch))
			return "No. В идентификаторе первый символ цифра";
		$ch = strtolower($ch); 
		if (strpbrk($ch, "abcdefghijklmnopqrstuvwxwz0123456789") === false)
			return "No. В идентификаторе символ на позиции ".$i. " не является буквой или цифрой";
	}
	return "Yes.";
}