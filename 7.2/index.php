<?php

require('app/app.php');

$view_bag = [
    'title' => 'Glossary List',
    'heading_text' => 'Glossary',
    'heading_value' => ''
];

if (isset($_GET['search']) and $_GET['search'] != '') {
    $items = Data::searchTerms($_GET['search']);
    $view_bag['heading_text'] = 'Search Results for: ';
    $view_bag['heading_value'] = $_GET['search'];
} else {
    $items = Data::getTerms();
}


view(name:'index', model: $items);