<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InvestIQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col min-h-[100dvh]">
        <?php include 'header.php'; ?>
        <main class="flex-1">
            <section class="w-full py-6 sm:py-12 md:py-24 lg:py-32 xl:py-8">
                <div class="container px-4 md:px-6">
                    <div class="grid gap-6 lg:grid-cols-[1fr_400px] lg:gap-12 xl:grid-cols-[1fr_600px]">
                        <div class="flex flex-col justify-center space-y-4">
                            <div class="space-y-2">
                                <h1 class="text-3xl font-bold tracking-tighter sm:text-5xl xl:text-6xl/none">
                                    Welcome to InvestIQ
                                </h1>
                                <p
                                    class="max-w-[600px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                                    Experience the power of AI predictions for a variety of applications. Sign up now to
                                    get started.
                                </p>
                            </div>
                            <div class="flex flex-col gap-2 min-[400px]:flex-row">
                                <a class="inline-flex h-10 items-center justify-center rounded-md bg-gray-900 px-8 text-sm font-medium text-gray-50 shadow transition-colors hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300"
                                    href="signup.php">
                                    Get Started
                                </a>
                                <a class="inline-flex h-10 items-center justify-center rounded-md border border-gray-200 bg-white px-8 text-sm font-medium shadow-sm transition-colors hover:bg-gray-100 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-800 dark:bg-gray-950 dark:hover:bg-gray-800 dark:hover:text-gray-50 dark:focus-visible:ring-gray-300"
                                    href="/contact.php">
                                    Contact Sales
                                </a>
                            </div>
                        </div>
                        <img src="../assets/hero.jpg" width="550" height="550" alt="Hero"
                            class="mx-auto aspect-video overflow-hidden rounded-xl object-cover object-center sm:w-full lg:order-last lg:aspect-square" />
                    </div>
                </div>
            </section>
            <section class="w-full py-12 md:py-24 lg:py-32">
                <div class="container space-y-12 px-4 md:px-6">
                    <div class="flex flex-col items-center justify-center space-y-4 text-center">
                        <div class="space-y-2">
                            <h2 class="text-3xl font-bold tracking-tighter sm:text-5xl">How it works</h2>
                            <p
                                class="max-w-[900px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                                Our AI analyzes various data sources to provide accurate predictions for different use
                                cases.
                            </p>
                        </div>
                    </div>
                    <div class="mx-auto grid max-w-5xl items-center gap-6 py-12 lg:grid-cols-2 lg:gap-12">
                        <img src="../assets/1.jpg" width="550" height="310" alt="Image"
                            class="mx-auto aspect-video overflow-hidden rounded-xl object-cover object-center" />
                        <div class="flex flex-col justify-center space-y-4">
                            <ul class="grid gap-6">
                                <li>
                                    <div class="grid gap-1">
                                        <h3 class="text-xl font-bold">Accurate Predictions</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Our AI uses advanced machine learning algorithms to make accurate
                                            predictions.
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid gap-1">
                                        <h3 class="text-xl font-bold">Real-time Analysis</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Get insights and predictions in real-time.
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="grid gap-1">
                                        <h3 class="text-xl font-bold">Customized Solutions</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Build personalized solutions based on our AI's recommendations.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="w-full py-12 md:py-24 lg:py-32">
                <div class="container grid items-center gap-6 px-4 md:px-6 lg:grid-cols-2 lg:gap-10">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tighter md:text-4xl/tight">
                            Experience the workflow the best teams love.
                        </h2>
                        <p
                            class="max-w-[600px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                            Focus on delivering features instead of managing infrastructure with automated solutions.
                        </p>
                    </div>
                    <div class="flex space-x-4 lg:justify-end">
                        <a class="inline-flex h-10 items-center justify-center rounded-md bg-gray-900 px-8 text-sm font-medium text-gray-50 shadow transition-colors hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-300"
                            href="contact.php">
                            Contact Sales
                        </a>
                        <a class="inline-flex h-10 items-center justify-center rounded-md border border-gray-200 bg-white px-8 text-sm font-medium shadow-sm transition-colors hover:bg-gray-100 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-300"
                            href="signup.php">
                            Learn more
                        </a>
                    </div>
                </div>
            </section>
            <section class="w-full py-12 md:py-24 lg:py-32 border-t">
                <div class="container px-4 md:px-6">
                    <div class="grid gap-10 sm:px-10 md:gap-16 md:grid-cols-2">
                        <div class="space-y-4">
                            <div class="inline-block rounded-lg bg-gray-100 px-3 py-1 text-sm dark:bg-gray-800">
                                Enhanced Performance</div>
                            <h2
                                class="lg:leading-tighter text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl xl:text-[3.4rem] 2xl:text-[3.75rem]">
                                Seamless User Experience with Optimized Performance
                            </h2>
                            <a class="inline-flex h-9 items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-gray-50 shadow transition-colors hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300"
                                href="signup.php">
                                Get Started
                            </a>
                        </div>
                        <div class="flex flex-col items-start space-y-4">
                            <div class="inline-block rounded-lg bg-gray-100 px-3 py-1 text-sm dark:bg-gray-800">Robust
                                Security
                            </div>
                            <p class="mx-auto max-w-[700px] text-gray-500 md:text-xl/relaxed dark:text-gray-400">
                                Benefit from our secure infrastructure designed to scale dynamically, ensuring a fast
                                and reliable experience for every user. Monitor and protect every aspect of your app
                                with our comprehensive tools.
                            </p>
                            <a class="inline-flex h-9 items-center justify-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-medium shadow-sm transition-colors hover:bg-gray-100 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-800 dark:bg-gray-950 dark:hover:bg-gray-800 dark:hover:text-gray-50 dark:focus-visible:ring-gray-300"
                                href="signup.php">
                                Contact Sales
                            </a>
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