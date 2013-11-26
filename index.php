<html>
	<head>
		<title>ULTIMATE ZOO // CS 304 - Zoo View</title>
		<meta name="description" content="Our cool zoo! Made by Sebastian Kazenbroot-Guppy, Norris Lee and Harlen Bains aka Jamaican Hopscotch Mafia">
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	<body> 
		<div id="mycontainer">
			<div class="centered"><h1>ZOO</h1></div>
            <div class="informativeviews">
            <br/>
                <form method="POST" action="index.php">
                    <h3><div class="centered">Find zoos with:<br/><br/>
                    <input type="submit" value="All Pokemon" name="findallpokemon">
                    <input type="submit" value="All Animals" name="findallanimals">
                    <input type="submit" value="Everything" name="findeverything">
                    <div class="clearFloat"></div>
                    </div></h3>
                </form>
            </div>

			<?php
				$success = True; //keep track of errors so it redirects the page only if there are no errors
				$db_conn = OCILogon("ora_w8x7", "a67961045", "ug");

				require ('functions.php');

				if (array_key_exists('createnewzoo', $_POST)) {
	                // Update tuple using data from user
					$tuple = array (
						":bind1" => $_POST['newzoo'],
						":bind2" => $_POST['newowner']
					);
					$alltuples = array (
						$tuple
					);
					executeBoundSQL("insert into zoo values (:bind1,$defaultcash,:bind2)", $alltuples);     
					OCICommit($db_conn);
            	} else if (array_key_exists('delButton', $_POST)) {
            		$name = $_POST['delzooname'];
	                $query = "delete from zoo where name='" . $name . "'";
	                $result = executePlainSQL($query);
	                OCICommit($db_conn);
            	} else if (array_key_exists('findallpokemon', $_POST)) {
                    executePlainSQL("drop view zooNames");
                    executePlainSQL("drop view animals");
                    executePlainSQL("drop view notZoos");
                    executePlainSQL("create view zooNames as select name from zoo");
                    executePlainSQL("create view animals as select distinct type from purchaseanimal where type='Charizard' or type='Snorlax'");
                    executePlainSQL("create view notZoos as select distinct name from (select * from zooNames, animals minus select zooname, type from purchaseanimal)");
                    $result = executePlainSQL("select * from zooNames minus select * from notZoos");
                    printNestedAggregationTable($result);
                } else if (array_key_exists('findallanimals', $_POST)) {
                    executePlainSQL("drop view zooNames");
                    executePlainSQL("drop view animals");
                    executePlainSQL("drop view notZoos");
                    executePlainSQL("create view zooNames as select name from zoo");
                    executePlainSQL("create view animals as select distinct type from purchaseanimal where type='Ant' or type='Giraffe'");
                    executePlainSQL("create view notZoos as select distinct name from (select * from zooNames, animals minus select zooname, type from purchaseanimal)");
                    $result = executePlainSQL("select * from zooNames minus select * from notZoos");
                    printNestedAggregationTable($result);
                } else if (array_key_exists('findeverything', $_POST)) {
                    executePlainSQL("drop view zooNames");
                    executePlainSQL("drop view animals");
                    executePlainSQL("drop view notZoos");
                    executePlainSQL("create view zooNames as select name from zoo");
                    executePlainSQL("create view animals as select distinct type from purchaseanimal where type='Charizard' or type='Snorlax' or type='Ant' or type='Giraffe' or type='Witch'");
                    executePlainSQL("create view notZoos as select distinct name from (select * from zooNames, animals minus select zooname, type from purchaseanimal)");
                    $result = executePlainSQL("select * from zooNames minus select * from notZoos");
                    printNestedAggregationTable($result);
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
			<div class="submitbox">
				<form method="POST" action="index.php">
					<h3><div class="floatLeft">Create New Zoo</div> <div class="floatRight">Zoo Name: <input type="text" name="newzoo"> Owner Name <input type="text" name="newowner"> <input type="submit" name="createnewzoo"></div></h3>
					<div class="clearFloat"></div>
				</form>
			</div>
        </div>

		<script type="text/javascript" src="http://gridster.net/assets/js/libs/jquery-1.7.2.min.js"></script>
		<script src="application.js" type="text/javascript"></script>
	</body>
</html>