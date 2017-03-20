<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>
<?php if(empty($_POST['name'])) {
	header("Location: signup.php");
	} ?>
<?php if(isset($_POST['name']) && !empty($_POST['name'])) {
		$user_name = htmlentities($_POST['name']);
		$user_gender = htmlentities($_POST['gender']);
		$user_age = htmlentities($_POST['age']);
		$user_ptype = htmlentities($_POST['ptype']);
		$user_os = htmlentities($_POST['os']);
		$user_min_age = htmlentities($_POST['min-age']);
		$user_max_age = htmlentities($_POST['max-age']);
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
	}; ?>

	

<div>
	<strong>Thank you</strong><br>
	<p>Welcome to NerdLuv, <?php echo $user_name ?></p>
	<p>Now <a href="matches.php">log in to see your matches.</a></p>

	<span style="color: red"><?= $detail?></span><br>

	<?php 
	$upload_file_name = $_FILES['user_img']['name'];
	$upload_file_type = $_FILES['user_img']['type'];
	$upload_file_size = $_FILES['user_img']['size'];
	$upload_file_max_size = 2000000;
	$user_name_file = preg_replace('/\s+/', '', $user_name);
	$upload_file_extension = substr($upload_file_name,strpos($upload_file_name,'.') + 1);
	$storage_file_name = rand(10000,50000).md5(strtolower($user_name_file)).rand(10000,50000).'.'.$upload_file_extension;
	$tmp_upload_file_name = $_FILES['user_img']['tmp_name'];
	$location = 'img/';
	$file_type = 'image/jpeg';
	
	if(isset($upload_file_name)) {
		if((($upload_file_extension=='jpg') || ($upload_file_extension=='jpeg'))
			&& ($upload_file_type=='image/jpeg') && ($upload_file_size < $upload_file_max_size)) {
			move_uploaded_file($tmp_upload_file_name,$location.$storage_file_name);
		} else {
			echo "No File uploaded.";
		}
	}; 
	 ?>
	
	<?php
		$file_name = "singles.txt"; 
		if(file_exists($file_name)) {

		// write data to file singles.txt
		$openFile = fopen($file_name, "a");
		 fopen("test.txt", "r+");
		$txt = $user_name . "," . $user_gender . "," . $user_age . "," 
		. $user_ptype . "," . $user_os . "," . $user_min_age . "," . $user_max_age . "\r\n";
		fwrite($openFile, $txt);
		fclose($openFile);	
		
	} else {
		echo "File not exist to write.";
	}
	?>
	
</div>

<?php include("bottom.html"); ?>