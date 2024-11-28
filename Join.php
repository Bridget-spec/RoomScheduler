<!DOCTYPE html>
<html>
<head>
    <title>Join Tables Example</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
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
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // Database connection details
    include_once 'db.php';

    // Join query
    $sql = "SELECT
                user.userid, user.username, user.userEmail, user.phoneNumber, user.userroleid,
                meetingbooking.meetingid, meetingbooking.title, meetingbooking.date, meetingbooking.description, meetingbooking.startTime, meetingbooking.endTime, meetingbooking.bookingid, meetingbooking.roomid, meetingbooking.status
            FROM
                user
            INNER JOIN
                meetingbooking ON user.userid = meetingbooking.userid";

    $result = $conn->query($sql);
    ?>

    <h2>Joined Table</h2>
    <table>
        <tr>
            <?php
            // Get column names for the joined table
            for ($i = 0; $i < $result->columnCount(); $i++) {
                $columnMeta = $result->getColumnMeta($i);
                echo "<th>" . $columnMeta['name'] . "</th>";
            }
            ?>
        </tr>
        <?php
        // Display data from the joined table
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    // Close connection
    $conn = null;
    ?>
</body>
</html>