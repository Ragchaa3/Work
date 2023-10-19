<?php
    include("menu.php");
    $msg = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $type = $_POST["type"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $data = $_POST["data"];

    if (!empty($name) && !empty($type) && !empty($price) && !empty($quantity)) {
        // Include your database connection details (db.php)
        include("db.php");

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Can not connect");
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO tamle_list (name, type, price, quantity, data) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $type, $price, $quantity, $data);

        if ($stmt->execute()) {
            $msg = "Registration successful";
        } else {
            $msg = "Error: " . $stmt->error;
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
     } else {
        $msg = "Бүх талбаруудыг бөглөнө үү.";
    }
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Нэр:</label>
    <input type="name" name="name"><br><br>
    
    <label>Төрөл:</label>
    <input type="text" name="type"><br><br>
    
    <label>Үнэ:</label>
    <input type="text" name="price"><br><br>
    
    <label>Тоо:</label>
    <input type="text" name="quantity"><br><br>
    
    <label>Огноо:</label>
    <input type="date" name="data"><br><br>
    
    <input type="submit" value="Save">
    <input type="reset" value="Cancel">
</form>

<?php
if (!empty($msg)) {
    echo "<font color='red'>$msg</font>";
}
?>
