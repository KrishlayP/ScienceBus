<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="bg-gradient-to-b from-blue-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

        <!-- Left Content -->
        <div>
            <span class="inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm mb-4">
                An IITK, CSTUP & UP Government Initiative
            </span>

            <h2 class="text-4xl md:text-5xl font-bold leading-tight mt-4">
                Bringing Science to <br>
                <span class="text-blue-600">Every Child’s Doorstep</span>
            </h2>

            <p class="text-gray-600 mt-6 max-w-xl">
                The Science Bus is a mobile science laboratory that travels to schools across
                Uttar Pradesh, making hands-on science education accessible to students who
                might not have access to well-equipped laboratories.
            </p>

            <div class="mt-8 flex gap-4">
                <a href="about.php"
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                    Learn More →
                </a>
                <a href="contact.php"
                   class="border border-blue-600 text-blue-600 px-6 py-3 rounded-lg font-medium hover:bg-blue-50 transition">
                    Contact Us
                </a>
            </div>
        </div>

        <!-- Right Slider -->
        <div class="relative">
            <div class="swiper rounded-2xl shadow-xl overflow-hidden">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="assets/images/slide1.jpg" class="w-full h-[380px] object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://www.istockphoto.com/photo/colorful-macaw-plumage-gm611171128-105107049?utm_source=pixabay&utm_medium=affiliate&utm_campaign=sponsored_photo&utm_content=adp_topbanner_media&utm_term=nature+feather" class="w-full h-[380px] object-cover">
                    </div>
                    <div class="swiper-slide">
                        <img src="assets/images/slide3.jpg" class="w-full h-[380px] object-cover">
                    </div>
                </div>

                <!-- Controls -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
