<?php

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        die("Please fill in all fields.");
    }

    $stmt = $conn->prepare("SELECT password FROM patientacc WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            echo "Login successful!";
            
            session_start();
            $_SESSION['username'] = $username;
            
           
            header("Location: home.php");
            exit();
        } else {
            header("Location: home.php");
            exit();
        }
    } else {
        echo "Invalid user or password.";
    }

    $stmt->close();
    $conn->close();
}
?>