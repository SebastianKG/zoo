<html>
	<head>
		<title>ULTIMATE ZOO // CS 304 - Zoo View</title>
		<meta name="description" content="Our cool zoo! Made by Sebastian Kazenbroot-Guppy, Norris Lee and Harlen Bains aka Jamaican Hopscotch Mafia">
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	<body>
		<div id="mycontainer">
			<?php 
				$zooname = ($_COOKIE['zooname']!='' ? $_COOKIE['zooname'] : 'undefined');
			 ?>

			<div class="centered"><h1> Our Zoo, <?php echo $zooname; ?><button type="button" name="logout"  id="logout" class="logout floatRight">Log Out</button></h1></div>
			<div class="clearAll"></div>

			<?php

			$success = True; //keep track of errors so it redirects the page only if there are no errors
			$db_conn = OCILogon("ora_w8x7", "a67961045", "ug");

			require ('functions.php');

			// Connect Oracle...
			if ($db_conn) {

				if (array_key_exists('delButton', $_POST)) {
	                $name = $_POST['delanimalname'];
	                $query = "delete from purchaseanimal where name=$name and zooname=$zooname";
	                $result = executePlainSQL($query);
	                OCICommit($db_conn);
            	}

            	if ($_POST && $success) {
            		header('location: zoo.php');
            		die();
            	} else {
					// Select data...
					$query = "select pen_id, maxpopulation, quality, name, type, bodysize, hydration, fullness, hygiene, happiness from purchasepen, purchaseanimal where id=pen_id and purchasepen.zooname='" . $zooname . "'";
					$result = executePlainSQL($query);
					printAnimalsWithButtons($result);
				}

				//Commit to save changes...
				OCILogoff($db_conn);
			} else {
				echo "cannot connect";
				$e = OCI_Error(); // For OCILogon errors pass no handle
				echo htmlentities($e['message']);
			}
			?>
		</div>
		<script type="text/javascript" src="http://gridster.net/assets/js/libs/jquery-1.7.2.min.js"></script>
  		<script src="application.js" type="text/javascript"></script>
	</body>
</html>