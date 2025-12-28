<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Science Bus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.css" rel="stylesheet"/>

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

</head>
<body class="bg-white text-gray-800">

<!-- Navbar -->
<!-- Navbar -->
<nav class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="bg-blue-600 p-2 rounded-lg flex items-center justify-center">
                <img 
                  src="assets/image/logo/logo.png" 
                  alt="The Science Bus Logo"
                  class="w-6 h-6 object-contain"
                />
            </div>
            <div>
                <h1 class="text-xl font-semibold">The Science Bus</h1>
                <p class="text-xs text-gray-500">
                  A Mobile Science Lab for School Children
                </p>
            </div>
        </div>

        <!-- Menu -->
        <ul class="hidden md:flex items-center gap-8 font-medium">

            <li>
              <a href="index.php"
                 class="<?= $currentPage=='index.php'
                   ? 'text-blue-600 border-b-2 border-blue-600 pb-1'
                   : 'hover:text-blue-600' ?>">
                Home
              </a>
            </li>

            <li>
              <a href="#about" class="hover:text-blue-600">
                About
              </a>
            </li>

            <li>
              <a href="news.php"
                 class="<?= $currentPage=='news.php'
                   ? 'text-blue-600 border-b-2 border-blue-600 pb-1'
                   : 'hover:text-blue-600' ?>">
                News
              </a>
            </li>

            <li>
              <a href="tour-profile.php"
                 class="<?= $currentPage=='tour-profile.php'
                   ? 'text-blue-600 border-b-2 border-blue-600 pb-1'
                   : 'hover:text-blue-600' ?>">
                Tour Profile
              </a>
            </li>

            <li>
              <a href="team.php"
                 class="<?= $currentPage=='team.php'
                   ? 'text-blue-600 border-b-2 border-blue-600 pb-1'
                   : 'hover:text-blue-600' ?>">
                Team
              </a>
            </li>

            <li>
              <a href="impact.php"
                 class="<?= $currentPage=='impact.php'
                   ? 'text-blue-600 border-b-2 border-blue-600 pb-1'
                   : 'hover:text-blue-600' ?>">
                Impact
              </a>
            </li>

        </ul>
    </div>
</nav>

