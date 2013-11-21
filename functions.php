<?php
function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
	//echo "<br>running ".$cmdstr."<br>";
	global $db_conn, $success;
	$statement = OCIParse($db_conn, $cmdstr); //There is a set of comments at the end of the file that describe some of the OCI specific functions and how they work

	if (!$statement) {
		echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
		$e = OCI_Error($db_conn); // For OCIParse errors pass the       
		// connection handle
		echo htmlentities($e['message']);
		$success = False;
	}

	$r = OCIExecute($statement, OCI_DEFAULT);
	if (!$r) {
		echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
		$e = oci_error($statement); // For OCIExecute errors pass the statementhandle
		echo htmlentities($e['message']);
		$success = False;
	} else {

	}
	return $statement;

}

function executeBoundSQL($cmdstr, $list) {
	/* Sometimes a same statement will be excuted for severl times, only
	 the value of variables need to be changed.
	 In this case you don't need to create the statement several times; 
	 using bind variables can make the statement be shared and just 
	 parsed once. This is also very useful in protecting against SQL injection. See example code below for how this functions is used */

	global $db_conn, $success;
	$statement = OCIParse($db_conn, $cmdstr);

	if (!$statement) {
		echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
		$e = OCI_Error($db_conn);
		echo htmlentities($e['message']);
		$success = False;
	}

	foreach ($list as $tuple) {
		foreach ($tuple as $bind => $val) {
			//echo $val;
			//echo "<br>".$bind."<br>";
			OCIBindByName($statement, $bind, $val);
			unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype

		}
		$r = OCIExecute($statement, OCI_DEFAULT);
		if (!$r) {
			echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($statement); // For OCIExecute errors pass the statementhandle
			echo htmlentities($e['message']);
			echo "<br>";
			$success = False;
		}
	}

}

function printResult($result) { //prints results from a select statement
	echo "<br>Got data from table tab1:<br>";
	echo "<table>";
	echo "<tr><th>ID</th><th>Name</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; // or just use "echo $row[0]" 
	}
	echo "</table>";

}

function printZooTable($result) { //prints results from a select statement
	echo "<br>Got data from table tab1:<br>";
	echo "<table>";
	echo "<tr><th>ID</th><th>Name</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["NID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; // or just use "echo $row[0]" 
	}
	echo "</table>";

}

function printAnimalsWithButtons($result) { //prints results from a select statement
	echo "<table>";
	echo "<tr><th>Pen #</th><th>Animal Name</th><th>Type</th><th>Hydration</th><th>Fullness</th><th>Hygiene</th><th>Happiness</th><th>Body Size</th><th>Pen Quality</th><th>Max Pen Capacity</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td>" . $row["PEN_ID"] . "</td><td>" . $row["NAME"] . "</td><td>" . $row["TYPE"] . "</td><td>" . $row["HYDRATION"] . "</td><td>" . $row["FULLNESS"] . "</td><td>" . $row["HYGIENE"] . "</td><td>" . $row["HAPPINESS"] . "</td><td>" . $row["BODYSIZE"] . "</td><td>" . $row["QUALITY"] . "</td><td>" . $row["MAXPOPULATION"] . "</td></tr>"; //or just use "echo $row[0]" 
	}
	echo "</table>";
}

function printAllZoos($result) { //prints results from a select statement
	echo "<table>";
	echo "<tr><th></th><th>Zoo Name</th><th>Owner Name</th><th>Cash</th></tr>";

	while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
		echo "<tr><td> <button type='button' name='" . $row["NAME"] . "'>Log On</button>" . "</td><td>" . $row["NAME"] . "</td><td>" . $row["OWNERNAME"] . "</td><td>" . $row["CASH"] . "</td></tr>";
	}
}
?>