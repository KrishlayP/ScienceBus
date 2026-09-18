<?php include 'includes/header.php'; ?>

<main class="min-h-[calc(100vh-126px)] bg-[linear-gradient(180deg,#eef7ff_0%,#ffffff_46%,#f7fbff_100%)] px-4 py-4 md:px-6 md:py-5">
  <section class="mx-auto max-w-[1840px]">
    <div id="galleryHeader" class="mb-6 flex flex-col gap-4 border-b border-blue-100 pb-5 md:flex-row md:items-end md:justify-between">
      <div>
        <p id="galleryEyebrow" class="text-sm font-semibold uppercase tracking-wide text-cyan-700">Browse Gallery</p>
        <h1 id="galleryTitle" class="mt-1 text-2xl font-bold text-slate-950 md:text-4xl">Locations</h1>
        <p id="gallerySubtitle" class="mt-2 max-w-2xl text-sm leading-6 text-slate-600 md:text-base">
          Select a location to view college-wise Science Bus visit photos.
        </p>
      </div>

      <button
        id="backBtn"
        type="button"
        class="hidden w-fit rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-cyan-300 hover:text-cyan-700"
      >
        &larr; Back
      </button>
    </div>

    <div
      id="galleryGrid"
      class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
    ></div>
  </section>
</main>

<div id="photoModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-slate-950/80 p-4">
  <div class="relative w-full max-w-5xl rounded-xl bg-white p-3 shadow-2xl">
    <button
      id="closeModal"
      type="button"
      class="absolute right-4 top-4 z-10 grid h-10 w-10 place-items-center rounded-full bg-white/90 text-2xl font-bold text-slate-800 shadow transition hover:bg-white"
      aria-label="Close photo"
    >
      &times;
    </button>
    <img id="modalImage" alt="" class="max-h-[82vh] w-full rounded-lg object-contain">
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const galleryGrid = document.getElementById('galleryGrid');
  const galleryTitle = document.getElementById('galleryTitle');
  const gallerySubtitle = document.getElementById('gallerySubtitle');
  const galleryEyebrow = document.getElementById('galleryEyebrow');
  const galleryHeader = document.getElementById('galleryHeader');
  const backBtn = document.getElementById('backBtn');
  const photoModal = document.getElementById('photoModal');
  const modalImage = document.getElementById('modalImage');
  const closeModal = document.getElementById('closeModal');

  let categories = [];
  let selectedCategory = null;
  let locationSlider = null;
  let locationSlideImages = [];
  let albumSlider = null;
  let albumSlideImages = [];

  function html(value) {
    return String(value || '').replace(/[&<>"']/g, char => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
    }[char]));
  }

  function categoryImages(category) {
    return (category.packages || []).flatMap(pkg => pkg.images || []);
  }

  function countPhotos(packages) {
    return (packages || []).reduce((total, pkg) => total + (pkg.images || []).length, 0);
  }

  function emptyMessage(text) {
    galleryGrid.innerHTML = '<p class="col-span-full rounded-xl border border-slate-200 bg-white p-8 text-center text-slate-500 shadow-sm">' + html(text) + '</p>';
  }

  function cardBase() {
    return 'group overflow-hidden rounded-xl border border-slate-200 bg-white text-left shadow-sm transition duration-200 hover:-translate-y-1 hover:border-cyan-300 hover:shadow-xl hover:shadow-blue-100';
  }

  function setGridMode(mode) {
    galleryGrid.className = 'grid gap-5';

    if (mode === 'colleges') {
      galleryGrid.className = 'space-y-5';
      return;
    }

    if (mode === 'photos') {
      galleryGrid.className += ' grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4';
      return;
    }

    galleryGrid.className += ' grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4';
  }

  function stopLocationSlider() {
    if (locationSlider) {
      clearInterval(locationSlider);
      locationSlider = null;
    }
    locationSlideImages = [];
  }

  function stopAlbumSlider() {
    if (albumSlider) {
      clearInterval(albumSlider);
      albumSlider = null;
    }
    albumSlideImages = [];
  }

  function randomSlideIndex(currentIndex) {
    if (locationSlideImages.length <= 1) {
      return 0;
    }

    let nextIndex = currentIndex;
    while (nextIndex === currentIndex) {
      nextIndex = Math.floor(Math.random() * locationSlideImages.length);
    }

    return nextIndex;
  }

  function addLocationViewer(category) {
    locationSlideImages = categoryImages(category);

    if (!locationSlideImages.length) {
      return null;
    }

    let activeIndex = 0;
    const layout = document.createElement('section');
    layout.className = 'grid gap-5 xl:grid-cols-[minmax(0,1.45fr)_minmax(520px,0.75fr)]';
    layout.innerHTML = `
      <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-blue-100/70">
        <div class="relative h-[300px] overflow-hidden bg-slate-950 sm:h-[430px] lg:h-[calc(100vh-180px)] lg:min-h-[380px] lg:max-h-[520px]">
          <img id="locationSlideImage" src="${html(locationSlideImages[0])}" alt="" class="h-full w-full object-cover transition duration-500">
          <span class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-slate-950/10 to-transparent"></span>

          <button id="locationPrev" type="button" class="absolute left-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full border border-white/25 bg-white/20 text-3xl leading-none text-white backdrop-blur transition hover:bg-white/30" aria-label="Previous location photo">&lsaquo;</button>
          <button id="locationNext" type="button" class="absolute right-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full border border-white/25 bg-white/20 text-3xl leading-none text-white backdrop-blur transition hover:bg-white/30" aria-label="Next location photo">&rsaquo;</button>

          <div class="absolute bottom-5 left-5 right-5 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
              <p class="text-sm font-semibold uppercase tracking-wide text-cyan-100">Location Highlights</p>
              <h2 class="mt-1 text-3xl font-bold text-white md:text-4xl">${html(category.name)}</h2>
            </div>
            <div class="flex flex-wrap gap-2">
              <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-bold uppercase tracking-wide text-cyan-800">${locationSlideImages.length} Photos</span>
              <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-bold uppercase tracking-wide text-blue-800">${(category.packages || []).length} Colleges</span>
              <span id="locationCounter" class="rounded-full bg-slate-950/70 px-3 py-1 text-xs font-bold uppercase tracking-wide text-white">1 / ${locationSlideImages.length}</span>
            </div>
          </div>
        </div>
      </article>

      <aside class="rounded-2xl border border-slate-200 bg-white/95 p-4 shadow-xl shadow-blue-100/60">
        <div class="mb-4 border-b border-slate-100 pb-4">
          <div class="flex items-start justify-between gap-3">
            <div>
              <p class="text-xs font-bold uppercase tracking-wide text-cyan-700">Colleges</p>
              <h3 class="mt-1 text-xl font-bold text-slate-950">Albums in ${html(category.name)}</h3>
            </div>
            <button type="button" data-gallery-back="locations" class="shrink-0 rounded-lg border border-blue-600 bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:border-blue-700 hover:bg-blue-700">&larr; Back</button>
          </div>
        </div>
        <div id="collegeCardPanel" class="grid max-h-[560px] grid-cols-1 gap-4 overflow-y-auto pr-1 sm:grid-cols-2"></div>
      </aside>
    `;

    galleryGrid.appendChild(layout);

    const slideImage = layout.querySelector('#locationSlideImage');
    const counter = layout.querySelector('#locationCounter');
    const prevButton = layout.querySelector('#locationPrev');
    const nextButton = layout.querySelector('#locationNext');

    function showSlide(index) {
      activeIndex = index;
      slideImage.style.opacity = '0.35';
      setTimeout(() => {
        slideImage.src = locationSlideImages[activeIndex];
        slideImage.style.opacity = '1';
        counter.textContent = (activeIndex + 1) + ' / ' + locationSlideImages.length;
      }, 180);
    }

    function showRandomSlide() {
      showSlide(randomSlideIndex(activeIndex));
    }

    prevButton.onclick = () => {
      clearInterval(locationSlider);
      showSlide((activeIndex - 1 + locationSlideImages.length) % locationSlideImages.length);
      locationSlider = setInterval(showRandomSlide, 3200);
    };

    nextButton.onclick = () => {
      clearInterval(locationSlider);
      showSlide((activeIndex + 1) % locationSlideImages.length);
      locationSlider = setInterval(showRandomSlide, 3200);
    };

    locationSlider = setInterval(showRandomSlide, 3200);
    layout.querySelector('[data-gallery-back="locations"]').onclick = showLocations;

    return layout.querySelector('#collegeCardPanel');
  }

  fetch('data_api.php?module=gallery&v=' + Date.now())
    .then(res => {
      if (!res.ok) {
        throw new Error('Gallery data unavailable');
      }
      return res.json();
    })
    .then(data => {
      categories = data.categories || [];
      if (!categories.length) {
        emptyMessage('No gallery albums available.');
        return;
      }
      showLocations();
    })
    .catch(() => {
      galleryTitle.textContent = 'Unable to load gallery';
      gallerySubtitle.textContent = 'Please try again after some time.';
      emptyMessage('Unable to load gallery data.');
    });

  function showLocations() {
    stopLocationSlider();
    stopAlbumSlider();
    window.scrollTo({top: 0, behavior: 'smooth'});
    selectedCategory = null;
    galleryEyebrow.textContent = 'Browse Gallery';
    galleryTitle.textContent = 'Locations';
    gallerySubtitle.textContent = 'Select a location to view college-wise Science Bus visit photos.';
    galleryHeader.classList.remove('hidden');
    backBtn.classList.add('hidden');
    backBtn.onclick = null;
    galleryGrid.innerHTML = '';
    setGridMode('locations');

    categories.forEach(category => {
      const packages = category.packages || [];
      const cover = categoryImages(category)[0] || '';
      const card = document.createElement('button');
      card.type = 'button';
      card.className = cardBase();
      card.innerHTML = `
        <span class="relative block aspect-[4/3] overflow-hidden bg-slate-100">
          ${cover ? `<img src="${html(cover)}" alt="" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">` : ''}
          <span class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></span>
          <span class="absolute left-4 top-4 rounded-full bg-white/95 px-3 py-1 text-xs font-bold text-cyan-800 shadow-sm">${packages.length} Colleges</span>
          <span class="absolute bottom-4 left-4 right-4 text-xl font-bold text-white">${html(category.name)}</span>
        </span>
        <span class="block p-4">
          <span class="block text-sm leading-6 text-slate-600">Open this location to explore college albums.</span>
          <span class="mt-3 inline-block rounded-full bg-cyan-50 px-3 py-1 text-xs font-bold uppercase tracking-wide text-cyan-800">${countPhotos(packages)} Photos</span>
        </span>
      `;
      card.onclick = () => showColleges(category);
      galleryGrid.appendChild(card);
    });
  }

  function showColleges(category) {
    stopLocationSlider();
    stopAlbumSlider();
    window.scrollTo({top: 0, behavior: 'smooth'});
    selectedCategory = category;
    galleryEyebrow.textContent = 'Location';
    galleryTitle.textContent = category.name;
    gallerySubtitle.textContent = 'Select a college to view all photos from this visit.';
    galleryHeader.classList.add('hidden');
    backBtn.classList.add('hidden');
    backBtn.onclick = showLocations;
    galleryGrid.innerHTML = '';
    setGridMode('colleges');

    const packages = category.packages || [];
    const collegePanel = addLocationViewer(category);

    if (!packages.length) {
      emptyMessage('No colleges available for this location.');
      return;
    }

    packages.forEach(pkg => {
      const images = pkg.images || [];
      const cover = images[0] || '';
      const card = document.createElement('button');
      card.type = 'button';
      card.className = cardBase() + ' min-w-0';
      card.innerHTML = `
        <span class="relative block aspect-[16/11] overflow-hidden bg-slate-100">
          ${cover ? `<img src="${html(cover)}" alt="" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">` : ''}
          <span class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/10 to-transparent"></span>
          <span class="absolute left-3 top-3 rounded-full bg-white/95 px-2.5 py-1 text-xs font-bold text-blue-800 shadow-sm">${images.length} Photos</span>
          <span class="absolute bottom-3 left-3 right-3 text-sm font-bold text-white">${html(pkg.name)}</span>
        </span>
        
      `;
      card.onclick = () => showPhotos(pkg);
      (collegePanel || galleryGrid).appendChild(card);
    });
  }

  function showPhotos(pkg) {
    stopLocationSlider();
    stopAlbumSlider();
    window.scrollTo({top: 0, behavior: 'smooth'});
    const images = pkg.images || [];
    galleryEyebrow.textContent = selectedCategory ? selectedCategory.name : 'Photos';
    galleryTitle.textContent = pkg.name;
    gallerySubtitle.textContent = 'Click any photo to preview it.';
    galleryHeader.classList.add('hidden');
    backBtn.classList.add('hidden');
    backBtn.onclick = () => showColleges(selectedCategory);
    galleryGrid.innerHTML = '';
    setGridMode('photos');

    if (!images.length) {
      emptyMessage('No photos in this college album.');
      return;
    }

    const photoPanel = addAlbumViewer(pkg, images);

    images.forEach(src => {
      const card = document.createElement('button');
      card.type = 'button';
      card.className = cardBase() + ' min-w-0';
      card.innerHTML = `
        <span class="block aspect-[4/3] overflow-hidden bg-slate-100">
          <img src="${html(src)}" alt="" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
        </span>
      `;
      card.onclick = () => openPhoto(src);
      (photoPanel || galleryGrid).appendChild(card);
    });
  }

  function addAlbumViewer(pkg, images) {
    albumSlideImages = images;
    let activeIndex = 0;

    const viewer = document.createElement('section');
    viewer.className = 'col-span-full grid gap-5 lg:grid-cols-[minmax(0,1.45fr)_minmax(520px,0.75fr)]';
    viewer.innerHTML = `
      <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-blue-100/70">
        <div class="relative h-[300px] overflow-hidden bg-slate-950 sm:h-[430px] lg:h-[calc(100vh-180px)] lg:min-h-[380px] lg:max-h-[520px]">
          <img id="albumSlideImage" src="${html(albumSlideImages[0])}" alt="" class="h-full w-full object-cover transition duration-500">
          <span class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-slate-950/10 to-transparent"></span>

          <button id="albumPrev" type="button" class="absolute left-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full border border-white/25 bg-white/20 text-3xl leading-none text-white backdrop-blur transition hover:bg-white/30" aria-label="Previous photo">&lsaquo;</button>
          <button id="albumNext" type="button" class="absolute right-4 top-1/2 grid h-11 w-11 -translate-y-1/2 place-items-center rounded-full border border-white/25 bg-white/20 text-3xl leading-none text-white backdrop-blur transition hover:bg-white/30" aria-label="Next photo">&rsaquo;</button>

          <div class="absolute bottom-5 left-5 right-5 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div class="min-w-0">
              <p class="text-sm font-semibold uppercase tracking-wide text-cyan-100">${html(selectedCategory ? selectedCategory.name : 'Photos')}</p>
              <h2 class="mt-1 text-2xl font-bold text-white md:text-4xl">${html(pkg.name)}</h2>
            </div>
            <div class="flex flex-wrap gap-2">
              <span class="rounded-full bg-white/90 px-3 py-1 text-xs font-bold uppercase tracking-wide text-cyan-800">${albumSlideImages.length} Photos</span>
              <span id="albumCounter" class="rounded-full bg-slate-950/70 px-3 py-1 text-xs font-bold uppercase tracking-wide text-white">1 / ${albumSlideImages.length}</span>
            </div>
          </div>
        </div>
      </article>

      <aside class="rounded-2xl border border-slate-200 bg-white/95 p-4 shadow-xl shadow-blue-100/60">
        <div class="mb-4 border-b border-slate-100 pb-4">
          <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
              <p class="text-xs font-bold uppercase tracking-wide text-cyan-700">Photos</p>
              <h3 class="mt-1 text-xl font-bold text-slate-950">Images in ${html(pkg.name)}</h3>
            </div>
            <button type="button" id="albumBack" class="shrink-0 rounded-lg border border-blue-600 bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:border-blue-700 hover:bg-blue-700">&larr; Back</button>
          </div>
        </div>
        <div id="albumPhotoPanel" class="grid max-h-[560px] grid-cols-1 gap-4 overflow-y-auto pr-1 sm:grid-cols-2"></div>
      </aside>
    `;

    galleryGrid.appendChild(viewer);

    const slideImage = viewer.querySelector('#albumSlideImage');
    const counter = viewer.querySelector('#albumCounter');

    function showSlide(index) {
      activeIndex = index;
      slideImage.style.opacity = '0.35';
      setTimeout(() => {
        slideImage.src = albumSlideImages[activeIndex];
        slideImage.style.opacity = '1';
        counter.textContent = (activeIndex + 1) + ' / ' + albumSlideImages.length;
      }, 180);
    }

    function nextSlide() {
      showSlide((activeIndex + 1) % albumSlideImages.length);
    }

    viewer.querySelector('#albumBack').onclick = () => showColleges(selectedCategory);
    viewer.querySelector('#albumPrev').onclick = () => {
      clearInterval(albumSlider);
      showSlide((activeIndex - 1 + albumSlideImages.length) % albumSlideImages.length);
      albumSlider = setInterval(nextSlide, 3200);
    };
    viewer.querySelector('#albumNext').onclick = () => {
      clearInterval(albumSlider);
      nextSlide();
      albumSlider = setInterval(nextSlide, 3200);
    };

    albumSlider = setInterval(nextSlide, 3200);

    return viewer.querySelector('#albumPhotoPanel');
  }

  function openPhoto(src) {
    modalImage.src = src;
    photoModal.classList.remove('hidden');
    photoModal.classList.add('flex');
  }

  function closePhoto() {
    photoModal.classList.add('hidden');
    photoModal.classList.remove('flex');
    modalImage.removeAttribute('src');
  }

  closeModal.onclick = closePhoto;
  photoModal.onclick = event => {
    if (event.target === photoModal) {
      closePhoto();
    }
  };
});
</script>
