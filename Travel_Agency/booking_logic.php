<?php
session_start();
require_once 'config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please login first to book a trip!");
}

if (isset($_POST['confirm_booking'])) {
    $user_id = $_SESSION['user_id'];
    $package_id = $_POST['package_id'];
    $persons = $_POST['person_count'];

    try {
        // 1. Get the price from DB (don't trust the frontend price!)
        $stmt = $pdo->prepare("SELECT price FROM packages WHERE id = :id");
        $stmt->execute(['id' => $package_id]);
        $package = $stmt->fetch();

        $total_price = $package['price'] * $persons;

        // 2. Insert into the 'bookings' table
        $sql = "INSERT INTO bookings (user_id, package_id, total_price) VALUES (:uid, :pid, :total)";
        $insert = $pdo->prepare($sql);
        $insert->execute([
            'uid' => $user_id,
            'pid' => $package_id,
            'total' => $total_price
        ]);

        // 3. Success! Send them to their dashboard
        header("Location: my_bookings.php?msg=success");
        exit();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}