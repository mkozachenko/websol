<html>
	<head>
		<title>MOONS</title>
	</head>
	<body>
		<?php
			$username="root";
			$password="";
			$host="localhost";
			$database="sol";
			$link=mysql_connect($host,$username,$password);
			if(!$link) {
			die('Could not connect: '.mysql_error());
			}
			mysql_select_db($database);
			$retrieve = mysql_query("SELECT name, id FROM planets");
		?>
		<form action="" method="POST" enctype="multipart/form-data" target="_self">
			<fieldset id="membershipform">
				<ul class="clearfix">
					<li id="li-status">
						<span>Add moon</span>
					</li>
					<li id="li-name">
						<label for="name">Name</label>
						<input name="name" type="text"id="name"/>
					</li>
					<li id="li-parent">
						<label for="parent">Parent</label>
						<?php
							echo "<select name='parent'>";
							while ($temp = mysql_fetch_assoc($retrieve))
							{
								  echo "<option value='".$temp['name']."'>".$temp['name']."</option>";
							}
							echo "</select>";
						?>
					</li>
					<li id="liradius">
						<label for="radius">Radius</label>
						<input name="radius" type="text" id="radius"/>
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
						<input name="rot-speed" type="text" id="rot-speed"/>
					</li>
					<li id="li-tilt">
						<label for="tilt">Tilt</label>
						<input name="tilt" type="text" id="tilt"/>
					</li>
					<label for="upfile">Texture:</label>
					<input type="file" name="upfile" id="upfile">
					<br>
					<input type="submit" name="submit" value="Добавить спутник &#9658;">
				</ul>
			</fieldset>
		</form>
		<?php
		if($_SERVER['REQUEST_METHOD']=='POST') {
			if(!$link) {
				die('Could not connect: '.mysql_error());
			}
			mysql_select_db($database);
			//
			$path="uploads/moonTextures/";
			$texture= $_FILES["upfile"]["name"];
			$name=mysql_real_escape_string($_POST['name']);
			$parent=mysql_real_escape_string($_POST['parent']);
			$radius=mysql_real_escape_string($_POST['radius']);
			$distance=mysql_real_escape_string($_POST['distance']);
			$orbspeed=mysql_real_escape_string($_POST['orb-speed']);
			$rotspeed=mysql_real_escape_string($_POST['rot-speed']);
			$tilt=mysql_real_escape_string($_POST['tilt']);
			if(trim($name)==''||trim($radius)==''||trim($distance)==''||trim($orbspeed)==''||trim($rotspeed)==''||trim($tilt)==''||trim($parent)==''){
					echo $query;
				}
				else{
					if($_FILES["upfile"]["size"] > 1024*3*1024)
				   {
				     echo ("Размер файла превышает три мегабайта");
				     exit;
				   }
				   if(is_uploaded_file($_FILES["upfile"]["tmp_name"]))
				   {
				     move_uploaded_file($_FILES["upfile"]["tmp_name"], $path.$_FILES["upfile"]["name"]);
				   } else {
				      echo("Ошибка загрузки файла");
				   }
					$query="INSERT INTO moons (`name`,`radius`, `distance`, `orbspeed`, `rotspeed`, `tilt`,`parent`, `texture`) VALUES ('$name','$radius','$distance','$orbspeed','$rotspeed','$tilt','$parent','$texture')";
					$results=mysql_query($query,$link) or die(mysql_error());
					var_dump($results);
			}
			}
			?>
	</body>
</html>