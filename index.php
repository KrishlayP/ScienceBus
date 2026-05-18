<?php include 'includes/header.php'; ?>

<!-- ================= HERO SLIDER IMAGES ================= -->
<script>
const images = [
  "assets/image/header/quote1.jpeg",
  "assets/image/header/quote3.jpeg",
  "assets/image/header/a.jpg",
  "assets/image/header/b.jpg",
  "assets/image/header/d.jpg",
  "assets/image/header/e.jpg",
];
</script>

<!-- ================= HERO SECTION ================= -->
<section class="bg-gradient-to-b from-blue-50 to-white py-6">
  <div class="max-w-7xl mx-auto px-4 md:px-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

    <!-- LEFT CONTENT -->
    <div>
      <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold leading-tight">
        Bringing Science to <br>
        <span class="text-blue-600">Every Child’s Doorstep</span>
      </h2>
      <div class="mt-1">
        <span class="text-[10px] md:text-xs text-blue-700 font-semibold italic">
          An IITK, CSTUP & UP Govt Initiative
        </span>
      </div>
      <p class="text-gray-600 mt-6 max-w-xl text-justify">
        <b>The Science Bus</b> was a first-of-its-kind initiative at the time of its conception. It is developed on a mobile bus platform and serves as a mobile laboratory. The bus is well equipped with a wide range of laboratory accessories, such as <b>telescopes, microscopes</b>, and a <b>3D printer</b>, to provide schoolchildren with hands-on experience in science experiments across multiple disciplines. It is also equipped with a large display screen for demonstrating experimental videos. <b>The Science Bus</b> has proven to be extremely effective in creating scientific awareness, strengthening practical understanding among children, and inspiring young minds across the region
      </p>

      
    </div>

    <!-- RIGHT SLIDER -->
    <div class="relative">
      <div class="swiper rounded-2xl overflow-hidden ring-2 ring-blue-500/60 shadow-lg">
        <div class="swiper-wrapper" id="heroSlider"></div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>

  </div>
</section>

<!-- ================= ABOUT SECTION ================= -->
<section id="about" class="py-10 bg-white">
  <div class="max-w-7xl mx-auto px-4 md:px-6 text-center mb-12">
    <span class="inline-block bg-blue-100 text-blue-700 px-6 py-2 rounded-full text-xl font-medium">
      About The Science Bus
    </span>
  </div>

  <div class="max-w-7xl mx-auto px-4 md:px-6 grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-start">

    <!-- FEATURES -->
    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl p-6 md:p-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

        <?php
        $features = [
          ["🔬","Hands-On Learning","Students engage with real experiments"],
          ["🚌","Mobile Lab","Science delivered directly to schools"],
          ["👩‍🏫","Expert Team","Guided by experienced educators"],
          ["🎓","Quality Education","Curriculum-aligned programs"],
        ];
        foreach ($features as $f):
        ?>
        <div class="bg-white rounded-2xl p-6 text-center shadow-sm">
          <div class="w-14 h-14 mx-auto flex items-center justify-center bg-blue-100 rounded-xl text-2xl mb-4">
            <?= $f[0] ?>
          </div>
          <h4 class="font-semibold text-lg mb-2"><?= $f[1] ?></h4>
          <p class="text-gray-600 text-sm"><?= $f[2] ?></p>
        </div>
        <?php endforeach; ?>

      </div>
    </div>

    <!-- TEXT -->
    <div class="space-y-6 text-gray-700 text-justify">
                With the objective of popularizing science among schoolchildren in remote areas, IIT Kanpur initiated the Science Bus Project in collaboration with the <b> Council of Science & Technology, Uttar Pradesh (CST-UP)</b>. Through this initiative, a large number of students, including girls, are provided with the opportunity to gain a deeper understanding of the experimental and practical aspects of science. Students actively participate in conducting experiments and display a high level of curiosity and enthusiasm during the sessions.
            </p>

            <p class="text-gray-700 leading-relaxed mb-6 text-justify">
                Experiments in Physics, Chemistry, Biology, and Design are demonstrated and conducted by the students themselves, thereby enriching the regular science curriculum followed in schools across Uttar Pradesh. The initiative extends science beyond textbooks through hands-on experiments.
            </p>

            <p class="text-gray-700 leading-relaxed text-justify">
                Connecting scientific concepts with students’ everyday lives.
                Eriments and modern equipment in a highly engaging and accessible manner.
            </p>

  </div>
</section>

<!-- ================= FACILITIES ================= -->
<section class="py-4 bg-gradient-to-b from-white to-blue-50">
  <div class="max-w-7xl mx-auto px-6 text-center">

    <!-- Section Badge -->
    <span class="inline-block bg-cyan-100 text-blue-700 px-6 py-2 rounded-full text-xl font-medium mb-6">
      Facilities
    </span>

    <!-- Heading -->
    <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-16">
      The Science Bus is equipped with state-of-the-art facilities to make learning
      engaging and effective.
    </p>

    <!-- Cards -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

      <!-- Card 1 -->
      <div
        class="group bg-white rounded-3xl p-8 shadow-sm transition-all duration-300
               hover:-translate-y-3 hover:shadow-xl hover:border
               border border-transparent hover:border-blue-200">

        <div
          class="w-16 h-16 mx-auto flex items-center justify-center
                 bg-white rounded-2xl mb-6 text-4xl transition
                 group-hover:bg-blue-100 group-hover:scale-110">
          🖨️
        </div>

        <h4 class="text-lg font-semibold mb-3 text-center">3D Printer</h4>
        <p class="text-gray-600 text-sm leading-relaxed text-center">
          Advanced 3D printing technology for hands-on learning of modern
          manufacturing concepts.
        </p>
      </div>

      <!-- Card 2 -->
      <div
        class="group bg-white rounded-3xl p-8 shadow-sm transition-all duration-300
               hover:-translate-y-3 hover:shadow-xl hover:border
               border border-transparent hover:border-blue-200">

        <div
          class="w-16 h-16 mx-auto flex items-center justify-center
                 bg-white rounded-2xl mb-6 text-4xl transition
                 group-hover:bg-blue-100 group-hover:scale-110">
          🖥️
        </div>

        <h4 class="text-lg font-semibold mb-3 text-center">75 Inch LCD Display</h4>
        <p class="text-gray-600 text-sm leading-relaxed text-center">
          Large high-definition display for engaging video demonstrations
          and animations.
        </p>
      </div>

      <!-- Card 3 -->
      <div
        class="group bg-white rounded-3xl p-8 shadow-sm transition-all duration-300
               hover:-translate-y-3 hover:shadow-xl hover:border
               border border-transparent hover:border-blue-200">

        <div
          class="w-16 h-16 mx-auto flex items-center justify-center
                 bg-white rounded-2xl mb-6 text-4xl transition
                 group-hover:bg-blue-100 group-hover:scale-110">
          🔬
        </div>

        <h4 class="text-lg font-semibold mb-3 text-center">Microscope</h4>
        <p class="text-gray-600 text-sm leading-relaxed text-center">
          Professional microscope for exploring the microscopic world in
          Physics, Chemistry, and Biology.
        </p>
      </div>

      <!-- Card 4 -->
      <div
        class="group bg-white rounded-3xl p-8 shadow-sm transition-all duration-300
               hover:-translate-y-3 hover:shadow-xl hover:border
               border border-transparent hover:border-blue-200">

        <div
          class="w-16 h-16 mx-auto flex items-center justify-center
                 bg-white rounded-2xl mb-6 text-4xl transition
                 group-hover:bg-blue-100 group-hover:scale-110">
          🔭
        </div>

        <h4 class="text-lg font-semibold mb-3 text-center">Science Experiments</h4>
        <p class="text-gray-600 text-sm leading-relaxed text-center">
          100+ experiments for VI–XII standard students covering all
          major scientific principles.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ================= IMPACT ================= -->
<section id="impactCard" class="py-8 bg-gradient-to-b from-blue-50 to-white">
  <div class="max-w-7xl mx-auto px-4 md:px-6">

    <div class="text-center mb-12">
      <span class="inline-block bg-blue-100 text-blue-700 px-6 py-2 rounded-full text-xl font-medium mb-4">
        Our Impact
      </span>
      <p class="text-gray-600">Transforming science education across Uttar Pradesh.</p>
    </div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

  <div class="bg-white rounded-3xl p-8 text-center shadow-sm hover:shadow-xl transition">
    <h3 class="counter text-5xl font-bold text-blue-700"
        data-target="2018">0</h3>
    <p class="text-gray-600 mt-2">Initiated</p>
  </div>

  <div class="bg-white rounded-3xl p-8 text-center shadow-sm hover:shadow-xl transition">
    <h3 class="counter text-5xl font-bold text-blue-700"
        data-target="148" data-suffix="+">0</h3>
    <p class="text-gray-600 mt-2">School Visits</p>
  </div>

  <div class="bg-white rounded-3xl p-8 text-center shadow-sm hover:shadow-xl transition">
    <h3 class="counter text-5xl font-bold text-blue-700"
        data-target="99" data-suffix="+">0</h3>
    <p class="text-gray-600 mt-2">Experiments</p>
  </div>

  <div class="bg-white rounded-3xl p-8 text-center shadow-sm hover:shadow-xl transition">
    <h3 class="counter text-5xl font-bold text-blue-700"
        data-target="198" data-suffix="+">0</h3>
    <p class="text-gray-600 mt-2">Students Daily</p>
  </div>

</div>


    <!-- MAP -->
    <div class="bg-white rounded-3xl p-6 shadow-xl">
      <h3 class="text-center text-xl font-semibold text-blue-700 mb-2">Our Location</h3>
      <p class="text-center text-gray-600 mb-4">Uttar Pradesh, India</p>
      <iframe
        src="https://www.google.com/maps?q=IIT%20Kanpur&output=embed"
        class="w-full h-[240px] sm:h-[320px] md:h-[380px] rounded-2xl border"
        loading="lazy"></iframe>
    </div>

  </div>
</section>

<!-- ================= SCRIPTS ================= -->
<script>
document.getElementById("heroSlider").innerHTML = images.map(img => `
  <div class="swiper-slide">
    <img src="${img}" class="w-full h-[220px] sm:h-[300px] md:h-[380px] object-cover">
  </div>
`).join("");

new Swiper(".swiper", {
  loop: true,
  autoplay: { delay: 3000, disableOnInteraction: false },
  pagination: { el: ".swiper-pagination", clickable: true },
  navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
});
</script>
<script>
const counters = document.querySelectorAll(".counter");
let counterStarted = false;

function startCounters() {
  if (counterStarted) return;
  counterStarted = true;

  counters.forEach(counter => {
    const target = +counter.dataset.target;
    const suffix = counter.dataset.suffix || "";
    let count = 0;

    const increment = Math.ceil(target / 90);

    const updateCounter = () => {
      count += increment;
      if (count >= target) {
        counter.textContent = target + suffix;
      } else {
        counter.textContent = count + suffix;
        requestAnimationFrame(updateCounter);
      }
    };

    updateCounter();
  });
}

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      startCounters();
      observer.disconnect(); // run once
    }
  });
}, { threshold: 0.35 });

observer.observe(document.getElementById("impactCard"));
</script>


<?php include 'includes/footer.php'; ?>
