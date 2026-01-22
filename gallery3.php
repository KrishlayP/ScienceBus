<?php include 'includes/header.php'; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4
            min-h-[70vh] md:min-h-[80vh] lg:h-[calc(98vh-160px)]
            mt-5 mb-5 px-3 md:px-6 bg-gradient-to-b from-blue-50 to-white">

  <!-- MAIN IMAGE -->
  <div class="lg:col-span-2 flex items-center justify-center
              bg-gray-100 rounded-3xl overflow-hidden
              shadow-inner border border-gray-200
              aspect-video w-full">

    <img
      id="mainImage"
      class="w-full h-full object-contain sm:object-cover
             transition-all duration-700"
      src=""
      alt="Gallery Display"
    >
  </div>

  <!-- THUMBNAILS -->
  <div id="thumbnails"
       class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-2
              gap-3 overflow-y-auto
              max-h-[30vh] sm:max-h-[35vh] lg:max-h-full
              pr-1">
  </div>

</div>

<?php include 'includes/footer.php'; ?>

<script>
  const mainImage = document.getElementById('mainImage');
  const thumbnailsContainer = document.getElementById('thumbnails');

  let images = [];
  let currentIndex = 0;

  fetch('assets/data/gallery.json')
    .then(response => response.json())
    .then(data => {
      images = data.images;

      if (!images.length) return;

      // First image
      mainImage.src = images[0];

      images.forEach((src, index) => {
        const img = document.createElement('img');
        img.src = src;
        img.className = `
          cursor-pointer rounded-xl
          object-cover w-full aspect-video
          border border-gray-200
          hover:scale-105 transition duration-300
        `;

        img.addEventListener('click', () => {
          mainImage.src = src;
          currentIndex = index;
        });

        thumbnailsContainer.appendChild(img);
      });

      // Auto slide
      setInterval(() => {
        currentIndex = (currentIndex + 1) % images.length;
        mainImage.src = images[currentIndex];
      }, 3000);
    })
    .catch(err => console.error('Gallery JSON error:', err));
</script>
