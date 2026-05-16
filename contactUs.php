<?php include 'includes/header.php'; ?>

<section class="py-24 bg-gradient-to-b from-blue-50 to-white">
  <div class="max-w-7xl mx-auto px-6 ">

    <!-- GRID -->
    <div class="grid lg:grid-cols-2 gap-16 items-start">

      <!-- LEFT CONTENT -->
      <div class="text-center mx-auto">

  <h2 class="text-4xl font-bold text-gray-800 mb-4">
    Get in Touch
  </h2>

  <p class="text-gray-600 max-w-md mx-auto mb-10">
    Interested in bringing The Science Bus to your school?
    Have questions about our programs? We'd love to hear from you!
  </p>

  <!-- Info -->
  <div class="space-y-6 flex flex-col items-center justify-center">

    <div class="flex items-center gap-4 w-full max-w-xs md:max-w-sm">
      <div class="w-12 h-12 shrink-0 flex items-center justify-center 
                  rounded-xl bg-blue-100 text-blue-600 text-xl">
        📍
      </div>
      <div class="text-left">
        <h4 class="font-semibold text-gray-700">Location</h4>
        <p class="text-gray-600 text-sm">
          Indian Institute of Technology Kanpur
        </p>
      </div>
    </div>

    <div class="flex items-center gap-4 w-full max-w-xs md:max-w-sm">
      <div class="w-12 h-12 shrink-0 flex items-center justify-center 
                  rounded-xl bg-blue-100 text-blue-600 text-xl">
        ✉️
      </div>
      <div class="text-left">
        <h4 class="font-semibold text-gray-700">Email</h4>
        <p class="text-blue-600 text-sm font-medium">
          pshubhashish8@gmail.com
        </p>

      </div>
    </div>
    <div class="flex items-center gap-4 w-full max-w-xs md:max-w-sm">
      <div class="w-12 h-12 shrink-0 flex items-center justify-center 
                  rounded-xl bg-blue-100 text-blue-600 text-xl">
        ✉️
      </div>
      <div class="text-left">
        <h4 class="font-semibold text-gray-700">Phone</h4>
        <p class="text-blue-600 text-sm font-medium">
          9794370873
        </p>
      </div>
    </div>

</div>
</div>


      <!-- RIGHT FORM CARD -->
      <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10">
        <form id="contactForm" class="space-y-6">
          <div id="contactMessage" class="hidden rounded-lg border px-4 py-3 text-sm"></div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
              Name
            </label>
            <input name="name" type="text" required placeholder="Your name"
              class="w-full rounded-lg border border-gray-300 px-4 py-3
                     focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
              Email
            </label>
            <input name="email" type="email" required placeholder="your.email@example.com"
              class="w-full rounded-lg border border-gray-300 px-4 py-3
                     focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
              School Name
            </label>
            <input name="school" type="text" placeholder="Your school"
              class="w-full rounded-lg border border-gray-300 px-4 py-3
                     focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
              Message
            </label>
            <textarea name="message" rows="4" required placeholder="Tell us about your requirements..."
              class="w-full rounded-lg border border-gray-300 px-4 py-3
                     focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
          </div>

          <button type="submit"
            class="w-full py-3 rounded-xl font-medium text-white
                   bg-gradient-to-r from-cyan-500 to-blue-600
                   hover:from-cyan-600 hover:to-blue-700 transition">
            Send Message
          </button>

        </form>
      </div>

    </div>
  </div>
</section>
<?php include 'includes/footer.php'; ?>
<script>
document.getElementById('contactForm').addEventListener('submit', async function (event) {
  event.preventDefault();
  const box = document.getElementById('contactMessage');
  try {
    const response = await fetch('contact_ajax.php', { method: 'POST', body: new FormData(this) });
    const json = await response.json();
    if (!json.ok) throw new Error(json.message || 'Message failed');
    box.className = 'rounded-lg border px-4 py-3 text-sm bg-emerald-50 border-emerald-200 text-emerald-800';
    box.textContent = json.message;
    this.reset();
  } catch (error) {
    box.className = 'rounded-lg border px-4 py-3 text-sm bg-red-50 border-red-200 text-red-700';
    box.textContent = error.message;
  }
});
</script>
