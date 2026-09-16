<?php
include 'database.php';

$id        = $_POST['id'];
$firstname = $_POST['firstname'];
$lastname  = $_POST['lastname'];
$email = $_POST['email'];

$query = "UPDATE students SET firstname = ?, lastname = ?, email = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $firstname, $lastname, $email, $id);
$stmt->execute();
$stmt->close();

header('Location: index.php');
?>