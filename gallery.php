<?php include 'includes/header.php'; ?>

<div class="max-w-7xl mx-auto mt-8 mb-12 px-4">

  <!-- BACK BUTTON -->
  <button id="backBtn"
          class="hidden mb-6 px-5 py-2 bg-blue-600 text-white rounded-xl shadow">
    ← Back
  </button>

  <!-- GALLERY GRID -->
  <div id="rightPanel"
       class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
  </div>

</div>

<!-- ================= MODAL ================= -->
<div id="imageModal"
     class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">

  <div class="bg-white max-w-5xl w-full mx-4 p-6 rounded-3xl relative">

    <button id="closeModal"
            class="absolute top-4 right-4 text-2xl font-bold">
      ✕
    </button>

    <img id="modalMainImage"
         class="w-full h-[65vh] object-contain rounded-2xl mb-5">

    <div id="modalThumbs"
         class="grid grid-cols-3 sm:grid-cols-4 gap-3 max-h-44 overflow-y-auto">
    </div>

  </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {

  const panel   = document.getElementById('rightPanel');
  const backBtn = document.getElementById('backBtn');

  const modal       = document.getElementById('imageModal');
  const modalImg    = document.getElementById('modalMainImage');
  const modalThumbs = document.getElementById('modalThumbs');
  const closeModal  = document.getElementById('closeModal');

  let packages = [];

  fetch('data_api.php?module=gallery')
    .then(res => res.json())
    .then(data => {
      packages = (data.categories || []).flatMap(category => category.packages || []);
      showPackages();
    });

  // ================= SHOW PACKAGES =================
  function showPackages() {
    panel.innerHTML = '';
    backBtn.classList.add('hidden');

    packages.forEach(pkg => {
      const card = document.createElement('div');
      card.className =
        'cursor-pointer p-7 bg-white border rounded-3xl text-center ' +
        'shadow-md hover:shadow-xl hover:-translate-y-1 transition';

      card.innerHTML = `
        <h2 class="text-xl font-bold text-blue-700 mb-2">${pkg.name}</h2>
        <p class="text-gray-500">${pkg.images.length} Photos</p>
      `;

      card.onclick = () => showImages(pkg);
      panel.appendChild(card);
    });
  }

  // ================= SHOW IMAGES =================
  function showImages(pkg) {
    panel.innerHTML = '';
    backBtn.classList.remove('hidden');

    pkg.images.forEach((src, index) => {
      const img = document.createElement('img');
      img.src = src;
      img.className =
        'cursor-pointer rounded-3xl border aspect-[16/10] object-cover ' +
        'shadow-md hover:shadow-xl hover:scale-[1.03] transition';

      img.onclick = () => openModal(pkg.images, index);
      panel.appendChild(img);
    });
  }

  // ================= MODAL =================
  function openModal(images, startIndex) {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    modalImg.src = images[startIndex];
    modalThumbs.innerHTML = '';

    images.forEach(src => {
      const thumb = document.createElement('img');
      thumb.src = src;
      thumb.className =
        'cursor-pointer rounded-xl border aspect-video object-cover ' +
        'hover:scale-105 transition';

      thumb.onclick = () => modalImg.src = src;
      modalThumbs.appendChild(thumb);
    });
  }

  closeModal.onclick = () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  };

  backBtn.onclick = showPackages;
});
</script>
