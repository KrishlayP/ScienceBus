<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>The Science Bus</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flowbite -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.css" rel="stylesheet" />

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.js"></script>

</head>

<body class="bg-white text-gray-800">

<!-- ================= TOP HEADER ================= -->
<nav class="bg-white border-b sticky top-0 z-50">
  <div class="max-w-[1600px] mx-auto px-3 sm:px-4 h-14 md:h-16 flex justify-between items-center gap-3">

    <!-- Logo -->
    <div class="flex min-w-0 items-center gap-2 md:gap-3">
      <div class="bg-blue-600 p-1.5 md:p-2 rounded-lg shadow-sm shrink-0">
        <img src="assets/image/logo/logo.png" class="w-5 h-5 md:w-7 md:h-7 object-contain" />
      </div>
      <div class="leading-tight min-w-0">
        <h1 class="truncate text-base sm:text-lg md:text-xl font-bold">The Science Bus</h1>
        <p class="hidden sm:block text-[11px] text-gray-500 italic">A Mobile Science Lab</p>
        <!-- <span class="text-[10px] md:text-xs text-blue-700 font-semibold italic">
          An IITK, CSTUP & UP Govt Initiative
        </span> -->
      </div>
    </div>

    <!-- Logos -->
    <div class="flex shrink-0 items-center gap-1.5 sm:gap-2 md:gap-3">
      <img src="assets/image/logo/iit1.jpg" class="h-7 sm:h-8 md:h-10 object-contain" />
      <img src="assets/image/logo/iit2.jpg" class="h-7 sm:h-8 md:h-10 object-contain" />
      <img src="assets/image/logo/iit3.jpg" class="h-7 sm:h-8 md:h-10 object-contain" />
    </div>

  </div>
</nav>

<!-- ================= MAIN NAV ================= -->
<nav class="sticky top-14 md:top-16 z-40 bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600 shadow-md">
  <div class="max-w-[1600px] mx-auto px-3 sm:px-4 py-1.5 flex items-center justify-between">

    <!-- LEFT: Hamburger + Menu -->
    <div class="flex items-center gap-4">

      <!-- Hamburger (Mobile) -->
      <button
        data-collapse-toggle="mobile-menu"
        type="button"
        class="md:hidden text-white"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Desktop Menu -->
      <ul class="hidden md:flex gap-5 lg:gap-8 text-white font-medium">
        <?php
        $menuItems = [
          "Home" => "index.php",
          "News" => "news.php",
          "Tour Profile" => "tour-profile.php",
          "Team" => "team.php",
          "Gallery" => "gallery3.php",
          "Contact Us" => "contactUs.php",
        ];
        foreach ($menuItems as $label => $link):
          $active = ($currentPage === $link)
            ? "border-b-2 border-white pb-1"
            : "hover:opacity-80";
        ?>
          <li>
            <a href="<?= $link ?>" class="<?= $active ?> transition">
              <?= $label ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>

    </div>

    <!-- RIGHT: Login -->
    <a
      href="admin/login.php"
      class="bg-white text-blue-600 px-4 py-1.5 rounded-full text-sm font-bold hover:bg-gray-100 transition"
    >
      Login
    </a>

  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-indigo-700">
    <ul class="flex flex-col text-white divide-y divide-indigo-500 p-4">
      <?php foreach ($menuItems as $label => $link): ?>
        <li>
          <a href="<?= $link ?>" class="block py-3">
            <?= $label ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>
