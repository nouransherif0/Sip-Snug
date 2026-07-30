<?php
/**
 * Utility script to create storage symlink on shared hosting like InfinityFree.
 * Visit: http://your-domain.com/symlink.php (or http://your-domain.com/public/symlink.php)
 */

$target = __DIR__ . '/../storage/app/public';
$link = __DIR__ . '/storage';

echo "<h2>Laravel Storage Symlink Generator for Shared Hosting</h2>";

if (file_exists($link)) {
    echo "<p style='color: orange;'>Symlink or directory <strong>'$link'</strong> already exists!</p>";
} else {
    if (!file_exists($target)) {
        mkdir($target, 0755, true);
        echo "<p style='color: blue;'>Created missing target directory: $target</p>";
    }
    
    if (function_exists('symlink')) {
        if (@symlink($target, $link)) {
            echo "<p style='color: green;'><strong>SUCCESS!</strong> Symlink created successfully:<br>From: <code>$target</code><br>To: <code>$link</code></p>";
        } else {
            echo "<p style='color: red;'><strong>FAILED!</strong> Unable to create symlink using symlink() function. Server permissions or restriction might be active.</p>";
        }
    } else {
        echo "<p style='color: red;'><strong>ERROR:</strong> <code>symlink()</code> function is disabled on this server PHP configuration.</p>";
    }
}
?>
