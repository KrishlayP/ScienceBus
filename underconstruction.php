<?php
// under-development.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Under Development</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 px-4">

  <div class="w-full max-w-md bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl p-8 sm:p-10 text-center text-white">

    <!-- Loader -->
    <div class="flex justify-center mb-6">
      <div class="w-14 h-14 border-4 border-white/30 border-t-white rounded-full animate-spin"></div>
    </div>

    <!-- Heading -->
    <h1 class="text-2xl sm:text-3xl font-bold mb-3">
      🚧 Website Under Development
    </h1>

    <!-- Description -->
    <p class="text-sm sm:text-base text-white/80 mb-6 leading-relaxed">
      We’re building something awesome for you.  
      Please check back again very soon.
    </p>


    <!-- Footer -->
    <div class="mt-8 text-xs text-white/60">
      © <?php echo date("Y"); ?> ScienceBus
    </div>

  </div>

</body>
</html>
