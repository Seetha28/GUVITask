<?php
session_start(); // start session

require_once 'db_connect.php'; // include database connection file

// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get form data
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password for security

  // prepare and bind SQL statement
  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param('sss', $username, $email, $password);

  // execute SQL statement and check for errors
  if ($stmt->execute()) {
    // registration successful, redirect to login page
    $_SESSION['message'] = 'Registration successful! Please log in.';
    header('Location: login.php');
    exit();
  } else {
    // registration failed, show error message
    $_SESSION['message'] = 'Registration failed. Please try again later.';
  }

  // close statement and connection
  $stmt->close();
  $conn->close();
}
?>



<?php unset($_SESSION['message']); // unset error message after displaying it ?>

