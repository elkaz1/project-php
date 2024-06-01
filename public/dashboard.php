<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - My Angel Prediction</title>
</head>

<body>
<div class="flex flex-col min-h-[100dvh]">
        <?php include 'navigation.php'; ?>

        <div class="flex-1 flex flex-col">
            <main class="flex min-h-[calc(100vh-_theme(spacing.16))] flex-1 flex-col gap-4 p-4 md:gap-8 md:p-10">
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <?php
                    // Connect to your database and fetch necessary data
                    include("connection.php");

                    // Fetch total users count
                    $query = "SELECT COUNT(*) as total_users FROM users";
                    $result = $mysqli->query($query);
                    $total_users = $result->fetch_assoc()['total_users'];

                    // Fetch total open cases count
                    $query = "SELECT COUNT(*) as total_open_cases FROM contacts WHERE status = 'pending'";
                    $result = $mysqli->query($query);
                    $total_open_cases = $result->fetch_assoc()['total_open_cases'];

                    // Fetch total closed cases count
                    $query = "SELECT COUNT(*) as total_closed_cases FROM contacts WHERE status = 'resolved'";
                    $result = $mysqli->query($query);
                    $total_closed_cases = $result->fetch_assoc()['total_closed_cases'];

                    // Close database connection
                    $mysqli->close();
                    ?>
                    
                    <!-- Total Users Card -->
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                        <div class="space-y-1.5 p-6 flex flex-row items-center justify-between pb-2">
                            <h3 class="whitespace-nowrap tracking-tight text-sm font-medium">Total Users</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-4 h-4 text-gray-500 dark:text-gray-400">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div class="p-6">
                            <div class="text-2xl font-bold"><?php echo $total_users; ?></div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total users in the system</p>
                        </div>
                    </div>
                    
                    <!-- Open Cases Card -->
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                        <div class="space-y-1.5 p-6 flex flex-row items-center justify-between pb-2">
                            <h3 class="whitespace-nowrap tracking-tight text-sm font-medium">Open Cases</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-4 h-4 text-gray-500 dark:text-gray-400">
                                <path
                                    d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                </path>
                                <path d="M13 5v2"></path>
                                <path d="M13 17v2"></path>
                                <path d="M13 11v2"></path>
                            </svg>
                        </div>
                        <div class="p-6">
                            <div class="text-2xl font-bold"><?php echo $total_open_cases; ?></div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total open cases</p>
                        </div>
                    </div>
                    
                    <!-- Closed Cases Card -->
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                        <div class="space-y-1.5 p-6 flex flex-row items-center justify-between pb-2">
                            <h3 class="whitespace-nowrap tracking-tight text-sm font-medium">Closed Cases</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-4 h-4 text-gray-500 dark:text-gray-400">
                                <path
                                    d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                                </path>
                                <path d="M13 5v2"></path>
                                <path d="M13 17v2"></path>
                                <path d="M13 11v2"></path>
                            </svg>
                        </div>
                        <div class="p-6">
                            <div class="text-2xl font-bold"><?php echo $total_closed_cases; ?></div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total closed cases</p>
                        </div>
                    </div>
                </div>
                
                <!-- Ticket Table -->
                <!-- Ticket Table -->
                <div>
                    <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                        <div class="relative w-full overflow-auto">
                            <table class="w-full caption-bottom text-sm">
                                <thead class="[&amp;_tr]:border-b">
                                    <tr
                                        class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 w-[100px]">
                                            Case ID
                                        </th>
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                            Status
                                        </th>
                                        <th
                                            class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0">
                                            Assigned To
                                        </th>
                                        <th
                                            class="h-12 px-4 align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 text-right">
                                            Created
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="[&amp;_tr:last-child]:border-0">
                                    <?php
                                    // Connect to your database
                                    include("connection.php");

                                    // Fetch contacts data
                                    $query = "SELECT * FROM contacts";
                                    $result = $mysqli->query($query);

                                    // Loop through each ticket and display it in the table
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr class='border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted'>";
                                        echo "<td class='p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium'>{$row['id']}</td>";
                                        echo "<td class='p-4 align-middle [&amp;:has([role=checkbox])]:pr-0'>{$row['status']}</td>";
                                        echo "<td class='p-4 align-middle [&amp;:has([role=checkbox])]:pr-0'>{$row['firstname']}</td>";
                                        echo "<td class='p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 text-right'>{$row['created_at']}</td>";
                                        echo "</tr>";
                                    }

                                    // Close database connection
                                    $mysqli->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
