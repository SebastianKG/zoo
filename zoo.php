<html>
	<head>
		<title>ZOO // CS 304</title>
		<meta name="description" content="Our cool zoo! Made by Sebastian Kazenbroot-Guppy, Norris Lee and Harlen Bains."
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
		<div id="mycontainer">

		<button type="button" name="logout"  id="logout">Log Out</button>

		<h1> Our Zoo, <?php echo ($_COOKIE['zooname']!='' ? $_COOKIE['zooname'] : 'Undefined (We Messed Up!)'); ?> </h1>

		<?php

		$success = True; //keep track of errors so it redirects the page only if there are no errors
		$db_conn = OCILogon("ora_w8x7", "a67961045", "ug");

		require ('functions.php');

		// Connect Oracle...
		if ($db_conn) {

			if (array_key_exists('reset', $_POST)) {
				// Drop old table...
				echo "<br> dropping table <br>";
				executePlainSQL("Drop table tab1");

				// Create new table...
				echo "<br> creating new table <br>";
				executePlainSQL("create table tab1 (nid number, name varchar2(30), primary key (nid))");
				OCICommit($db_conn);

			} else
				if (array_key_exists('insertsubmit', $_POST)) {
					//Getting the values from user and insert data into the table
					$tuple = array (
						":bind1" => $_POST['insNo'],
						":bind2" => $_POST['insName']
					);
					$alltuples = array (
						$tuple
					);
					executeBoundSQL("insert into tab1 values (:bind1, :bind2)", $alltuples);
					OCICommit($db_conn);

				} else
					if (array_key_exists('updatesubmit', $_POST)) {
						// Update tuple using data from user
						$tuple = array (
							":bind1" => $_POST['oldName'],
							":bind2" => $_POST['newName']
						);
						$alltuples = array (
							$tuple
						);
						executeBoundSQL("update tab1 set name=:bind2 where name=:bind1", $alltuples);
						OCICommit($db_conn);

					} else
						if (array_key_exists('dostuff', $_POST)) {
							// Insert data into table...
							executePlainSQL("insert into tab1 values (10, 'Frank')");
							// Inserting data into table using bound variables
							$list1 = array (
								":bind1" => 6,
								":bind2" => "All"
							);
							$list2 = array (
								":bind1" => 7,
								":bind2" => "John"
							);
							$allrows = array (
								$list1,
								$list2
							);
							executeBoundSQL("insert into tab1 values (:bind1, :bind2)", $allrows); //the function takes a list of lists
							// Update data...
							//executePlainSQL("update tab1 set nid=10 where nid=2");
							// Delete data...
							//executePlainSQL("delete from tab1 where nid=1");
							OCICommit($db_conn);
						}

			if ($_POST && $success) {
				//POST-REDIRECT-GET -- See http://en.wikipedia.org/wiki/Post/Redirect/Get
				header("location: zoo.php");
			} else {
				// Select data...
				$result = executePlainSQL("select pen_id, maxpopulation, quality, name, type, bodysize, hydration, fullness, hygiene, happiness from purchasepen, purchaseanimal where id=pen_id"); // add "and zooname=<"
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