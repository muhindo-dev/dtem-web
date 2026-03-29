<?php
/**
 * Setup Sample Data for DTEHM Health Ministries Website - Fixed Version
 * This script populates all modules with realistic sample content using correct column names
 */

require_once '../config.php';
require_once '../functions.php';
require_once 'config/crud-helper.php';

// Create uploads directories if they don't exist
$directories = [
    '../uploads/news',
    '../uploads/events',
    '../uploads/causes',
    '../uploads/team',
    '../uploads/gallery'
];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Helper function to download placeholder images
function downloadImage($category, $filename, $width = 800, $height = 600) {
    $url = "https://picsum.photos/{$width}/{$height}?random=" . rand(1, 10000);
    $filepath = "../uploads/{$category}/{$filename}";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    curl_close($ch);
    
    if ($data) {
        file_put_contents($filepath, $data);
        return $filename;
    }
    return null;
}

try {
    $pdo = getDBConnection();
    
    echo "Starting sample data setup...\n\n";
    
    // ========================================
    // 1. NEWS BLOG - 8 Articles
    // ========================================
    echo "Creating News Articles...\n";
    
    $newsArticles = [
        ['title' => 'DTEHM Launches New Education Initiative for Underprivileged Children', 'category' => 'Education', 'days_ago' => 7],
        ['title' => 'Community Clean-Up Drive: 200 Volunteers Make a Difference', 'category' => 'Community', 'days_ago' => 5],
        ['title' => 'DTEHM Distributes 1000 Food Packages to Families in Need', 'category' => 'Relief', 'days_ago' => 10],
        ['title' => 'Free Medical Camp Serves 500 Patients in Rural Areas', 'category' => 'Healthcare', 'days_ago' => 3],
        ['title' => 'Skills Training Program Graduates First Batch of 50 Women', 'category' => 'Empowerment', 'days_ago' => 15],
        ['title' => 'DTEHM Partners with Local Schools to Combat Childhood Malnutrition', 'category' => 'Education', 'days_ago' => 2],
        ['title' => 'Youth Mentorship Program: Building Tomorrow\'s Leaders Today', 'category' => 'Youth', 'days_ago' => 8],
        ['title' => 'Emergency Relief Fund Supports Families After Recent Floods', 'category' => 'Relief', 'days_ago' => 1]
    ];
    
    $newsContent = [
        '<p>DTEHM (DTEHM Health Ministries) is proud to announce the launch of our comprehensive education initiative designed to transform the lives of underprivileged children. This program will provide free tutoring, school supplies, and mentorship to over 500 students in our first year.</p><p>Our dedicated team of volunteers and educators will work closely with local schools to identify students who would benefit most from this program.</p>',
        '<p>What started as a small initiative grew into one of the most impactful community events of the year. Over 200 volunteers from all walks of life gathered at dawn to participate in our citywide clean-up drive covering 15 neighborhoods, parks, and public spaces.</p>',
        '<p>In response to the growing food insecurity in our community, DTEHM has ramped up its food distribution efforts. This month, we successfully distributed 1,000 food packages to families struggling to make ends meet. Each package contains essential items for a family of four for two weeks.</p>',
        '<p>Access to healthcare remains a significant challenge in rural areas. To address this, DTEHM organized a comprehensive medical camp that served over 500 patients across three villages last weekend. A team of 25 doctors, nurses, and healthcare volunteers provided free consultations and distributed essential medicines.</p>',
        '<p>Today marks a significant milestone as DTEHM celebrates the graduation of 50 women from our Skills Training and Employment Program. After three months of intensive training in tailoring, computer skills, and entrepreneurship, these women are ready to embark on new career paths.</p>',
        '<p>Recognizing that proper nutrition is fundamental to children\'s learning and development, DTEHM has partnered with five local schools to provide nutritious meals to students from low-income families. The program ensures that 1,200 children receive at least one balanced meal each school day.</p>',
        '<p>Every young person deserves guidance and support. DTEHM\'s new Youth Mentorship Program pairs at-risk youth aged 13-18 with successful professionals who serve as mentors and role models. The program focuses on personal development, academic support, career exploration, and life skills training.</p>',
        '<p>In response to the recent floods that displaced over 300 families, DTEHM has launched an Emergency Relief Fund and mobilized our disaster response team. Within 48 hours, our team established relief camps, distributed emergency supplies, and began coordinating with local authorities.</p>'
    ];
    
    foreach ($newsArticles as $index => $article) {
        $newsData = [
            'title' => $article['title'],
            'slug' => strtolower(str_replace(' ', '-', preg_replace('/[^A-Za-z0-9 ]/', '', $article['title']))),
            'category' => $article['category'],
            'excerpt' => substr(strip_tags($newsContent[$index]), 0, 200) . '...',
            'content' => $newsContent[$index],
            'featured_image' => downloadImage('news', 'news-' . ($index + 1) . '.jpg', 1200, 800),
            'author_id' => 1,
            'status' => 'published',
            'published_at' => date('Y-m-d H:i:s', strtotime('-' . $article['days_ago'] . ' days'))
        ];
        $id = insertRecord('news_posts', $newsData);
        echo "  ✓ Created: {$article['title']}\n";
    }
    
    // ========================================
    // 2. EVENTS - 8 Events
    // ========================================
    echo "\nCreating Events...\n";
    
    $eventsData = [
        [
            'title' => 'Annual Charity Gala 2026',
            'slug' => 'annual-charity-gala-2026',
            'start_datetime' => '2026-03-15 18:00:00',
            'end_datetime' => '2026-03-15 23:00:00',
            'venue_name' => 'Grand Ballroom, City Convention Center',
            'venue_address' => '123 Main Street, Downtown',
            'description' => '<p>Join us for an elegant evening of dinner, entertainment, and fundraising to support DTEHM\'s programs. This year\'s gala will feature live music, a silent auction, and inspiring stories from the communities we serve.</p><p>Dress code: Formal attire. Tickets include a three-course dinner, beverages, and entertainment.</p>',
            'event_type' => 'Fundraiser',
            'max_capacity' => 300,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Community Health Fair',
            'slug' => 'community-health-fair',
            'start_datetime' => '2026-02-22 09:00:00',
            'end_datetime' => '2026-02-22 16:00:00',
            'venue_name' => 'Central Park',
            'venue_address' => 'Main Field, Central Park',
            'description' => '<p>Free health screenings, consultations, and wellness information for the entire family. Services include blood pressure and glucose screening, BMI assessment, dental check-ups, vision testing, nutrition counseling, and fitness demonstrations.</p>',
            'event_type' => 'Healthcare',
            'max_capacity' => 500,
            'registration_required' => 0,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Education Summit: Bridging the Achievement Gap',
            'slug' => 'education-summit-2026',
            'start_datetime' => '2026-04-10 10:00:00',
            'end_datetime' => '2026-04-10 17:00:00',
            'venue_name' => 'University Conference Hall',
            'venue_address' => 'State University Campus',
            'description' => '<p>A one-day summit bringing together educators, policymakers, and community leaders to discuss strategies for improving educational outcomes for underprivileged students. Features keynote speakers, panel discussions, and workshops.</p>',
            'event_type' => 'Conference',
            'max_capacity' => 200,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Spring Cleanup and Tree Planting Drive',
            'slug' => 'spring-cleanup-tree-planting',
            'start_datetime' => '2026-03-28 08:00:00',
            'end_datetime' => '2026-03-28 14:00:00',
            'venue_name' => 'Various locations',
            'venue_address' => 'Multiple locations across the city',
            'description' => '<p>Join hundreds of volunteers for our annual Spring Cleanup and Tree Planting Drive. We\'ll beautify our community while making a lasting environmental impact. All supplies provided. Event concludes with a community picnic.</p>',
            'event_type' => 'Volunteer',
            'max_capacity' => 400,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Skills Workshop: Computer Literacy for Seniors',
            'slug' => 'computer-literacy-seniors',
            'start_datetime' => '2026-02-18 14:00:00',
            'end_datetime' => '2026-02-18 17:00:00',
            'venue_name' => 'DTEHM Community Center',
            'venue_address' => '456 Community Ave, Room 101',
            'description' => '<p>Free computer literacy workshop designed specifically for seniors who want to learn basic computer skills and internet safety. Topics include using email, video calling with family, online shopping safety, and social media basics.</p>',
            'event_type' => 'Workshop',
            'max_capacity' => 25,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Charity 5K Run for Education',
            'slug' => 'charity-5k-run',
            'start_datetime' => '2026-05-10 07:00:00',
            'end_datetime' => '2026-05-10 11:00:00',
            'venue_name' => 'Riverside Park',
            'venue_address' => 'Main Entrance, Riverside Park',
            'description' => '<p>Run or walk to support education programs for underprivileged children. All fitness levels welcome! The scenic route follows the riverside path. Registration includes race bib, timing chip, t-shirt, and finisher medal.</p>',
            'event_type' => 'Fundraiser',
            'max_capacity' => 1000,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Women Empowerment Workshop',
            'slug' => 'women-empowerment-workshop',
            'start_datetime' => '2026-03-08 10:00:00',
            'end_datetime' => '2026-03-08 16:00:00',
            'venue_name' => 'DTEHM Community Center',
            'venue_address' => '456 Community Ave, Main Hall',
            'description' => '<p>Celebrating International Women\'s Day with a full-day workshop focused on personal development, financial literacy, and entrepreneurship. Sessions include building self-confidence, financial planning, starting a business, and networking.</p>',
            'event_type' => 'Workshop',
            'max_capacity' => 100,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Back to School Supply Drive Distribution',
            'slug' => 'back-to-school-distribution',
            'start_datetime' => '2026-08-15 09:00:00',
            'end_datetime' => '2026-08-15 14:00:00',
            'venue_name' => 'DTEHM Community Center',
            'venue_address' => '456 Community Ave',
            'description' => '<p>Free school supplies distribution for students from low-income families. Each student receives a backpack filled with grade-appropriate supplies. Distribution is first-come, first-served. We anticipate serving 500 students.</p>',
            'event_type' => 'Distribution',
            'max_capacity' => 500,
            'registration_required' => 0,
            'status' => 'upcoming'
        ]
    ];
    
    foreach ($eventsData as $event) {
        $event['event_image'] = downloadImage('events', 'event-' . time() . rand(1000, 9999) . '.jpg', 1200, 800);
        $id = insertRecord('events', $event);
        echo "  ✓ Created: {$event['title']}\n";
    }
    
    // ========================================
    // 3. CAUSES - 8 Causes
    // ========================================
    echo "\nCreating Causes...\n";
    
    $causesData = [
        [
            'title' => 'Build a School in Rural Communities',
            'slug' => 'build-school-rural-communities',
            'description' => '<p>Children in remote villages are walking 5-10 kilometers daily to attend school. Help us build a new school building that will serve 300 students and provide them with a safe, accessible learning environment.</p><p>The project includes construction of 8 classrooms, library and computer lab, safe drinking water facility, sanitation facilities, and playground.</p>',
            'goal_amount' => 150000.00,
            'raised_amount' => 87500.00,
            'category' => 'Education',
            'urgency' => 'high',
            'is_featured' => 1,
            'status' => 'active'
        ],
        [
            'title' => 'Emergency Medical Equipment Fund',
            'slug' => 'emergency-medical-equipment',
            'description' => '<p>Our community health clinic desperately needs updated medical equipment to serve patients effectively. We\'re raising funds to purchase essential diagnostic and treatment equipment including digital X-ray machine, ultrasound system, patient monitoring devices, and laboratory equipment.</p>',
            'goal_amount' => 200000.00,
            'raised_amount' => 145000.00,
            'category' => 'Healthcare',
            'urgency' => 'critical',
            'is_featured' => 1,
            'status' => 'active'
        ],
        [
            'title' => 'Feed 1000 Families Monthly',
            'slug' => 'feed-1000-families',
            'description' => '<p>Food insecurity affects countless families in our community. Our monthly food distribution program provides nutritious food packages to families struggling to meet their basic needs. Each $50 donation provides a family of four with two weeks of essential groceries.</p>',
            'goal_amount' => 60000.00,
            'raised_amount' => 42300.00,
            'category' => 'Food Security',
            'urgency' => 'high',
            'is_featured' => 1,
            'status' => 'active'
        ],
        [
            'title' => 'Scholarship Fund for Underprivileged Students',
            'slug' => 'scholarship-fund-students',
            'description' => '<p>Talented students from low-income families often cannot pursue higher education due to financial constraints. Our scholarship program removes these barriers. Scholarships cover tuition fees, books and supplies, living expenses, and mentorship. We aim to award 50 scholarships this year.</p>',
            'goal_amount' => 100000.00,
            'raised_amount' => 58900.00,
            'category' => 'Education',
            'urgency' => 'medium',
            'is_featured' => 0,
            'status' => 'active'
        ],
        [
            'title' => 'Clean Water Project for Villages',
            'slug' => 'clean-water-project',
            'description' => '<p>Access to clean water is a basic human right, yet many villages in our region still lack safe drinking water. This project will install 10 deep-water wells and hand pumps in villages currently without clean water access. Each well will serve approximately 200 people.</p>',
            'goal_amount' => 80000.00,
            'raised_amount' => 35600.00,
            'category' => 'Water & Sanitation',
            'urgency' => 'critical',
            'is_featured' => 1,
            'status' => 'active'
        ],
        [
            'title' => 'Women\'s Vocational Training Center',
            'slug' => 'womens-training-center',
            'description' => '<p>Economic empowerment is key to breaking the cycle of poverty. We\'re establishing a vocational training center to provide women with marketable skills and entrepreneurship training. The center will offer courses in tailoring, computer skills, beauty services, and business management.</p>',
            'goal_amount' => 120000.00,
            'raised_amount' => 78200.00,
            'category' => 'Women Empowerment',
            'urgency' => 'medium',
            'is_featured' => 0,
            'status' => 'active'
        ],
        [
            'title' => 'Senior Citizens Support Program',
            'slug' => 'senior-citizens-support',
            'description' => '<p>Our elderly population faces unique challenges including health issues, social isolation, and financial hardship. This program provides comprehensive support including monthly food and medicine assistance, regular health check-ups, social activities, and emergency assistance.</p>',
            'goal_amount' => 108000.00,
            'raised_amount' => 67400.00,
            'category' => 'Elder Care',
            'urgency' => 'medium',
            'is_featured' => 0,
            'status' => 'active'
        ],
        [
            'title' => 'Orphanage Renovation and Expansion',
            'slug' => 'orphanage-renovation',
            'description' => '<p>Our orphanage, home to 75 children, urgently needs renovation and expansion. The building is over 30 years old, and we need additional space to accommodate more children. Project includes structural repairs, dormitory expansion, kitchen renovation, and playground facilities.</p>',
            'goal_amount' => 175000.00,
            'raised_amount' => 92800.00,
            'category' => 'Child Welfare',
            'urgency' => 'high',
            'is_featured' => 0,
            'status' => 'active'
        ]
    ];
    
    foreach ($causesData as $cause) {
        $cause['cause_image'] = downloadImage('causes', 'cause-' . time() . rand(1000, 9999) . '.jpg', 1200, 800);
        $id = insertRecord('causes', $cause);
        echo "  ✓ Created: {$cause['title']}\n";
    }
    
    // ========================================
    // 4. GALLERY - 8 Albums with 5 photos each
    // ========================================
    echo "\nCreating Gallery Albums and Images...\n";
    
    $albumsData = [
        ['title' => 'Education Initiative 2025', 'description' => 'Photos from our education programs, showing students receiving tutoring and school supplies.', 'category' => 'Education'],
        ['title' => 'Community Health Fair 2025', 'description' => 'Highlights from our annual community health fair with free health screenings.', 'category' => 'Healthcare'],
        ['title' => 'Food Distribution Program', 'description' => 'Volunteers distributing food packages to families in need during monthly events.', 'category' => 'Relief'],
        ['title' => 'Women Empowerment Workshops', 'description' => 'Women participating in our skills training and empowerment workshops.', 'category' => 'Empowerment'],
        ['title' => 'Community Cleanup Drive', 'description' => 'Volunteers working together to clean and beautify our neighborhoods.', 'category' => 'Community'],
        ['title' => 'Children\'s Day Celebration', 'description' => 'Children enjoying games, activities, and entertainment during our special celebration.', 'category' => 'Events'],
        ['title' => 'Charity Gala 2025', 'description' => 'Memorable moments from our annual charity gala featuring supporters and entertainment.', 'category' => 'Events'],
        ['title' => 'Rural Medical Camps', 'description' => 'Medical professionals providing free healthcare in remote villages.', 'category' => 'Healthcare']
    ];
    
    foreach ($albumsData as $albumData) {
        $albumData['slug'] = strtolower(str_replace(' ', '-', preg_replace('/[^A-Za-z0-9 ]/', '', $albumData['title'])));
        $albumData['cover_image'] = downloadImage('gallery', 'album-' . time() . rand(1000, 9999) . '.jpg', 1200, 800);
        $albumData['status'] = 'active';
        
        $albumId = insertRecord('gallery_albums', $albumData);
        echo "  ✓ Created Album: {$albumData['title']}\n";
        
        // Create 5 photos for this album
        for ($i = 1; $i <= 5; $i++) {
            $photoData = [
                'album_id' => $albumId,
                'image_path' => downloadImage('gallery', "album-{$albumId}-photo-{$i}.jpg", 1200, 800),
                'title' => "Photo {$i}",
                'caption' => "Photo {$i} from {$albumData['title']}",
                'sort_order' => $i
            ];
            insertRecord('gallery_images', $photoData);
            echo "    ✓ Added photo {$i}/5\n";
            sleep(1); // Small delay to ensure unique random images
        }
    }
    
    // ========================================
    // 5. TEAM MEMBERS - 8 Members
    // ========================================
    echo "\nCreating Team Members...\n";
    
    $teamData = [
        [
            'name' => 'Dr. Sarah Mitchell',
            'position' => 'Executive Director',
            'department' => 'Leadership',
            'bio' => 'Dr. Sarah Mitchell brings over 20 years of experience in nonprofit management and community development. She holds a Ph.D. in Social Work from Columbia University and has dedicated her career to empowering underserved communities.',
            'email' => 'sarah.mitchell@ulfa.org',
            'phone' => '+1 (555) 123-4567',
            'photo' => downloadImage('team', 'sarah-mitchell.jpg', 600, 600),
            'social_facebook' => 'https://facebook.com/sarahmitchell',
            'social_twitter' => 'https://twitter.com/sarahmitchell',
            'social_linkedin' => 'https://linkedin.com/in/sarahmitchell',
            'display_order' => 1,
            'status' => 'active'
        ],
        [
            'name' => 'Michael Chen',
            'position' => 'Director of Programs',
            'department' => 'Management',
            'bio' => 'Michael oversees all DTEHM programs, ensuring quality implementation and maximum impact. With a Master\'s degree in Public Administration and 15 years of program management experience, he excels at coordinating complex initiatives.',
            'email' => 'michael.chen@ulfa.org',
            'phone' => '+1 (555) 123-4568',
            'photo' => downloadImage('team', 'michael-chen.jpg', 600, 600),
            'social_linkedin' => 'https://linkedin.com/in/michaelchen',
            'display_order' => 2,
            'status' => 'active'
        ],
        [
            'name' => 'Dr. Aisha Patel',
            'position' => 'Healthcare Coordinator',
            'department' => 'Program Staff',
            'bio' => 'Dr. Aisha Patel is a board-certified physician specializing in community health. She leads our medical outreach programs and coordinates health education initiatives across all communities we serve.',
            'email' => 'aisha.patel@ulfa.org',
            'phone' => '+1 (555) 123-4569',
            'photo' => downloadImage('team', 'aisha-patel.jpg', 600, 600),
            'social_facebook' => 'https://facebook.com/aishapatel',
            'social_linkedin' => 'https://linkedin.com/in/aishapatel',
            'display_order' => 3,
            'status' => 'active'
        ],
        [
            'name' => 'James Rodriguez',
            'position' => 'Education Program Manager',
            'department' => 'Program Staff',
            'bio' => 'James manages our education initiatives, including tutoring programs, scholarship distribution, and school partnerships. A former teacher with a Master\'s in Education Policy, he understands the challenges facing underprivileged students.',
            'email' => 'james.rodriguez@ulfa.org',
            'phone' => '+1 (555) 123-4570',
            'photo' => downloadImage('team', 'james-rodriguez.jpg', 600, 600),
            'social_facebook' => 'https://facebook.com/jamesrodriguez',
            'social_twitter' => 'https://twitter.com/jamesrodriguez',
            'display_order' => 4,
            'status' => 'active'
        ],
        [
            'name' => 'Emily Thompson',
            'position' => 'Communications Director',
            'department' => 'Administrative',
            'bio' => 'Emily leads our communications strategy, managing social media, public relations, and donor communications. With a background in journalism and nonprofit communications, she excels at storytelling that inspires action.',
            'email' => 'emily.thompson@ulfa.org',
            'phone' => '+1 (555) 123-4571',
            'photo' => downloadImage('team', 'emily-thompson.jpg', 600, 600),
            'social_facebook' => 'https://facebook.com/emilythompson',
            'social_twitter' => 'https://twitter.com/emilythompson',
            'social_linkedin' => 'https://linkedin.com/in/emilythompson',
            'display_order' => 5,
            'status' => 'active'
        ],
        [
            'name' => 'David Kim',
            'position' => 'Finance Manager',
            'department' => 'Administrative',
            'bio' => 'David ensures financial transparency and sustainability for DTEHM. As a Certified Public Accountant with nonprofit finance expertise, he manages budgets, grants, and financial reporting with meticulous attention to detail.',
            'email' => 'david.kim@ulfa.org',
            'phone' => '+1 (555) 123-4572',
            'photo' => downloadImage('team', 'david-kim.jpg', 600, 600),
            'social_linkedin' => 'https://linkedin.com/in/davidkim',
            'display_order' => 6,
            'status' => 'active'
        ],
        [
            'name' => 'Maria Santos',
            'position' => 'Volunteer Coordinator',
            'department' => 'Program Staff',
            'bio' => 'Maria recruits, trains, and coordinates our amazing volunteer network of over 500 active volunteers. Her organizational skills and warm personality make every volunteer feel valued and empowered.',
            'email' => 'maria.santos@ulfa.org',
            'phone' => '+1 (555) 123-4573',
            'photo' => downloadImage('team', 'maria-santos.jpg', 600, 600),
            'social_facebook' => 'https://facebook.com/mariasantos',
            'social_twitter' => 'https://twitter.com/mariasantos',
            'social_linkedin' => 'https://linkedin.com/in/mariasantos',
            'display_order' => 7,
            'status' => 'active'
        ],
        [
            'name' => 'Robert Johnson',
            'position' => 'Operations Manager',
            'department' => 'Management',
            'bio' => 'Robert oversees day-to-day operations, facilities management, and logistics for all DTEHM programs and events. His military background brings discipline and efficiency to our operational processes.',
            'email' => 'robert.johnson@ulfa.org',
            'phone' => '+1 (555) 123-4574',
            'photo' => downloadImage('team', 'robert-johnson.jpg', 600, 600),
            'social_linkedin' => 'https://linkedin.com/in/robertjohnson',
            'display_order' => 8,
            'status' => 'active'
        ]
    ];
    
    foreach ($teamData as $member) {
        $member['slug'] = strtolower(str_replace(' ', '-', $member['name']));
        $id = insertRecord('team_members', $member);
        echo "  ✓ Created: {$member['name']} - {$member['position']}\n";
    }
    
    echo "\n========================================\n";
    echo "✓ Sample data setup completed successfully!\n";
    echo "========================================\n\n";
    echo "Summary:\n";
    echo "- 8 News Articles created\n";
    echo "- 8 Events created\n";
    echo "- 8 Causes created\n";
    echo "- 8 Gallery Albums created (with 40 total photos)\n";
    echo "- 8 Team Members created\n";
    echo "\nAll modules now have realistic sample content!\n";
    echo "You can now view them in the admin panel.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
