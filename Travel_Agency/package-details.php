<?php
session_start();
require_once 'config/db.php';

// 1. Get the ID from the URL (e.g., package-details.php?id=5)
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// 2. Fetch only THIS package
$stmt = $pdo->prepare("SELECT * FROM packages WHERE id = :id");
$stmt->execute(['id' => $id]);
$package = $stmt->fetch();

if (!$package) {
    die("Package not found!");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $package['title']; ?> - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row bg-white shadow rounded overflow-hidden">
            <div class="col-md-6 p-0">
                <img src="assets/images/<?php echo $package['image_path']; ?>" class="img-fluid w-100"
                    style="height: 100%; object-fit: cover;">
            </div>

            <div class="col-md-6 p-5">
                <h1><?php echo htmlspecialchars($package['title']); ?></h1>
                <p class="badge bg-info text-dark"><?php echo $package['transport_type']; ?></p>
                <hr>

                <h3 class="text-primary">Base Price: $<span id="base-price"><?php echo $package['price']; ?></span></h3>

                <form action="booking_logic.php" method="POST">

                    <input type="hidden" name="package_id" value="<?php echo $package['id']; ?>">

                    <div class="mt-4">
                        <label>Number of Persons:</label>
                        <input type="number" name="person_count" id="person-count" class="form-control w-25" value="1"
                            min="1">
                    </div>

                    <div class="mt-4 p-3 bg-light border rounded">
                        <h5>Total Amount:</h5>
                        <h2 class="text-success">$<span id="total-price"><?php echo $package['price']; ?></span></h2>
                    </div>

                    <button type="submit" name="confirm_booking" class="btn btn-success btn-lg w-100 mt-4">
                        Book This Trip Now
                    </button>
                </form>



                <!-- <button class="btn btn-success btn-lg w-100 mt-4">Book This Trip</button> -->
            </div>
        </div>
    </div>

    <script>
        // 1. Grab elements from the DOM (Document Object Model)
        const personInput = document.getElementById('person-count');
        const basePrice = parseFloat(document.getElementById('base-price').innerText);
        const totalPriceDisplay = document.getElementById('total-price');

        // 2. Add an Event Listener
        // 'input' fires every time the user types or clicks the arrows
        personInput.addEventListener('input', function () {
            let count = personInput.value;

            // 3. Logic: Calculate
            if (count < 1) count = 1; // Prevent negative numbers
            const total = count * basePrice;

            // 4. Update the UI
            totalPriceDisplay.innerText = total.toFixed(2);
        });
    </script>

</body>

</html>