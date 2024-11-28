<!DOCTYPE html>
<html>
<head>
    <title>Equipment Table</title>
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

    // SQL query to select data from the equipment table
    $sql = "SELECT equipmentid, description FROM equipment";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Equipment ID</th><th>Description</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row["equipmentid"]) . "</td><td>" . htmlspecialchars($row["description"]) . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No data found in the equipment table.";
    }

    $conn->close();
    ?>
</body>
</html>