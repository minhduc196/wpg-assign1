<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>
<?php
		$myFile = file("singles.txt");
		// $myFile = file("test.txt");

		// check for input name exist
		function findInfo($input) {
			global $myFile;
			$info = "";
			$check = false;
			foreach ($myFile as $value) {
				list($name, $gender, $age, $ptype, $os, $min_age, $max_age) = explode(",", $value);
				if(strcmp($name, $input) == 0) {
					$check = true;
					$info =  "$name,$gender,$age,$ptype,$os,$min_age,$max_age";
					break;
				}
			};
			if(!$check) {
				$info = "";
				echo $input . " Data Not Found";
			};
			return $info;
		}			
	?>
	<?php if($_GET["name"] == NULL) {
		header("Location: matches.php"); } else { ?>
<div>
	<strong>Matches for <?= $_GET["name"]; ?></strong>
	
	<?php 
		//compare data to get matches
		$info = findInfo($_GET["name"]); 
		$info = explode(",", $info);
		$person_gender = $info[1];
		$person_age = $info[2];
		$person_ptype = $info[3];
		$person_os = $info[4];
		$person_min_age = $info[5];
		$person_max_age = $info[6];
		global $myFile;
		foreach ($myFile as $value) {
			list($name, $gender, $age, $ptype, $os, $min_age, $max_age) = explode(",", $value);
			similar_text($person_ptype, $ptype,$result);
			if((strcmp($person_gender, $gender) != 0) && ($age >= $person_min_age && $age <= $person_max_age) 
				&& (($person_age > $min_age) && ($person_age < $max_age))
				&& (strcmp($person_os, $os) == 0) && ($result  >=25)) {
			
	?>
	<div class="match">
		<p><?= $name?></p>
		<img src="files/user.jpg" alt="user">
		<ul>
			<li><strong>gender:</strong><?php echo $gender; ?></li>
			<li><strong>age:</strong><?= $age?></li>
			<li><strong>type:</strong><?php echo $ptype; ?></li>
			<li><strong>OS:</strong><?php echo $os; ?></li>
		</ul>
	</div>
			<?php }} 
			?>
</div>
<?php } ?>
<?php include("bottom.html"); ?>