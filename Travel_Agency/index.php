<?php

session_start();
require_once 'config/db.php';

$stmt = $pdo->query("SELECT * FROM packages");
$packages = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Destination | Travel Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .package=card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a href="#" class="navbar-brand">TravelEase</a>
            <div class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="nav-link text-white">
                        Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
                    <a href="logout.php" class="nav-link">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="nav-link">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- main section -->
    <div class="container">
        <h2 class="mb-4">Top Vocation Packages</h2>
        <div class="row">
            <?php foreach ($packages as $package): ?>
                <div class="col-md-4 mb-4">
                    <div class="card package-card shadow-sm">
                        <img src="assets/images/<?php echo $package['image_path']; ?>" class="card-img-top"
                            alt="Package Image">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($package['title']); ?></h5>
                            <p class="text-muted">Transport: <?php echo $package['transport_type']; ?></p>
                            <h4 class="text-primary">$<?php echo number_format($package['price'], 2); ?></h4>

                            <a href="book_now.php?id=<?php echo $package['id']; ?>"
                                class="btn btn-outline-primary w-100 mt-2">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>