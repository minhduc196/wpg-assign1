<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>
<?php if(empty($_POST['name'])) {
	header("Location: signup.php");
	} ?>
<?php if(isset($_POST['name']) && !empty($_POST['name'])) {
		$user_name = $_POST['name'];
		$user_gender = $_POST['gender'];
		$user_age = $_POST['age'];
		$user_ptype = $_POST['ptype'];
		$user_os = $_POST['os'];
		$user_min_age = $_POST['min-age'];
		$user_max_age = $_POST['max-age'];
		$detail = "";
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
		if(!empty($user_max_age) && empty($user_min_age)) {
			$user_min_age = 1;
			$detail = "User min age not found, default value used.";
		}
		else if(!preg_match("/[1-9]/",$user_min_age) || empty($user_min_age)) {
			echo "<a href=\"signup.php\">Go back</a><br>";
			die($user_min_age . " is not a valid min age");
		};
		if(!empty($user_min_age) && empty($user_max_age)) {
			$user_max_age = 99;
			$detail = "User max age not found, default value used.";
		}
		else if(!preg_match("/[1-9]/",$user_max_age) || ($user_min_age > $user_max_age)) {
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

	<span style="color: red"><?= $detail?></span>
	
	<?php 
		//write data to file singles.txtt
		fopen("singles.txt", "r+");
		// fopen("test.txt", "r+");
		$txt = $user_name . "," . $user_gender . "," . $user_age . "," 
		. $user_ptype . "," . $user_os . "," . $user_min_age . "," . $user_max_age . "\r\n";
		file_put_contents("singles.txt", $txt, FILE_APPEND);
		fclose("singles.txt");		
	?>
</div>

<?php include("bottom.html"); ?>