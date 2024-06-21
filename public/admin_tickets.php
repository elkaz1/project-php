<?php
include("connection.php");
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Redirect to login page if user is not logged in
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

// Fetch user information from the database
$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

// Check if user is admin
$is_admin = ($row['role'] == '1');

// Fetch ticket data from the database
$query_tickets = "SELECT * FROM contacts";
$result_tickets = $mysqli->query($query_tickets);
if (!$result_tickets) {
    die("Error fetching tickets: " . $mysqli->error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    // Retrieve the ticket ID from the form
    $ticket_id = $_POST['ticket_id'];
    
    // Update the status of the ticket
    $new_status = "resolved"; // Change this value as needed
    $query = "UPDATE contacts SET status = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("si", $new_status, $ticket_id);
    
    if ($stmt->execute()) {
        // Status updated successfully
        header("Location: admin_tickets.php");
        exit();
    } else {
        // Error updating status
        echo "Error updating status: " . $mysqli->error;
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Tickets</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<div class="flex flex-col w-full min-h-screen">
    <?php include 'navigation.php'; ?>

    <main class="flex-1 px-6 py-8">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Support Tickets</h1>
        </div>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm">
                    <thead class="[&amp;_tr]:border-b">
                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                Ticket ID
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                Customer
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                Email
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                Message
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                Status
                            </th>
                            <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="[&amp;_tr:last-child]:border-0">
                        <?php
                        while ($ticket = $result_tickets->fetch_assoc()) {
                            ?>
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">#<?php echo $ticket['id']; ?></td>
                                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?php echo $ticket['firstname'] . ' ' . $ticket['lastname']; ?></td>
                                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?php echo $ticket['email']; ?></td>
                                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?php echo $ticket['message']; ?></td>
                                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                    <div class="inline-flex w-fit items-center whitespace-nowrap rounded-full border px-2.5 py-0.5 text-xs font-semibold 
                                    <?php 
                                    if ($ticket['status'] == 'pending') {
                                        echo 'bg-yellow-300 text-yellow-800';
                                    } elseif ($ticket['status'] == 'resolved') {
                                        echo 'bg-green-300 text-green-800';
                                    } 
                                    ?>
                                    transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
                                        <?php echo $ticket['status']; ?>
                                    </div>
                                </td>
                                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                    <form method="POST" action="">
                                        <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                                        <button type="submit" name="update_status" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                                            Resolve
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </main>
</div>

</body>

</html>
