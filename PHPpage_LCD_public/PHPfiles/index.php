<html>
	<head>
		<title>ESP8266 Live Demo</title>
		<style>
		html, body{
			background-color: #F2F2F2;
			font-family: Arial;
			font-size: 1em;
		}
		table{
			border-spacing: 0;
			border-collapse: collapse;
			margin: 0 auto;
		}
		th{
			padding: 8px;
			background-color: #FF837A;
			border: 1px solid #FF837A;
		}
		td{
			padding: 10px;
			background-color: #FFF;
			border: 1px solid #CCC;
		}
		</style>
	</head>
	<body>
		<?php	
			// Database credentials.
			$servername = "";
			$username = "";
			$dbname = "";
			$password = "";

			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Get number of entries in the database.
			if ($result = mysqli_query($conn, "SELECT date FROM data")) {

				// Count number of rows on table.
				$row_cnt = mysqli_num_rows($result);

				// Print result.
				printf("The database has %d entries.", $row_cnt);
			}	
			// Get the most recent 25 entries.
			$result = mysqli_query($conn, "SELECT date, time, keystroke FROM data ORDER BY date DESC, time DESC  LIMIT 25");
			echo "<table><tr><th>Date</th><th>Time</th><th>Keystrokes</th></tr>";
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr><td>";
				echo $row["date"];
				echo "</td><td>";
				echo $row["time"];
				echo "</td><td>";
				echo $row["keystroke"];
				echo "</td>";
			}
			echo "</tr></table>";

			// Close connection.
			mysqli_close($conn);
		?>
	</body>
</html>
