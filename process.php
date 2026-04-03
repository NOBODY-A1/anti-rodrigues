<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($message)) {
        die("Error: All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);

        $insertedId = $pdo->lastInsertId();

        // Verify by fetching the inserted data from database
        $stmt = $pdo->prepare("SELECT name, email, message FROM contacts WHERE id = ?");
        $stmt->execute([$insertedId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo "<h2>Data Successfully Stored in Database</h2>";
            echo "Name: " . htmlspecialchars($row['name']) . "<br>";
            echo "Email: " . htmlspecialchars($row['email']) . "<br>";
            echo "Message: " . htmlspecialchars($row['message']) . "<br>";
        } else {
            echo "Error: Data not found in database.";
        }
    } catch (PDOException $e) {
        die("Error saving message: " . $e->getMessage());
    }
}
?>