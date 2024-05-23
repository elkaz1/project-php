<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <!--
// v0 by Vercel.
// https://v0.dev/t/44nSqeXSNOE
-->

<div class="w-full">
  <section class="py-6 md:py-12 lg:py-16 xl:py-20">
    <div class="container px-4 md:px-6">
      <div class="grid gap-6 lg:grid-cols-12 lg:gap-10">
        <div class="space-y-3 lg:col-span-7 xl:col-span-8">
          <h1 class="text-3xl font-bold tracking-tighter sm:text-5xl md:text-6xl lg:text-7xl/none">About Us</h1>
          <p class="max-w-[700px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
            We are a team of passionate experts dedicated to providing innovative solutions for our clients. Our
            mission is to deliver excellence through collaboration, creativity, and commitment. We believe in
            building long-term relationships based on trust, integrity, and value.
          </p>
        </div>
        <div class="grid w-full grid-cols-1 gap-6 lg:col-span-5 lg:grid-cols-2 lg:gap-10">
          <div class="flex items-center space-x-4">
            <div class="w-16 h-16 rounded-full overflow-hidden">
              <img
                src="/placeholder.svg"
                alt="Team member"
                width="64"
                height="64"
                class="rounded-full object-cover object-center"
                style="aspect-ratio: 64 / 64; object-fit: cover;"
              />
            </div>
            <div class="space-y-1">
              <h3 class="text-lg font-semibold">Alice Johnson</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">CEO &amp; Founder</p>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <div class="w-16 h-16 rounded-full overflow-hidden">
              <img
                src="/placeholder.svg"
                alt="Team member"
                width="64"
                height="64"
                class="rounded-full object-cover object-center"
                style="aspect-ratio: 64 / 64; object-fit: cover;"
              />
            </div>
            <div class="space-y-1">
              <h3 class="text-lg font-semibold">Mark Thompson</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Head of Innovation</p>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <div class="w-16 h-16 rounded-full overflow-hidden">
              <img
                src="/placeholder.svg"
                alt="Team member"
                width="64"
                height="64"
                class="rounded-full object-cover object-center"
                style="aspect-ratio: 64 / 64; object-fit: cover;"
              />
            </div>
            <div class="space-y-1">
              <h3 class="text-lg font-semibold">Sophia Lee</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Marketing Manager</p>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <div class="w-16 h-16 rounded-full overflow-hidden">
              <img
                src="/placeholder.svg"
                alt="Team member"
                width="64"
                height="64"
                class="rounded-full object-cover object-center"
                style="aspect-ratio: 64 / 64; object-fit: cover;"
              />
            </div>
            <div class="space-y-1">
              <h3 class="text-lg font-semibold">David Miller</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Financial Analyst</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="border-t">
    <div class="container px-4 md:px-6">
      <div class="grid gap-6 lg:grid-cols-12 lg:gap-10">
        <div class="space-y-3 lg:col-span-7 xl:col-span-8">
          <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl">Achievements</h2>
          <ul class="grid gap-2 list-disc text-gray-500 md:grid-cols-2 dark:text-gray-400">
            <li>Increased customer satisfaction by 30%.</li>
            <li>Launched award-winning mobile app.</li>
            <li>Named Top 100 Innovators by Tech Magazine.</li>
            <li>Expanded operations to 5 new countries.</li>
          </ul>
        </div>
        <div class="space-y-3 lg:col-span-5 lg:space-y-4">
          <form class="grid gap-4">
            <div class="grid gap-2">
              <label
                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="name"
              >
                Name
              </label>
              <input
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                id="name"
                required=""
                placeholder="Enter your name"
              />
            </div>
            <div class="grid gap-2">
              <label
                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="email"
              >
                Email
              </label>
              <input
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                id="email"
                required=""
                placeholder="Enter your email"
                type="email"
              />
            </div>
            <div class="grid gap-2">
              <label
                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                for="message"
              >
                Your Message
              </label>
              <textarea
                class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-[100px] resize-none"
                id="message"
                required=""
                placeholder="Enter your message"
              ></textarea>
            </div>
            <button
              class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2"
              type="submit"
            >
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>