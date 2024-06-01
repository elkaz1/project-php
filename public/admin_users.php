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
if (!$stmt) {
    die("Error preparing statement: " . $mysqli->error);
}
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
}
$result = $stmt->get_result();
if (!$result) {
    die("Error getting result: " . $mysqli->error);
}
$currentUser = $result->fetch_assoc();
$stmt->close();

if ($currentUser['role'] != 1) {
    echo "Access denied!";
    exit();
}

// Fetch all users from the database
$query = "SELECT * FROM users";
$result = $mysqli->query($query);
if (!$result) {
    die("Error fetching users: " . $mysqli->error);
}
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

<body>    <div class="flex flex-col w-full min-h-screen">

<header class="flex h-16 w-full shrink-0 items-center  border-b bg-gray-950 text-gray-50">
    <a class="flex items-center gap-2" href="#" rel="ugc">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
            <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
        </svg>
        <span class="sr-only">My angel predection</span>
    </a>
    <nav class="ml-6 hidden md:flex gap-6">
       
            <a class="font-medium hover:underline" href="dashboard.php" rel="ugc">Dashboard</a>
            <a class="font-medium hover:underline" href="admin_users.php" rel="ugc">Users</a>
            <a class="font-medium hover:underline" href="admin_tickets.php" rel="ugc">Tickets</a>
        
        <a class="font-medium hover:underline" href="/settings" rel="ugc">Settings</a>
    </nav>
    <div class="ml-auto flex items-center gap-4 relative">
        <button
            class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10 rounded-full"
            type="button" id="userMenuButton" aria-haspopup="menu" aria-expanded="false" data-state="closed">
            <span class="relative flex shrink-0 overflow-hidden rounded-full h-8 w-8">
                <img src="../assets/profile.png" alt="@shadcn" />
                <span class="flex h-full w-full items-center justify-center rounded-full bg-muted text-black">JP</span>
            </span>
            <span class="sr-only">Toggle user menu</span>
        </button>
        <div id="userMenu"
            class="hidden absolute top-full right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-300">
            <a href="profile.php" class="block px-4 py-2 text-black hover:bg-gray-200">Profile</a>
            <a href="/logout" class="block px-4 py-2 text-black hover:bg-gray-200">Logout</a>
        </div>
    </div>

</header>    <div class="flex flex-col min-h-screen">
        <main class="flex-1 px-6 py-8">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <span class="relative flex shrink-0 overflow-hidden rounded-full h-16 w-16">
                        <span class="flex h-full w-full items-center justify-center rounded-full bg-muted">AD</span>
                    </span>
                    <div class="grid gap-1">
                        <h1 class="text-2xl font-bold">Users</h1>
                        <p class="text-gray-500 dark:text-gray-400">Manage all users</p>
                    </div>
                </div>
                <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2">Add User</button>
            </div>
            <div class="border rounded-lg overflow-hidden">
                <div class="relative w-full overflow-auto">
                    <table class="w-full caption-bottom text-sm">
                        <thead class="[&amp;_tr]:border-b">
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">First Name</th>
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Last Name</th>
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Email</th>
                                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="[&amp;_tr:last-child]:border-0">
                            <?php while ($row = $result->fetch_assoc()) {
                                echo "<script>console.log(" . json_encode($row) . ");</script>";
                                 ?>
                                <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                    <td class="p-4 align-middle">
                                        <div class="flex items-center gap-4">
                                            <span class="relative flex shrink-0 overflow-hidden rounded-full h-10 w-10">
                                                <span class="flex h-full w-full items-center justify-center rounded-full bg-muted"><?php echo strtoupper(substr($row['firstname'], 0, 1)) . strtoupper(substr($row['lastname'], 0, 1)); ?></span>
                                            </span>
                                            <div class="grid gap-1">
                                                <p class="font-medium"><?php echo htmlspecialchars($row['firstname']); ?></p>
                                                <p class="text-gray-500 dark:text-gray-400"><?php echo "@" . htmlspecialchars(isset($row['username']) ? $row['username'] : ''); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 align-middle"><?php echo htmlspecialchars($row['lastname']); ?></td>
                                    <td class="p-4 align-middle"><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td class="p-4 align-middle">
                                        <div class="flex gap-2">
                                            <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">Edit</button>
                                            <form method="POST" action="">
                                                <input type="hidden" name="delete_user_id" value="<?php echo $row['id']; ?>">
                                                <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-red-600 text-white hover:bg-red-700 h-9 rounded-md px-3" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>
            function logout() {
                // Send an AJAX request to the logout endpoint
                fetch('/logout', {
                    method: 'POST', // Assuming your logout endpoint uses POST method
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ logout: true })
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = '/index.php';
                    } else {
                        console.error('Logout failed');
                    }
                })
                .catch(error => {
                    console.error('Error during logout:', error);
                });
            }

            // Add click event listener to the logout link
            document.querySelector('.logout-link').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior
                logout(); // Call logout function
            });
        </script>
    <script>
    const userMenuButton = document.getElementById('userMenuButton');
    const userMenu = document.getElementById('userMenu');

    userMenuButton.addEventListener('click', () => {
        const isOpen = userMenuButton.getAttribute('aria-expanded') === 'true';
        userMenuButton.setAttribute('aria-expanded', !isOpen);
        userMenuButton.setAttribute('data-state', isOpen ? 'closed' : 'open');
        userMenu.classList.toggle('hidden', isOpen);
    });
</script>
  
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
