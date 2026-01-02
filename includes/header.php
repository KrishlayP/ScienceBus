<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>The Science Bus</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flowbite -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.css"
    rel="stylesheet"
  />

  <!-- Swiper -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
  />
</head>

<body class="bg-white text-gray-800">

<!-- ===================== TOP HEADER ===================== -->
<nav class="bg-white border-b">
  <div class="max-w-7xl mx-auto px-6 py-4 grid grid-cols-3 items-center">

    <!-- LEFT LOGO -->
    <div class="flex justify-start">
      <img
        src="assets/image/logo/iit1.jpg"
        alt="Left Logo"
        class="h-16 md:h-20 object-contain"
      />
    </div>

    <!-- CENTER TITLE -->
    <div class="flex items-center justify-center gap-3 text-center">
      <div class="bg-blue-600 p-2 rounded-lg">
        <img
          src="assets/image/logo/logo.png"
          alt="The Science Bus Logo"
          class="w-6 h-6 object-contain"
        />
      </div>

      <div class="leading-tight">
        <h1 class="text-xl md:text-4xl font-semibold text-gray-800">
          The Science Bus
        </h1>
        <p class="text-xs md:text-sm text-gray-500">
          A Mobile Science Lab for School Children
        </p>
      </div>
    </div>

    <!-- RIGHT LOGOS -->
    <div class="flex justify-end gap-4">
      <img
        src="assets/image/logo/iit2.jpg"
        alt="Right Logo 1"
        class="h-16 md:h-20 object-contain"
      />
      <img
        src="assets/image/logo/iit3.jpg"
        alt="Right Logo 2"
        class="h-16 md:h-20 object-contain"
      />
    </div>

  </div>
</nav>

<!-- ===================== NAV MENU ===================== -->
<nav class="bg-white border-b">
  <div class="max-w-7xl mx-auto px-9 py-4 flex items-center justify-between">

    <!-- DESKTOP MENU -->
    <ul class="hidden md:flex items-center gap-12 font-medium">

      <?php
      $menuItems = [
        "Home" => "index.php",
        "News" => "news.php",
        "Tour Profile" => "tour-profile.php",
        "Team" => "team.php",
        "contactUs" => "contactUs.php",
      ];

      foreach ($menuItems as $label => $link):
        $activeClass = $currentPage === $link
          ? "text-blue-600 border-b-2 border-blue-600 pb-1"
          : "hover:text-blue-600";
      ?>
        <li>
          <a href="<?= $link ?>" class="<?= $activeClass ?>">
            <?= $label ?>
          </a>
        </li>
        

      <?php endforeach; ?>

    </ul>

    <!-- EMPTY LOGO SPACE (UNCHANGED) -->
    <div class="flex items-center gap-3 shrink-0">
  <a
    href="login.php"
    class="inline-flex items-center gap-2 px-5 py-2 rounded-full
           bg-blue-600 text-white text-sm font-medium
           transition-all duration-300
           hover:bg-blue-700 hover:shadow-lg
           focus:outline-none focus:ring-2 focus:ring-blue-400"
  >
    <!-- Icon -->
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="w-4 h-4"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      stroke-width="2"
    >
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5m0 0l-5-5m5 5H3" />
    </svg>

    Login
  </a>
</div>


    <!-- MOBILE TOGGLE -->
    <button
      data-collapse-toggle="mobile-menu"
      type="button"
      class="md:hidden inline-flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none"
    >
      <svg
        class="w-6 h-6"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24"
      >
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

  </div>

  <!-- MOBILE MENU -->
  <div id="mobile-menu" class="hidden md:hidden border-t">
    <ul class="flex flex-col gap-4 p-4 font-medium">
      <?php foreach ($menuItems as $label => $link): ?>
        <li>
          <a href="<?= $link ?>" class="hover:text-blue-600">
            <?= $label ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>

</body>
</html>
