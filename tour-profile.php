<?php include 'includes/header.php'; ?>

<!-- ================= HERO ================= -->
<section class="bg-gradient-to-b from-blue-50 to-white py-3">
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-5 text-center">

<p class="text-sm uppercase tracking-widest text-blue-600 mb-3 font-medium">
Our Journey Across Uttar Pradesh
</p>

<h1 class="text-xl sm:text-2xl md:text-3xl font-semibold max-w-3xl mx-auto">
From December 2018 to Till now, The Science Bus traveled across Uttar Pradesh,
bringing science education to thousands.
</h1>

<div class="mt-10 sm:mt-16 grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">

<div class="bg-white rounded-2xl p-6 border border-blue-400 shadow-sm hover:shadow-lg hover:-translate-y-2 transition">
<p class="text-3xl font-bold text-slate-900">18</p>
<p class="text-slate-500 mt-1">Total Tours</p>
</div>

<div class="bg-white rounded-2xl p-6 border border-blue-400 shadow-sm hover:shadow-lg hover:-translate-y-2 transition">
<p class="text-3xl font-bold text-slate-900">60,000 +</p>
<p class="text-slate-500 mt-1">People Benefitted</p>
</div>

<div class="bg-white rounded-2xl p-6 border border-blue-400 shadow-sm hover:shadow-lg hover:-translate-y-2 transition">
<p class="text-3xl font-bold text-slate-900">8</p>
<p class="text-slate-500 mt-1">Districts Covered</p>
</div>

<div class="bg-white rounded-2xl p-6 border border-blue-400 shadow-sm hover:shadow-lg hover:-translate-y-2 transition">
<p class="text-3xl font-bold text-slate-900">2018–Till Date</p>
<p class="text-slate-500 mt-1">Active Period</p>
</div>

</div>
</div>
</section>


<!-- ================= TOUR HISTORY ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-10">

<div class="bg-white rounded-2xl shadow-lg border overflow-hidden">

<div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
<h2 class="text-white font-semibold text-lg">Complete Tour History</h2>
</div>


<!-- TABLE WRAPPER -->
<div class="overflow-x-auto flex ">

<div class="w-full max-w-5xl">

<!-- TABLE HEADER -->
<div class="grid grid-cols-12 gap-4 px-6 py-3 text-sm font-semibold bg-slate-100 text-gray-700">

<div class="">S.No</div>

<div class="col-span-4 md:col-span-3">
District
</div>

<div class="col-span-6 md:col-span-8">
Description
</div>

</div>

<div id="tourRows" class="divide-y"></div>

</div>
</div>


<div class="text-center py-6">
<button id="tourBtn"
class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 transition">
Show More ↓
</button>
</div>

</div>
</section>


<!-- ================= CTA ================= -->
<section class="py-6 bg-white text-center px-4">

<h2 class="text-xl sm:text-2xl md:text-3xl font-semibold">
Want The Science Bus at Your School?
</h2>

<p class="mt-4 text-gray-600 max-w-2xl mx-auto">
Contact us today to schedule a visit and bring hands-on science education.
</p>

<div class="mt-6 sm:mt-8">

<button type="button"
onclick="openVisitModal()"
class="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition">

Schedule a Visit →

</button>

</div>

</section>


<!-- ================= MODAL ================= -->
<div id="visitModal"
class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50 px-4">

<div class="bg-white max-w-2xl w-full p-6 sm:p-8 rounded-2xl relative max-h-[90vh] overflow-y-auto">

<button onclick="closeVisitModal()"
class="absolute top-4 right-4 text-2xl text-gray-400">&times;</button>

<h2 class="text-2xl font-semibold mb-6">
Schedule a Visit
</h2>

<form class="grid grid-cols-1 md:grid-cols-2 gap-4">

<input class="border p-3 rounded-lg" placeholder="School Name">

<input class="border p-3 rounded-lg" placeholder="Contact Person">

<input class="border p-3 rounded-lg" placeholder="Email">

<input class="border p-3 rounded-lg" placeholder="Phone">

<input type="date" class="border p-3 rounded-lg">

<input type="time" class="border p-3 rounded-lg">

<input class="border p-3 rounded-lg md:col-span-2" placeholder="No. of Students">

<textarea class="border p-3 rounded-lg md:col-span-2"
rows="3"
placeholder="Additional Notes"></textarea>

<div class="md:col-span-2 text-center">

<button class="bg-blue-600 text-white px-8 py-3 rounded-xl">
Submit
</button>

</div>

</form>

</div>
</div>


<?php include 'includes/footer.php'; ?>


<!-- ================= SCRIPT ================= -->
<script>

const tours = [

{no:1,district:"Chitrakoot",desc:"This initiative has reached around 4,500 students in Chitrakoot, fostering curiosity and hands-on learning in science and technology."},

{no:2,district:"Kumbh Mela, Prayagraj",desc:"This event at the world-famous Kumbh Mela in Prayagraj has benefited around 30,000 people, offering spiritual, social, and economic opportunities to visitors and local communities."},

{no:3,district:"Ballia",desc:"In Ballia, the initiative benefited around 2,000 students, promoting practical learning and scientific awareness."},

{no:4,district:"Meerut",desc:"In Meerut, the initiative benefited around 15,000 students, encouraging hands-on learning and scientific curiosity."},

{no:5,district:"Chandauli",desc:"In Chandauli, the initiative benefited around 1,800 students, fostering interest in science through interactive and practical learning experiences"},

{no:6,district:"Kanpur",desc:"In Kanpur, the initiative benefited around 250 students, promoting hands-on science learning and practical exposure."},

{no:7,district:"Etawah",desc:"In Etawah, the initiative benefited around 1,500 students, enhancing scientific understanding through practical and interactive sessions."},

{no:8,district:"Jaunpur Mela",desc:"At the Jaunpur Mela, the initiative benefited around 4,000 people, spreading awareness and community engagement through interactive outreach activities."},

];


let visible = 5;

const rows = document.getElementById("tourRows");
const btn = document.getElementById("tourBtn");


function render(){

rows.innerHTML = tours.slice(0,visible).map(t=>`

<div class="grid grid-cols-12 gap-4 px-6 py-4 text-sm items-start hover:bg-slate-50 transition">

<div class="col-span-2 md:col-span-1 font-medium text-gray-700">
${t.no}
</div>

<div class="col-span-4 md:col-span-3 font-medium text-gray-800">
${t.district}
</div>

<div class="col-span-6 md:col-span-8 text-gray-600 leading-relaxed">
${t.desc}
</div>

</div>

`).join("");

btn.textContent =
visible < tours.length
? "Show More ↓"
: "Show Less ↑";

}


btn.onclick = () => {

visible =
visible < tours.length
? tours.length
: 5;

render();

}


render();


/* MODAL */

function openVisitModal(){

const m=document.getElementById("visitModal");

m.classList.remove("hidden");
m.classList.add("flex");

}

function closeVisitModal(){

const m=document.getElementById("visitModal");

m.classList.add("hidden");
m.classList.remove("flex");

}

document.getElementById("visitModal").onclick=e=>{

if(e.target.id==="visitModal")
closeVisitModal();

};

</script>