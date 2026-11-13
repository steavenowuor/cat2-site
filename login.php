<?php
include 'db.php';
session_start();
$msg = "";
$cls = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if ($row && password_verify($_POST['password'], $row['password'])) {
        $_SESSION['user'] = $_POST['username'];
        $msg = "Login successful. Welcome, " . $_POST['username'] . "!";
        $cls = "ok";
    } else {
        $msg = "Invalid username or password.";
        $cls = "err";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body>
<nav><a href="index.php">Home</a><a href="signup.php">Sign Up</a><a href="login.php">Login</a><a href="feedback.php">Feedback</a></nav>
<div class="box">
  <h2>Login</h2>
  <?php if ($msg) echo "<div class='msg $cls'>" . htmlspecialchars($msg) . "</div>"; ?>
  <form method="POST">
    <input name="username" placeholder="Username" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
</div>
</body>
</html>
