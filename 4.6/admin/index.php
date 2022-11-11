<?php

require("../app/app.php");

$view_bag = [
    'title' => 'Admin Panel',
    'heading_text' => 'This is the admin panel',
];


view('admin/index', get_terms());