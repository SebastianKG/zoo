<html>
	<head>
		<title>ULTIMATE ZOO // CS 304 - Zoo View</title>
		<meta name="description" content="Our cool zoo! Made by Sebastian Kazenbroot-Guppy, Norris Lee and Harlen Bains aka Jamaican Hopscotch Mafia">
		<!-- <?php require ('main.css'); ?> -->
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	<body>
		<?php 
			$animalname = ($_COOKIE['animalname']!='' ? $_COOKIE['animalname'] : 'undefined');
			if ($animalname == 'undefined') {
				header("location: zoo.php");
				die();
			}

			$zooname = ($_COOKIE['zooname']!='' ? $_COOKIE['zooname'] : 'undefined');
			if ($zooname == 'undefined') {
				header("location: index.php");
				die();
			}
		 ?>

		<div class="centered"><h1> Tending to <?php echo $animalname; ?><button type="button" name="backtozoo"  id="backtozoo" class="floatRight">Back to Zoo</button></h1></div>
		<div class="clearAll"></div>


		 <?php

		$success = True; //keep track of errors so it redirects the page only if there are no errors
		$db_conn = OCILogon("ora_w8x7", "a67961045", "ug");

		require ('functions.php');

		// Connect Oracle...
		if ($db_conn) {

			// Select data...
			$query = "select name, type, bodysize, hydration, fullness, hygiene, happiness from purchasepen where zooname='" . $zooname . "' and animalname='" . $animalname . "'";
			$result = executePlainSQL($query);
			printAnimalsWithButtons($result);

			//Commit to save changes...
			OCILogoff($db_conn);
		} else {
			echo "cannot connect";
			$e = OCI_Error(); // For OCILogon errors pass no handle
			echo htmlentities($e['message']);
		}
		?>

		<script type="text/javascript" src="http://gridster.net/assets/js/libs/jquery-1.7.2.min.js"></script>
		<script src="application.js" type="text/javascript"></script>
	</body>
</html>