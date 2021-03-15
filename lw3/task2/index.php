<?php
header("Content-Type: text/plain");
$param = "identifier";
if (($value = getParameter($param)) === null)
{
	echo "Параметр " . $param . " не найден";
} 
else
{
	$errorMessage = "";
	if (validateSr3Identifier($value, $errorMessage))
	{
		echo "Yes.";
	}
	else
	{
		echo $errorMessage;
	}
}

function validateSr3Identifier(string $identifier, string& $errorMessage) : bool
{
	for ($i = 0; $i < strlen($identifier); ++$i)
	{
		$ch = $identifier[$i];
		if ($i === 0 && ctype_digit($ch))
		{
			$errorMessage = "No. В идентификаторе первый символ цифра";
			return false;
		}
		$ch = strtolower($ch); 
		if (strpbrk($ch, "abcdefghijklmnopqrstuvwxwz0123456789") === false)
		{
			$errorMessage = "No. В идентификаторе символ на позиции " . $i . " не является буквой или цифрой";
			return false;
		}
	}
	return true;
}

function getParameter(string $key) : ?string
{
	return isset($_GET[$key]) ? (string)$_GET[$key] : null;
}