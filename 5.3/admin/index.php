<?php

session_start();

require("../app/app.php");
ensure_user_is_authenticated();

$view_bag = [
    'title' => 'Admin Panel',
    'heading_text' => 'This is the admin panel',
];


view('admin/index', Data::getTerms());