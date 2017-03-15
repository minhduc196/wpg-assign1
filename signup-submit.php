<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>

<?php function checkName($name) {
	if(!preg_match("/[a-zA-Z]/",$_POST["name"])) {
		die("Name not valid");
		} 
	} ?>

<div>
	<strong>Thank you</strong><br>
	<p>Welcome to NerdLuv, <?php echo $_POST["name"] ?></p>
	<p>Now <a href="matches.php">log in to see your matches.</a></p>
	
	<?php 
		//write data to file singles.txtt
		// fopen("singles.txt", "a+");
		fopen("test.txt", "r+");
		$txt = $_POST["name"] . "," . $_POST["gender"] . "," 
		. $_POST["age"] . ",". strtoupper($_POST["type"]) . "," . $_POST["os"] . ","
		. $_POST["min-age"] . "," . $_POST["max-age"] . "\r\n";
		file_put_contents("test.txt", $txt, FILE_APPEND);
		fclose($myFile);		
	?>
</div>

<?php include("bottom.html"); ?>