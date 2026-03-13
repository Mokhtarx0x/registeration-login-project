<?php
session_start();
require 'config.php';

// Protect this page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Get user data
$id     = $_SESSION["user_id"];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user   = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Top bar -->
<div class="dashboard-header">
  <h2>Authentication Dashboard</h2>
  <a href="logout.php">Log Out</a>
</div>

<!-- Content -->
<div class="dashboard-body">
  <h1>Hello, <?= htmlspecialchars($user["first_name"]) ?>! </h1>

  <div class="info-card">
    <h3>Your Profile</h3>

    <div class="info-row">
      <span>Full Name</span>
      <span><?= htmlspecialchars($user["first_name"] . " " . $user["second_name"]) ?></span>
    </div>

    <div class="info-row">
      <span>Username</span>
      <span>@<?= htmlspecialchars($user["username"]) ?></span>
    </div>

    <div class="info-row">
      <span>Email</span>
      <span><?= htmlspecialchars($user["email"]) ?></span>
    </div>

    <div class="info-row">
      <span>Member Since</span>
      <span><?= date("F j, Y", strtotime($user["created_at"])) ?></span>
    </div>
  </div>
</div>

</body>
</html>
