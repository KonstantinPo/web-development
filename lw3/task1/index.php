<?php
header("Content-Type: text/plain");
if (($value = getParameter("name")) !== null)
{	
	echo "Параметр name без пробелов:" . removeExtraBlanks($value);
}
else
{
	echo "Параметр name не найден";
}

function removeExtraBlanks(string $string) : string 
{
	$string = trim($string);
	$res = "";
	$addBlank = true;
	foreach (str_split($string) as $ch)
	{
		if($ch !== " ")
		{
			$res .= $ch;
			$addBlank = true;
		} 
		else if ($addBlank)
		{
			$res .= $ch;
			$addBlank = false;
		}
	}
	return $res;
}

function getParameter(string $key) : ?string
{
	return isset($_GET[$key]) ? (string)$_GET[$key] : null;
}
