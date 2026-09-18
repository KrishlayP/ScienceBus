<?php
require_once __DIR__ . '/includes/data.php';
$profile = load_tour_profile_data();
$stats = $profile['stats'];
$tours = $profile['tours'];
include 'includes/header.php';
?>

<section class="bg-gradient-to-b from-blue-50 to-white py-8">
  <div class="mx-auto max-w-7xl px-4 text-center sm:px-6">
    <p class="mb-3 text-sm font-semibold uppercase tracking-widest text-blue-600">Our Journey Across Uttar Pradesh</p>
    <h1 class="mx-auto max-w-3xl text-xl font-semibold leading-snug text-slate-950 sm:text-2xl md:text-3xl">
      From December 2018 to till now, The Science Bus traveled across Uttar Pradesh, bringing science education to thousands.
    </h1>

    <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
      <div class="rounded-xl border border-blue-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <p class="text-3xl font-bold text-slate-900"><?= e($stats['total_tours']) ?></p>
        <p class="mt-1 text-slate-500">Total Tours</p>
      </div>
      <div class="rounded-xl border border-blue-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <p class="text-3xl font-bold text-slate-900"><?= e($stats['people_benefitted']) ?></p>
        <p class="mt-1 text-slate-500">People Benefitted</p>
      </div>
      <div class="rounded-xl border border-blue-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <p class="text-3xl font-bold text-slate-900"><?= e($stats['districts_covered']) ?></p>
        <p class="mt-1 text-slate-500">Districts Covered</p>
      </div>
      <div class="rounded-xl border border-blue-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
        <p class="text-3xl font-bold text-slate-900"><?= e($stats['active_period']) ?></p>
        <p class="mt-1 text-slate-500">Active Period</p>
      </div>
    </div>
  </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
  <div class="overflow-hidden rounded-xl border bg-white shadow-lg">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
      <h2 class="font-semibold text-white">Complete Tour History</h2>
    </div>

    <div class="overflow-x-auto">
      <div class="min-w-[760px]">
        <div class="grid grid-cols-12 gap-4 bg-slate-100 px-6 py-3 text-sm font-semibold text-gray-700">
          <div>S.No</div>
          <div class="col-span-2">Tour Start</div>
          <div class="col-span-2">Tour End</div>
          <div class="col-span-3">District</div>
          <div class="col-span-4">Description</div>
        </div>
        <div id="tourRows" class="divide-y"></div>
      </div>
    </div>

    <div class="py-6 text-center">
      <button id="tourBtn" class="rounded-xl bg-blue-600 px-8 py-3 text-white transition hover:bg-blue-700">Show More &darr;</button>
    </div>
  </div>
</section>

<section class="bg-white px-4 py-8 text-center">
  <h2 class="text-xl font-semibold sm:text-2xl md:text-3xl">Want The Science Bus at Your School?</h2>
  <p class="mx-auto mt-4 max-w-2xl text-gray-600">Contact us today to schedule a visit and bring hands-on science education.</p>
  <button type="button" onclick="openVisitModal()" class="mt-6 rounded-xl bg-blue-600 px-8 py-4 text-white transition hover:bg-blue-700">
    Schedule a Visit &rarr;
  </button>
</section>

<div id="visitModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">
  <div class="relative max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white p-6 sm:p-8">
    <button onclick="closeVisitModal()" class="absolute right-4 top-4 text-2xl text-gray-400">&times;</button>
    <h2 class="mb-6 text-2xl font-semibold">Schedule a Visit</h2>
    <form class="grid grid-cols-1 gap-4 md:grid-cols-2">
      <input class="rounded-lg border p-3" placeholder="School Name">
      <input class="rounded-lg border p-3" placeholder="Contact Person">
      <input class="rounded-lg border p-3" placeholder="Email">
      <input class="rounded-lg border p-3" placeholder="Phone">
      <input type="date" class="rounded-lg border p-3">
      <input type="time" class="rounded-lg border p-3">
      <input class="rounded-lg border p-3 md:col-span-2" placeholder="No. of Students">
      <textarea class="rounded-lg border p-3 md:col-span-2" rows="3" placeholder="Additional Notes"></textarea>
      <div class="text-center md:col-span-2">
        <button class="rounded-xl bg-blue-600 px-8 py-3 text-white">Submit</button>
      </div>
    </form>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
const tours = <?= json_encode(array_values($tours), JSON_UNESCAPED_UNICODE) ?>;
let visible = 5;
const rows = document.getElementById('tourRows');
const btn = document.getElementById('tourBtn');

function html(value) {
  return String(value || '').replace(/[&<>"']/g, char => ({
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  }[char]));
}

function render() {
  rows.innerHTML = tours.slice(0, visible).map((tour, index) => `
    <div class="grid grid-cols-12 gap-4 px-6 py-4 text-sm transition hover:bg-slate-50">
      <div class="font-medium text-gray-700">${index + 1}</div>
      <div class="col-span-2 text-gray-600">${html(tour.tour_start)}</div>
      <div class="col-span-2 text-gray-600">${html(tour.tour_end)}</div>
      <div class="col-span-3 font-medium text-gray-800">${html(tour.district)}</div>
      <div class="col-span-4 leading-relaxed text-gray-600">${html(tour.description)}</div>
    </div>
  `).join('');

  btn.hidden = tours.length <= 5;
  btn.innerHTML = visible < tours.length ? 'Show More &darr;' : 'Show Less &uarr;';
}

btn.onclick = () => {
  visible = visible < tours.length ? tours.length : 5;
  render();
};

function openVisitModal() {
  const modal = document.getElementById('visitModal');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closeVisitModal() {
  const modal = document.getElementById('visitModal');
  modal.classList.add('hidden');
  modal.classList.remove('flex');
}

render();
</script>
