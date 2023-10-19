<?php
    include("buyonline.php");
    $msg = ""; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];

    if (!empty($email) && !empty($firstname) && !empty($lastname) && !empty($password)) {
        // Include your database connection details (db.php)
        include("db.php");

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Can not connect");
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO table_user (email, firstname, lastname, password, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $firstname, $lastname, $password, $phone);

        if ($stmt->execute()) {
            $msg = "Registration successful";
        } else {
            $msg = "Error: " . $stmt->error;
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        $msg = "All fields are required.";
    }
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Email:</label>
    <input type="email" name="email"><br><br>
    
    <label>First Name:</label>
    <input type="text" name="firstname"><br><br>
    
    <label>Last Name:</label>
    <input type="text" name="lastname"><br><br>
    
    <label>Password:</label>
    <input type="password" name="password"><br><br>
    
    <label>Phone:</label>
    <input type="text" name="phone"><br><br>
    
    <input type="submit" value="Save">
    <input type="reset" value="Cancel">
</form>

<?php
if (!empty($msg)) {
    echo "<font color='red'>$msg</font>";
}
?>
