<?php
/**
 * Setup Sample Data for DTEHM Health Ministries Website
 * This script populates all modules with realistic sample content
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
    $url = "https://picsum.photos/{$width}/{$height}?random=" . rand(1, 1000);
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
    
    $newsData = [
        [
            'title' => 'DTEHM Launches New Education Initiative for Underprivileged Children',
            'slug' => 'ulfa-launches-new-education-initiative',
            'category' => 'News',
            'excerpt' => 'We are excited to announce our newest program aimed at providing quality education to children from low-income families across the region.',
            'content' => '<p>DTEHM (DTEHM Health Ministries) is proud to announce the launch of our comprehensive education initiative designed to transform the lives of underprivileged children. This program will provide free tutoring, school supplies, and mentorship to over 500 students in our first year.</p><p>Our dedicated team of volunteers and educators will work closely with local schools to identify students who would benefit most from this program. We believe that every child deserves access to quality education regardless of their economic background.</p><p>The initiative includes after-school tutoring programs, distribution of textbooks and learning materials, scholarship opportunities for exceptional students, and career counseling services. We are also partnering with local businesses to provide internship opportunities for older students.</p>',
            'featured_image' => downloadImage('news', 'education-initiative.jpg', 1200, 800),
            'author_id' => 1,
            'status' => 'published',
            'published_at' => date('Y-m-d H:i:s', strtotime('-7 days'))
        ],
        [
            'title' => 'Community Clean-Up Drive: 200 Volunteers Make a Difference',
            'slug' => 'community-cleanup-drive-success',
            'type' => 'Story',
            'excerpt' => 'Last Saturday, our volunteers came together for the largest community clean-up drive in the city, collecting over 2 tons of waste.',
            'content' => '<p>What started as a small initiative grew into one of the most impactful community events of the year. Over 200 volunteers from all walks of life gathered at dawn to participate in our citywide clean-up drive.</p><p>The event covered 15 neighborhoods, parks, and public spaces. Volunteers worked tirelessly from 6 AM to 2 PM, collecting trash, removing graffiti, and planting trees. The sense of community and shared purpose was truly inspiring.</p><p>One volunteer, Maria Rodriguez, shared: "This is what community is all about. Seeing everyone working together, regardless of age or background, gives me hope for our future." The event concluded with a community lunch where participants shared their experiences and discussed future initiatives.</p>',
            'image' => downloadImage('news', 'cleanup-drive.jpg', 1200, 800),
            'author' => 'Michael Chen',
            'status' => 'published',
            'featured' => 1
        ],
        [
            'title' => 'DTEHM Distributes 1000 Food Packages to Families in Need',
            'slug' => 'food-distribution-program',
            'type' => 'News',
            'excerpt' => 'Our monthly food distribution program reached a milestone this week, helping families affected by recent economic challenges.',
            'content' => '<p>In response to the growing food insecurity in our community, DTEHM has ramped up its food distribution efforts. This month, we successfully distributed 1,000 food packages to families struggling to make ends meet.</p><p>Each package contains essential items including rice, lentils, cooking oil, canned goods, fresh vegetables, and hygiene products - enough to sustain a family of four for two weeks. The distribution was organized across five locations to ensure accessibility for all beneficiaries.</p><p>This program is made possible through generous donations from local businesses and individual supporters. We are particularly grateful to Fresh Foods Market and Community Grocers for their ongoing partnership and support.</p>',
            'image' => downloadImage('news', 'food-distribution.jpg', 1200, 800),
            'author' => 'Aisha Patel',
            'status' => 'published',
            'featured' => 0
        ],
        [
            'title' => 'Free Medical Camp Serves 500 Patients in Rural Areas',
            'slug' => 'free-medical-camp-rural-areas',
            'type' => 'News',
            'excerpt' => 'Our medical outreach program brought healthcare services to remote villages, providing free consultations and medicines.',
            'content' => '<p>Access to healthcare remains a significant challenge in rural areas. To address this, DTEHM organized a comprehensive medical camp that served over 500 patients across three villages last weekend.</p><p>A team of 25 doctors, nurses, and healthcare volunteers provided free consultations, basic health screenings, and distributed essential medicines. Services included general health check-ups, dental care, eye examinations, and health education sessions.</p><p>Dr. Rajesh Kumar, who led the medical team, noted: "Many patients we saw had conditions that could have been easily prevented or treated if they had regular access to healthcare. This camp is just the beginning of our efforts to bridge this gap."</p><p>The camp also included awareness sessions on nutrition, hygiene, and preventive healthcare. We plan to make this a quarterly initiative, rotating through different rural communities.</p>',
            'image' => downloadImage('news', 'medical-camp.jpg', 1200, 800),
            'author' => 'Dr. Emily Roberts',
            'status' => 'published',
            'featured' => 1
        ],
        [
            'title' => 'Skills Training Program Graduates First Batch of 50 Women',
            'slug' => 'skills-training-program-graduation',
            'type' => 'Story',
            'excerpt' => 'Empowering women through skills development: Our first cohort of trainees celebrates their achievement and new opportunities.',
            'content' => '<p>Today marks a significant milestone as DTEHM celebrates the graduation of 50 women from our Skills Training and Employment Program. After three months of intensive training in tailoring, computer skills, and entrepreneurship, these women are ready to embark on new career paths.</p><p>The program was designed to provide women from disadvantaged backgrounds with marketable skills and employment opportunities. Participants received training in various trades, business management, and soft skills development.</p><p>Graduate Fatima Khan shared her experience: "This program has changed my life. I now have the skills and confidence to start my own tailoring business and support my family." Several participants have already secured employment, while others are starting their own small businesses with support from our microfinance initiative.</p><p>We are proud of these remarkable women and look forward to supporting their continued success. The next cohort will begin training next month.</p>',
            'image' => downloadImage('news', 'skills-training.jpg', 1200, 800),
            'author' => 'Sarah Johnson',
            'status' => 'published',
            'featured' => 0
        ],
        [
            'title' => 'DTEHM Partners with Local Schools to Combat Childhood Malnutrition',
            'slug' => 'school-nutrition-program',
            'type' => 'News',
            'excerpt' => 'New partnership brings nutritious meals to 1,200 school children daily, addressing malnutrition in our community.',
            'content' => '<p>Recognizing that proper nutrition is fundamental to children\'s learning and development, DTEHM has partnered with five local schools to provide nutritious meals to students from low-income families.</p><p>The program ensures that 1,200 children receive at least one balanced meal each school day. Menus are designed by nutritionists to meet children\'s dietary needs and include fresh fruits, vegetables, proteins, and whole grains.</p><p>Principal James Martinez of Lincoln Elementary shared: "We\'ve already noticed improvements in student attendance and concentration. When children are well-fed, they can focus on learning." The program also includes nutrition education for parents, teaching them how to prepare healthy meals on a budget.</p><p>This initiative is funded through a combination of grants, corporate sponsorships, and individual donations. We invite community members to support this vital program through our website.</p>',
            'image' => downloadImage('news', 'school-nutrition.jpg', 1200, 800),
            'author' => 'Michael Chen',
            'status' => 'published',
            'featured' => 0
        ],
        [
            'title' => 'Youth Mentorship Program: Building Tomorrow\'s Leaders Today',
            'slug' => 'youth-mentorship-program-launch',
            'type' => 'News',
            'excerpt' => 'DTEHM introduces a comprehensive mentorship program connecting at-risk youth with successful professionals in various fields.',
            'content' => '<p>Every young person deserves guidance and support as they navigate life\'s challenges. DTEHM\'s new Youth Mentorship Program pairs at-risk youth aged 13-18 with successful professionals who serve as mentors and role models.</p><p>The program focuses on personal development, academic support, career exploration, and life skills training. Mentors meet with their mentees weekly, providing guidance, encouragement, and real-world insights into various career paths.</p><p>James Wilson, a software engineer and mentor, explains: "I grew up in similar circumstances, and a mentor made all the difference in my life. Now I want to pay it forward and help young people realize their potential." The program currently serves 75 youth, with plans to expand to 200 participants by next year.</p><p>We are actively recruiting mentors from diverse professional backgrounds. If you\'re interested in making a lasting impact on a young person\'s life, please contact us.</p>',
            'image' => downloadImage('news', 'youth-mentorship.jpg', 1200, 800),
            'author' => 'Aisha Patel',
            'status' => 'published',
            'featured' => 0
        ],
        [
            'title' => 'Emergency Relief Fund Supports Families After Recent Floods',
            'slug' => 'flood-relief-emergency-fund',
            'type' => 'News',
            'excerpt' => 'DTEHM mobilizes emergency response to provide immediate assistance to families affected by devastating floods.',
            'content' => '<p>In response to the recent floods that displaced over 300 families in the region, DTEHM has launched an Emergency Relief Fund and mobilized our disaster response team. Our immediate priority is ensuring affected families have access to shelter, food, clean water, and medical care.</p><p>Within 48 hours of the disaster, our team established relief camps, distributed emergency supplies, and began coordinating with local authorities and other organizations. We have provided temporary shelter for 150 families and distributed food, water, and hygiene kits to all affected households.</p><p>Beyond immediate relief, we are committed to supporting these families through the recovery process. This includes helping them rebuild their homes, replacing lost belongings, and providing psychological support to those traumatized by the disaster.</p><p>The response has been overwhelming, with volunteers working around the clock and donations pouring in from across the country. However, the need remains great, and we continue to accept donations to support our relief and recovery efforts.</p>',
            'image' => downloadImage('news', 'flood-relief.jpg', 1200, 800),
            'author' => 'Dr. Emily Roberts',
            'status' => 'published',
            'featured' => 1
        ]
    ];
    
    foreach ($newsData as $news) {
        $id = insertRecord('news_posts', $news);
        echo "  ✓ Created: {$news['title']}\n";
    }
    
    // ========================================
    // 2. EVENTS - 8 Events
    // ========================================
    echo "\nCreating Events...\n";
    
    $eventsData = [
        [
            'title' => 'Annual Charity Gala 2026',
            'slug' => 'annual-charity-gala-2026',
            'event_date' => '2026-03-15',
            'event_time' => '18:00:00',
            'location' => 'Grand Ballroom, City Convention Center',
            'description' => '<p>Join us for an elegant evening of dinner, entertainment, and fundraising to support DTEHM\'s programs. This year\'s gala will feature live music, a silent auction, and inspiring stories from the communities we serve.</p><p>Dress code: Formal attire. Tickets include a three-course dinner, beverages, and entertainment. All proceeds support our education, healthcare, and community development initiatives.</p><p>Early bird tickets available until February 28th. Table sponsorship opportunities available for businesses and groups.</p>',
            'image' => downloadImage('events', 'charity-gala.jpg', 1200, 800),
            'capacity' => 300,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Community Health Fair',
            'slug' => 'community-health-fair',
            'event_date' => '2026-02-22',
            'event_time' => '09:00:00',
            'location' => 'Central Park, Main Field',
            'description' => '<p>Free health screenings, consultations, and wellness information for the entire family. Our Community Health Fair brings together healthcare professionals, fitness experts, and wellness providers to promote healthy living.</p><p>Services include: Blood pressure and glucose screening, BMI assessment, dental check-ups, vision testing, nutrition counseling, fitness demonstrations, and mental health resources.</p><p>Activities for children include face painting, healthy cooking demos, and interactive health education. Free health kits will be distributed to all attendees.</p>',
            'image' => downloadImage('events', 'health-fair.jpg', 1200, 800),
            'capacity' => 500,
            'registration_required' => 0,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Education Summit: Bridging the Achievement Gap',
            'slug' => 'education-summit-2026',
            'event_date' => '2026-04-10',
            'event_time' => '10:00:00',
            'location' => 'University Conference Hall',
            'description' => '<p>A one-day summit bringing together educators, policymakers, and community leaders to discuss strategies for improving educational outcomes for underprivileged students.</p><p>The summit will feature keynote speakers, panel discussions, and workshops on topics including innovative teaching methods, technology in education, parent engagement, and addressing learning gaps.</p><p>Continental breakfast and lunch will be provided. CEU credits available for educators. Registration required for planning purposes.</p>',
            'image' => downloadImage('events', 'education-summit.jpg', 1200, 800),
            'capacity' => 200,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Spring Cleanup and Tree Planting Drive',
            'slug' => 'spring-cleanup-tree-planting',
            'event_date' => '2026-03-28',
            'event_time' => '08:00:00',
            'location' => 'Various locations across the city',
            'description' => '<p>Join hundreds of volunteers for our annual Spring Cleanup and Tree Planting Drive. We\'ll beautify our community while making a lasting environmental impact.</p><p>Volunteers will work in teams to clean parks, plant trees, create community gardens, and revitalize public spaces. All supplies, tools, and safety equipment will be provided.</p><p>The event concludes with a community picnic featuring local food vendors. Volunteer t-shirts included. Family-friendly activities and prizes for most active volunteers.</p>',
            'image' => downloadImage('events', 'spring-cleanup.jpg', 1200, 800),
            'capacity' => 400,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Skills Workshop: Computer Literacy for Seniors',
            'slug' => 'computer-literacy-seniors',
            'event_date' => '2026-02-18',
            'event_time' => '14:00:00',
            'location' => 'DTEHM Community Center, Room 101',
            'description' => '<p>Free computer literacy workshop designed specifically for seniors who want to learn basic computer skills and internet safety. Topics covered include using email, video calling with family, online shopping safety, and social media basics.</p><p>Small class size ensures personalized attention. No prior computer experience necessary. Computers provided, or bring your own laptop. Light refreshments will be served.</p><p>This is the first in a series of monthly workshops. Space is limited, so early registration is encouraged.</p>',
            'image' => downloadImage('events', 'computer-workshop.jpg', 1200, 800),
            'capacity' => 25,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Charity 5K Run for Education',
            'slug' => 'charity-5k-run',
            'event_date' => '2026-05-10',
            'event_time' => '07:00:00',
            'location' => 'Riverside Park, Main Entrance',
            'description' => '<p>Run or walk to support education programs for underprivileged children. All fitness levels welcome! The scenic route follows the riverside path with water stations every kilometer.</p><p>Registration includes race bib, timing chip, official race t-shirt, and finisher medal. Awards for top finishers in each age category. Kids\' fun run (1K) starts at 8:30 AM.</p><p>Post-race celebration features live music, food trucks, kids\' activities, and prize drawings. All proceeds benefit our education initiative providing school supplies and tutoring to students in need.</p>',
            'image' => downloadImage('events', 'charity-run.jpg', 1200, 800),
            'capacity' => 1000,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Women Empowerment Workshop',
            'slug' => 'women-empowerment-workshop',
            'event_date' => '2026-03-08',
            'event_time' => '10:00:00',
            'location' => 'DTEHM Community Center, Main Hall',
            'description' => '<p>Celebrating International Women\'s Day with a full-day workshop focused on personal development, financial literacy, and entrepreneurship. Designed for women seeking to enhance their skills and build confidence.</p><p>Workshop sessions include: Building self-confidence, Financial planning and saving strategies, Starting a small business, Legal rights and resources, Work-life balance, and Networking opportunities.</p><p>Guest speakers include successful women entrepreneurs, financial advisors, and motivational speakers. Lunch and materials provided. Childcare available upon request during registration.</p>',
            'image' => downloadImage('events', 'women-workshop.jpg', 1200, 800),
            'capacity' => 100,
            'registration_required' => 1,
            'status' => 'upcoming'
        ],
        [
            'title' => 'Back to School Supply Drive Distribution',
            'slug' => 'back-to-school-distribution',
            'event_date' => '2026-08-15',
            'event_time' => '09:00:00',
            'location' => 'DTEHM Community Center',
            'description' => '<p>Free school supplies distribution for students from low-income families. Each student will receive a backpack filled with grade-appropriate supplies including notebooks, pencils, pens, rulers, calculators, and more.</p><p>Families should bring proof of enrollment and income verification. Distribution is on a first-come, first-served basis while supplies last. We anticipate serving 500 students.</p><p>In addition to supplies, we\'ll have information tables about our tutoring programs, after-school activities, and scholarship opportunities. Free haircuts and refreshments will also be available.</p>',
            'image' => downloadImage('events', 'school-supplies.jpg', 1200, 800),
            'capacity' => 500,
            'registration_required' => 0,
            'status' => 'upcoming'
        ]
    ];
    
    foreach ($eventsData as $event) {
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
            'description' => '<p>Children in remote villages are walking 5-10 kilometers daily to attend school. Help us build a new school building that will serve 300 students and provide them with a safe, accessible learning environment.</p><p>The project includes: Construction of 8 classrooms, Library and computer lab, Safe drinking water facility, Sanitation facilities, Play area and sports equipment.</p><p>Your donation will give children in these communities the education they deserve without the burden of dangerous daily commutes.</p>',
            'goal_amount' => 150000.00,
            'raised_amount' => 87500.00,
            'image' => downloadImage('causes', 'build-school.jpg', 1200, 800),
            'status' => 'active',
            'featured' => 1
        ],
        [
            'title' => 'Emergency Medical Equipment Fund',
            'slug' => 'emergency-medical-equipment',
            'description' => '<p>Our community health clinic desperately needs updated medical equipment to serve patients effectively. We\'re raising funds to purchase essential diagnostic and treatment equipment.</p><p>Priority equipment includes: Digital X-ray machine, Ultrasound system, Patient monitoring devices, Laboratory equipment, Emergency response kits.</p><p>This equipment will enable our clinic to provide comprehensive healthcare services to thousands of patients annually, many of whom cannot afford private healthcare facilities.</p>',
            'goal_amount' => 200000.00,
            'raised_amount' => 145000.00,
            'image' => downloadImage('causes', 'medical-equipment.jpg', 1200, 800),
            'status' => 'active',
            'featured' => 1
        ],
        [
            'title' => 'Feed 1000 Families Monthly',
            'slug' => 'feed-1000-families',
            'description' => '<p>Food insecurity affects countless families in our community. Our monthly food distribution program provides nutritious food packages to families struggling to meet their basic needs.</p><p>Each $50 donation provides a family of four with two weeks of essential groceries including rice, lentils, cooking oil, canned goods, fresh produce, and hygiene items.</p><p>Help us reach our goal of serving 1,000 families every month. Your contribution ensures no family goes hungry and parents can focus on other critical needs like healthcare and education.</p>',
            'goal_amount' => 60000.00,
            'raised_amount' => 42300.00,
            'image' => downloadImage('causes', 'feed-families.jpg', 1200, 800),
            'status' => 'active',
            'featured' => 1
        ],
        [
            'title' => 'Scholarship Fund for Underprivileged Students',
            'slug' => 'scholarship-fund-students',
            'description' => '<p>Talented students from low-income families often cannot pursue higher education due to financial constraints. Our scholarship program removes these barriers and helps students achieve their academic dreams.</p><p>Scholarships cover: Full tuition fees, Books and supplies, Living expenses, Mentorship and career guidance.</p><p>We aim to award 50 scholarships this year to deserving students who demonstrate academic excellence and financial need. Each scholarship costs $2,000 per year. Your donation can change a student\'s life trajectory and break the cycle of poverty through education.</p>',
            'goal_amount' => 100000.00,
            'raised_amount' => 58900.00,
            'image' => downloadImage('causes', 'scholarships.jpg', 1200, 800),
            'status' => 'active',
            'featured' => 0
        ],
        [
            'title' => 'Clean Water Project for Villages',
            'slug' => 'clean-water-project',
            'description' => '<p>Access to clean water is a basic human right, yet many villages in our region still lack safe drinking water. Residents, primarily women and children, walk kilometers daily to fetch water from contaminated sources.</p><p>This project will install 10 deep-water wells and hand pumps in villages currently without clean water access. Each well will serve approximately 200 people and includes: Water quality testing, Maintenance training for local communities, Sanitation education programs.</p><p>Your contribution will dramatically improve health outcomes and free up time for children to attend school instead of fetching water.</p>',
            'goal_amount' => 80000.00,
            'raised_amount' => 35600.00,
            'image' => downloadImage('causes', 'clean-water.jpg', 1200, 800),
            'status' => 'active',
            'featured' => 1
        ],
        [
            'title' => 'Women\'s Vocational Training Center',
            'slug' => 'womens-training-center',
            'description' => '<p>Economic empowerment is key to breaking the cycle of poverty. We\'re establishing a vocational training center to provide women with marketable skills and entrepreneurship training.</p><p>The center will offer courses in: Tailoring and fashion design, Computer skills and office management, Beauty and wellness services, Small business management, Financial literacy.</p><p>Funds will cover: Building renovation, Equipment and supplies, Instructor salaries for first year, Materials for 100 students. Upon completion, graduates receive job placement assistance and microloans to start their own businesses.</p>',
            'goal_amount' => 120000.00,
            'raised_amount' => 78200.00,
            'image' => downloadImage('causes', 'training-center.jpg', 1200, 800),
            'status' => 'active',
            'featured' => 0
        ],
        [
            'title' => 'Senior Citizens Support Program',
            'slug' => 'senior-citizens-support',
            'description' => '<p>Our elderly population faces unique challenges including health issues, social isolation, and financial hardship. This program provides comprehensive support to improve their quality of life.</p><p>Services include: Monthly food and medicine assistance, Regular health check-ups and home visits, Social activities and companionship programs, Legal and financial advice, Emergency assistance fund.</p><p>We currently serve 150 seniors and aim to expand to 300. Your donation of $30 per month sponsors one senior citizen, ensuring they receive the care and dignity they deserve in their golden years.</p>',
            'goal_amount' => 108000.00,
            'raised_amount' => 67400.00,
            'image' => downloadImage('causes', 'senior-support.jpg', 1200, 800),
            'status' => 'active',
            'featured' => 0
        ],
        [
            'title' => 'Orphanage Renovation and Expansion',
            'slug' => 'orphanage-renovation',
            'description' => '<p>Our orphanage, home to 75 children, urgently needs renovation and expansion. The building is over 30 years old, and we need additional space to accommodate more children in need of safe shelter.</p><p>Project scope includes: Structural repairs and weatherproofing, Dormitory expansion (adding capacity for 25 more children), Kitchen and dining hall renovation, Study rooms and library, Playground and recreational facilities, Solar panels for electricity.</p><p>This renovation will provide children with a safer, more comfortable living environment where they can heal, learn, and grow into successful adults.</p>',
            'goal_amount' => 175000.00,
            'raised_amount' => 92800.00,
            'image' => downloadImage('causes', 'orphanage-renovation.jpg', 1200, 800),
            'status' => 'active',
            'featured' => 0
        ]
    ];
    
    foreach ($causesData as $cause) {
        $id = insertRecord('causes', $cause);
        echo "  ✓ Created: {$cause['title']}\n";
    }
    
    // ========================================
    // 4. GALLERY - 8 Albums with 5 photos each
    // ========================================
    echo "\nCreating Gallery Albums and Images...\n";
    
    $albumsData = [
        [
            'title' => 'Education Initiative 2025',
            'slug' => 'education-initiative-2025',
            'description' => 'Photos from our education programs, showing students receiving tutoring, school supplies, and participating in learning activities.',
            'cover_image' => downloadImage('gallery', 'album-education-cover.jpg', 1200, 800),
            'photos' => 5
        ],
        [
            'title' => 'Community Health Fair 2025',
            'slug' => 'health-fair-2025',
            'description' => 'Highlights from our annual community health fair where we provided free health screenings and medical consultations.',
            'cover_image' => downloadImage('gallery', 'album-health-cover.jpg', 1200, 800),
            'photos' => 5
        ],
        [
            'title' => 'Food Distribution Program',
            'slug' => 'food-distribution-program',
            'description' => 'Volunteers distributing food packages to families in need during our monthly food distribution events.',
            'cover_image' => downloadImage('gallery', 'album-food-cover.jpg', 1200, 800),
            'photos' => 5
        ],
        [
            'title' => 'Women Empowerment Workshops',
            'slug' => 'women-empowerment-workshops',
            'description' => 'Women participating in our skills training and empowerment workshops, learning new trades and business skills.',
            'cover_image' => downloadImage('gallery', 'album-women-cover.jpg', 1200, 800),
            'photos' => 5
        ],
        [
            'title' => 'Community Cleanup Drive',
            'slug' => 'community-cleanup-drive',
            'description' => 'Volunteers working together to clean and beautify our neighborhoods during the annual cleanup campaign.',
            'cover_image' => downloadImage('gallery', 'album-cleanup-cover.jpg', 1200, 800),
            'photos' => 5
        ],
        [
            'title' => 'Children\'s Day Celebration',
            'slug' => 'childrens-day-celebration',
            'description' => 'Children enjoying games, activities, and entertainment during our special Children\'s Day celebration event.',
            'cover_image' => downloadImage('gallery', 'album-children-cover.jpg', 1200, 800),
            'photos' => 5
        ],
        [
            'title' => 'Charity Gala 2025',
            'slug' => 'charity-gala-2025',
            'description' => 'Memorable moments from our annual charity gala, featuring supporters, entertainment, and fundraising activities.',
            'cover_image' => downloadImage('gallery', 'album-gala-cover.jpg', 1200, 800),
            'photos' => 5
        ],
        [
            'title' => 'Rural Medical Camps',
            'slug' => 'rural-medical-camps',
            'description' => 'Medical professionals providing free healthcare services to residents of remote villages during our outreach camps.',
            'cover_image' => downloadImage('gallery', 'album-medical-cover.jpg', 1200, 800),
            'photos' => 5
        ]
    ];
    
    foreach ($albumsData as $albumData) {
        $photoCount = $albumData['photos'];
        unset($albumData['photos']);
        
        $albumId = insertRecord('gallery_albums', $albumData);
        echo "  ✓ Created Album: {$albumData['title']}\n";
        
        // Create photos for this album
        for ($i = 1; $i <= $photoCount; $i++) {
            $photoData = [
                'album_id' => $albumId,
                'image' => downloadImage('gallery', "album-{$albumId}-photo-{$i}.jpg", 1200, 800),
                'caption' => "Photo {$i} from {$albumData['title']}",
                'display_order' => $i
            ];
            insertRecord('gallery_images', $photoData);
            echo "    ✓ Added photo {$i}/{$photoCount}\n";
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
            'bio' => '<p>Dr. Sarah Mitchell brings over 20 years of experience in nonprofit management and community development. She holds a Ph.D. in Social Work from Columbia University and has dedicated her career to empowering underserved communities.</p><p>Before joining DTEHM, Sarah led several successful initiatives in education reform and healthcare access. Her vision and leadership have been instrumental in expanding our programs and impact.</p>',
            'email' => 'sarah.mitchell@ulfa.org',
            'phone' => '+1 (555) 123-4567',
            'photo' => downloadImage('team', 'sarah-mitchell.jpg', 600, 600),
            'facebook' => 'https://facebook.com/sarahmitchell',
            'twitter' => 'https://twitter.com/sarahmitchell',
            'linkedin' => 'https://linkedin.com/in/sarahmitchell',
            'display_order' => 1,
            'status' => 'active'
        ],
        [
            'name' => 'Michael Chen',
            'position' => 'Director of Programs',
            'bio' => '<p>Michael oversees all DTEHM programs, ensuring quality implementation and maximum impact. With a Master\'s degree in Public Administration and 15 years of program management experience, he excels at coordinating complex initiatives.</p><p>Michael\'s passion for community service began as a Peace Corps volunteer. He brings strategic thinking and operational excellence to every project.</p>',
            'email' => 'michael.chen@ulfa.org',
            'phone' => '+1 (555) 123-4568',
            'photo' => downloadImage('team', 'michael-chen.jpg', 600, 600),
            'facebook' => '',
            'twitter' => 'https://twitter.com/michaelchen',
            'linkedin' => 'https://linkedin.com/in/michaelchen',
            'display_order' => 2,
            'status' => 'active'
        ],
        [
            'name' => 'Dr. Aisha Patel',
            'position' => 'Healthcare Coordinator',
            'bio' => '<p>Dr. Aisha Patel is a board-certified physician specializing in community health. She leads our medical outreach programs and coordinates health education initiatives across all communities we serve.</p><p>Aisha\'s commitment to accessible healthcare drives her work in establishing medical camps and training community health workers. She believes quality healthcare is a fundamental right.</p>',
            'email' => 'aisha.patel@ulfa.org',
            'phone' => '+1 (555) 123-4569',
            'photo' => downloadImage('team', 'aisha-patel.jpg', 600, 600),
            'facebook' => 'https://facebook.com/aishapatel',
            'twitter' => '',
            'linkedin' => 'https://linkedin.com/in/aishapatel',
            'display_order' => 3,
            'status' => 'active'
        ],
        [
            'name' => 'James Rodriguez',
            'position' => 'Education Program Manager',
            'bio' => '<p>James manages our education initiatives, including tutoring programs, scholarship distribution, and school partnerships. A former teacher with a Master\'s in Education Policy, he understands the challenges facing underprivileged students.</p><p>His innovative approaches to education have helped hundreds of students improve their academic performance and access higher education opportunities.</p>',
            'email' => 'james.rodriguez@ulfa.org',
            'phone' => '+1 (555) 123-4570',
            'photo' => downloadImage('team', 'james-rodriguez.jpg', 600, 600),
            'facebook' => 'https://facebook.com/jamesrodriguez',
            'twitter' => 'https://twitter.com/jamesrodriguez',
            'linkedin' => '',
            'display_order' => 4,
            'status' => 'active'
        ],
        [
            'name' => 'Emily Thompson',
            'position' => 'Communications Director',
            'bio' => '<p>Emily leads our communications strategy, managing social media, public relations, and donor communications. With a background in journalism and nonprofit communications, she excels at storytelling that inspires action.</p><p>Her campaigns have significantly increased our visibility and donor engagement, helping us expand our reach and impact.</p>',
            'email' => 'emily.thompson@ulfa.org',
            'phone' => '+1 (555) 123-4571',
            'photo' => downloadImage('team', 'emily-thompson.jpg', 600, 600),
            'facebook' => 'https://facebook.com/emilythompson',
            'twitter' => 'https://twitter.com/emilythompson',
            'linkedin' => 'https://linkedin.com/in/emilythompson',
            'display_order' => 5,
            'status' => 'active'
        ],
        [
            'name' => 'David Kim',
            'position' => 'Finance Manager',
            'bio' => '<p>David ensures financial transparency and sustainability for DTEHM. As a Certified Public Accountant with nonprofit finance expertise, he manages budgets, grants, and financial reporting with meticulous attention to detail.</p><p>His financial stewardship ensures that every dollar donated is used efficiently to maximize our impact on the communities we serve.</p>',
            'email' => 'david.kim@ulfa.org',
            'phone' => '+1 (555) 123-4572',
            'photo' => downloadImage('team', 'david-kim.jpg', 600, 600),
            'facebook' => '',
            'twitter' => '',
            'linkedin' => 'https://linkedin.com/in/davidkim',
            'display_order' => 6,
            'status' => 'active'
        ],
        [
            'name' => 'Maria Santos',
            'position' => 'Volunteer Coordinator',
            'bio' => '<p>Maria recruits, trains, and coordinates our amazing volunteer network of over 500 active volunteers. Her organizational skills and warm personality make every volunteer feel valued and empowered.</p><p>She believes volunteers are the heart of our organization and works tirelessly to create meaningful engagement opportunities that match skills with community needs.</p>',
            'email' => 'maria.santos@ulfa.org',
            'phone' => '+1 (555) 123-4573',
            'photo' => downloadImage('team', 'maria-santos.jpg', 600, 600),
            'facebook' => 'https://facebook.com/mariasantos',
            'twitter' => 'https://twitter.com/mariasantos',
            'linkedin' => 'https://linkedin.com/in/mariasantos',
            'display_order' => 7,
            'status' => 'active'
        ],
        [
            'name' => 'Robert Johnson',
            'position' => 'Operations Manager',
            'bio' => '<p>Robert oversees day-to-day operations, facilities management, and logistics for all DTEHM programs and events. His military background brings discipline and efficiency to our operational processes.</p><p>From coordinating large-scale events to managing supply chains for our distribution programs, Robert ensures everything runs smoothly behind the scenes.</p>',
            'email' => 'robert.johnson@ulfa.org',
            'phone' => '+1 (555) 123-4574',
            'photo' => downloadImage('team', 'robert-johnson.jpg', 600, 600),
            'facebook' => '',
            'twitter' => '',
            'linkedin' => 'https://linkedin.com/in/robertjohnson',
            'display_order' => 8,
            'status' => 'active'
        ]
    ];
    
    foreach ($teamData as $member) {
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
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
