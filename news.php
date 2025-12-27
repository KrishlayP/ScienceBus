<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>The Science Bus – News & Updates</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flowbite -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-slate-50 text-gray-800">

<!-- ================= HEADER ================= -->
<header class="bg-white border-b border-slate-200">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

    <a href="#" class="text-blue-600 text-sm font-medium hover:underline">
      ← Back to Home
    </a>

    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white">
        🚌
      </div>
      <div>
        <h1 class="font-semibold">The Science Bus – News & Updates</h1>
        <p class="text-sm text-gray-500">Latest stories & school visits</p>
      </div>
    </div>

  </div>
</header>

<!-- ================= HERO ================= -->
<section class="bg-white">
  <div class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold text-gray-900">
      Latest News & School Visits
    </h2>
    <p class="text-gray-600 mt-2 max-w-xl">
      Bringing hands-on science education to schools across Uttar Pradesh
    </p>
  </div>
</section>

<!-- ================= HIGHLIGHTS ================= -->
<section class="max-w-7xl mx-auto px-6 -mt-6">
  <div
    id="highlightGrid"
    class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
  </div>
</section>

<!-- ================= NEWS ================= -->
<section class="max-w-7xl mx-auto px-6 mt-20 pb-24">

  <div class="text-center mb-12">
    <span class="inline-block bg-cyan-100 text-cyan-700 px-5 py-2 rounded-full text-sm font-medium mb-3">
      Recent Visits
    </span>
    <h3 class="text-2xl font-bold">Schools We’ve Visited</h3>
    <p class="text-gray-600 mt-2">
      Hands-on science programs conducted across Uttar Pradesh
    </p>
  </div>

  <div id="newsGrid" class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3"></div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-slate-900 text-gray-400">
  <div class="max-w-7xl mx-auto px-6 py-6 text-center text-sm">
    © 2025 The Science Bus. All rights reserved.
  </div>
</footer>

<!-- ================= DATA + LOOPS ================= -->
<script>
  /* ---------- HIGHLIGHTS DATA ---------- */
  const highlights = [
    { icon: "🏅", title: "Innovation Award 2024", subtitle: "National Education Ministry", color: "cyan" },
    { icon: "🏫", title: "150+ Schools Visited", subtitle: "Across Uttar Pradesh", color: "blue" },
    { icon: "🚌", title: "Mobile Science Lab", subtitle: "IIT Kanpur & CSTUP", color: "indigo" }
  ];

  document.getElementById("highlightGrid").innerHTML =
    highlights.map(h => `
      <div class="w-full max-w-sm
                  bg-white rounded-2xl p-7 flex gap-5
                  border border-slate-200
                  shadow-md
                  transition-all duration-300 ease-out
                  hover:-translate-y-2 hover:shadow-2xl hover:border-${h.color}-300">

        <div class="w-12 h-12 rounded-xl bg-${h.color}-50 text-${h.color}-600
                    flex items-center justify-center shrink-0">
          ${h.icon}
        </div>

        <div>
          <p class="font-semibold">${h.title}</p>
          <p class="text-sm text-gray-500 mt-1">${h.subtitle}</p>
        </div>
      </div>
    `).join("");

  /* ---------- NEWS DATA ---------- */
  const news = [
    {
      title: "Kendriya Vidyalaya, Kanpur",
      location: "Kanpur, UP",
      month: "December 2024",
      image: "assets/images/news1.jpg",
      desc: "Three-day science workshop covering physics, chemistry, and biology."
    },
    {
      title: "Government School, Unnao",
      location: "Unnao, UP",
      month: "November 2024",
      image: "assets/images/news2.jpg",
      desc: "Interactive sessions on 3D printing and robotics."
    },
    {
      title: "Sunbeam School, Varanasi",
      location: "Varanasi, UP",
      month: "October 2024",
      image: "assets/images/news3.jpg",
      desc: "Week-long science exhibition with hands-on experiments."
    }
  ];

  document.getElementById("newsGrid").innerHTML =
    news.map(n => `
      <article class="bg-white rounded-2xl overflow-hidden
                      border border-slate-200
                      shadow-md
                      transition-all duration-300 ease-out
                      hover:-translate-y-2 hover:shadow-2xl hover:border-blue-300">

        <img src="${n.image}"
             class="w-full h-48 object-cover border-b border-slate-200"
             alt="">

        <div class="p-6">
          <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full mb-3">
            ${n.month}
          </span>
          <h4 class="font-semibold text-lg">${n.title}</h4>
          <p class="text-sm text-blue-600 mt-1">📍 ${n.location}</p>
          <p class="text-sm text-gray-600 mt-3">${n.desc}</p>
        </div>
      </article>
    `).join("");
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.1/flowbite.min.js"></script>
</body>
</html>
