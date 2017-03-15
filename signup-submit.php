<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>
<?php $err = ""; ?>
<?php if(isset($_POST['name']) && !empty($_POST['name'])) {
		$user_name = $_POST['name'];
		$user_gender = $_POST['gender'];
		$user_age = $_POST['age'];
		$user_ptype = $_POST['ptype'];
		$user_os = $_POST['os'];
		$user_min_age = $_POST['min-age'];
		$user_max_age = $_POST['max-age'];
		$user_ptype_uc = strtoupper($user_ptype);
		if(!preg_match("/[a-z^A-Z]/", $user_name)) {
			echo "<a href=\"signup.php\">Go back</a><br>";
			die($user_name . " is not a valid name.");
		};
		if(empty($user_gender)) {
			echo "<a href=\"signup.php\">Go back</a><br>";
			die("Gender is required");
		};
		if(!preg_match("/[1-9]/",$user_age) || empty($user_age)) {
			echo "<a href=\"signup.php\">Go back</a><br>";
			die($user_age . " is not a valid age");
		};
		if(!preg_match("/[I,E][N,S][F,T][J,P]/",$user_ptype) || empty($user_ptype)) {
			echo "<a href=\"signup.php\">Go back</a><br>";
			die($user_ptype . " is not a valid type");
		};
		if(empty($user_os)) {
			echo "<a href=\"signup.php\">Go back</a><br>";
			die("OS not valid");
		}
		if(!preg_match("/[1-9]/",$user_min_age) || empty($user_min_age)) {
			echo "<a href=\"signup.php\">Go back</a><br>";
			die($user_min_age . " is not a valid min age");
		};
		if(!preg_match("/[1-9]/",$user_max_age) || empty($user_max_age) || ($user_min_age > $user_max_age)) {
			die($user_max_age . " is not a valid max age");
		}
	} else {
		echo "<a href=\"signup.php\">Go back</a><br>";
		die("All field must be filled");
		} ?>

<div>
	<strong>Thank you</strong><br>
	<p>Welcome to NerdLuv, <?php echo $user_name ?></p>
	<p>Now <a href="matches.php">log in to see your matches.</a></p>
	
	<?php 
		//write data to file singles.txtt
		// fopen("singles.txt", "a+");
		// fopen("test.txt", "r+");
		// $txt = $_POST["name"] . "," . $_POST["gender"] . "," 
		// . $_POST["age"] . ",". strtoupper($_POST["type"]) . "," . $_POST["os"] . ","
		// . $_POST["min-age"] . "," . $_POST["max-age"] . "\r\n";
		// file_put_contents("test.txt", $txt, FILE_APPEND);
		// fclose($myFile);		
	?>
</div>

<?php include("bottom.html"); ?>