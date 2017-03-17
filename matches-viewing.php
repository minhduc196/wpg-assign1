<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>
<?php if(empty($_GET['name'])) {
	header("Location: matches.php");
	} ?>
<?php $info = "";
$file_name = "singles.txt";
$user_name = $_GET['name'];
$handle = file($file_name);
if(file_exists($file_name)) {
	foreach ($handle as $line) {
		list($name, $gender, $age, $ptype, $os, $min_age, $max_age) = explode(',',$line);
		if($user_name == $name) {
			$info = $line;
		}
	}
} 
?>

<div>
	<strong>Matches for <?= $user_name; ?></strong>
	
	<?php 
		//compare data to get matches
		$info_array = explode(",", $info);
		$person_gender = $info_array[1];
		$person_age = $info_array[2];
		$person_ptype = $info_array[3];
		$person_os = $info_array[4];
		$person_min_age = $info_array[5];
		$person_max_age = $info_array[6];
		foreach ($handle as $value) {
			list($name, $gender, $age, $ptype, $os, $min_age, $max_age) = explode(",", $value);
			similar_text($person_ptype, $ptype,$result);
			if(($person_gender != $gender) && ($age >= $person_min_age && $age <= $person_max_age) 
				&& (($person_age > $min_age) && ($person_age < $max_age))
				&& ($person_os == $os) && ($result  >=25)) {
			$dir = "img";
		$loadFolder = opendir($dir.'/');
		$user_image = preg_replace('/\s+/', '', $name);
		$user_image_lc = strtolower($user_image);
		$file = scandir($dir);
		$check = false;
		foreach ($file as $match_image) {
			if($user_image_lc == substr($match_image, 0, strlen($user_image_lc))) {
				$avatar = $match_image;
				$check = true;
			}
		}
		if(!$check) {
			$avatar = "user.jpg";
		}
		$url = $dir."/". $avatar;
	?>
	<div class="match">
		<p><?= $name?></p>
		<img src="<?php echo $url;?>" alt="user">
		<ul>
			<li><strong>gender:</strong><?php echo $gender; ?></li>
			<li><strong>age:</strong><?= $age?></li>
			<li><strong>type:</strong><?php echo $ptype; ?></li>
			<li><strong>OS:</strong><?php echo $os; ?></li>
		</ul>
	</div>
<?php }} ?>
</div>

<?php include("bottom.html"); ?>