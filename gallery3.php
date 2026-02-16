<?php include 'includes/header.php'; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4
            min-h-[70vh] md:min-h-[75vh]
            lg:min-h-[70vh]
            mt-5 mb-16 px-3 md:px-6
            bg-gradient-to-b from-blue-50 to-white">


  <!-- LEFT : MAIN IMAGE -->
  <!-- LEFT : MAIN IMAGE -->
<div class="lg:col-span-2">

<div class="relative flex items-center justify-center
            bg-gray-100 rounded-3xl overflow-hidden
            shadow-inner border border-gray-200
            w-full h-[320px] sm:h-[360px] md:h-[400px] lg:h-[420px]">


    <img id="mainImage"
         class="w-full h-full object-contain sm:object-cover transition-all duration-500"
         src=""
         alt="Gallery Display">

    <button id="prevBtn"
            class="absolute left-4 bg-black/50 text-white p-2 rounded-full">
      ❮
    </button>

    <button id="nextBtn"
            class="absolute right-4 bg-black/50 text-white p-2 rounded-full">
      ❯
    </button>

    <div id="dotsContainer"
         class="absolute bottom-4 flex gap-2 justify-center w-full">
    </div>
  </div>

  <!-- TITLE -->
  <div id="galleryTitle"
       class="text-center mt-3 text-lg font-semibold text-gray-700">
  </div>

</div>


  <!-- RIGHT SIDE -->
  <div>

    <button id="backBtn"
            class="hidden mb-3 px-4 py-2 bg-blue-600 text-white rounded-lg">
      ← Back to Packages
    </button>

<div id="rightPanel"
     class="grid grid-cols-2 gap-3 overflow-y-auto
            lg:max-h-[520px] pr-1">
</div>


  </div>
</div>


<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {

  const mainImage  = document.getElementById('mainImage');
  const rightPanel = document.getElementById('rightPanel');
  const backBtn    = document.getElementById('backBtn');
  const prevBtn    = document.getElementById('prevBtn');
  const nextBtn    = document.getElementById('nextBtn');
  const dotsContainer = document.getElementById('dotsContainer');
  const galleryTitle  = document.getElementById('galleryTitle');

  let packages = [];
  let images = [];
  let currentIndex = 0;
  let slider = null;

  // ==========================
  // FETCH DATA
  // ==========================
  fetch('assets/data/gallery.json')
    .then(res => res.json())
    .then(data => {
      packages = data.packages;
      showPackages();
      startMainSlider();
    });

  // ==========================
  // MAIN SLIDER (ALL IMAGES)
  // ==========================
  function startMainSlider() {
    clearInterval(slider);

    images = [];
    packages.forEach(pkg => {
      images = images.concat(pkg.images);
    });

    currentIndex = 0;
    updateSlider();
    slider = setInterval(nextSlide, 3000);

    galleryTitle.textContent = "All Gallery";
  }

  // ==========================
  // SHOW PACKAGE CARDS
  // ==========================
  function showPackages() {
    rightPanel.innerHTML = '';
    backBtn.classList.add('hidden');

    packages.forEach(pkg => {

      const div = document.createElement('div');
      div.className =
        'cursor-pointer bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300';

      div.innerHTML = `
        <div class="aspect-video overflow-hidden">
          <img src="${pkg.images[0]}"
               class="w-full h-full object-cover hover:scale-110 transition duration-500">
        </div>
        <div class="p-3">
          <h4 class="font-semibold text-blue-700">${pkg.name}</h4>
          <p class="text-xs text-gray-500">${pkg.images.length} images</p>
        </div>
      `;

      div.onclick = () => loadPackage(pkg);
      rightPanel.appendChild(div);
    });
  }

  // ==========================
  // LOAD PACKAGE
  // ==========================
  function loadPackage(pkg) {
    clearInterval(slider);
    rightPanel.innerHTML = '';
    backBtn.classList.remove('hidden');

    images = pkg.images;
    currentIndex = 0;
    galleryTitle.textContent = pkg.name;

    updateSlider();

    // thumbnails
    images.forEach((src, i) => {
      const img = document.createElement('img');
      img.src = src;
      img.className =
        'cursor-pointer rounded-xl object-cover w-full aspect-video border hover:scale-105 transition';

      img.onclick = () => {
        currentIndex = i;
        updateSlider();
      };

      rightPanel.appendChild(img);
    });

    slider = setInterval(nextSlide, 3000);
  }

  // ==========================
  // SLIDER CORE
  // ==========================
  function updateSlider() {
    if (!images.length) return;

    mainImage.src = images[currentIndex];
    renderDots();
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % images.length;
    updateSlider();
  }

  function prevSlide() {
    currentIndex =
      (currentIndex - 1 + images.length) % images.length;
    updateSlider();
  }

  // arrows
  prevBtn.onclick = function () {
    clearInterval(slider);
    prevSlide();
    slider = setInterval(nextSlide, 3000);
  };

  nextBtn.onclick = function () {
    clearInterval(slider);
    nextSlide();
    slider = setInterval(nextSlide, 3000);
  };

  // ==========================
  // DOTS
  // ==========================
  function renderDots() {
    dotsContainer.innerHTML = '';

    images.forEach((_, i) => {
      const dot = document.createElement('div');
      dot.className =
        'w-3 h-3 rounded-full cursor-pointer transition ' +
        (i === currentIndex
          ? 'bg-blue-600 scale-110'
          : 'bg-gray-400');

      dot.onclick = () => {
        clearInterval(slider);
        currentIndex = i;
        updateSlider();
        slider = setInterval(nextSlide, 3000);
      };

      dotsContainer.appendChild(dot);
    });
  }

  // ==========================
  // BACK BUTTON
  // ==========================
  backBtn.onclick = function () {
    showPackages();
    startMainSlider();
  };

});
</script>





