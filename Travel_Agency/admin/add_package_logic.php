<?php

require_once "../config/db.php";

if (isset($_POST['add-package-btn'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $transport = $_POST['transport'];

    $image_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $folder = "../assets/images/" . $image_name;

    if (move_uploaded_file($temp_name, $folder)) {

        try {
            $sql = "INSERT INTO packages (title, price, transport_type, image_path) VALUES (:title, :price, :transport, :image)";
            $stme = $pdo->prepare($sql);
            $stmt->execute([
                "title" => $title,
                "price" => $price,
                "transport" => $transport,
                "img" => $image_name
            ]);

            echo "Package Added Successfully!";
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    } else {
        echo "Failed to upload image.";
    }
}