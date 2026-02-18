<?php include 'includes/header.php'; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4
            min-h-[70vh] mt-5 mb-16 px-3 md:px-6
            bg-gradient-to-b from-blue-50 to-white">

  <!-- LEFT -->
  <div class="lg:col-span-2">

    <div class="relative flex items-center justify-center
                bg-gray-100 rounded-3xl overflow-hidden
                shadow-inner border border-gray-200
                w-full h-[420px]">

      <img id="mainImage"
           class="w-full h-full object-contain"
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

    <div id="galleryTitle"
         class="text-center mt-3 text-lg font-semibold text-gray-700">
    </div>

  </div>

  <!-- RIGHT -->
 <div class="mt-4 lg:mt-8">

    <button id="backBtn"
            class="hidden mb-3 px-4 py-2 bg-blue-600 text-white rounded-lg">
      ← Back
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

  let categories = [];
  let images = [];
  let currentIndex = 0;
  let slider = null;



  // ===== LOAD JSON =====
  // ===== LOAD JSON =====
fetch('assets/data/gallery.json?v=' + Date.now())
  .then(res => {

    if (!res.ok) throw new Error("JSON NOT FOUND");
    return res.json();
  })
  .then(data => {


    categories = data.categories || [];

    if (!categories.length) {

      return;
    }

    showCategories();
    startMainSlider();
  })
  .catch(err => {

  });


  // ===== MAIN SLIDER =====
  function startMainSlider() {
    clearInterval(slider);

    images = [];
    categories.forEach(cat => {
      cat.packages.forEach(pkg => {
        images = images.concat(pkg.images);
      });
    });



    currentIndex = 0;
    updateSlider();
    slider = setInterval(nextSlide, 3000);
    galleryTitle.textContent = "All Gallery";
  }

  // ===== SHOW CATEGORIES =====
  function showCategories() {
    rightPanel.innerHTML = '';
    backBtn.classList.add('hidden');

    categories.forEach(cat => {
      const div = document.createElement('div');
      div.className =
        'cursor-pointer bg-white rounded-2xl p-4 text-center shadow-md';

      div.innerHTML = `
        <h3 class="font-bold text-blue-700">${cat.name}</h3>
        <p class="text-xs text-gray-500">${cat.packages.length} albums</p>
      `;

      div.onclick = () => showPackages(cat);
      rightPanel.appendChild(div);
    });
  }

  // ===== SHOW PACKAGES =====
  function showPackages(category) {
    rightPanel.innerHTML = '';
    backBtn.classList.remove('hidden');
    galleryTitle.textContent = category.name;



    category.packages.forEach(pkg => {
      const imgPath = pkg.images[0];


      const div = document.createElement('div');
      div.className =
        'cursor-pointer bg-white rounded-2xl overflow-hidden shadow-md';

      div.innerHTML = `
        <div class="aspect-video overflow-hidden">
          <img src="${imgPath}"
               class="w-full h-full object-cover"
               onerror="this.style.border='3px solid red'">
        </div>
        <div class="p-2 text-center">
          <h4 class="font-semibold text-blue-700">${pkg.name}</h4>
        </div>
      `;

      div.onclick = () => loadPackage(pkg, category);
      rightPanel.appendChild(div);
    });

    backBtn.onclick = showCategories;
  }

  // ===== LOAD PACKAGE =====
  function loadPackage(pkg, category) {
    clearInterval(slider);
    rightPanel.innerHTML = '';
    backBtn.classList.remove('hidden');

    images = pkg.images;
    currentIndex = 0;



    galleryTitle.textContent = category.name + " / " + pkg.name;

    updateSlider();

    images.forEach((src, i) => {
      const img = document.createElement('img');
      img.src = src;
      img.className =
        'cursor-pointer rounded-xl object-cover w-full aspect-video border';

      img.onerror = () => {
        img.style.border = "3px solid red";

      };

      img.onclick = () => {
        currentIndex = i;
        updateSlider();
      };

      rightPanel.appendChild(img);
    });

    slider = setInterval(nextSlide, 3000);
    backBtn.onclick = () => showPackages(category);
  }

  // ===== SLIDER =====
  function updateSlider() {
    if (!images.length) return;

    const src = images[currentIndex];
    mainImage.src = src;



    mainImage.onerror = () => {
      mainImage.style.border = "4px solid red";

    };

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

  prevBtn.onclick = () => {
    clearInterval(slider);
    prevSlide();
    slider = setInterval(nextSlide, 3000);
  };

  nextBtn.onclick = () => {
    clearInterval(slider);
    nextSlide();
    slider = setInterval(nextSlide, 3000);
  };

  // ===== DOTS =====
  function renderDots() {
    dotsContainer.innerHTML = '';

    images.forEach((_, i) => {
      const dot = document.createElement('div');
      dot.className =
        'w-3 h-3 rounded-full cursor-pointer ' +
        (i === currentIndex
          ? 'bg-blue-600'
          : 'bg-gray-400');

      dot.onclick = () => {
        currentIndex = i;
        updateSlider();
      };

      dotsContainer.appendChild(dot);
    });
  }

});
</script>
