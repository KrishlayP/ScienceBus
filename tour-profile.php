
<?php include 'includes/header.php'; ?>
<!-- ================= HERO ================= -->
<section class="bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600">
  <div class="max-w-7xl mx-auto px-6 py-20 text-center text-white">
    <p class="text-sm uppercase text-blue-100 mb-3">
      Our Journey Across Uttar Pradesh
    </p>
    <h1 class="text-2xl md:text-3xl font-semibold max-w-3xl mx-auto">
      From December 2018 to March 2020, The Science Bus traveled across Uttar Pradesh,
      bringing science education to thousands.
    </h1>

    <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <div class="bg-white/10 rounded-2xl p-6">
        <p class="text-3xl font-bold">18</p>
        <p class="text-blue-100">Total Tours</p>
      </div>
      <div class="bg-white/10 rounded-2xl p-6">
        <p class="text-3xl font-bold">87,730</p>
        <p class="text-blue-100">People Benefitted</p>
      </div>
      <div class="bg-white/10 rounded-2xl p-6">
        <p class="text-3xl font-bold">18</p>
        <p class="text-blue-100">Districts Covered</p>
      </div>
      <div class="bg-white/10 rounded-2xl p-6">
        <p class="text-3xl font-bold">2018–2020</p>
        <p class="text-blue-100">Active Period</p>
      </div>
    </div>
  </div>
</section>

<!-- ================= TOUR HISTORY ================= -->
<section class="max-w-7xl mx-auto px-6 py-10">
  <div class="bg-white rounded-2xl shadow-lg border overflow-hidden">

    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
      <h2 class="text-white font-semibold text-lg">Complete Tour History</h2>
    </div>

    <div class="grid grid-cols-12 gap-4 px-6 py-3 text-sm font-medium bg-slate-100">
      <div class="col-span-1">S.No</div>
      <div class="col-span-2">Tour Start</div>
      <div class="col-span-2">Tour End</div>
      <div class="col-span-3">District</div>
      <div class="col-span-4">Description</div>
    </div>

    <div id="tourRows" class="divide-y"></div>

    <div class="text-center py-6">
      <button id="tourBtn"
        class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 transition">
        Show More ↓
      </button>
    </div>
  </div>
</section>

<!-- ================= CTA ================= -->
<section class="py-4 bg-white text-center">
  <h2 class="text-2xl md:text-3xl font-semibold">
    Want The Science Bus at Your School?
  </h2>
  <p class="mt-4 text-gray-600">
    Contact us today to schedule a visit and bring hands-on science education.
  </p>
  <div class="mt-8">
    <button type="button"
      onclick="openVisitModal()"
      class="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition">
      Schedule a Visit →
    </button>
  </div>
</section>

<!-- ================= MODAL ================= -->
<div id="visitModal"
     class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">

  <div class="bg-white max-w-2xl w-full p-8 rounded-2xl relative">
    <button onclick="closeVisitModal()"
      class="absolute top-4 right-4 text-2xl text-gray-400">&times;</button>

    <h2 class="text-2xl font-semibold mb-6">Schedule a Visit</h2>

    <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <input class="border p-3 rounded-lg" placeholder="School Name">
      <input class="border p-3 rounded-lg" placeholder="Contact Person">
      <input class="border p-3 rounded-lg" placeholder="Email">
      <input class="border p-3 rounded-lg" placeholder="Phone">
      <input type="date" class="border p-3 rounded-lg">
      <input type="time" class="border p-3 rounded-lg">
      <input class="border p-3 rounded-lg md:col-span-2" placeholder="No. of Students">
      <textarea class="border p-3 rounded-lg md:col-span-2" rows="3"
        placeholder="Additional Notes"></textarea>

      <div class="md:col-span-2 text-center">
        <button class="bg-blue-600 text-white px-8 py-3 rounded-xl">
          Submit
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ================= FOOTER ================= -->
<?php include 'includes/footer.php'; ?>

<!-- ================= SCRIPT ================= -->
<script>
const tours = [
 {no:1,start:"16/12/2018",end:"31/12/2018",district:"Chitrakoot",desc:"4500 students benefitted"},
 {no:2,start:"20/01/2019",end:"04/03/2019",district:"Kumbh Mela, Prayagraj",desc:"30000 population benefitted"},
 {no:3,start:"31/03/2019",end:"20/04/2019",district:"Ballia",desc:"2000 students benefitted"},
 {no:4,start:"27/04/2019",end:"27/05/2019",district:"Meerut",desc:"15000 students benefitted"},
 {no:5,start:"16/07/2019",end:"31/07/2019",district:"Chandauli",desc:"1800 students benefitted"},
 {no:6,start:"10/08/2019",end:"10/08/2019",district:"Kanpur",desc:"250 students benefitted"},
 {no:7,start:"19/08/2019",end:"03/09/2019",district:"Etawah",desc:"1500 students benefitted"},
 {no:8,start:"06/09/2019",end:"11/09/2019",district:"Jaunpur Mela",desc:"4000 population benefitted"},
];

let visible = 5;
const rows = document.getElementById("tourRows");
const btn = document.getElementById("tourBtn");

function render() {
 rows.innerHTML = tours.slice(0,visible).map(t=>`
  <div class="grid grid-cols-12 gap-4 px-6 py-4">
    <div class="col-span-1">${t.no}</div>
    <div class="col-span-2">${t.start}</div>
    <div class="col-span-2">${t.end}</div>
    <div class="col-span-3">${t.district}</div>
    <div class="col-span-4">${t.desc}</div>
  </div>
 `).join("");
 btn.textContent = visible < tours.length ? "Show More ↓" : "Show Less ↑";
}
btn.onclick=()=>{visible=visible<tours.length?tours.length:5;render();}
render();

function openVisitModal(){
 const m=document.getElementById("visitModal");
 m.classList.remove("hidden"); m.classList.add("flex");
}
function closeVisitModal(){
 const m=document.getElementById("visitModal");
 m.classList.add("hidden"); m.classList.remove("flex");
}
document.getElementById("visitModal").onclick=e=>{
 if(e.target.id==="visitModal") closeVisitModal();
};
</script>

</body>

