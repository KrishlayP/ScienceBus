<?php 
include 'includes/header.php'; 
require_once 'includes/data.php';
$teamData = load_team_data();
?>

<section class="bg-gradient-to-b from-blue-50 to-white py-12" id="team">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block bg-blue-100 text-blue-700 px-6 py-2 rounded-full text-sm font-medium mb-6">
            Meet Our Team
        </span>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-16">
            Dedicated professionals committed to making science education accessible to all.
        </p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
    <?php foreach ($teamData['main_team'] as $member): ?>
        <div class="group bg-white rounded-3xl p-8 border-2 border-blue-100 shadow-sm transition-all duration-300 hover:-translate-y-3 hover:shadow-xl hover:border-blue-400">
            <img src="<?= $member['image'] ?>" 
                 class="mx-auto w-32 h-32 rounded-full object-cover ring-8 ring-gray-100 group-hover:ring-blue-400 transition-all duration-300">
            
            <h4 class="text-xl font-bold mt-8 text-gray-800"><?= $member['name'] ?></h4>
            <p class="text-blue-600 font-semibold mt-1"><?= $member['role'] ?></p>
            <p class="text-gray-500 text-sm mt-1"><?= $member['org'] ?></p>
            <p class="mt-6 text-sm text-blue-600 font-medium flex item-center gap-2 justify-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5" viewBox="0 0 512 512"><path d="M48 64c-26.5 0-48 21.5-48 48 0 15.1 7.1 29.3 19.2 38.4l208 156c17.1 12.8 40.5 12.8 57.6 0l208-156c12.1-9.1 19.2-23.3 19.2-38.4 0-26.5-21.5-48-48-48L48 64zM0 196L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-188-198.4 148.8c-34.1 25.6-81.1 25.6-115.2 0L0 196z"/></svg><?= $member['email'] ?></p>
        </div>
    <?php endforeach; ?>
</div>
    </div>
</section>

<section class="bg-gradient-to-b from-white to-blue-50 py-10">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">
            <span class="inline-block bg-blue-100 text-blue-700 px-6 py-2 rounded-full text-sm font-medium mb-4">
                Educator Team
            </span>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Educators responsible for hands-on science demonstrations and learning.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php foreach ($teamData['educator_team'] as $member): ?>
                <div class="group bg-white rounded-3xl p-8 border-2 border-blue-100 text-center shadow-sm transition-all duration-300 hover:-translate-y-3 hover:shadow-xl hover:border-blue-400">
                    
                    <img src="<?= $member['image'] ?>" 
                         class="mx-auto w-32 h-32 rounded-full object-cover ring-4 ring-gray-200 group-hover:ring-blue-300 transition">

                    <h4 class="text-lg font-semibold text-gray-800 mt-6"><?= $member['name'] ?></h4>
                    <p class="mt-2 text-blue-600 font-medium"><?= $member['role'] ?></p>

                    <p class="text-gray-500 text-sm mt-1">
                        <?= !empty($member['contact']) ? "📞 ".$member['contact'] : "📞 XXXXXXXXXX" ?>
                    </p>

                    <p class="mt-3 text-xs text-blue-600 flex items-center gap-2 justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 512 512">
                            <path d="M48 64c-26.5 0-48 21.5-48 48 0 15.1 7.1 29.3 19.2 38.4l208 156c17.1 12.8 40.5 12.8 57.6 0l208-156c12.1-9.1 19.2-23.3 19.2-38.4 0-26.5-21.5-48-48-48L48 64z"/>
                        </svg>
                        <?= $member['email'] ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<section class="bg-gradient-to-b from-blue-50 to-white py-10">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">
            <span class="inline-block bg-blue-100 text-blue-700 px-6 py-2 rounded-full text-sm font-medium mb-4">
                Operational Team
            </span>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                The backbone team ensuring smooth operations of The Science Bus.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php foreach ($teamData['operational_team'] as $member): ?>
                <div class="group bg-white rounded-3xl p-8 border-2 border-blue-100 text-center shadow-sm transition-all duration-300 hover:-translate-y-3 hover:shadow-xl hover:border-blue-400">
                    
                    <img src="<?= $member['image'] ?>" 
                         class="mx-auto w-32 h-32 rounded-full object-cover ring-4 ring-gray-200 group-hover:ring-blue-300 transition">

                    <h4 class="text-lg font-semibold text-gray-800 mt-6"><?= $member['name'] ?></h4>
                    <p class="mt-2 text-blue-600 font-medium"><?= $member['role'] ?></p>

                    <p class="text-gray-500 text-sm mt-1">
                        <?= !empty($member['contact']) ? "📞 ".$member['contact'] : "📞 XXXXXXXXXX" ?>
                    </p>

                    <p class="mt-3 text-xs text-blue-600 flex items-center gap-2 justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 512 512">
                            <path d="M48 64c-26.5 0-48 21.5-48 48 0 15.1 7.1 29.3 19.2 38.4l208 156c17.1 12.8 40.5 12.8 57.6 0l208-156c12.1-9.1 19.2-23.3 19.2-38.4 0-26.5-21.5-48-48-48L48 64z"/>
                        </svg>
                        <?= $member['email'] ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>



<?php include 'includes/footer.php'; ?>
