<!DOCTYPE html>
<html>
<head>
    <title>Tables Example</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px;
            float: left;
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
include_once 'db.php';

// Query for the first table
$sql1 = "SELECT * FROM user";
$result1 = $conn->query($sql1);

// Query for the second table
$sql2 = "SELECT * FROM meetingbooking";
$result2 = $conn->query($sql2);
?>

<h2>Table 1</h2>
<table>
    <tr>
        <?php
        // Get column names for the first table
        for ($i = 0; $i < $result1->columnCount(); $i++) {
            $columnMeta = $result1->getColumnMeta($i);
            echo "<th>" . $columnMeta['name'] . "</th>";
        }
        ?>
    </tr>
    <?php
    // Display data for the first table
    while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<h2>Table 2</h2>
<table>
    <tr>
        <?php
        // Get column names for the second table
        for ($i = 0; $i < $result2->columnCount(); $i++) {
            $columnMeta = $result2->getColumnMeta($i);
            echo "<th>" . $columnMeta['name'] . "</th>";
        }
        ?>
    </tr>
    <?php
    // Display data for the second table
    while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<?php
// Close connections
$conn = null;
?>

</body>
</html>