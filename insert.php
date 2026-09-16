<?php
include 'database.php';

$firstname = $_POST['firstname'];
$lastname  = $_POST['lastname'];
$email     = $_POST['email'];

$query = "INSERT INTO students (firstname, lastname, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $firstname, $lastname, $email);
$stmt->execute();
$stmt->close();

header('Location: index.php');
?>