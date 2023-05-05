<?php
session_start(); // start session

require_once 'db_connect.php'; // include database connection file

// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // prepare and bind SQL statement
  $stmt = $conn->prepare("SELECT id, password FROM

