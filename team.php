<?php 
include 'includes/header.php'; 

// 1. Define the Team Data
$teamData = [
    "main_team" => [
        [
            "name" => "Prof. Deepu Philip",
            "role" => "Professor, DOMS Department",
            "org" => "IIT Kanpur",
            "email" => "dphilip@iitk.ac.in",
            "image" => "assets/image/Team/dphilip.jpg"
        ],
        [
            "name" => "Dr. Sumit Kumar Srivastava",
            "role" => "Scientific Officer",
            "org" => "C.S.T Department, UP",
            "email" => "sumit.astro.physics@gmail.com",
            "image" => "assets/images/team2.jpg"
        ],
        [
            "name" => "Rachna Agrawal",
            "role" => "Project Executive Officer",
            "org" => "IIT Kanpur",
            "email" => "rachna@iitk.ac.in",
            "image" => "assets/image/Team/rachna.jpg"
        ]
    ],
    "support_team" => [
        [
            "name" => "Mr. Ashish Tripathi",
            "role" => "Operational Manager",
            "org" => "IIT Kanpur",
            "email" => "ashishkt@iitk.ac.in",
            "contact" => "",
            "image" => "assets/images/support1.jpg"
        ],
        [
            "name" => "Mr. Subhashish Panday",
            "role" => "Lab Technician",
            "org" => "",
            "email" => "pshubhashish8@gmail.com",
            "contact" => "9794370873",
            "image" => "assets/image/Team/Shubhashish.jpeg"
        ],
        [
            "name" => "Mr. Devendra Mishra",
            "role" => "Bus Driver",
            "org" => "",
            "email" => "devendramishra225@gmail.com",
            "contact" => "9838577697",
            "image" => "assets/image/Team/devendra.jpeg"
        ],
        [
            "name" => "Mr. Rinku",
            "role" => "Equipment Specialist",
            "org" => "",
            "email" => "rinkugangwar9991@gmail.com",
            "contact" => "9451237404",
            "image" => "assets/image/Team/rinku.jpeg"
        ],
        [
            "name" => "Mr. Brikesh Kumar",
            "role" => "Lab Assistant",
            "org" => "",
            "email" => "brikesh.kumar.0108@gmail.com",
            "contact" => "7860134226",
            "image" => "assets/image/Team/brikesh.jpeg"
        ]
    ]
];
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
            <p class="mt-6 text-sm text-blue-600 font-medium">✉️ <?= $member['email'] ?></p>
        </div>
    <?php endforeach; ?>
</div>
    </div>
</section>

<section class="bg-gradient-to-b from-white to-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="inline-block bg-blue-100 text-blue-700 px-6 py-2 rounded-full text-sm font-medium mb-4">
                Support Team
            </span>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                The dedicated professionals who keep The Science Bus running smoothly.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php foreach ($teamData['support_team'] as $member): ?>
                <div class="group bg-white rounded-3xl p-8 border-2 border-blue-100 text-center shadow-sm transition-all duration-300 hover:-translate-y-3 hover:shadow-xl hover:border-blue-400">
                    <img src="<?= $member['image'] ?>" class="mx-auto w-32 h-32 rounded-full object-cover ring-4 ring-gray-200 group-hover:ring-blue-200 transition">
                    <h4 class="text-lg font-semibold text-gray-800 mt-6"><?= $member['name'] ?></h4>
                    <p class="mt-2 text-blue-600 font-medium"><?= $member['role'] ?></p>
                    
                    <?php if(!empty($member['org'])): ?>
                        <p class="text-gray-500 text-sm"><?= $member['org'] ?></p>
                    <?php endif; ?>

                    <?php if(!empty($member['contact'])): ?>
                        <p class="text-gray-500 text-sm">📞 <?= $member['contact'] ?></p>
                    <?php endif; ?>
                    
                    <p class="mt-3 text-xs text-blue-600">✉️ <?= $member['email'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>