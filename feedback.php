<?php
include 'db.php';
$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO feedback (name, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['name'], $_POST['message']);
    $stmt->execute();
    $msg = "Feedback submitted.";
}
$res = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Feedback</title><link rel="stylesheet" href="style.css"></head>
<body>
<nav><a href="index.php">Home</a><a href="signup.php">Sign Up</a><a href="login.php">Login</a><a href="feedback.php">Feedback</a></nav>
<div class="box wide">
  <h2>Send feedback</h2>
  <?php if ($msg) echo "<div class='msg ok'>" . htmlspecialchars($msg) . "</div>"; ?>
  <form method="POST">
    <input name="name" placeholder="Your name" required>
    <textarea name="message" rows="4" placeholder="Your message" required></textarea>
    <button type="submit">Submit</button>
  </form>
  <h2 style="margin-top:30px">Submitted feedback</h2>
  <table>
    <tr><th>ID</th><th>Name</th><th>Message</th><th>Time</th></tr>
    <?php while ($r = $res->fetch_assoc()) {
        echo "<tr><td>" . $r['id'] . "</td><td>" . htmlspecialchars($r['name']) . "</td><td>" . htmlspecialchars($r['message']) . "</td><td>" . $r['submitted_at'] . "</td></tr>";
    } ?>
  </table>
</div>
</body>
</html>
