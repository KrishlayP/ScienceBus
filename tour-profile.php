<?php include 'includes/header.php'; ?>

<!-- ================= TOP BAR ================= -->
<header class="bg-white border-b">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <a href="/" class="text-blue-600 font-medium">← Back to Home</a>

    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white">🚌</div>
      <div>
        <p class="font-semibold">Tour Profile</p>
        <p class="text-xs text-gray-500">Complete Tour History</p>
      </div>
    </div>
  </div>
</header>

<!-- ================= HERO ================= -->
<section class="bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600">
  <div class="max-w-7xl mx-auto px-6 py-20 text-center text-white">
    <p class="text-sm uppercase text-blue-100 mb-3">
      Our Journey Across Uttar Pradesh
    </p>
    <h1 class="text-2xl md:text-3xl font-semibold max-w-3xl mx-auto">
      From December 2018 to March 2020, The Science Bus traveled across Uttar Pradesh,
      bringing science education to thousands of students and communities.
    </h1>

    <!-- Stats -->
    <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <div class="bg-white/10 rounded-2xl p-6 text-left">
        <p class="text-3xl font-bold">18</p>
        <p class="text-blue-100">Total Tours</p>
      </div>
      <div class="bg-white/10 rounded-2xl p-6 text-left">
        <p class="text-3xl font-bold">87,730</p>
        <p class="text-blue-100">People Benefitted</p>
      </div>
      <div class="bg-white/10 rounded-2xl p-6 text-left">
        <p class="text-3xl font-bold">18</p>
        <p class="text-blue-100">Districts Covered</p>
      </div>
      <div class="bg-white/10 rounded-2xl p-6 text-left">
        <p class="text-3xl font-bold">2018–2020</p>
        <p class="text-blue-100">Active Period</p>
      </div>
    </div>
  </div>
</section>

<!-- ================= TOUR HISTORY ================= -->
<section class="max-w-7xl mx-auto px-6 py-24">

  <div class="bg-white rounded-2xl shadow-lg overflow-hidden border">

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
      <h2 class="text-white font-semibold text-lg">Complete Tour History</h2>
    </div>

    <!-- Column Headings -->
    <div class="grid grid-cols-12 gap-4 px-6 py-3 text-sm font-medium text-gray-600 bg-slate-100">
      <div class="col-span-1">S.No</div>
      <div class="col-span-2">Tour Start</div>
      <div class="col-span-2">Tour End</div>
      <div class="col-span-3">District</div>
      <div class="col-span-4">Description</div>
    </div>

    <!-- Rows -->
    <div id="tourRows" class="divide-y"></div>

    <!-- Button -->
    <div class="text-center py-6">
      <button
        id="tourBtn"
        class="inline-flex items-center gap-2
               rounded-xl bg-blue-600 px-8 py-3
               text-white font-medium hover:bg-blue-700 transition">
        Show More ↓
      </button>
    </div>
  </div>

</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-slate-900 text-slate-400 text-center py-6 text-sm">
  © 2025 The Science Bus. All rights reserved.
</footer>

<!-- ================= SCRIPT ================= -->
<script>
  const tours = [
    { no: 1, start:"16/12/2018", end:"31/12/2018", district:"Chitrakoot", desc:"4500 students benefitted" },
    { no: 2, start:"20/01/2019", end:"04/03/2019", district:"Kumbh Mela, 2019, Prayagraj", desc:"30000 general population benefitted" },
    { no: 3, start:"31/03/2019", end:"20/04/2019", district:"Ballia", desc:"2000 students benefitted" },
    { no: 4, start:"27/04/2019", end:"27/05/2019", district:"Meerut", desc:"15000 students benefitted" },
    { no: 5, start:"16/07/2019", end:"31/07/2019", district:"Chandauli", desc:"1800 students benefitted" },
    { no: 6, start:"10/08/2019", end:"10/08/2019", district:"Kanpur", desc:"250 students benefitted at Khalsa Inter College, Govind Nagar, Kanpur" },
    { no: 7, start:"19/08/2019", end:"03/09/2019", district:"Etawah", desc:"1500 students benefitted" },
    { no: 8, start:"06/09/2019", end:"11/09/2019", district:"Bhadauchh Mela, Jaunpur", desc:"4000 general population benefitted", highlight:true },
    { no: 9, start:"15/09/2019", end:"18/09/2019", district:"Gughal Mela, Saharanpur", desc:"2000 general population benefitted" },
    { no:10, start:"01/10/2019", end:"25/10/2019", district:"Sandila", desc:"7000 students benefitted" },
    { no:11, start:"13/11/2019", end:"28/11/2019", district:"Jalaun", desc:"250 students benefitted" },
    { no:12, start:"04/10/2019", end:"14/10/2019", district:"Gorakhpur", desc:"4200 general population benefitted" },
    { no:13, start:"10/01/2020", end:"15/01/2020", district:"Gorakhpur Mahotsav 2020", desc:"3500 general population benefitted" },
    { no:14, start:"16/01/2020", end:"25/01/2020", district:"Deoria Mahotsav 2020", desc:"8500 general population benefitted" },
    { no:15, start:"27/01/2020", end:"30/01/2020", district:"Amroha", desc:"1200 students benefitted" },
    { no:16, start:"05/02/2020", end:"06/02/2020", district:"Rampur", desc:"500 students benefitted" },
    { no:17, start:"20/02/2020", end:"24/02/2020", district:"Kalinjar Mahotsav, Banda", desc:"30000 general population benefitted" },
    { no:18, start:"01/03/2020", end:"16/03/2020", district:"Ghaziabad", desc:"1500 students benefitted" }
  ];

  const INITIAL = 6;   // pehle 6 rows dikhenge
  let visible = INITIAL;

  const rowsEl = document.getElementById("tourRows");
  const btn = document.getElementById("tourBtn");

  function render() {
    rowsEl.innerHTML = tours.slice(0, visible).map(t => `
      <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center
                  ${t.highlight ? 'bg-cyan-50' : 'bg-white'}
                  hover:bg-slate-50 transition">
        <div class="col-span-1 text-gray-600">${t.no}</div>
        <div class="col-span-2 flex items-center gap-2">📅 ${t.start}</div>
        <div class="col-span-2 flex items-center gap-2">📅 ${t.end}</div>
        <div class="col-span-3 flex items-center gap-2 font-medium">📍 ${t.district}</div>
        <div class="col-span-4 text-gray-700">${t.desc}</div>
      </div>
    `).join("");

    btn.textContent = visible < tours.length ? "Show More ↓" : "Show Less ↑";
  }

  btn.onclick = () => {
    visible = visible < tours.length ? tours.length : INITIAL;
    render();
  };

  render();
</script>


</body>
</html>
