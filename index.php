<?php include 'includes/header.php'; ?>
<script>
  const images = [
    "assets/image/header/bus2.jpg",
    "assets/image/header/quote1.jpeg",
    "assets/image/header/quote2.jpeg",
    "assets/image/header/quote3.jpeg",
    "assets/image/header/a.jpg",
    "assets/image/header/b.jpg",
    "assets/image/header/c.jpg",
    "assets/image/header/d.jpg",
    "assets/image/header/e.jpg",
    "assets/image/header/f.jpg",
    "assets/image/header/g.jpg",
    "assets/image/header/h.jpg",
    "assets/image/header/i.jpg"
  ];
</script>


<!-- Hero Section -->
<section class="bg-gradient-to-b from-blue-50 to-white py-3">
    
    <!-- TOP CENTER BADGE -->
    <div class="max-w-7xl mx-auto px-6 text-center mb-10">
        <span class="inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm">
            An IITK, CSTUP & UP Government Initiative
        </span>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

        <!-- LEFT CONTENT -->
        <div class="-mt-6">
            <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                Bringing Science to <br>
                <span class="text-blue-600">Every Child’s Doorstep</span>
            </h2>

            <p class="text-gray-600 mt-6 max-w-xl">
                The Science Bus is a mobile science laboratory that travels to schools across
                Uttar Pradesh, making hands-on science education accessible to students who
                might not have access to well-equipped laboratories.
            </p>

            <div class="mt-8 flex gap-4">
                <a href="#about"
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                    Learn More →
                </a>
                <a href="contactUs.php"
                   class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-blue-50 transition">
                    Contact Us
                </a>
            </div>
        </div>

        <!-- RIGHT SLIDER -->
        <div class="relative">
          <div class="swiper rounded-2xl shadow-xl overflow-hidden">
            <div class="swiper-wrapper" id="heroSlider">
              <!-- Images will be injected -->
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
          </div>
        </div>


    </div>
</section>

<!-- About The Science Bus -->
<section class="py-10 bg-white" id="about">

    <!-- TOP CENTER TITLE -->
    <div class="max-w-7xl mx-auto px-6 text-center mb-12">
        <div class="inline-block bg-blue-100 text-blue-700 px-5 py-2 rounded-full text-xl font-medium">
            About The Science Bus
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-start">

        <!-- LEFT: FEATURE CARDS -->
        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl p-8">
            <div class="grid sm:grid-cols-2 gap-6">

                <!-- Card 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm text-center">
                    <div class="flex justify-center mb-4">
                        <div class="w-14 h-14 flex items-center justify-center bg-cyan-100 rounded-xl text-2xl">
                            🔬
                        </div>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">Hands-On Learning</h4>
                    <p class="text-gray-600 text-sm">
                        Students engage with real experiments
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm text-center">
                    <div class="flex justify-center mb-4">
                        <div class="w-14 h-14 flex items-center justify-center bg-blue-100 rounded-xl text-2xl">
                            🚌
                        </div>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">Mobile Lab</h4>
                    <p class="text-gray-600 text-sm">
                        We bring science directly to schools
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm text-center">
                    <div class="flex justify-center mb-4">
                        <div class="w-14 h-14 flex items-center justify-center bg-purple-100 rounded-xl text-2xl">
                            👩‍🏫
                        </div>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">Expert Team</h4>
                    <p class="text-gray-600 text-sm">
                        Guided by experienced educators
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm text-center">
                    <div class="flex justify-center mb-4">
                        <div class="w-14 h-14 flex items-center justify-center bg-green-100 rounded-xl text-2xl">
                            🎓
                        </div>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">Quality Education</h4>
                    <p class="text-gray-600 text-sm">
                        Curriculum-aligned programs
                    </p>
                </div>

            </div>
        </div>

        <!-- RIGHT: TEXT CONTENT -->
        <div>
            <p class="text-gray-700 leading-relaxed mb-6 text-justify">
                The Council of Science & Technology, U.P. (CSTUP) is an autonomous body under
                the Department of Science & Technology, Government of U.P. The main activities
                of CSTUP include science popularization, grant-in-aid for research projects,
                innovation promotion, IPR, biotechnology development and technology.
                The Science Bus is one of its flagship initiatives.
            </p>

            <p class="text-gray-700 leading-relaxed mb-6 text-justify">
                The Science Bus is a fully air-conditioned mobile science laboratory equipped
                with more than 100 experiments covering Physics, Chemistry, and Biology.
                It includes advanced equipment like a 3D printer, microscope, and telescope.
                The bus uses AdBlue technology, which reduces nitrogen oxide levels in exhaust
                fumes by converting them into a less harmful mixture of nitrogen and water vapor.
            </p>

            <p class="text-gray-700 leading-relaxed text-justify">
                Traveling mainly to remote areas, the bus enables students to perform experiments
                in batches of 5–20 students, educating more than 200 students each day. The lesson
                plans are aligned with UP Board and CBSE Board syllabi, featuring easy-to-follow
                animations and demonstration videos for better understanding.
            </p>
        </div>

    </div>
</section>



<!-- Facilities Section -->
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



<section id="impactCard" class="relative py-6 bg-gradient-to-b from-blue-50 to-white">

    <div class="max-w-7xl mx-auto px-6">

        <!-- Heading -->
        <div class="text-center mb-16">
            <span
                class="inline-block bg-blue-100 text-blue-700
                       px-6 py-2 rounded-full text-xl font-medium mb-4">
                Our Impact
            </span>

            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Transforming science education across Uttar Pradesh, one school at a time.
            </p>
        </div>

        <!-- Impact Cards -->
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 mb-20">

  <!-- Card -->
  <div
    class="stat-card group rounded-3xl p-10 text-center
           bg-white border border-blue-100 shadow-sm
           transition-all duration-300
           hover:-translate-y-3 hover:bg-blue-50 hover:shadow-xl">

    <h3
      class="counter text-5xl font-bold text-blue-700"
      data-target="2001"
      data-suffix="">
      0
    </h3>
    <p class="mt-3 text-gray-600">Initiated</p>
  </div>

  <div class="stat-card group rounded-3xl p-10 text-center bg-white border border-blue-100 shadow-sm transition-all duration-300 hover:-translate-y-3 hover:bg-blue-50 hover:shadow-xl">
    <h3 class="counter text-5xl font-bold text-blue-700" data-target="148" data-suffix="+">0</h3>
    <p class="mt-3 text-gray-600">School Visits</p>
  </div>

  <div class="stat-card group rounded-3xl p-10 text-center bg-white border border-blue-100 shadow-sm transition-all duration-300 hover:-translate-y-3 hover:bg-blue-50 hover:shadow-xl">
    <h3 class="counter text-5xl font-bold text-blue-700" data-target="99" data-suffix="+">0</h3>
    <p class="mt-3 text-gray-600">Experiments</p>
  </div>

  <div class="stat-card group rounded-3xl p-10 text-center bg-white border border-blue-100 shadow-sm transition-all duration-300 hover:-translate-y-3 hover:bg-blue-50 hover:shadow-xl">
    <h3 class="counter text-5xl font-bold text-blue-700" data-target="198" data-suffix="+">0</h3>
    <p class="mt-3 text-gray-600">Students Daily</p>
  </div>

</div>
<script>
  const section = document.getElementById("impactCard");
  const counters = section.querySelectorAll(".counter");

  let hasAnimated = false;

  const startCounting = () => {
    if (hasAnimated) return;
    hasAnimated = true;

    counters.forEach(counter => {
      const target = +counter.dataset.target;
      const suffix = counter.dataset.suffix || "";
      let count = 0;

      const increment = Math.ceil(target / 90);

      const updateCount = () => {
        count += increment;
        if (count >= target) {
          counter.textContent = target + suffix;
        } else {
          counter.textContent = count + suffix;
          requestAnimationFrame(updateCount);
        }
      };

      updateCount();
    });
  };

  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          startCounting();
          observer.disconnect(); // run only once
        }
      });
    },
    { threshold: 0.35 }
  );

  observer.observe(section);
</script>



        <!-- Location Box -->
        <div
            class="rounded-3xl p-10 bg-white
                   border border-blue-100 shadow-xl">

            <h3 class="text-center text-xl font-semibold text-blue-700 mb-2">
                Our Location
            </h3>
            <p class="text-center text-gray-600 mb-6">
                Uttar Pradesh, India
            </p>

            <!-- Map -->
            <div class="overflow-hidden rounded-2xl border border-blue-100">
                <iframe
                    src="https://www.google.com/maps?q=IIT%20Kanpur&output=embed"
                    class="w-full h-[380px]"
                    loading="lazy">
                </iframe>
            </div>

        </div>

    </div>
</section>

<script>
  const slider = document.getElementById("heroSlider");

  slider.innerHTML = images
    .map(
      (img) => `
      <div class="swiper-slide">
        <img src="${img}" class="w-full h-[380px] object-cover" />
      </div>
    `
    )
    .join("");
</script>
<script>
  new Swiper(".swiper", {
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>



<?php include 'includes/footer.php'; ?>
