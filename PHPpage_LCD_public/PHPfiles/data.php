<?php
	// Current date and time.
	$curdate = date('m/d/Y');
	$curtime = date('H:i:s');
	
	// Get values.
	$key = $_GET['key'];
	
// If all three values are present, insert it into the MySQL database.
		if(isset($key)){
			// Database credentials
			$servername = "";
			$username = "";
			$dbname = "";
			$password = "";

			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			// Insert values into table.
			$sql = "INSERT INTO data (date, time, keys)
			VALUES ('$curdate', '$curtime', $key)";

			if (mysqli_query($conn, $sql)) {
				echo "OK";
			} else {
				echo "Fail: " . $sql . "<br>" . mysqli_error($conn);
			}
			
			// Close connection.
			mysqli_close($conn);
		}

?>
