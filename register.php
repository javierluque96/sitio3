<?php
  require_once 'libs/User.php';

  $email = $_POST["email"];

  

  if (User::emailAvailable($email)) {
      // $id, $name, $surname, $user_type, $email, $password, $address, $phone
      // User type 10 is for a student
      $user = new User(null, $_POST["name"], $_POST["surname"], 20, $_POST["email"], $_POST["password"], $_POST["address"], $_POST["phone"] ?? null);
      $user->insert();
      header("Location: /");
  } else {
      header("Location: register.html");
  }
