<html>
	<head>
		<title>ULTIMATE ZOO // CS 304 - Zoo View</title>
		<meta name="description" content="Our cool zoo! Made by Sebastian Kazenbroot-Guppy, Norris Lee and Harlen Bains aka Jamaican Hopscotch Mafia">
		<!-- <?php require ('main.css'); ?> -->
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	<body>
        <form method="POST" action="animal.php">
		<?php 
			$animalname = ($_COOKIE['animalname']!='' ? $_COOKIE['animalname'] : 'undefined');

			$zooname = ($_COOKIE['zooname']!='' ? $_COOKIE['zooname'] : 'undefined');
		 ?>

		<div class="centered"><h1> Tending to <?php echo $animalname; ?><button type="button" name="backtozoo"  id="backtozoo" class="floatRight">Back to Zoo</button></h1></div>
		<div class="clearAll"></div>


		 <?php

		$success = True; //keep track of errors so it redirects the page only if there are no errors
		$db_conn = OCILogon("ora_w8x7", "a67961045", "ug");

		require ('functions.php');

		// Connect Oracle...
		if ($db_conn) {
            // Happy Meal, Durian, GameBoy, White Russian, Axe Bodyspray
            if (array_key_exists('HappyMeal', $_POST)) {
                $query = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='HappyMeal')-1 where zooname='" . $zooname ."' and name='HappyMeal'";
                executePlainSQL($query);
                OCICommit($db_conn);
            }// Hydration -25, Hygiene -25, Fullness +50, Happiness +50
            if (array_key_exists('Durian', $_POST)) {
                $query = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='Durian')-1 where zooname='" . $zooname ."' and name='Durian'";
                executePlainSQL($query);
                OCICommit($db_conn);
            }// Hydration +5, Hygiene -20, Fullness +75, Happiness -10
            if (array_key_exists('GameBoy', $_POST)) {
                $query = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='GameBoy')-1 where zooname='" . $zooname ."' and name='GameBoy'";
                executePlainSQL($query);
                OCICommit($db_conn);
            }// Hydration -5, Hygiene -20, Fullness -5, Happiness +30
            if (array_key_exists('WhiteRussian', $_POST)) {
                $query = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='WhiteRussian')-1 where zooname='" . $zooname ."' and name='WhiteRussian'";
                executePlainSQL($query);
                OCICommit($db_conn);
            }// Hydration +20, Hygiene -20, Fullness -5, Happiness +20
            if (array_key_exists('AxeBodyspray', $_POST)) {
                $query = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='AxeBodyspray')-1 where zooname='" . $zooname ."' and name='AxeBodyspray'";
                executePlainSQL($query);
                OCICommit($db_conn);
            }// Hydration 0, Hygiene 20, Fullness 0, Happiness -10
            
            if ($_POST && $success) {
                header("location: animal.php");
                $query = "select name, type, bodysize, hydration, fullness, hygiene, happiness from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "'";
                $result = executePlainSQL($query);
                printAnimal($result);
                
                // Select data...
                $itemQuery = "select name, hydrationeffect, hygieneeffect, fullnesseffect, happinesseffect, amount, price from purchaseitem where zooname='" . $zooname . "' AND amount>0";
                $itemResult = executePlainSQL($itemQuery);
                printItems($itemResult);
            } else {
                // Select data...
                $query = "select name, type, bodysize, hydration, fullness, hygiene, happiness from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "'";
                $result = executePlainSQL($query);
                printAnimal($result);
            
                // Select data...
                $itemQuery = "select name, hydrationeffect, hygieneeffect, fullnesseffect, happinesseffect, amount, price from purchaseitem where zooname='" . $zooname . "' AND amount>0";
                $itemResult = executePlainSQL($itemQuery);
                printItems($itemResult);
            }
                
			//Commit to save changes...
			OCILogoff($db_conn);
		} else {
			echo "cannot connect";
			$e = OCI_Error(); // For OCILogon errors pass no handle
			echo htmlentities($e['message']);
		}
		?>
        </form>
		<script type="text/javascript" src="http://gridster.net/assets/js/libs/jquery-1.7.2.min.js"></script>
		<script src="application.js" type="text/javascript"></script>
	</body>
</html>