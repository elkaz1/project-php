<?php
include("connection.php");
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

// Check if the logged-in user is an admin
$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$currentUser = $result->fetch_assoc();
$stmt->close();

if ($currentUser['role'] != 1) {
    echo "Access denied!";
    exit();
}

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $delete_user_id = $_POST['delete_user_id'];
    if ($delete_user_id != $user_id) { // Admin cannot delete their own account
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $delete_user_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all users from the database
$query = "SELECT * FROM users";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="flex flex-col gap-8 p-6 md:p-10">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <span class="relative flex shrink-0 overflow-hidden rounded-full h-16 w-16">
                    <span class="flex h-full w-full items-center justify-center rounded-full bg-muted">AD</span>
                </span>
                <div class="grid gap-1">
                    <h1 class="text-2xl font-bold">Users</h1>
                    <p class="text-gray-500 dark:text-gray-400">Manage all users</p>
                </div>
            </div>
            <button
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2">
                Add User
            </button>
        </div>
        <div class="grid gap-6">
            <div class="border rounded-lg overflow-hidden">
                <div class="relative w-full overflow-auto">
                    <table class="w-full caption-bottom text-sm">
                        <thead class="[&amp;_tr]:border-b">
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">First
                                    Name</th>
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Last Name
                                </th>
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Email
                                </th>
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="[&amp;_tr:last-child]:border-0">
                            <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                <td class="p-4 align-middle">
                                    <div class="flex items-center gap-4">
                                        <span class="relative flex shrink-0 overflow-hidden rounded-full h-10 w-10">
                                            <span
                                                class="flex h-full w-full items-center justify-center rounded-full bg-muted">
                                                <?php echo strtoupper(substr($row['firstname'], 0, 1)) . strtoupper(substr($row['lastname'], 0, 1)); ?>
                                            </span>
                                        </span>
                                        <div class="grid gap-1">
                                            <p class="font-medium"><?php echo htmlspecialchars($row['firstname'] ); ?>
                                            </p>
                                            <p class="text-gray-500 dark:text-gray-400">
                                                <?php echo "@" . htmlspecialchars(isset($row['username']) ? $row['username'] : ''); ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 align-middle"><?php echo htmlspecialchars($row['lastname']); ?></td>
                                <td class="p-4 align-middle"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="p-4 align-middle">
                                    <div class="flex gap-2">
                                        <button
                                            class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                                            Edit
                                        </button>
                                        <form method="POST" action="">
                                            <input type="hidden" name="delete_user_id" value="<?php echo $row['id']; ?>">
                                            <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-red-600 text-white hover:bg-red-700 h-9 rounded-md px-3" type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>