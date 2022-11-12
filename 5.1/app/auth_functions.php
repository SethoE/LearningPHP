<?php

function is_user_authenticated() {
    return isset($_SESSION['email']);
}

function ensure_user_is_authenticated() {
    if (!is_user_authenticated()) {
      redirect('../login.php');
      die();
    }
}

function authenticate_user($email, $password) {
  $users = CONFIG['users'];

  if (!isset($users[$email])) {
    return false;
  }

  $user_password = $users[$email];
  
  return  $user_password === $password;
}
