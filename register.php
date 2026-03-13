<?php
session_start();
require 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username    = trim($_POST["username"]);
    $email       = trim($_POST["email"]);
    $password    = $_POST["password"];
    $first_name  = trim($_POST["first_name"]);
    $second_name = trim($_POST["second_name"]);

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($first_name) || empty($second_name)) {
        $error = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";

    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";

    } else {
        // Check if username or email already exists
        $check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' OR email='$email'");

        if (mysqli_num_rows($check) > 0) {
            $error = "Username or email is already taken.";

        } else {
            // Save user to database
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password, first_name, second_name)
                    VALUES ('$username', '$email', '$hashed', '$first_name', '$second_name')";

            if (mysqli_query($conn, $sql)) {
                $_SESSION["flash"] = "Account created! Please log in.";
                header("Location: login.php");
                exit;
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="auth-container">
  <div class="auth-box">
    <h1>Create Account</h1>
    <p>Already have one? <a href="login.php">Log in</a></p>

    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php">

      <div class="form-row">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="first_name" placeholder="First Name:" required>
        </div>
        <div class="form-group">
          <label>Second Name</label>
          <input type="text" name="second_name" placeholder="Second Name :" required>
        </div>
      </div>

      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Min. 6 characters" required>
      </div>

      <button type="submit" class="btn">Register</button>
    </form>
  </div>
</div>

</body>
</html>
