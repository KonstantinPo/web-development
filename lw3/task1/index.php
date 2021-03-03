<?php
header("Content-Type: text/plain");
$value = Get("name");
if ($value === null) {
	echo "Параметр name не найден";
} else {
	
	echo "Параметр name без пробелов:".RemoveExtraBlanks($value);
}

function RemoveExtraBlanks(string $string) : string {
	$string = trim($string);
	$res = "";
	$addBlank = true;
	foreach (str_split($string) as $ch) {
		if ($ch != " ") {
			$res .= $ch;
			$addBlank = true;
		} else if ($addBlank) {
			$res .= $ch;
			$addBlank = false;
		}
	}
	return $res;
}
function Get(string $key) : ?string {
	return array_key_exists($key, $_GET) ? (string)$_GET[$key] : null;
}
