<?php
$conn = new mysqli('localhost', 'root', '', 'phpcrud_bagobo_clear');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>