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

<!-- ================= NAVBAR ================= -->
<nav class="bg-white border-b">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

    <!-- LEFT: 3 LOGOS -->
    <div class="flex items-center gap-3 shrink-0">
      <img src="assets/image/logo/logo1.png" class="w-7 h-7 md:w-8 md:h-8 object-contain">
      <img src="assets/image/logo/logo2.png" class="w-7 h-7 md:w-8 md:h-8 object-contain">
      <img src="assets/image/logo/logo3.png" class="w-7 h-7 md:w-8 md:h-8 object-contain">
    </div>

    <!-- CENTER: PREVIOUS LOGO + TITLE + SUBTITLE -->
    <div class="flex items-center gap-3 text-center flex-1 justify-center">

      <!-- PREVIOUS BLUE ICON -->
      <div class="bg-blue-600 p-2 rounded-lg flex items-center justify-center shrink-0">
        <img 
          src="assets/image/logo/logo.png" 
          alt="The Science Bus Logo"
          class="w-5 h-5 object-contain"
        />
      </div>

      <!-- TITLE TEXT -->
      <div class="leading-tight">
        <h1 class="text-lg md:text-xl font-semibold text-gray-800">
          The Science Bus
        </h1>
        <p class="text-[10px] md:text-xs text-gray-500">
          A Mobile Science Lab for School Children
        </p>
      </div>
    </div>

    <!-- RIGHT: MENU (UNCHANGED) -->
    <ul class="hidden md:flex items-center gap-8 font-medium shrink-0">

      <li>
        <a href="index.php"
          class="<?= $currentPage=='index.php'
            ? 'text-blue-600 border-b-2 border-blue-600 pb-1'
            : 'hover:text-blue-600' ?>">
          Home
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

    </ul>

    <!-- MOBILE HAMBURGER (RIGHT) -->
    <button
      data-collapse-toggle="mobile-menu"
      type="button"
      class="md:hidden inline-flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none shrink-0"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

  </div>

  <!-- MOBILE MENU -->
  <div id="mobile-menu" class="hidden md:hidden border-t">
    <ul class="flex flex-col gap-4 p-4 font-medium">
      <li><a href="index.php" class="hover:text-blue-600">Home</a></li>
      <li><a href="news.php" class="hover:text-blue-600">News</a></li>
      <li><a href="tour-profile.php" class="hover:text-blue-600">Tour Profile</a></li>
      <li><a href="team.php" class="hover:text-blue-600">Team</a></li>
    </ul>
  </div>
</nav>