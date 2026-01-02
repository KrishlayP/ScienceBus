<?php include 'includes/header.php'; ?>

<body class="bg-slate-50 text-gray-800">

<!-- ================= HERO ================= -->
<section class="bg-white">
  <div class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold">Latest News & School Visits</h2>
    <p class="text-gray-600 mt-2 max-w-xl">
      Bringing hands-on science education to schools across Uttar Pradesh
    </p>
  </div>
</section>

<!-- ================= HIGHLIGHTS ================= -->
<section class="max-w-7xl mx-auto px-6 -mt-6">
  <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">

    <div class="max-w-sm bg-white rounded-2xl p-7 flex gap-5 border border-slate-200 shadow-md hover:-translate-y-2 hover:shadow-xl transition">
      <div class="w-12 h-12 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">🏅</div>
      <div>
        <p class="font-semibold">Innovation Award 2024</p>
        <p class="text-sm text-gray-500 mt-1">National Education Ministry</p>
      </div>
    </div>

    <div class="max-w-sm bg-white rounded-2xl p-7 flex gap-5 border border-slate-200 shadow-md hover:-translate-y-2 hover:shadow-xl transition">
      <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">🏫</div>
      <div>
        <p class="font-semibold">150+ Schools Visited</p>
        <p class="text-sm text-gray-500 mt-1">Across Uttar Pradesh</p>
      </div>
    </div>

    <div class="max-w-sm bg-white rounded-2xl p-7 flex gap-5 border border-slate-200 shadow-md hover:-translate-y-2 hover:shadow-xl transition">
      <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">🚌</div>
      <div>
        <p class="font-semibold">Mobile Science Lab</p>
        <p class="text-sm text-gray-500 mt-1">IIT Kanpur & CSTUP</p>
      </div>
    </div>

  </div>
</section>

<!-- ================= NEWS ================= -->
<section class="max-w-7xl mx-auto px-6 mt-20 pb-24">
  <div class="text-center mb-12">
    <span class="inline-block bg-cyan-100 text-cyan-700 px-5 py-2 rounded-full text-sm font-medium mb-3">
      Recent Visits
    </span>
    <h3 class="text-2xl font-bold">Schools We’ve Visited</h3>
  </div>

  <div id="newsGrid" class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3"></div>

  <div id="newsBtnWrap" class="text-center mt-14 hidden">
    <button id="newsBtn" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-8 py-3 text-white font-medium hover:bg-blue-700 transition">
      View More →
    </button>
  </div>
</section>

<!-- ================= MEDIA ================= -->
<section class="bg-[#f4fbfd] py-4">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <span class="inline-block bg-blue-100 text-blue-700 px-5 py-2 rounded-full text-sm font-medium mb-4">
        Media Coverage
      </span>
      <h2 class="text-3xl font-bold">In The News</h2>
    </div>

    <div id="mediaGrid" class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4"></div>

    <div id="mediaBtnWrap" class="text-center mt-16 hidden">
      <button id="mediaBtn" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-8 py-3 text-white font-medium hover:bg-blue-700 transition">
        View More →
      </button>
    </div>
  </div>
</section>

<!-- ================= SOCIAL IMPACT ================= -->
<section class="bg-white py-4">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <span class="inline-block bg-purple-100 text-purple-700 px-5 py-2 rounded-full text-sm font-medium mb-4">
        Social Impact
      </span>
      <h2 class="text-3xl font-bold">What People Are Saying</h2>
    </div>

    <div id="impactGrid" class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3"></div>

    <div id="impactBtnWrap" class="text-center mt-16 hidden">
      <button id="impactBtn" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-8 py-3 text-white font-medium hover:bg-blue-700 transition">
        View More →
      </button>
    </div>
  </div>
</section>

<!-- ================= FOOTER ================= -->
<!-- ================= CALL TO ACTION ================= -->
<section class="bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600 py-10">
  <div class="max-w-4xl mx-auto px-6 text-center text-white">

    <h2 class="text-3xl md:text-4xl font-semibold">
      Want The Science Bus at Your School?
    </h2>

    <p class="mt-6 text-lg text-blue-100 leading-relaxed">
      We’re always looking to visit more schools and inspire more students.
      Get in touch with us to schedule a visit!
    </p>

    <div class="mt-10">
      <a
        href="contactUs.php"
        class="inline-flex items-center gap-2
               bg-white text-blue-700
               px-8 py-4 rounded-xl
               font-medium
               shadow-lg
               hover:scale-105 hover:shadow-xl
               transition">
        Contact Us →
      </a>
    </div>

  </div>
</section>

<?php include 'includes/footer.php'; ?>



<!-- ================= REUSABLE SCRIPT ================= -->
<script>
  function initViewMore({ data, initial, gridId, btnWrapId, btnId, template }) {
    let visible = initial;
    let expanded = false;

    const grid = document.getElementById(gridId);
    const btnWrap = document.getElementById(btnWrapId);
    const btn = document.getElementById(btnId);

    function render() {
      grid.innerHTML = data.slice(0, visible).map(template).join("");
      btnWrap.classList.toggle("hidden", expanded);
    }

    // View More click → OPEN
    btn.addEventListener("click", (e) => {
      e.stopPropagation(); // very important
      expanded = true;
      visible = data.length;
      render();
    });

    // Click anywhere outside → CLOSE
    document.addEventListener("click", (e) => {
      if (!expanded) return;

      const clickedInside =
        grid.contains(e.target) || btn.contains(e.target);

      if (!clickedInside) {
        expanded = false;
        visible = initial;
        render();
      }
    });

    render();
  }

  /* NEWS */
  initViewMore({
    data: Array.from({ length: 7 }, (_, i) => ({
      title: `School Visit ${i + 1}`,
      location: "Uttar Pradesh",
      month: "2024",
      image: "https://picsum.photos/600/400?" + i
    })),
    initial: 6,
    gridId: "newsGrid",
    btnWrapId: "newsBtnWrap",
    btnId: "newsBtn",
    template: n => `
      <article class="bg-white rounded-2xl overflow-hidden border shadow-md hover:-translate-y-2 hover:shadow-xl transition">
        <img src="${n.image}" class="w-full h-48 object-cover border-b">
        <div class="p-6">
          <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">${n.month}</span>
          <h4 class="font-semibold text-lg mt-3">${n.title}</h4>
          <p class="text-sm text-blue-600 mt-1">📍 ${n.location}</p>
        </div>
      </article>`
  });

  /* MEDIA */
  initViewMore({
    data: Array.from({ length: 6 }, (_, i) => ({
      source: "National Media",
      title: `Media Coverage ${i + 1}`,
      image: "https://picsum.photos/500/300?" + i
    })),
    initial: 4,
    gridId: "mediaGrid",
    btnWrapId: "mediaBtnWrap",
    btnId: "mediaBtn",
    template: m => `
      <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-md hover:-translate-y-2 hover:shadow-xl transition">
        <img src="${m.image}" class="w-full h-40 object-cover">
        <div class="p-6">
          <p class="text-sm text-blue-600 font-medium mb-2">📰 ${m.source}</p>
          <h3 class="font-semibold text-lg">${m.title}</h3>
        </div>
      </article>`
  });

  /* SOCIAL IMPACT */
  initViewMore({
    data: Array.from({ length: 5 }, () => ({
      text: "The Science Bus visit was a life-changing experience for students.",
      author: "Educator, UP"
    })),
    initial: 3,
    gridId: "impactGrid",
    btnWrapId: "impactBtnWrap",
    btnId: "impactBtn",
    template: t => `
      <div class="relative rounded-2xl p-8 border border-slate-200 shadow-md hover:-translate-y-2 hover:shadow-xl transition bg-white">
        <p class="text-gray-700 italic">“${t.text}”</p>
        <p class="mt-6 font-semibold text-gray-900">— ${t.author}</p>
      </div>`
  });
</script>


</body>
</html>
