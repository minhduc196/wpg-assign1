<?php 
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function write_data($name, $gender, $age, $ptype, $os, $min_age, $max_age) {
	$file_name = "singles.txt"; 
	if(file_exists($file_name)) {

		// write data to file singles.txt
		$openFile = fopen($file_name, "a");
		fopen("test.txt", "r+");
		$txt = $name . "," . $gender . "," . $age . "," 
		. $ptype . "," . $os . "," . $min_age . "," . $max_age . "\r\n";
		fwrite($openFile, $txt);
		fclose($openFile);	

	} else {
		echo "File not exist to write.";
	}
} 
function compare($name, $gender, $age, $ptype, $os, $min_age, $max_age) {
	
}
?>