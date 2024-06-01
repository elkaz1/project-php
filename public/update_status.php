<?php
include("connection.php");
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    // Retrieve the ticket ID from the form
    $ticket_id = $_POST['ticket_id'];
    
    // Perform validation and sanitization if needed

    // Update the status of the ticket
    $new_status = "Resolved"; // Change this value as needed
    $query = "UPDATE contacts SET status = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("si", $new_status, $ticket_id);
    
    if ($stmt->execute()) {
        // Status updated successfully
        // You can redirect the user back to the previous page or display a success message
        header("Location: admin_tickets.php");
        exit();
    } else {
        // Error updating status
        // You can redirect the user back to the previous page or display an error message
        echo "Error updating status: " . $mysqli->error;
    }
    
    $stmt->close();
}

// If the form was not submitted properly, redirect the user
header("Location: admin_tickets.php");
exit();
?>
