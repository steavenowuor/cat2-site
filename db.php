<?php
$conn = new mysqli("localhost", "catuser", "StrongPass123", "CAT2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
