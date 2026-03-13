<?php
session_start();
require 'config.php';

// Already logged in
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";

    } else {
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        $user   = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"]    = $user["id"];
            $_SESSION["username"]   = $user["username"];
            $_SESSION["first_name"] = $user["first_name"];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect username or password.";
        }
    }
}

$flash = $_SESSION["flash"] ?? "";
unset($_SESSION["flash"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="auth-container">
  <div class="auth-box">
    <h1>Welcome Back</h1>
    <p>No account yet? <a href="register.php">Register</a></p>

    <?php if ($flash): ?>
      <div class="success"><?= htmlspecialchars($flash) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">

      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter your username" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>

      <button type="submit" class="btn">Log In</button>
    </form>
  </div>
</div>

</body>
</html>
