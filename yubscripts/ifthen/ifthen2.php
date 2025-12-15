<?php  //IFT command. Parses using traditional "if" structure.
$input = isset($_GET['input']) ? $_GET['input'] : '';
$delimit = isset($_GET['delimit']) ? $_GET['delimit'] : ',';
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '';

if (strpos($input, "(")==0 and strpos($input, ")")<>False){
	$input = right($input,strlen($input)-1); //Remove the leading "(".
	$exploded = explode(")",$input); //Split string around ")".
	$thenelse = explode($delimit,$exploded[1]); //Split up then,else.
	$then = trim($thenelse[0]);
	$else = trim($thenelse[1]);
	
	$result = $else;
	
	if (strpos($exploded[0],"<>")==True){
		$strings = explode("<>",$exploded[0]);
		if (trim($strings[0]) <> trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],"==")==True){
		$strings = explode("==",$exploded[0]);
		if (trim($strings[0]) == trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],"<=")==True){
		$strings = explode("<=",$exploded[0]);
		if (trim($strings[0]) <= trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],">=")==True){
		$strings = explode(">=",$exploded[0]);
		if (trim($strings[0]) >= trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],"=")==True){
		$strings = explode("=",$exploded[0]);
		if (trim($strings[0]) == trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],">")==True){
		$strings = explode(">",$exploded[0]);
		if (trim($strings[0]) > trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],"<")==True){
		$strings = explode("<",$exploded[0]);
		if (trim($strings[0]) < trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (trim(strtoupper($exploded[0]))=="TRUE"){
		$result = $then;
	}
	
	elseif (trim(strtoupper($exploded[0]))=="YES"){
		$result = $then;
	}
	
	elseif (trim($exploded[0])=="1"){
		$result = $then;
	}
}

// Send the result.
// If $redirect is true and $result is a web site, then redirect to the site.
if (strtoupper($redirect) == "TRUE" and strtoupper(substr($result, 0, 4)) == "HTTP"){
	header("Location: $result");
}
// Else just echo $result.
else{
	header('Content-Type: text/javascript;charset=utf-8');
	echo $result;
}


//returns $length characters from the right of $string
function right($string, $length) {
   return substr($string, -$length, $length);
}
?>