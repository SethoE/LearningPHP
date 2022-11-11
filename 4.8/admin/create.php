<?php

require("../app/app.php");


if (is_post()) {
    if (isset($_POST['term']) && $_POST['term']) {
        $term = sanitize($_POST['term']);
        $definition = sanitize($_POST['definition']);

        if (empty($term) || empty($definition)) {
            // TODO: display error message
        } else {
            add_term($term, $definition);
            redirect('index.php');
        }
    }
}

$view_bag = [
    'title' => 'Create term',
    'heading_text' => 'This page will let you create a new term.',
];


view('admin/create');