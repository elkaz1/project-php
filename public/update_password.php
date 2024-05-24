<?php
include("connection.php");
session_start();

// Ensure user is logged in
if (isset($_SESSION['valid'])) {
    $user_id = $_SESSION['id'];
    
    if (isset($_POST['password'])) {
        $new_password = $_POST['password'];

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user_id);
        $stmt->execute();
        $stmt->close();

        // Return a success message
        echo "Password updated successfully.";
    } else {
        // Return an error message if password parameter is not set
        echo "Error: Password parameter not set.";
    }
} else {
    // Return an error message if user is not logged in
    echo "Error: User not logged in.";
}
?>
