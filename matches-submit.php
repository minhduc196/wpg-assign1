<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>
<?php if(empty($_GET['name'])) {
	header("Location: matches.php");
	} ?>
<?php $info = "";
$err = "";
$found = false;
$file_name = "singles.txt";
$user_name = $_GET['name'];
$handle = file($file_name);
if(file_exists($file_name)) {
	foreach ($handle as $line) {
		list($name, $gender, $age, $ptype, $os, $min_age, $max_age) = explode(',',$line);
		if($user_name == $name) {
			$info = $line;
			$found = true;
			break;
		}
	}
} else { $err = "File not exist."; }

?>

<div>
	<strong>Matches for <?= $user_name; ?></strong>
	
	<?php if(!$found) {
		$err = "User not exist.";
		} else {
			$info_array = explode(',',$info);
			$person_gender = $info_array[1];
			$person_age = $info_array[2];
			$person_ptype = $info_array[3];
			$person_os = $info_array[4];
			$person_min_age = $info_array[5];
			$person_max_age = $info_array[6];
			$match = false;
			$num = 0;
			similar_text($person_ptype, $ptype,$result);
			foreach ($handle as $key) {
				list($name, $gender, $age, $ptype, $os, $min_age, $max_age) = explode(',',$key);
				if(($person_gender != $gender) && ($age >= $person_min_age && $age <= $person_max_age) 
					&& (($person_age > $min_age) && ($person_age < $max_age)) && ($person_os == $os) && ($result  >=25)) {
					$match = true;
					$match_name[] = $name;
					$match_gender[] = $gender;
					$match_age[] = $age;
					$match_ptype[] = $ptype;
					$match_os[] = $os;
					$num++;		
					$dir = "img";
				$loadFolder = opendir($dir.'/');
				$user_image = preg_replace('/\s+/', '', $name);
				$user_image_lc = md5(strtolower($user_image));
				$file = scandir($dir);
				$check = false;
				foreach ($file as $match_image) {
					if($user_image_lc == substr($match_image, 5, strlen($user_image_lc))) {
						$avatar = $match_image;
						$check = true;
						break;
					} else {
				}
				}

			if(!$check) {
				$avatar = "user.jpg";
			}
			$url = $dir."/". $avatar;
					} else { $err = "No match found"; } 
				} 
			}
			// die();
			?>
	<?php if($found && $match) {
		for($i =0; $i < $num;$i++) {
		?>
	<div class="match">
		<p><?= $match_name[$i]?></p>
		<img src="<?= $url;?>" alt="user">
		<ul>
			<li><strong>gender:</strong><?= $match_gender[$i]; ?></li>
			<li><strong>age:</strong><?= $match_age[$i]?></li>
			<li><strong>type:</strong><?= $match_ptype[$i]; ?></li>
			<li><strong>OS:</strong><?= $match_os[$i]; ?></li>
		</ul>
	</div>
	<?php
	}	} else { echo $err . " <a href=\"matches.php\">Go Back</a>";} ?>
</div>

<?php include("bottom.html"); ?>