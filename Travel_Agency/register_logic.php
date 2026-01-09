<?php

require_once 'config/db.php';

if (isset($_POST['register_btn'])) {

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($full_name) || empty($email) || empty($passwrod)) {
        die("Please fill all fields");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (full_name, email, password) VALUES (:name, :email, :pass)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'name' => $full_name,
            'email' => $email,
            'pass' => $hashed_password
        ]);

        echo "Registration successful! <a href='login.php'>Login here</a>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Email already registered!";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>