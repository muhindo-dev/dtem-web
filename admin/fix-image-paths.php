<?php
/**
 * Update image paths in database to match actual files
 */

require_once '../config.php';
require_once '../functions.php';
require_once 'config/crud-helper.php';

try {
    $pdo = getDBConnection();
    
    echo "Updating image paths in database...\n\n";
    
    // Update News
    echo "Updating News images...\n";
    $news = $pdo->query("SELECT id FROM news_posts ORDER BY id")->fetchAll();
    foreach ($news as $index => $item) {
        $filename = 'news-' . ($index + 1) . '.jpg';
        $pdo->exec("UPDATE news_posts SET featured_image = '{$filename}' WHERE id = {$item['id']}");
        echo "  ✓ News #{$item['id']} -> {$filename}\n";
    }
    
    // Update Events
    echo "\nUpdating Events images...\n";
    $events = $pdo->query("SELECT id FROM events ORDER BY id")->fetchAll();
    foreach ($events as $index => $item) {
        $filename = 'event-' . ($index + 1) . '.jpg';
        $pdo->exec("UPDATE events SET event_image = '{$filename}' WHERE id = {$item['id']}");
        echo "  ✓ Event #{$item['id']} -> {$filename}\n";
    }
    
    // Update Causes
    echo "\nUpdating Causes images...\n";
    $causes = $pdo->query("SELECT id FROM causes ORDER BY id")->fetchAll();
    foreach ($causes as $index => $item) {
        $filename = 'cause-' . ($index + 1) . '.jpg';
        $pdo->exec("UPDATE causes SET cause_image = '{$filename}' WHERE id = {$item['id']}");
        echo "  ✓ Cause #{$item['id']} -> {$filename}\n";
    }
    
    // Update Gallery Albums
    echo "\nUpdating Gallery Albums images...\n";
    $albums = $pdo->query("SELECT id FROM gallery_albums ORDER BY id")->fetchAll();
    foreach ($albums as $index => $item) {
        $filename = 'gallery-album-' . ($index + 1) . '.jpg';
        $pdo->exec("UPDATE gallery_albums SET cover_image = '{$filename}' WHERE id = {$item['id']}");
        echo "  ✓ Album #{$item['id']} -> {$filename}\n";
        
        // Update album images
        $pdo->exec("UPDATE gallery_images SET image_path = 'gallery-album-{$item['id']}-img-1.jpg' WHERE album_id = {$item['id']} AND sort_order = 1");
        $pdo->exec("UPDATE gallery_images SET image_path = 'gallery-album-{$item['id']}-img-2.jpg' WHERE album_id = {$item['id']} AND sort_order = 2");
        $pdo->exec("UPDATE gallery_images SET image_path = 'gallery-album-{$item['id']}-img-3.jpg' WHERE album_id = {$item['id']} AND sort_order = 3");
        $pdo->exec("UPDATE gallery_images SET image_path = 'gallery-album-{$item['id']}-img-4.jpg' WHERE album_id = {$item['id']} AND sort_order = 4");
        $pdo->exec("UPDATE gallery_images SET image_path = 'gallery-album-{$item['id']}-img-5.jpg' WHERE album_id = {$item['id']} AND sort_order = 5");
    }
    
    // Update Team Members
    echo "\nUpdating Team Member photos...\n";
    $team = $pdo->query("SELECT id FROM team_members ORDER BY id")->fetchAll();
    foreach ($team as $index => $item) {
        $filename = 'team-' . ($index + 1) . '.jpg';
        $pdo->exec("UPDATE team_members SET photo = '{$filename}' WHERE id = {$item['id']}");
        echo "  ✓ Team #{$item['id']} -> {$filename}\n";
    }
    
    echo "\n✅ All image paths updated successfully!\n";
    echo "\nYou can now refresh your admin panel to see the images.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
