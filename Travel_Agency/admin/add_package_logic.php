<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../config/db.php";

if (isset($_POST['add_package_btn'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $transport = $_POST['transport'];

    $image_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $folder = "../assets/images/" . $image_name;

    if (move_uploaded_file($temp_name, $folder)) {

        try {
            $sql = "INSERT INTO packages (title, price, transport_type, image_path) VALUES (:title, :price, :transport, :image)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                "title" => $title,
                "price" => $price,
                "transport" => $transport,
                "image" => $image_name
            ]);

            echo "Package Added Successfully!";
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    } else {
        echo "Failed to upload image.";
    }
}