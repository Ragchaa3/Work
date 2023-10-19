<?php
include("menu.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Барааны жагсаалт</title>
</head>
<body>
    <h1>Бараа</h1>
    <table border="1">
        <tr>
            <th>Нэр</th>
            <th>Төрөл</th>
            <th>Үнэ</th>
            <th>Тоо</th>
            <th>Огноо</th>
        </tr>

        <?php
        include("db.php");
        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Холболт амжилтгүй: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM tamle_list";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["type"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td>" . $row["data"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Бараа олдсонгүй.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
