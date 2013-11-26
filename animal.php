<html>
	<head>
		<title>ULTIMATE ZOO // CS 304 - Zoo View</title>
		<meta name="description" content="Our cool zoo! Made by Sebastian Kazenbroot-Guppy, Norris Lee and Harlen Bains aka Jamaican Hopscotch Mafia">
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	<body>
		<div id="mycontainer">
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
		            // Hydration -25, Hygiene -25, Fullness +50, Happiness +50, Price 350
		            if (array_key_exists('HappyMeal', $_POST)) {
		                $itemquery = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='HappyMeal')-1 where zooname='" . $zooname ."' and name='HappyMeal'";
		                $animalquery = "update purchaseanimal set hydration=(select max(case when hydration<=0 then 0 else (select hydration-25 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), hygiene=(select max(case when hygiene<=0 then 0 else (select hygiene-25 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), fullness=(select max(case when fullness<=0 then 0 else (select fullness+50 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), happiness=(select max(case when happiness<=0 then 0 else (select happiness+50 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "') where zooname='" . $zooname . "' and name='" . $animalname . "'";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-350 where name='" . $zooname . "'";
		                executePlainSQL($itemquery);
		                executePlainSQL($animalquery);
		                executePlainSQL($cashquery);
		                OCICommit($db_conn);
		            }// Hydration +5, Hygiene -20, Fullness +75, Happiness -10, Price 200
		            if (array_key_exists('Durian', $_POST)) {
		                $itemquery = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='Durian')-1 where zooname='" . $zooname ."' and name='Durian'";
		                $animalquery = "update purchaseanimal set hydration=(select max(case when hydration<=0 then 0 else (select hydration+5 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), hygiene=(select max(case when hygiene<=0 then 0 else (select hygiene-20 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), fullness=(select max(case when fullness<=0 then 0 else (select fullness+75 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), happiness=(select max(case when happiness<=0 then 0 else (select happiness-10 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "') where zooname='" . $zooname . "' and name='" . $animalname . "'";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-200 where name='" . $zooname . "'";
		                executePlainSQL($itemquery);
		                executePlainSQL($animalquery);
		                executePlainSQL($cashquery);
		                OCICommit($db_conn);
		            }// Hydration -5, Hygiene -20, Fullness -5, Happiness +30, Price 500
		            if (array_key_exists('GameBoy', $_POST)) {
		                $itemquery = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='GameBoy')-1 where zooname='" . $zooname ."' and name='GameBoy'";
		                $animalquery = "update purchaseanimal set hydration=(select max(case when hydration<=0 then 0 else (select hydration-5 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), hygiene=(select max(case when hygiene<=0 then 0 else (select hygiene-20 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), fullness=(select max(case when fullness<=0 then 0 else (select fullness-5 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), happiness=(select max(case when happiness<=0 then 0 else (select happiness+30 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "') where zooname='" . $zooname . "' and name='" . $animalname . "'";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-500 where name='" . $zooname . "'";
		                executePlainSQL($itemquery);
		                executePlainSQL($animalquery);
		                executePlainSQL($cashquery);
		                OCICommit($db_conn);
		            }// Hydration +20, Hygiene -20, Fullness -5, Happiness +20, Price 250
		            if (array_key_exists('WhiteRussian', $_POST)) {
		                $itemquery = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='WhiteRussian')-1 where zooname='" . $zooname ."' and name='WhiteRussian'";
		                $animalquery = "update purchaseanimal set hydration=(select max(case when hydration<=0 then 0 else (select hydration-25 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), hygiene=(select max(case when hygiene<=0 then 0 else (select hygiene-25 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), fullness=(select max(case when fullness<=0 then 0 else (select fullness+50 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), happiness=(select max(case when happiness<=0 then 0 else (select happiness+50 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "') where zooname='" . $zooname . "' and name='" . $animalname . "'";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-250 where name='" . $zooname . "'";
		                executePlainSQL($itemquery);
		                executePlainSQL($aimalquery);
		                executePlainSQL($cashquery);
		                OCICommit($db_conn);
		            }// Hydration 0, Hygiene 20, Fullness 0, Happiness -10, Price 150
		            if (array_key_exists('AxeBodyspray', $_POST)) {
		                $itemquery = "update purchaseitem set amount=(select amount from purchaseitem where zooname='" . $zooname . "' and name='AxeBodyspray')-1 where zooname='" . $zooname ."' and name='AxeBodyspray'";
		                $animalquery = "update purchaseanimal set hygiene=(select max(case when hygiene<=0 then 0 else (select hygiene+20 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "'), happiness=(select max(case when happiness<=0 then 0 else (select happiness-10 from purchaseanimal where zooname='" . $zooname . "' and name='" . $animalname . "') end) from purchaseanimal where name='" . $animalname . "' and zooname='" . $zooname . "') where zooname='" . $zooname . "' and name='" . $animalname . "'";
		                $cashquery = "update zoo set cash=(select cash from zoo where name='" . $zooname . "')-150 where name='" . $zooname . "'";
		                executePlainSQL($itemquery);
		                executePlainSQL($animalquery);
		                executePlainSQL($cashquery);
		                OCICommit($db_conn);
		            }
		            
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
		</div>
		<script type="text/javascript" src="http://gridster.net/assets/js/libs/jquery-1.7.2.min.js"></script>
		<script src="application.js" type="text/javascript"></script>
	</body>
</html>