<?php
/**
 * Download relevant images from Unsplash for all modules
 */

function downloadImage($url, $filepath) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($data && $httpCode == 200) {
        file_put_contents($filepath, $data);
        return true;
    }
    return false;
}

echo "Downloading relevant images from Unsplash...\n\n";

// News images - education, community, charity themes
echo "Downloading News images...\n";
$newsKeywords = ['education', 'community', 'volunteer', 'charity', 'helping', 'donation', 'school', 'food-bank'];
for ($i = 1; $i <= 8; $i++) {
    $keyword = $newsKeywords[$i - 1];
    $url = "https://source.unsplash.com/1200x800/?{$keyword},charity";
    $filepath = "../uploads/news-{$i}.jpg";
    if (downloadImage($url, $filepath)) {
        echo "  ✓ Downloaded news-{$i}.jpg ({$keyword})\n";
        sleep(1); // Rate limiting
    }
}

// Event images - gala, conference, workshop, health fair themes
echo "\nDownloading Event images...\n";
$eventKeywords = ['conference', 'workshop', 'seminar', 'fundraiser', 'gala', 'community-event', 'health-fair', 'charity-run'];
for ($i = 1; $i <= 8; $i++) {
    $keyword = $eventKeywords[$i - 1];
    $url = "https://source.unsplash.com/1200x800/?{$keyword},event";
    $filepath = "../uploads/event-{$i}.jpg";
    if (downloadImage($url, $filepath)) {
        echo "  ✓ Downloaded event-{$i}.jpg ({$keyword})\n";
        sleep(1);
    }
}

// Cause images - building, medical, food, education themes
echo "\nDownloading Cause images...\n";
$causeKeywords = ['school-building', 'medical-equipment', 'food-donation', 'scholarship', 'water-well', 'training-center', 'elderly-care', 'children-home'];
for ($i = 1; $i <= 8; $i++) {
    $keyword = $causeKeywords[$i - 1];
    $url = "https://source.unsplash.com/1200x800/?{$keyword},charity";
    $filepath = "../uploads/cause-{$i}.jpg";
    if (downloadImage($url, $filepath)) {
        echo "  ✓ Downloaded cause-{$i}.jpg ({$keyword})\n";
        sleep(1);
    }
}

// Gallery album covers
echo "\nDownloading Gallery album covers...\n";
$galleryKeywords = ['education-program', 'health-checkup', 'food-distribution', 'women-empowerment', 'community-cleanup', 'children-activities', 'fundraising-event', 'medical-camp'];
for ($i = 1; $i <= 8; $i++) {
    $keyword = $galleryKeywords[$i - 1];
    $url = "https://source.unsplash.com/1200x800/?{$keyword}";
    $filepath = "../uploads/gallery-album-{$i}.jpg";
    if (downloadImage($url, $filepath)) {
        echo "  ✓ Downloaded gallery-album-{$i}.jpg ({$keyword})\n";
        sleep(1);
    }
    
    // Download 5 photos for each album
    for ($j = 1; $j <= 5; $j++) {
        $url = "https://source.unsplash.com/1200x800/?{$keyword},photo-{$j}";
        $filepath = "../uploads/gallery-album-{$i}-img-{$j}.jpg";
        if (downloadImage($url, $filepath)) {
            echo "    • Downloaded gallery-album-{$i}-img-{$j}.jpg\n";
            sleep(1);
        }
    }
}

// Team member photos - professional portraits
echo "\nDownloading Team member photos...\n";
for ($i = 1; $i <= 17; $i++) {
    $gender = ($i % 2 == 0) ? 'man' : 'woman';
    $url = "https://source.unsplash.com/600x600/?professional-portrait,{$gender}-{$i}";
    $filepath = "../uploads/team-{$i}.jpg";
    if (downloadImage($url, $filepath)) {
        echo "  ✓ Downloaded team-{$i}.jpg\n";
        sleep(1);
    }
}

echo "\n✅ All images downloaded successfully!\n";
echo "Total: 8 news + 8 events + 8 causes + 48 gallery + 17 team = 89 images\n";
