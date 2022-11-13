<?php

session_start();

require("../app/app.php");
ensure_user_is_authenticated();

$view_bag = [
    'title' => 'Delete term',
    'heading_text' => 'This page will delete a term from the database.',
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

    $term = Data::getTerm($key);

    if ($term === false) {
        view('not_found');
        die();
    }
    view('admin/delete', $term);

}
if (is_post()) {
    if (isset($_POST['term'])) {
        $term = sanitize($_POST['term']);

        if (empty($term)) {
            // TODO: display error message
        } else {
            Data::deleteTerm($term);
            redirect('index.php');
        }
    }
}