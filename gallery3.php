<?php include 'includes/header.php';?>

<div class="grid grid-cols-3 gap-4 h-[calc(98vh-160px)] mt-1 mb-5 ">

  <!-- MAIN IMAGE -->
  <div class="col-span-2 flex items-center justify-center bg-gray-100 rounded-base overflow-hidden">
    <img
      id="mainImage"
      class="max-w-full max-h-full object-contain transition-all duration-500"
      src=""
      alt=""
    >
  </div>

  <!-- THUMBNAILS -->
  <div id="thumbnails" class="grid grid-cols-2 gap-3 overflow-y-auto"></div>

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

      // Set first image
      mainImage.src = images[0];

      // Create thumbnails
      images.forEach((src, index) => {
        const img = document.createElement('img');
        img.src = src;
        img.className = 'thumb cursor-pointer rounded-base';
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


