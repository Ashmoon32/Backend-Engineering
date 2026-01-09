<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
<p>You can now see our exclusive travel packages.</p>
<a href="logout.php">Logout</a>