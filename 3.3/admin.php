<?php
session_start();
require_once('./../inc/config.php');
require_once('./../inc/functions.php');

ensure_user_is_authenticated();

echo $_SESSION['email'];
echo $_SESSION['password'];
?>
<a href="http://localhost/php-fundamentals-2017/3.3/logout.php" style="margin:auto 20px;">Click hier to Logout</a>