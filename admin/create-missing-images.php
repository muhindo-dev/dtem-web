<?php
/**
 * Create missing team member images
 */

// Create missing team images (9-17)
function createPlaceholderImage($filename, $text, $width = 600, $height = 600) {
    $filepath = "../uploads/{$filename}";
    
    // Skip if already exists
    if (file_exists($filepath)) {
        return false;
    }
    
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
    
    return true;
}

echo "Creating missing team member images...\n\n";

$created = 0;
for ($i = 1; $i <= 17; $i++) {
    $filename = "team-{$i}.jpg";
    if (createPlaceholderImage($filename, "TEAM {$i}", 600, 600)) {
        echo "  ✓ Created {$filename}\n";
        $created++;
    } else {
        echo "  • {$filename} already exists\n";
    }
}

echo "\n✅ Created {$created} missing images!\n";
echo "Total team images: 17\n";
