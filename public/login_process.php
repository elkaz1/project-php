<?php
include("connection.php");
session_start(); // Start the session

if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

    if(empty($email) || empty($pass)) {
        echo "Either email or password field is empty.";
        echo "<br/>";
        header("Location: login.php");

    } else {
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row && password_verify($pass, $row['password'])) {
            $_SESSION['valid'] = $row['email'];
            $_SESSION['name'] = $row['firstname'];
            $_SESSION['id'] = $row['id'];

            // Check if user is admin or client
            if ($row['role'] == '1') {
                // Redirect admin to dashboard
                header('Location: dashboard.php');
            } else {
                // Redirect client to stocks
                header('Location: dash.php');
            }
            exit();
        } else {
            echo "Invalid email or password.";
            echo "<br/>";
            header("Location: login.php");
        }
        $stmt->close();
    }
} else {}
?>