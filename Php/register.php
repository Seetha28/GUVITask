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

<!DOCTYPE html>
<html>
  <head>
    <title>Signup Page</title>
  </head>
  <body>
    <div class="container mt-5">
      <h2>Signup</h2>
      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $_SESSION['message']; ?>
        </div>
      <?php } ?>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </form>
    </div>
  </body>
</html>

<?php unset($_SESSION['message']); // unset error message after displaying it ?>

