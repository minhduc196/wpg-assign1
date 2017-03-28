<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>
<?php if(empty($_POST['name'])) {
	header("Location: signup.php");
} ?>
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
?>
<?php 
$err = "";
$check = false; 
if(isset($_POST['name']) && !empty($_POST['name'])) {
	if(preg_match("/[a-z^A-Z]/", $_POST['name'])) {
		$user_name = test_input($_POST['name']);
		if(isset($_POST['gender'])) {
			$user_gender = test_input($_POST['gender']);
			if(isset($_POST['age']) && !empty($_POST['age'])) {
				if(preg_match("/[1-9]/",$_POST['age'])) {
					if($_POST['age'] >= 1 && $_POST['age'] <= 99) {
						$user_age = test_input($_POST['age']);
						if(isset($_POST['ptype']) && !empty($_POST['ptype'])) {
							if(!preg_match("/[I,E][N,S][F,T][J,P]/",$_POST['ptype'])) {
								$user_ptype = test_input($_POST['ptype']);
								$user_ptype_uc = strtoupper($user_ptype);
								if(isset($_POST['os'])) {
									$user_os = test_input($_POST['os']);
									if(isset($_POST['min-age']) && isset($_POST['max-age']) && !empty($_POST['min-age']) || !empty($_POST['max-age'])) {
										if($_POST['max-age'] > $_POST['min-age']) {
											$user_min_age = test_input($_POST['min-age']);
											$user_max_age = test_input($_POST['max-age']);
											$check = true;
										} else { $err = "Min age must be smaller than max age."; };
										if(empty($_POST['min-age'])) {
											$user_min_age = 1;
											$user_max_age = test_input($_POST['max-age']);
											$check = true;
										} else if(empty($_POST['max-age'])) {
											$user_max_age = 99;
											$user_min_age = test_input($_POST['min-age']);
											$check = true;
										} else if(empty($_POST['mix-age']) && empty($_POST['max-age'])) {
											$check = false;
											$err = "Both field cant be blank.";
										} 
									} else { $err = "At least one age field must be filled."; }
								} else { $err = "No os selected."; }
							} else { $err = "Invalid personal type."; }
						} else { $err = "Personal type must be filled."; } 
					} else { $err = "Age must be a number between 1 and 99."; }
				} else { $err = "Age must be a number."; } 
			} else { $err = "Age must be filled."; }
		} else { $err = "Gender must be selected."; }
	} else { $err = "Invalid name. Must be a character and number are not allowed."; } 
} else { $err = "Name must be filled."; }
?>

<?php if($check) { ?>

<div>
	<strong>Thank you</strong><br>
	<p>Welcome to NerdLuv, <?php echo $user_name ?></p>
	<p>Now <a href="matches.php">log in to see your matches.</a></p>
</div>

<?php 
write_data($user_name, $user_gender, $user_age, $user_ptype_uc, $user_os, $user_min_age, $user_max_age);
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
	}
 } else { ?>
<div>
	<strong>Sorry</strong><br>
	<p><?php echo $err . " <a href=\"signup.php\">Go Back</a>";?></p>
</div>
<?php } ?>
<?php include("bottom.html"); ?>