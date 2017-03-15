<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>

<form action="matches-viewing.php" method="GET">
	<fieldset>
		<legend>Returning User</legend>
		<p>
			<label class="left"><strong>Name:</strong></label>
			<input type="text" name="name" size="16">
		</p>
		<input type="submit" value="View My Matches">
	</fieldset>
</form>

<?php include("bottom.html"); ?>