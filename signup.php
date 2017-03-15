<?php include("top.html"); ?>
<?php ini_set('error_reporting', 0) ?>

<form name="signup" action="signup-submit.php" method="POST">

	<fieldset>
		<legend>New User Sign up</legend>
		<p>
			<label class="left"><strong>Name:</strong></label>
			<input type="text" name="name" size="16">
		</p>
		<p>
			<label class="left"><strong>Gender:</strong></label>
			<input type="radio" name="gender" value="M">Male
			<input type="radio" name="gender" checked value="F">Female
		</p>
		<p>
			<label class="left"><strong>Aged:</strong></label>
			<input type="text" name="age" size="6" maxlength="2">
		</p>
		<p>
			<label><strong>Personality Type:</strong></label>
			<input type="text" name="ptype" size="6" maxlength="4">&nbsp;(<a href="http://www.humanmetrics.com/cgi-win/jtypes2.asp">Don't know your type?</a>)
		</p>
		<p>
			<label class="left"><strong>Favorite OS:</strong></label>
			<select name="os">
				<option value="Windows">Windows</option>
				<option value="MAC OS X">MAC OS X</option>
				<option value="Linux">Linux</option>
			</select>
		</p>
		<p>
			<label class="left"><strong>Seeking age</strong></label>
			<input type="text" name="min-age" size="6" placeholder="min" maxlength="2"> to 
			<input type="text" name="max-age" size="6" placeholder="max" maxlength="2">
		</p>

		<input type="submit" value="Sign up">
	</fieldset>
</form>

<?php include("bottom.html"); ?>
