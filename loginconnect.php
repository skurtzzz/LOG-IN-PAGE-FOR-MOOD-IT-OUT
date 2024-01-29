<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // TODO: Validate and sanitize input (e.g., using filter_input)

    // Your database connection details
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "diary";

    // Create a PDO connection
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // TODO: Perform login authentication using the provided $username and $password
        // Example query (replace with your actual table and column names)
        $query = "SELECT * FROM users WHERE Username = :username AND PASSWORD = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Login successful
            header("Location: http://localhost/WEBSITE/home.html#");
            exit();
        } else {
            // Login failed
            echo '<script>alert("Incorrect username or password.");</script>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $conn = null;
    }
} else {
    // Handle invalid request method
    echo "Invalid request method!";
}
?>
