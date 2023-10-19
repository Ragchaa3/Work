<?php
include("buyonline.php");
$msg = ""; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!empty($email) && !empty($password)) {
        // Include your database connection details (db.php)
        include("db.php");

        // Create a database connection
        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Can not connect");
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM table_user WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $msg = "Login successful";
            // Redirect to another page after successful login
            header("Location: welcome.php");
        } else {
            $msg = "Invalid email or password";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        $msg = "Email and password are required.";
    }
}
?>
<form method='post' action='buying.php'>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Email:</label>
    <input type="email" name="email"><br><br>
    
    <label>Password:</label>
    <input type="password" name="password"><br><br>
    
    <input type="submit" value="Login">
    <input type="reset" value="Cancel">
</form>
</form>

<?php
if (!empty($msg)) {
    echo "<font color='red'>$msg</font>";
}
?>
