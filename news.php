<?php include 'includes/header.php'; ?>
<body class="bg-slate-50 text-gray-800">

<!-- ================= HERO ================= -->
<section class="bg-gradient-to-b from-blue-50 to-white py-3">
  <div class="max-w-7xl mx-auto px-6 py-5 text-center">

    <p class="text-sm uppercase tracking-widest text-blue-600 mb-4 font-medium">
      Updates & Impact
    </p>

    <h2 class="text-2xl md:text-4xl font-bold max-w-4xl mx-auto leading-tight">
      Latest News & School Visits
    </h2>

    <p class="text-blue-600 mt-4 max-w-xl mx-auto font-medium">
      Bringing hands-on science education to schools across Uttar Pradesh
    </p>

    <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">

      <div class="w-full max-w-sm bg-white rounded-2xl p-7 flex items-center gap-5
                  border border-slate-200 shadow-md
                  transition-all duration-300
                  hover:-translate-y-2 hover:shadow-xl">
        <div class="w-14 h-14 rounded-xl text-2xl flex items-center justify-center">🏅</div>
        <div class="text-left">
          <p class="font-bold text-lg">Innovation Award 2024</p>
          <p class="text-sm text-blue-900 mt-1">National Education Ministry</p>
        </div>
      </div>

      <div class="w-full max-w-sm bg-white rounded-2xl p-7 flex items-center gap-5
                  border border-slate-200 shadow-md
                  transition-all duration-300
                  hover:-translate-y-2 hover:shadow-xl">
        <div class="w-14 h-14 rounded-xl text-2xl flex items-center justify-center">🏫</div>
        <div class="text-left">
          <p class="font-bold text-lg">150+ Schools Visited</p>
          <p class="text-sm text-blue-900 mt-1">Across Uttar Pradesh</p>
        </div>
      </div>

      <div class="w-full max-w-sm bg-white rounded-2xl p-7 flex items-center gap-5
                  border border-slate-200 shadow-md
                  transition-all duration-300
                  hover:-translate-y-2 hover:shadow-xl">
        <div class="w-14 h-14 rounded-xl text-2xl flex items-center justify-center">🚌</div>
        <div class="text-left">
          <p class="font-bold text-lg">Mobile Science Lab</p>
          <p class="text-sm text-blue-900 mt-1">IIT Kanpur & CSTUP</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ================= NEWS ================= -->
<section class="max-w-7xl mx-auto px-6 mt-18 pb-24">
  <div class="text-center mb-12">
    <span class="inline-block bg-cyan-100 text-cyan-700 px-5 py-2 rounded-full text-sm font-medium mb-3">
      Recent Visits
    </span>
    <h3 class="text-2xl font-bold">Schools We’ve Visited</h3>
  </div>

  <div id="newsGrid" class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3"></div>

  <div id="newsBtnWrap" class="text-center mt-14 hidden">
    <button id="newsBtn"
      class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-8 py-3 text-white font-medium hover:bg-blue-700 transition">
      View More →
    </button>
  </div>
</section>

<!-- ================= MEDIA ================= -->
<section class="bg-[#f4fbfd] py-10">
  <div class="max-w-7xl mx-auto px-6">

    <div class="text-center mb-16">
      <span class="inline-block bg-blue-100 text-blue-700 px-5 py-2 rounded-full text-sm font-medium mb-4">
        Media Coverage
      </span>
      <h2 class="text-3xl font-bold">In The News</h2>
    </div>

    <div id="mediaGrid" class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3"></div>

    <div id="mediaBtnWrap" class="text-center mt-16 hidden">
      <button
        id="mediaBtn"
        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-8 py-3 text-white font-medium hover:bg-blue-700 transition">
        View More →
      </button>
    </div>

  </div>
</section>

<!-- ================= SOCIAL IMPACT ================= -->
<section class="bg-white py-4 overflow-hidden">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <span class="inline-block bg-purple-100 text-purple-700 px-5 py-2 rounded-full text-sm font-medium mb-4">
        Social Impact
      </span>
      <h2 class="text-3xl font-bold">What People Are Saying</h2>
    </div>

    <!-- SLIDER WRAPPER -->
    <div class="relative overflow-hidden">
      <div
        id="impactGrid"
        class="flex gap-10 transition-transform duration-700 ease-in-out"
      ></div>
    </div>

    <div id="impactBtnWrap" class="text-center mt-16 hidden">
      <button
        id="impactBtn"
        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-8 py-3 text-white font-medium hover:bg-blue-700 transition"
      >
        View More →
      </button>
    </div>
  </div>
</section>


<!-- ================= CTA ================= -->
<section class="bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600 py-10">
  <div class="max-w-4xl mx-auto px-6 text-center text-white">
    <h2 class="text-3xl md:text-4xl font-semibold">Want The Science Bus at Your School?</h2>
    <p class="mt-6 text-lg text-blue-100">
      We’re always looking to visit more schools and inspire more students.
    </p>
    <div class="mt-10">
      <a href="contactUs.php"
        class="inline-flex items-center gap-2 bg-white text-blue-700 px-8 py-4 rounded-xl font-medium shadow-lg hover:scale-105 transition">
        Contact Us →
      </a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- ================= SCRIPT ================= -->
<script>
  function initViewMore({ data, initial, gridId, btnWrapId, btnId, template }) {
    let visible = initial;
    let expanded = false;

    const grid = document.getElementById(gridId);
    const btnWrap = document.getElementById(btnWrapId);
    const btn = document.getElementById(btnId);

    function render() {
      grid.innerHTML = data.slice(0, visible).map(template).join("");
      const showBtn = data.length > initial && !expanded;
      btnWrap.classList.toggle("hidden", !showBtn);
    }

    btn.addEventListener("click", e => {
      e.stopPropagation();
      expanded = true;
      visible = data.length;
      render();
    });

    document.addEventListener("click", e => {
      if (!expanded) return;
      if (grid.contains(e.target) || btn.contains(e.target)) return;

      expanded = false;
      visible = initial;
      render();
    });

    render();
  }

  const sections = [
    {
      initial: 6,
      gridId: "newsGrid",
      btnWrapId: "newsBtnWrap",
      btnId: "newsBtn",
      data: Array.from({ length: 7 }, (_, i) => ({
        title: `School Visit ${i + 1}`,
        location: "Uttar Pradesh",
        month: "2024",
        image: "https://picsum.photos/600/400?" + i
      })),
      template: n => `
        <article class="bg-white rounded-2xl overflow-hidden border shadow-md hover:-translate-y-2 hover:shadow-xl transition">
          <img src="${n.image}" class="w-full h-48 object-cover border-b">
          <div class="p-6">
            <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">${n.month}</span>
            <h4 class="font-semibold text-lg mt-3">${n.title}</h4>
            <p class="text-sm text-blue-600 mt-1">📍 ${n.location}</p>
          </div>
        </article>`
    },
    
  ];

  sections.forEach(initViewMore);
</script>
<script>
const impactConfig = {
  initial: 3,
  gridId: "impactGrid",
  btnWrapId: "impactBtnWrap",
  btnId: "impactBtn",
  data: Array.from({ length: 5 }, () => ({
    text: "The Science Bus visit was a life-changing experience for students.",
    author: "Educator, UP"
  })),
  template: t => `
    <div class="min-w-[360px] bg-white rounded-2xl p-8 border shadow-md hover:-translate-y-2 hover:shadow-xl transition">
      <p class="italic text-gray-700">“${t.text}”</p>
      <p class="mt-6 font-semibold text-gray-900">— ${t.author}</p>
    </div>`
};

const grid = document.getElementById(impactConfig.gridId);
const btnWrap = document.getElementById(impactConfig.btnWrapId);
const btn = document.getElementById(impactConfig.btnId);

let index = 0;

// render cards
impactConfig.data.forEach(item => {
  grid.insertAdjacentHTML("beforeend", impactConfig.template(item));
});

// show button if needed
if (impactConfig.data.length > impactConfig.initial) {
  btnWrap.classList.remove("hidden");
}

// slide logic
function slideImpact() {
  const cardWidth = grid.children[0].offsetWidth + 40; // gap included
  index++;

  if (index > grid.children.length - impactConfig.initial) {
    index = 0;
  }

  grid.style.transform = `translateX(-${index * cardWidth}px)`;
}

// auto move
let autoSlide = setInterval(slideImpact, 3000);

// pause on hover
grid.addEventListener("mouseenter", () => clearInterval(autoSlide));
grid.addEventListener("mouseleave", () => {
  autoSlide = setInterval(slideImpact, 3000);
});

// button click = manual move
btn.addEventListener("click", slideImpact);
</script>
<script>
function initMediaGrid(config) {
  const {
    initial,
    gridId,
    btnWrapId,
    btnId,
    data,
    template
  } = config;

  const grid = document.getElementById(gridId);
  const btnWrap = document.getElementById(btnWrapId);
  const btn = document.getElementById(btnId);

  let expanded = false;

  function render() {
    const visible = expanded ? data.length : initial;

    grid.innerHTML = data
      .slice(0, visible)
      .map(template)
      .join("");

    if (data.length > initial) {
      btnWrap.classList.remove("hidden");
      btn.textContent = expanded ? "View Less ↑" : "View More →";
    }
  }

  btn.addEventListener("click", (e) => {
    e.stopPropagation(); // prevent outside click
    expanded = !expanded;
    render();

    if (!expanded) {
      grid.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  });

  // 👇 CLOSE ON OUTSIDE CLICK
  document.addEventListener("click", (e) => {
    if (!expanded) return;

    const section = grid.closest("section");
    if (!section.contains(e.target)) {
      expanded = false;
      render();
      grid.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  });

  render();
}

/* ---------- FETCH NEWS JSON ---------- */
fetch('assets/data/news.json')
  .then(res => {
    if (!res.ok) {
      throw new Error("HTTP error " + res.status);
    }
    return res.json();
  })
  .then(json => {
    if (!json.news || !Array.isArray(json.news)) {
      throw new Error("'news' key missing or invalid");
    }

    const mediaData = json.news.map((img, i) => ({
      source: "National Media",
      title: `Media Coverage ${i + 1}`,
      image: img
    }));

    initMediaGrid({
      initial: 3,
      gridId: "mediaGrid",
      btnWrapId: "mediaBtnWrap",
      btnId: "mediaBtn",
      data: mediaData,
      template: m => `
        <article class="bg-white rounded-2xl overflow-hidden border shadow-md hover:-translate-y-2 hover:shadow-xl transition">
          <img src="${m.image}"
               class="w-full h-44 object-fit"
               onerror="this.style.display='none'">
          <div class="p-6">
            <p class="text-sm text-blue-600 font-medium mb-2">📰 ${m.source}</p>
            <h3 class="font-semibold text-lg">${m.title}</h3>
          </div>
        </article>
      `
    });
  })
  .catch(err => {
    console.error("❌ Media load failed:", err);
  });
</script>




</body>
</html>
