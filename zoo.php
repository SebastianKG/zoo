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
	                $query = "delete from purchaseanimal where name='" . $name . "' and zooname='" . $zooname ."'";
	                $result = executePlainSQL($query);
	                OCICommit($db_conn);
            	} else if (array_key_exists('addnewpen', $_POST)) {
	                $query = "insert into purchasepen values (0,5,(select max(id) from purchasepen where zooname = '" . $zooname . "') + 1,10,'" . $zooname ."')";
	                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-500 where name='" . $zooname . "'";
	                executePlainSQL($query);
	                executePlainSQL($cashquery);
	                OCICommit($db_conn);
            	} else if (array_key_exists('addnewanimal', $_POST)) {
					   $animal = $_POST['animal'];
					   $penID = $_POST['penId'];
					   $name = $_POST['newanimalname'];
					   if ($animal == "Charizard") {
					   	$query = "insert into purchaseanimal values ('" . $name . "','Charizard',50,50,50,50,$charizardBodySize,$penID,'" . $zooname ."')";
					   	$popQuery = "update purchasepen set currentpopulation = (select currentpopulation from purchasepen where zooname = '" . $zooname . "') + " . $charizardBodySize . "";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-" . $charizardCost . " where name='" . $zooname . "'";
		                executePlainSQL($query);
		                executePlainSQL($popQuery);
		                executePlainSQL($cashquery);
					   } else if ($animal == "Snorlax") {
					   	$query = "insert into purchaseanimal values ('" . $name . "','Snorlax',50,50,50,50,$snorlaxBodySize,$penID,'" . $zooname ."')";
					   	$popQuery = "update purchasepen set currentpopulation = (select currentpopulation from purchasepen where zooname = '" . $zooname . "') + " . $snorlaxBodySize . "";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-" . $snorlaxCost . " where name='" . $zooname . "'";
		                executePlainSQL($query);
		                executePlainSQL($popQuery);
		                executePlainSQL($cashquery);
					   } else if ($animal == "Witch") {
					   	$query = "insert into purchaseanimal values ('" . $name . "','Witch',50,50,50,50,$witchBodySize,$penID,'" . $zooname ."')";
					   	$popQuery = "update purchasepen set currentpopulation = (select currentpopulation from purchasepen where zooname = '" . $zooname . "') + " . $witchBodySize . "";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-" . $witchCost . " where name='" . $zooname . "'";
		                executePlainSQL($query);
		                executePlainSQL($popQuery);
		                executePlainSQL($cashquery);
					   } else if ($animal == "Ant") {
					   	$query = "insert into purchaseanimal values ('" . $name . "','Giraffe',50,50,50,50,$antBodySize,$penID,'" . $zooname ."')";
					   	$popQuery = "update purchasepen set currentpopulation = (select currentpopulation from purchasepen where zooname = '" . $zooname . "') + " . $antBodySize . "";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-" . $antCost . " where name='" . $zooname . "'";
		                executePlainSQL($query);
		                executePlainSQL($popQuery);
		                executePlainSQL($cashquery);
					   } else if ($animal == "Giraffe") {
					   	$query = "insert into purchaseanimal values ('" . $name . "','Giraffe',50,50,50,50,$giraffeBodySize,$penID,'" . $zooname ."')";
					   	$popQuery = "update purchasepen set currentpopulation = (select currentpopulation from purchasepen where zooname = '" . $zooname . "') + " . $giraffeBodySize . "";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-" . $giraffeCost . " where name='" . $zooname . "'";
		                executePlainSQL($query);
		                executePlainSQL($popQuery);
		                executePlainSQL($cashquery);
					   } else {
					   	echo "Incorrect Choice";
					   }
            	}

            	/*CREATE TABLE PurchaseAnimal (
	name 				VARCHAR(32),
	type				VARCHAR(32),
	hydration			INTEGER,
	fullness			INTEGER,
	hygiene				INTEGER,
	happiness 			INTEGER,
	bodysize			INTEGER,
	pen_id				INTEGER NOT NULL,
	zooname				VARCHAR(32),
	PRIMARY KEY (name, zooname),
	FOREIGN KEY (pen_id,zooname) REFERENCES PurchasePen(id,zooname),
	FOREIGN KEY (zooname) REFERENCES Zoo(name) 
		ON DELETE CASCADE
);*/

            	if ($_POST && $success) {
            		header('location: zoo.php');
            		die();
            	} else {
					// Select data...
					$query = "select pen_id, currentpopulation, quality, name, type, bodysize, hydration, fullness, hygiene, happiness from purchasepen, purchaseanimal where id=pen_id and purchasepen.zooname='" . $zooname . "'";
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

			<div class="submitbox">
				<form method="POST" action="zoo.php">
					<h3><div class="centered"><input type="submit" name="addnewpen" value="Add New Pen"></div></h3>
				</form>
				<?php $totalCapacity = executePlainSQL("select sum(maxpopulation) from purchasepen where zooname='" $zooname "'"); ?>
				<p>Total Capacity = <?php echo $totalCapacity; ?></p>
			</div>

			<div class="submitbox">
				<form method="POST" action="zoo.php">
					<select id="animal" name="animal">                      
					  <option value="0">--Select Animal--</option>
					  <option value="Charizard">Charizard</option>
					  <option value="Snorlax">Snorlax</option>
					  <option value="Witch">Witch</option>
					  <option value="Ant">Ants</option>
					  <option value="Giraffe">Giraffe</option>
					</select>
					<br/>Pen # to insert into: <input type="text" name="penId">
					<br/>Name: <input type="text" name="newanimalname">
					<br/><input type="submit" name="addnewanimal" value="Add New Animal">
				</form>
			</div>

		</div>
		<script type="text/javascript" src="http://gridster.net/assets/js/libs/jquery-1.7.2.min.js"></script>
  		<script src="application.js" type="text/javascript"></script>
	</body>
</html>