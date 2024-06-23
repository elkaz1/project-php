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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<header class="flex h-16 w-full shrink-0 items-center  border-b bg-gray-950 text-gray-50">
    <a class="flex items-center gap-2" href="index.php" rel="ugc">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
            <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
        </svg>
        <span class="sr-only">My angel predection</span>
    </a>
    <nav class="ml-6 hidden md:flex gap-6">
        <?php if ($is_admin) { ?>
            <a class="font-medium hover:underline" href="dashboard.php" rel="ugc">Dashboard</a>
            <a class="font-medium hover:underline" href="admin_users.php" rel="ugc">Users</a>
            <a class="font-medium hover:underline" href="admin_tickets.php" rel="ugc">Tickets</a>
        <?php } else { ?>
            <a class="font-medium hover:underline" href="prediction.php" rel="ugc">Stocks Predicts</a>
            <button data-modal-target="watchlist-modal" data-modal-toggle="watchlist-modal">
                    <a class="font-medium hover:underline" rel="ugc">
                        Watchlist
                    </a>
            </button>
            <button data-modal-target="settings-modal" data-modal-toggle="settings-modal">
                    <a class="font-medium hover:underline" rel="ugc">
                        Settings
                    </a>
                </button>
                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal">
                    <a class="font-medium hover:underline" rel="ugc">
                        Search
                    </a>
                </button>
        <?php } ?>
        <a class="font-medium hover:underline" href="dash.php" rel="ugc">Stocks</a>
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
            class="hidden absolute top-full right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-300 z-10">
            <a href="profile.php" class="block px-4 py-2 text-black hover:bg-gray-200">Profile</a>
            <a href="/logout" class="block px-4 py-2 text-black hover:bg-gray-200">Logout</a>
        </div>
    </div>

</header>
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
                        // If logout is successful, redirect to the login page
                        window.location.href = '/index.php';
                    } else {
                        // If logout fails, display an error message
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
