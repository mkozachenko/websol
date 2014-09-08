<html>
	<head>
		<title>INFO</title>
	</head>
	<body>
		<form action="" method="POST" enctype="multipart/form-data" target="_self">
			<fieldset id="membershipform">
				<ul class="clearfix">
					<li id="li-status">
						<span>Add planet</span>
					</li>
					<li id="li-name">
						<label for="name">Name</label>
						<input name="name" type="text" id="name"/>
					</li>

					<li id="li-wiki">
						<label for="wiki">Wiki</label>
						<textarea name="wiki" id="wiki" rows="8" cols="30" maxlength="1024" ></textarea>
						<div id="wiki"></div>
					</li>

					<li id="li-video">
						<label for="video">Videos</label>
						<input name="video" type="text" id="video"/>
					</li>
					<li id="li-video">
						<label for="photo">Photos</label>
						<input name="photo" type="text" id="photo"/>
					</li>
					<li id="li-links">
						<label for="links">Links</label>
						<input name="links" type="text" id="links"/>
						<input type="submit" name="submit" value="Send Application &#9658;">
				</ul>
			</fieldset>
		</form>

		<?php //show all possible errors. should be ALWAYS set to that level
		error_reporting(E_ALL);
		// sometimes buttons not being sent or gets misspelled
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$username = "root";
			$password = "";
			$host = "localhost";
			$database = "sol";
			$link = mysql_connect($host, $username, $password);
			if (!$link) {
				die('Could not connect: ' . mysql_error());
			}
			// Select your database
			mysql_select_db($database);

			$name = mysql_real_escape_string($_POST['name']);
			$wiki = nl2br($_POST['wiki']);
			$video = mysql_real_escape_string($_POST['video']);
			$photo = mysql_real_escape_string($_POST['photo']);
			$links = mysql_real_escape_string($_POST['links']);
			
			if(trim($name)==''||trim($wiki)==''||trim($video)==''||trim($links)==''){
					echo $query;
				}
				else{
					$query = "INSERT INTO info (`name`,`wiki`,`photos`,`videos`,`links`) VALUES ('$name','$wiki','$photo','$video','$links')";
					echo $query;
					$results = mysql_query($query, $link) or die(mysql_error());
					var_dump($results);
				}
		}
		?>

		<script>
			$(document).ready(function() {
				var text_max = 1024;
				$('#wiki).html(text_max + ' characters remaining');

				$('#textarea').keyup(function() {
					var text_length = $('#textarea').val().length;
					var text_remaining = text_max - text_length;

					$('#wiki').html(text_remaining + ' characters remaining');
				});
			});
		</script>

	</body>
</html>