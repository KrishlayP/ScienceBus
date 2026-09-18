<?php
require_once __DIR__ . '/database.php';

const UPLOAD_DIR = __DIR__ . '/../assets/uploads';
const UPLOAD_WEB_PATH = 'assets/uploads/';

function load_news_data()
{
    try {
        $rows = db_fetch_all('SELECT image FROM news_items ORDER BY sort_order ASC, created_at DESC, id DESC');
        return ['news' => array_column($rows, 'image')];
    } catch (Throwable $error) {
        return default_news_data();
    }
}

function default_home_slider_data()
{
    return [
        'slides' => [
            ['id' => md5('assets/image/header/quote1.jpeg'), 'title' => 'Quote 1', 'image' => 'assets/image/header/quote1.jpeg'],
            ['id' => md5('assets/image/header/quote3.jpeg'), 'title' => 'Quote 3', 'image' => 'assets/image/header/quote3.jpeg'],
            ['id' => md5('assets/image/header/a.jpg'), 'title' => 'Science Bus', 'image' => 'assets/image/header/a.jpg'],
            ['id' => md5('assets/image/header/b.jpg'), 'title' => 'Science Bus Lab', 'image' => 'assets/image/header/b.jpg'],
            ['id' => md5('assets/image/header/d.jpg'), 'title' => 'Science Activity', 'image' => 'assets/image/header/d.jpg'],
            ['id' => md5('assets/image/header/e.jpg'), 'title' => 'Science Outreach', 'image' => 'assets/image/header/e.jpg'],
        ],
    ];
}

function ensure_home_slider_tables()
{
    db_exec(
        'CREATE TABLE IF NOT EXISTS home_slider_items (
            id varchar(32) NOT NULL,
            title varchar(190) NOT NULL DEFAULT "",
            image varchar(255) NOT NULL,
            sort_order int NOT NULL DEFAULT 0,
            created_at datetime NOT NULL DEFAULT current_timestamp(),
            updated_at datetime NULL DEFAULT NULL ON UPDATE current_timestamp(),
            PRIMARY KEY (id),
            UNIQUE KEY home_slider_items_image_unique (image),
            KEY home_slider_items_sort_idx (sort_order, created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
    );
}

function load_home_slider_data()
{
    try {
        ensure_home_slider_tables();
        $rows = db_fetch_all(
            'SELECT id, title, image
             FROM home_slider_items
             ORDER BY sort_order ASC, created_at ASC, id ASC'
        );

        return ['slides' => $rows ?: default_home_slider_data()['slides']];
    } catch (Throwable $error) {
        return default_home_slider_data();
    }
}

function load_gallery_data()
{
    try {
        $categories = db_fetch_all('SELECT id, name FROM gallery_categories ORDER BY sort_order ASC, id ASC');
    } catch (Throwable $error) {
        return default_gallery_data();
    }

    if (!$categories) {
        return default_gallery_data();
    }

    $data = ['categories' => []];

    foreach ($categories as $category) {
        $packages = db_fetch_all(
            'SELECT id, name FROM gallery_packages WHERE category_id = ? ORDER BY sort_order ASC, id ASC',
            [$category['id']]
        );

        $categoryData = ['name' => $category['name'], 'packages' => []];
        foreach ($packages as $package) {
            $images = db_fetch_all(
                'SELECT image FROM gallery_images WHERE package_id = ? ORDER BY sort_order ASC, id ASC',
                [$package['id']]
            );

            $categoryData['packages'][] = [
                'name' => $package['name'],
                'images' => array_column($images, 'image'),
            ];
        }

        $data['categories'][] = $categoryData;
    }

    return has_gallery_images($data) ? $data : default_gallery_data();
}

function load_messages_data()
{
    try {
        return [
            'messages' => db_fetch_all(
                'SELECT id, name, email, school, message, DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") AS created_at
                 FROM contact_messages
                 ORDER BY created_at DESC, id DESC'
            ),
        ];
    } catch (Throwable $error) {
        return ['messages' => []];
    }
}

function default_social_impact_data()
{
    return [
        'testimonials' => [
            [
                'id' => 'default-1',
                'username' => 'User1',
                'description' => 'The Science Bus visit was a truly inspiring and life-changing experience for our students, sparking curiosity and making science come alive beyond the classroom.',
                'rating' => 5,
            ],
            [
                'id' => 'default-2',
                'username' => 'User2',
                'description' => 'For many of our students, this was their first real exposure to practical experiments, and it has ignited a new passion for learning.',
                'rating' => 5,
            ],
            [
                'id' => 'default-3',
                'username' => 'User3',
                'description' => 'The interactive sessions made science fun, relatable, and unforgettable for our children.',
                'rating' => 5,
            ],
            [
                'id' => 'default-4',
                'username' => 'User4',
                'description' => 'The Science Bus visit opened young minds to innovation and possibilities they had never imagined before.',
                'rating' => 5,
            ],
            [
                'id' => 'default-5',
                'username' => 'User5',
                'description' => 'The Science Bus brought science out of textbooks and into reality, leaving our students motivated, confident, and eager to explore more.',
                'rating' => 5,
            ],
        ],
    ];
}

function ensure_social_impact_tables()
{
    db_exec(
        'CREATE TABLE IF NOT EXISTS social_impact_testimonials (
            id varchar(32) NOT NULL,
            username varchar(190) NOT NULL,
            description text NOT NULL,
            rating tinyint NOT NULL DEFAULT 5,
            sort_order int NOT NULL DEFAULT 0,
            created_at datetime NOT NULL DEFAULT current_timestamp(),
            updated_at datetime NULL DEFAULT NULL ON UPDATE current_timestamp(),
            PRIMARY KEY (id),
            KEY social_impact_sort_idx (sort_order, created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
    );

    $count = (int) db_column('SELECT COUNT(*) FROM social_impact_testimonials');
    if ($count > 0) {
        return;
    }

    foreach (default_social_impact_data()['testimonials'] as $index => $item) {
        db_exec(
            'INSERT INTO social_impact_testimonials (id, username, description, rating, sort_order)
             VALUES (?, ?, ?, ?, ?)',
            [
                'social_impact_' . ($index + 1),
                $item['username'],
                $item['description'],
                (int) $item['rating'],
                $index,
            ]
        );
    }
}

function load_social_impact_data()
{
    try {
        ensure_social_impact_tables();
        $rows = db_fetch_all(
            'SELECT id, username, description, rating
             FROM social_impact_testimonials
             ORDER BY sort_order ASC, created_at ASC, id ASC'
        );

        foreach ($rows as &$row) {
            $row['rating'] = max(1, min(5, (int) $row['rating']));
        }
        unset($row);

        return ['testimonials' => $rows ?: default_social_impact_data()['testimonials']];
    } catch (Throwable $error) {
        return default_social_impact_data();
    }
}

function default_tour_profile_data()
{
    return [
        'stats' => [
            'total_tours' => '18',
            'people_benefitted' => '60,000 +',
            'districts_covered' => '8',
            'active_period' => '2018-Till Date',
        ],
        'tours' => [
            ['id' => 1, 'tour_start' => '2018-12-16', 'tour_end' => '2018-12-31', 'district' => 'Chitrakoot', 'description' => '4500 students benefitted'],
            ['id' => 2, 'tour_start' => '2019-01-20', 'tour_end' => '2019-03-04', 'district' => 'Kumbh Mela, 2019, Prayagraj', 'description' => '30,000 general population benefitted'],
            ['id' => 3, 'tour_start' => '2019-03-31', 'tour_end' => '2019-04-20', 'district' => 'Ballia', 'description' => '2000 students benefitted'],
            ['id' => 4, 'tour_start' => '2019-04-27', 'tour_end' => '2019-05-27', 'district' => 'Meerut', 'description' => '15000 students benefitted'],
            ['id' => 5, 'tour_start' => '2019-07-16', 'tour_end' => '2019-07-31', 'district' => 'Chandauli', 'description' => '1800 students benefitted'],
            ['id' => 6, 'tour_start' => '2019-08-10', 'tour_end' => '2019-08-10', 'district' => 'Kanpur', 'description' => '250 students benefitted at Khalsa Inter College, Govind Nagar, Kanpur'],
            ['id' => 7, 'tour_start' => '2019-08-19', 'tour_end' => '2019-09-03', 'district' => 'Etawah', 'description' => '1500 students benefitted'],
            ['id' => 8, 'tour_start' => '2019-09-06', 'tour_end' => '2019-09-11', 'district' => 'Bhadauchath Mela Jaunpur', 'description' => '4000 general population benefitted'],
            ['id' => 9, 'tour_start' => '2019-09-15', 'tour_end' => '2019-09-18', 'district' => 'Gughal Mela, Saharanpur', 'description' => '2000 general population benefitted'],
            ['id' => 10, 'tour_start' => '2019-10-01', 'tour_end' => '2019-10-25', 'district' => 'Sandila', 'description' => '7000 students benefitted'],
            ['id' => 11, 'tour_start' => '2019-11-13', 'tour_end' => '2019-11-28', 'district' => 'Jalaun', 'description' => '250 students benefitted'],
            ['id' => 12, 'tour_start' => '2019-10-04', 'tour_end' => '2019-10-14', 'district' => 'Gorakhpur', 'description' => '4200 general population benefitted'],
            ['id' => 13, 'tour_start' => '2020-01-10', 'tour_end' => '2020-01-15', 'district' => 'Gorakhpur Mahotsav 2020', 'description' => '3500 general population benefitted'],
            ['id' => 14, 'tour_start' => '2020-01-16', 'tour_end' => '2020-01-25', 'district' => 'Deoria Mahotsav 2020', 'description' => '8500 general population benefitted'],
            ['id' => 15, 'tour_start' => '2020-01-27', 'tour_end' => '2020-01-30', 'district' => 'Amroha', 'description' => '1200 students benefitted'],
            ['id' => 16, 'tour_start' => '2020-02-05', 'tour_end' => '2020-02-06', 'district' => 'Rampur', 'description' => '500 students benefitted'],
            ['id' => 17, 'tour_start' => '2020-02-20', 'tour_end' => '2020-02-24', 'district' => 'Kalinjar Mahotsav, Banda', 'description' => '30000 general population benefitted'],
            ['id' => 18, 'tour_start' => '2020-03-01', 'tour_end' => '2020-03-16', 'district' => 'Ghaziabad', 'description' => '1500 students benefitted'],
        ],
    ];
}

function ensure_tour_profile_tables()
{
    db_exec(
        'CREATE TABLE IF NOT EXISTS tour_profile_stats (
            stat_key varchar(80) NOT NULL,
            stat_value varchar(190) NOT NULL DEFAULT "",
            PRIMARY KEY (stat_key)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
    );

    db_exec(
        'CREATE TABLE IF NOT EXISTS tour_profile_items (
            id int NOT NULL AUTO_INCREMENT,
            tour_start date NULL,
            tour_end date NULL,
            district varchar(190) NOT NULL,
            description text NOT NULL,
            sort_order int NOT NULL DEFAULT 0,
            created_at datetime NOT NULL DEFAULT current_timestamp(),
            updated_at datetime NULL DEFAULT NULL ON UPDATE current_timestamp(),
            PRIMARY KEY (id),
            KEY tour_profile_items_sort_idx (sort_order, id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
    );

    try {
        db_exec('ALTER TABLE tour_profile_items ADD COLUMN tour_start date NULL AFTER id');
    } catch (Throwable $error) {
    }

    try {
        db_exec('ALTER TABLE tour_profile_items ADD COLUMN tour_end date NULL AFTER tour_start');
    } catch (Throwable $error) {
    }
}

function load_tour_profile_data()
{
    try {
        ensure_tour_profile_tables();

        $defaults = default_tour_profile_data();
        $statRows = db_fetch_all('SELECT stat_key, stat_value FROM tour_profile_stats');
        $stats = $defaults['stats'];
        foreach ($statRows as $row) {
            $stats[$row['stat_key']] = $row['stat_value'];
        }

        $tours = db_fetch_all(
            'SELECT id, DATE_FORMAT(tour_start, "%Y-%m-%d") AS tour_start, DATE_FORMAT(tour_end, "%Y-%m-%d") AS tour_end, district, description
             FROM tour_profile_items
             ORDER BY sort_order ASC, id ASC'
        );

        return [
            'stats' => $stats,
            'tours' => $tours ?: $defaults['tours'],
        ];
    } catch (Throwable $error) {
        return default_tour_profile_data();
    }
}

function load_admin_users_data()
{
    return [
        'users' => db_fetch_all(
            'SELECT id, name, email, password, role, DATE_FORMAT(created_at, "%Y-%m-%dT%H:%i:%s") AS created_at
             FROM admin_users
             ORDER BY created_at ASC, name ASC'
        ),
    ];
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect_to($path)
{
    header('Location: ' . $path);
    exit;
}

function make_id()
{
    return bin2hex(random_bytes(8));
}

function save_uploaded_image($field)
{
    if (empty($_FILES[$field]['name']) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $tmp = $_FILES[$field]['tmp_name'];
    $mime = mime_content_type($tmp);
    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];

    if (!isset($allowed[$mime])) {
        return null;
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0775, true);
    }

    $fileName = date('YmdHis') . '-' . make_id() . '.' . $allowed[$mime];
    $destination = UPLOAD_DIR . '/' . $fileName;

    if (!move_uploaded_file($tmp, $destination)) {
        return null;
    }

    return UPLOAD_WEB_PATH . $fileName;
}

function default_team_data()
{
    return [
        'main_team' => [
            [
                'id' => make_id(),
                'name' => 'Prof. Deepu Philip',
                'role' => 'Professor, DOMS Department',
                'org' => 'IIT Kanpur',
                'email' => 'dphilip@iitk.ac.in',
                'contact' => '',
                'image' => 'assets/image/Team/ProfDeepuPhilip.png',
            ],
            [
                'id' => make_id(),
                'name' => 'Dr. Sumit Kumar Srivastava',
                'role' => 'Scientific Officer',
                'org' => 'C.S.T Department, UP',
                'email' => 'sumit.astro.physics@gmail.com',
                'contact' => '',
                'image' => 'assets/image/Team/sumitkumarsr.jpeg',
            ],
            [
                'id' => make_id(),
                'name' => 'Rachna Agrawal',
                'role' => 'Project Executive Officer',
                'org' => 'IIT Kanpur',
                'email' => 'rachna@iitk.ac.in',
                'contact' => '',
                'image' => 'assets/image/Team/rachna.jpeg',
            ],
        ],
        'educator_team' => [
            [
                'id' => make_id(),
                'name' => 'Mr. Rinku',
                'role' => 'Educator',
                'org' => '',
                'email' => 'rinkugangwar9991@gmail.com',
                'contact' => '9451237404',
                'image' => 'assets/image/Team/rinku.jpeg',
            ],
            [
                'id' => make_id(),
                'name' => 'Mr. Brikesh Kumar',
                'role' => 'Educator',
                'org' => '',
                'email' => 'brikesh.kumar.0108@gmail.com',
                'contact' => '7860134226',
                'image' => 'assets/image/Team/brikesh.jpeg',
            ],
        ],
        'operational_team' => [
            [
                'id' => make_id(),
                'name' => 'Mr. Ashish Tripathi',
                'role' => 'Operational Manager',
                'org' => 'IIT Kanpur',
                'email' => 'ashishkt@iitk.ac.in',
                'contact' => '',
                'image' => 'assets/image/Team/ashish.jpeg',
            ],
            [
                'id' => make_id(),
                'name' => 'Mr. Subhashish Panday',
                'role' => 'Lab Technician',
                'org' => '',
                'email' => 'pshubhashish8@gmail.com',
                'contact' => '9794370873',
                'image' => 'assets/image/Team/Shubhashish.jpeg',
            ],
            [
                'id' => make_id(),
                'name' => 'Mr. Devendra Mishra',
                'role' => 'Bus Driver',
                'org' => '',
                'email' => 'devendramishra225@gmail.com',
                'contact' => '9838577697',
                'image' => 'assets/image/Team/devendra.jpeg',
            ],
        ],
    ];
}

function default_gallery_data()
{
    return ['categories' => []];
}

function default_news_data()
{
    return [
        'news' => [
            'assets/image/news/10jaunpur_20260117_visit.jpeg',
            'assets/image/news/9Meerut_bus_visit.jpeg',
            'assets/image/news/8Balia_bus_visit.jpeg',
            'assets/image/news/7yogi-ji_bus_launch.jpeg',
            'assets/image/news/6Etawah_bus_visit.jpeg',
            'assets/image/news/5Etawah-II_bus_visit.jpeg',
            'assets/image/news/4Kandhini_bus_visit.jpeg',
            'assets/image/news/3Chakiya.jpg',
            'assets/image/news/2Sandeela2.jpg',
            'assets/image/news/1Sandeela1.jpg',
        ],
    ];
}

function has_gallery_images($data)
{
    foreach ($data['categories'] as $category) {
        foreach ($category['packages'] as $package) {
            if (!empty($package['images'])) {
                return true;
            }
        }
    }

    return false;
}

function load_team_data()
{
    try {
        $rows = db_fetch_all(
            'SELECT id, section, name, role, org, email, contact, image
             FROM team_members
             ORDER BY FIELD(section, "main_team", "educator_team", "operational_team"), sort_order ASC, created_at ASC'
        );
    } catch (Throwable $error) {
        return default_team_data();
    }

    if (!$rows) {
        return default_team_data();
    }

    $data = [
        'main_team' => [],
        'educator_team' => [],
        'operational_team' => [],
    ];

    foreach ($rows as $row) {
        $section = $row['section'];
        unset($row['section']);
        if (isset($data[$section])) {
            $data[$section][] = $row;
        }
    }

    return $data;
}
