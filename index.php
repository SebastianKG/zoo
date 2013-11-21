<html>
	<head>
		<title>ZOO // CS 304</title>
		<meta name="description" content="Our cool zoo! Made by Sebastian Kazenbroot-Guppy, Norris Lee and Harlen Bains."
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body> 
		<div id="mycontainer">
			<button type="button" name="logout">Log Out</btn>

			<?php
				$result = executePlainSQL("select * from zoo");
				printAllZoos($result);
			?>

			<div id="log">ourLog</div>
		</div>
		
		<script type="text/javascript" src="http://gridster.net/assets/js/libs/jquery-1.7.2.min.js"></script>
		<script src="application.js" type="text/javascript"></script>
	</body>
</html>