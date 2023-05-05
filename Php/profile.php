<?php
// Start session
session_start();

// Connect to MongoDB
$mongoClient = new MongoDB\Client('mongodb://localhost:27017');
$database = $mongoClient->mydatabase;
$collection = $database->users;

// Check if user is logged in
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

// Get current user data
$user = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_SESSION['user']->id)]);

// Update user data
$updateResult = $collection->updateOne(
  ['_id' => new MongoDB\BSON\ObjectID($_SESSION['user']->id)],
  ['$set' => [
    'age' => $_POST['age'],
    'dob' => $_POST['dob'],
    'contact' => $_POST['contact']
  ]]
);

// Check if update was successful
if ($updateResult->getModifiedCount() > 0) {
  $response = [
    'status' => 'success',
    'message' => 'Profile updated successfully.'
  ];
} else {
  $response = [
    'status' => 'error',
    'message' => 'An error occurred. Please try again later.'
  ];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>

