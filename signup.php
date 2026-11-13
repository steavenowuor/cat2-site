<?php
include 'db.php';
$msg = "";
$cls = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = trim($_POST['username']);
    $e = trim($_POST['email']);
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $u, $e, $p);
        $stmt->execute();
        $msg = "Registered successfully. You can now log in.";
        $cls = "ok";
    } catch (mysqli_sql_exception $ex) {
        $msg = "Could not register: username already exists.";
        $cls = "err";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Sign Up</title><link rel="stylesheet" href="style.css"></head>
<body>
<nav><a href="index.php">Home</a><a href="signup.php">Sign Up</a><a href="login.php">Login</a><a href="feedback.php">Feedback</a></nav>
<div class="box">
  <h2>Create an account</h2>
  <?php if ($msg) echo "<div class='msg $cls'>" . htmlspecialchars($msg) . "</div>"; ?>
  <form method="POST">
    <input name="username" placeholder="Username" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Sign up</button>
  </form>
</div>
</body>
</html>
