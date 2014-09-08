<html>
	<head>
		<title>PLANETS</title>
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
		<li id="liradius">
		<label for="radius">Radius</label>
		<input name="radius" type="text" id="radius" title="Last Name" />
		</li>
		<li id="li-distance">
		<label for="distance">Distance</label>
		<input name="distance" type="text" id="distance"/>
		</li>
		<li id="li-orb-speed">
		<label for="orb-speed">Orbital speed</label>
		<input name="orb-speed" type="text" id="orb-speed"/>
		</li>
		<li id="li-rot-speed">
		<label for="rot-speed">Rotational speed</label>
		<input name="rot-speed" type="text"id="rot-speed"/>
		</li>
		<li id="li-tilt">
		<label for="tilt">Tilt</label>
		<input name="tilt" type="text" id="tilt"/>
		</li>
		<label for="upfile">Texture:</label>
		<input type="file" name="upfile" id="upfile">
		<br>
		<input type="submit" name="submit" value="Add new planet &#9658;">
		</ul>
		</fieldset>
		</form>
		<?php
		//error_reporting(E_ALL);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$username = "root";
			$password = "";
			$host = 'localhost';
			$database = "sol";
			$link = mysql_connect($host, $username, $password);
			if (!$link) {
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db($database);
			//
			$path = "uploads/planetTextures/";
			
			$texture = $_FILES["upfile"]["name"];
			$name = mysql_real_escape_string($_POST['name']);
			$radius = mysql_real_escape_string($_POST['radius']);
			$distance = mysql_real_escape_string($_POST['distance']);
			$orbspeed = mysql_real_escape_string($_POST['orb-speed']);
			$rotspeed = mysql_real_escape_string($_POST['rot-speed']);
			$tilt = mysql_real_escape_string($_POST['tilt']);
			
			$query = "Не все поля заполнены!<br>";
			
			if(trim($name)==''||trim($radius)==''||trim($distance)==''||trim($orbspeed)==''||trim($rotspeed)==''||trim($tilt)==''){
				echo $query;
			}
			else{
				if ($_FILES["upfile"]["size"] > 1024 * 3 * 1024) {
				echo("Размер файла превышает три мегабайта");
				exit ;
			}
				if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
				move_uploaded_file($_FILES["upfile"]["tmp_name"], $path . $_FILES["upfile"]["name"]);
			} else {
				echo("Ошибка загрузки файла<br>");
			}
			$query = "INSERT INTO planets (`name`,`radius`, `distance`, `orb-speed`, `rot-speed`, `tilt`, `texture`) VALUES ('$name','$radius','$distance','$orbspeed','$rotspeed','$tilt','$texture')";
			$results = mysql_query($query, $link) or die(mysql_error());
			var_dump($results);
			}
		}
		?>
	</body>
</html>