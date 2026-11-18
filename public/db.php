<?php
// Database settings (XAMPP defaults)
$host    = "localhost";
$dbName  = "newtown_attendance";
$dbUser  = "root";
$dbPass  = "";          // XAMPP's root user has no password by default

try {
    // PDO is PHP's built-in database connector
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPass
    );
    // Show real errors instead of failing silently
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Return rows as ["column" => value] arrays
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}