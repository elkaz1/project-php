<?php
include("connection.php");
session_start();

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

// Function to update password
function updatePassword($mysqli, $user_id, $new_password)
{
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("si", $hashed_password, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete account
function deleteAccount($mysqli, $user_id)
{
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    // Redirect to logout page after account deletion
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        $new_password = $_POST['password'];
        updatePassword($mysqli, $user_id, $new_password);
        echo "<script>alert('Password updated successfully.');</script>";
    } elseif (isset($_POST['delete']) && !$is_admin) {
        deleteAccount($mysqli, $user_id);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
<div class="flex flex-col w-full min-h-screen">
        <?php include 'navigation.php'; ?>
    <div class="flex h-screen w-full items-center justify-center px-4 dark:bg-gray-950">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md" data-v0-t="card">
            <div class="flex flex-col p-6 space-y-1 text-center">
                <h3 class="whitespace-nowrap tracking-tight text-2xl font-bold">User Profile</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">View and update your information.</p>
            </div>
            <div class="p-6 space-y-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="firstname">First Name</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="firstname" name="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>" readonly />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="lastname">Last Name</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="lastname" name="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>" readonly />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">Email</label>
                    <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" readonly />
                </div>
                <form method="POST" action="">
                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="password">New Password</label>
                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="password" name="password" type="password" />
                    </div>
                    <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-black text-white hover:bg-primary/90 h-10 px-4 py-2 w-full" type="submit">
                        Update Password
                    </button>
                </form>
                <?php if (!$is_admin) { ?>
                    <form method="POST" action="">
                        <input type="hidden" name="delete" value="1" />
                        <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-red-500 text-white hover:bg-red-600 h-10 px-4 py-2 w-full" type="submit">
                            Delete Account
                        </button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
