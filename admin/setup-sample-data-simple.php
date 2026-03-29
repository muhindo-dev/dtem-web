<?php
/**
 * Setup Sample Data - Simplified Version
 * All images stored in single uploads folder
 */

require_once '../config.php';
require_once '../functions.php';
require_once 'config/crud-helper.php';

// Ensure uploads directory exists
if (!file_exists('../uploads')) {
    mkdir('../uploads', 0777, true);
}

// Helper function to create a simple colored placeholder image
function createPlaceholderImage($filename, $text, $width = 1200, $height = 800) {
    $filepath = "../uploads/{$filename}";
    
    // Create image
    $image = imagecreatetruecolor($width, $height);
    
    // Random background color
    $colors = [
        [52, 152, 219],   // Blue
        [46, 204, 113],   // Green
        [155, 89, 182],   // Purple
        [241, 196, 15],   // Yellow
        [230, 126, 34],   // Orange
        [231, 76, 60],    // Red
        [52, 73, 94]      // Dark blue
    ];
    
    $color = $colors[array_rand($colors)];
    $bg = imagecolorallocate($image, $color[0], $color[1], $color[2]);
    imagefill($image, 0, 0, $bg);
    
    // White text
    $white = imagecolorallocate($image, 255, 255, 255);
    
    // Add text
    $font_size = 5;
    $text_width = imagefontwidth($font_size) * strlen($text);
    $text_height = imagefontheight($font_size);
    $x = ($width - $text_width) / 2;
    $y = ($height - $text_height) / 2;
    
    imagestring($image, $font_size, $x, $y, $text, $white);
    
    // Save as JPEG
    imagejpeg($image, $filepath, 90);
    imagedestroy($image);
    
    return $filename;
}

try {
    $pdo = getDBConnection();
    
    echo "Setting up sample data with simplified image storage...\n\n";
    
    // ========================================
    // 1. NEWS ARTICLES
    // ========================================
    echo "Creating News Articles...\n";
    
    $newsArticles = [
        ['title' => 'Education Initiative Launch', 'category' => 'Education'],
        ['title' => 'Community Cleanup Success', 'category' => 'Community'],
        ['title' => 'Food Distribution Program', 'category' => 'Relief'],
        ['title' => 'Free Medical Camp', 'category' => 'Healthcare'],
        ['title' => 'Skills Training Graduation', 'category' => 'Empowerment'],
        ['title' => 'School Nutrition Partnership', 'category' => 'Education'],
        ['title' => 'Youth Mentorship Launch', 'category' => 'Youth'],
        ['title' => 'Flood Relief Response', 'category' => 'Relief']
    ];
    
    foreach ($newsArticles as $index => $article) {
        $filename = 'news-' . ($index + 1) . '.jpg';
        createPlaceholderImage($filename, 'NEWS ' . ($index + 1), 1200, 800);
        
        $newsData = [
            'title' => $article['title'],
            'slug' => strtolower(str_replace(' ', '-', $article['title'])),
            'category' => $article['category'],
            'excerpt' => 'This is a sample news article about ' . $article['title'] . '. It provides important information about DTEHM\'s charitable activities and community impact.',
            'content' => '<p>This is detailed content for ' . $article['title'] . '. Our organization continues to make a positive impact in the community through dedicated programs and volunteer efforts.</p><p>We are committed to serving those in need and creating lasting change in our communities.</p>',
            'featured_image' => $filename,
            'author_id' => 1,
            'status' => 'published',
            'published_at' => date('Y-m-d H:i:s', strtotime('-' . ($index + 1) . ' days'))
        ];
        
        insertRecord('news_posts', $newsData);
        echo "  ✓ {$article['title']} -> {$filename}\n";
    }
    
    // ========================================
    // 2. EVENTS
    // ========================================
    echo "\nCreating Events...\n";
    
    $events = [
        ['title' => 'Annual Charity Gala 2026', 'type' => 'Fundraiser', 'days' => 55],
        ['title' => 'Community Health Fair', 'type' => 'Healthcare', 'days' => 34],
        ['title' => 'Education Summit', 'type' => 'Conference', 'days' => 81],
        ['title' => 'Spring Cleanup Drive', 'type' => 'Volunteer', 'days' => 68],
        ['title' => 'Computer Literacy Workshop', 'type' => 'Workshop', 'days' => 30],
        ['title' => 'Charity 5K Run', 'type' => 'Fundraiser', 'days' => 111],
        ['title' => 'Women Empowerment Workshop', 'type' => 'Workshop', 'days' => 48],
        ['title' => 'School Supply Distribution', 'type' => 'Distribution', 'days' => 208]
    ];
    
    foreach ($events as $index => $event) {
        $filename = 'event-' . ($index + 1) . '.jpg';
        createPlaceholderImage($filename, 'EVENT ' . ($index + 1), 1200, 800);
        
        $eventData = [
            'title' => $event['title'],
            'slug' => strtolower(str_replace(' ', '-', $event['title'])),
            'description' => '<p>Join us for ' . $event['title'] . '. This is an important event that brings our community together to support DTEHM\'s mission.</p><p>Registration and more details available on our website.</p>',
            'event_image' => $filename,
            'event_type' => $event['type'],
            'start_datetime' => date('Y-m-d 10:00:00', strtotime('+' . $event['days'] . ' days')),
            'end_datetime' => date('Y-m-d 16:00:00', strtotime('+' . $event['days'] . ' days')),
            'venue_name' => 'DTEHM Community Center',
            'venue_address' => '456 Community Avenue',
            'registration_required' => 1,
            'max_capacity' => 200,
            'status' => 'upcoming',
            'created_by' => 1
        ];
        
        insertRecord('events', $eventData);
        echo "  ✓ {$event['title']} -> {$filename}\n";
    }
    
    // ========================================
    // 3. CAUSES
    // ========================================
    echo "\nCreating Causes...\n";
    
    $causes = [
        ['title' => 'Build a School', 'category' => 'Education', 'goal' => 150000, 'raised' => 87500],
        ['title' => 'Medical Equipment Fund', 'category' => 'Healthcare', 'goal' => 200000, 'raised' => 145000],
        ['title' => 'Feed 1000 Families', 'category' => 'Food Security', 'goal' => 60000, 'raised' => 42300],
        ['title' => 'Student Scholarships', 'category' => 'Education', 'goal' => 100000, 'raised' => 58900],
        ['title' => 'Clean Water Project', 'category' => 'Water', 'goal' => 80000, 'raised' => 35600],
        ['title' => 'Women Training Center', 'category' => 'Empowerment', 'goal' => 120000, 'raised' => 78200],
        ['title' => 'Senior Citizens Support', 'category' => 'Elder Care', 'goal' => 108000, 'raised' => 67400],
        ['title' => 'Orphanage Renovation', 'category' => 'Child Welfare', 'goal' => 175000, 'raised' => 92800]
    ];
    
    foreach ($causes as $index => $cause) {
        $filename = 'cause-' . ($index + 1) . '.jpg';
        createPlaceholderImage($filename, 'CAUSE ' . ($index + 1), 1200, 800);
        
        $causeData = [
            'title' => $cause['title'],
            'slug' => strtolower(str_replace(' ', '-', $cause['title'])),
            'description' => '<p>Support our ' . $cause['title'] . ' initiative. Your donation will make a direct impact on the lives of those we serve.</p><p>Every contribution counts and helps us reach our goal.</p>',
            'cause_image' => $filename,
            'category' => $cause['category'],
            'goal_amount' => $cause['goal'],
            'raised_amount' => $cause['raised'],
            'start_date' => date('Y-m-d', strtotime('-30 days')),
            'urgency' => $cause['raised'] < ($cause['goal'] * 0.5) ? 'high' : 'medium',
            'is_featured' => $index < 3 ? 1 : 0,
            'status' => 'active',
            'created_by' => 1
        ];
        
        insertRecord('causes', $causeData);
        echo "  ✓ {$cause['title']} -> {$filename}\n";
    }
    
    // ========================================
    // 4. GALLERY ALBUMS
    // ========================================
    echo "\nCreating Gallery Albums...\n";
    
    $albums = [
        ['title' => 'Education Programs 2025', 'category' => 'Education'],
        ['title' => 'Health Fair Events', 'category' => 'Healthcare'],
        ['title' => 'Food Distribution', 'category' => 'Relief'],
        ['title' => 'Women Empowerment', 'category' => 'Empowerment'],
        ['title' => 'Community Cleanups', 'category' => 'Community'],
        ['title' => 'Children Activities', 'category' => 'Youth'],
        ['title' => 'Fundraising Galas', 'category' => 'Events'],
        ['title' => 'Medical Outreach', 'category' => 'Healthcare']
    ];
    
    foreach ($albums as $index => $album) {
        $cover_filename = 'gallery-album-' . ($index + 1) . '.jpg';
        createPlaceholderImage($cover_filename, 'ALBUM ' . ($index + 1), 1200, 800);
        
        $albumData = [
            'title' => $album['title'],
            'slug' => strtolower(str_replace(' ', '-', $album['title'])),
            'description' => 'Photo collection from ' . $album['title'] . ' showcasing our community impact and volunteer activities.',
            'cover_image' => $cover_filename,
            'category' => $album['category'],
            'status' => 'active',
            'created_by' => 1
        ];
        
        $albumId = insertRecord('gallery_albums', $albumData);
        echo "  ✓ {$album['title']} -> {$cover_filename}\n";
        
        // Add 5 images to each album
        if ($albumId) {
            for ($i = 1; $i <= 5; $i++) {
                $img_filename = 'gallery-album-' . ($index + 1) . '-img-' . $i . '.jpg';
                createPlaceholderImage($img_filename, 'Photo ' . $i, 1200, 800);
                
                $imageData = [
                    'album_id' => $albumId,
                    'image_path' => $img_filename,
                    'title' => 'Photo ' . $i,
                    'caption' => 'Image ' . $i . ' from ' . $album['title'],
                    'sort_order' => $i
                ];
                
                insertRecord('gallery_images', $imageData);
            }
            echo "    Added 5 photos\n";
        }
    }
    
    // ========================================
    // 5. TEAM MEMBERS
    // ========================================
    echo "\nCreating Team Members...\n";
    
    $team = [
        ['name' => 'Dr. Sarah Mitchell', 'position' => 'Executive Director', 'dept' => 'Leadership'],
        ['name' => 'Michael Chen', 'position' => 'Director of Programs', 'dept' => 'Management'],
        ['name' => 'Dr. Aisha Patel', 'position' => 'Healthcare Coordinator', 'dept' => 'Program Staff'],
        ['name' => 'James Rodriguez', 'position' => 'Education Manager', 'dept' => 'Program Staff'],
        ['name' => 'Emily Thompson', 'position' => 'Communications Director', 'dept' => 'Administrative'],
        ['name' => 'David Kim', 'position' => 'Finance Manager', 'dept' => 'Administrative'],
        ['name' => 'Maria Santos', 'position' => 'Volunteer Coordinator', 'dept' => 'Program Staff'],
        ['name' => 'Robert Johnson', 'position' => 'Operations Manager', 'dept' => 'Management']
    ];
    
    foreach ($team as $index => $member) {
        $filename = 'team-' . ($index + 1) . '.jpg';
        createPlaceholderImage($filename, strtoupper(substr($member['name'], 0, 2)), 600, 600);
        
        $memberData = [
            'name' => $member['name'],
            'slug' => strtolower(str_replace(' ', '-', $member['name'])),
            'position' => $member['position'],
            'department' => $member['dept'],
            'bio' => $member['name'] . ' is a dedicated member of the DTEHM team, bringing expertise and passion to the ' . $member['position'] . ' role. With years of experience in nonprofit work, ' . explode(' ', $member['name'])[0] . ' helps drive our mission forward.',
            'photo' => $filename,
            'email' => strtolower(str_replace(' ', '.', $member['name'])) . '@ulfa.org',
            'phone' => '+1 (555) 123-45' . (67 + $index),
            'social_linkedin' => 'https://linkedin.com/in/' . strtolower(str_replace(' ', '', $member['name'])),
            'display_order' => $index + 1,
            'status' => 'active'
        ];
        
        insertRecord('team_members', $memberData);
        echo "  ✓ {$member['name']} -> {$filename}\n";
    }
    
    echo "\n========================================\n";
    echo "✓ Sample data setup completed!\n";
    echo "========================================\n\n";
    echo "Summary:\n";
    echo "- 8 News Articles with images\n";
    echo "- 8 Events with images\n";
    echo "- 8 Causes with images\n";
    echo "- 8 Gallery Albums with 5 photos each (48 total images)\n";
    echo "- 8 Team Members with photos\n";
    echo "\n✓ All images stored in: /uploads/\n";
    echo "✓ Total images created: " . (8 + 8 + 8 + 40 + 8) . "\n";
    
} catch (Exception $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
}
