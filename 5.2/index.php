<?php

require('app/app.php');
require('./app/auth_functions.php');

$view_bag = [
    'title' => 'Glossary List',
    'heading_text' => 'Glossary',
    'heading_value' => ''
];

$data = new FileDataProvider(CONFIG['data_file']);

if (isset($_GET['search']) and $_GET['search'] != '') {
    $items = $data->search_terms($_GET['search']);
    $view_bag['heading_text'] = 'Search Results for: ';
    $view_bag['heading_value'] = $_GET['search'];
} else {
    $items = $data->get_terms();
}

view('index', $items);