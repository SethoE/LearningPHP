<?php

require("../app/app.php");

$view_bag = [
    'title' => 'Edit term',
    'heading_text' => 'This page will allow you to edit the term and definition.',
];

if (is_get()) {
    $key = '';
    if (isset($_GET['key']) and $_GET['key'] !== '') {
        $key = sanitize($_GET['key']);

        if (empty($key)) {
            view('not_found');
            die();
        }
    }

    $term = get_term($key);

    if ($term === false) {
        view('not_found');
        die();
    }
    view('admin/edit', $term);

}
if (is_post()) {
    if (isset($_POST['term']) and isset($_POST['definition']) and isset($_POST['original-term'])) {
        $term = sanitize($_POST['term']);
        $definition = sanitize($_POST['definition']);
        $original_term = sanitize($_POST['original-term']);

        if (empty($term) || empty($definition) || empty($original_term)) {
            // TODO: display error message
        } else {
            update_term($original_term, $term, $definition);
            redirect('index.php');
        }
    }
}