<!DOCTYPE html>
<html>
<head>
    <title>Conference Rooms</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    // Database connection details
    $servername = "pluto.hood.edu";
    $username = "bna6";
    $password = "password";
    $dbname = "bna6db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select data from the conference_room table
    $sql = "SELECT roomid, roomCapacity, roomNumber, roomLocation FROM conference_room";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Room ID</th><th>Room Capacity</th><th>Room Number</th><th>Room Location</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["roomid"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["roomCapacity"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["roomNumber"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["roomLocation"]) . "</td>";
        
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No conference room found.";
    }

    $conn->close();
    ?>
</body>
</html>