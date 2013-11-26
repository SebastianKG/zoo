<html>
	<head>
		<title>ULTIMATE ZOO // CS 304 - Zoo View</title>
		<meta name="description" content="Our cool zoo! Made by Sebastian Kazenbroot-Guppy, Norris Lee and Harlen Bains aka Jamaican Hopscotch Mafia">
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	<body> 
			<?php
				$success = True; //keep track of errors so it redirects the page only if there are no errors
				$db_conn = OCILogon("ora_w8x7", "a67961045", "ug");

				require ('functions.php');

				if (array_key_exists('createnewzoo', $_POST)) {
	                // Update tuple using data from user
					$tuple = array (
						":bind1" => $_POST['newzoo']
					);
					$alltuples = array (
						$tuple
					);
					executeBoundSQL("insert into zoo values (:bind1,1000,Harlen)", $alltuples);     
					OCICommit($db_conn);
            	}

				if ($db_conn) {
					$result = executePlainSQL("select * from zoo");
					printAllZoos($result);
				
						//Commit to save changes...
					OCILogoff($db_conn);
				} else {
					echo "cannot connect";
					$e = OCI_Error(); // For OCILogon errors pass no handle
					echo htmlentities($e['message']);
				}
			?>

			<form method="POST" action="index.php">
				Create New Zoo<br/>Enter New Zoo Name: <input type="text" name="newzoo"> <input type="submit" name="createnewzoo">Create</button>
			</form>

		<script type="text/javascript" src="http://gridster.net/assets/js/libs/jquery-1.7.2.min.js"></script>
		<script src="application.js" type="text/javascript"></script>
	</body>
</html>