<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - InvestIQ</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col min-h-[100dvh]">
        <?php include 'header.php'; ?>

        <main class="flex-1 flex items-center justify-center">
            <section class="py-6 md:py-12 lg:py-16 xl:py-20">
                <div class="container mx-auto px-4 md:px-6">
                    <div class="text-center">
                        <div class="space-y-3">
                            <h1 class="text-3xl font-bold tracking-tighter sm:text-5xl md:text-6xl lg:text-7xl/none">
                                About Us
                            </h1>
                            <p class="max-w-[700px] mx-auto text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                                At InvestIQ, we are driven by a passion for innovation and a commitment to excellence. Our mission is to empower our clients with cutting-edge solutions that drive success. Through collaboration, creativity, and a steadfast dedication to quality, we build long-term relationships grounded in trust and integrity.
                            </p>
                        </div>
                    </div>
                    <div class="grid gap-6 lg:grid-cols-3 lg:gap-10 mt-12">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-full overflow-hidden">
                                    <img src="../assets/hero.jpg" alt="Elkamel Zakaria" width="64" height="64"
                                        class="rounded-full object-cover object-center"
                                        style="aspect-ratio: 64 / 64; object-fit: cover;" />
                                </div>
                                <div class="space-y-1 text-center">
                                    <h3 class="text-lg font-semibold">Elkamel Zakaria</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">CEO & Founder</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-center space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-full overflow-hidden">
                                    <img src="../assets/hero.jpg" alt="Elabiad Ayman" width="64" height="64"
                                        class="rounded-full object-cover object-center"
                                        style="aspect-ratio: 64 / 64; object-fit: cover;" />
                                </div>
                                <div class="space-y-1 text-center">
                                    <h3 class="text-lg font-semibold">Elabiad Ayman</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Marketing & Founder</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-center space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-full overflow-hidden">
                                    <img src="../assets/hero.jpg" alt="Elhabchi Marwan" width="64" height="64"
                                        class="rounded-full object-cover object-center"
                                        style="aspect-ratio: 64 / 64; object-fit: cover;" />
                                </div>
                                <div class="space-y-1 text-center">
                                    <h3 class="text-lg font-semibold">Elhabchi Marwan</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">IT Specialist</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="flex flex-col gap-2 sm:flex-row py-6 w-full shrink-0 items-center px-4 md:px-6 border-t">
            <p class="text-xs text-gray-500 dark:text-gray-400">© 2024 InvestIQ. All rights reserved.</p>
            <nav class="sm:ml-auto flex gap-4 sm:gap-6">
                <a class="text-xs hover:underline underline-offset-4" href="#">
                    Terms of Service
                </a>
                <a class="text-xs hover:underline underline-offset-4" href="#">
                    Privacy
                </a>
            </nav>
        </footer>
    </div>
    
</body>

</html>
