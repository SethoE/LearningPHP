<?php

function get_terms()
{
    $json = get_data();

    return json_decode($json);
}

function get_term($term)
{
    $terms = get_terms();

    foreach ($terms as $item) {
        if ($item->term == $term) {
            return $item;
        }
    }

    return false;
}

function search_terms($search)
{
    $items = get_terms();

    $results = array_filter($items, function ($item) use ($search) {
        // truthy
        // 1 - 12345 -1
        // 'asdfasfd'
        // falsey
        // 0 ''
        if (
            strpos(strtolower($item->term), strtolower($search)) !== false ||
            strpos(strtolower($item->definition), strtolower($search)) !== false
        ) {
            return $item;
        }
    });
    return $results;
}
function get_data()
{
    $fname = CONFIG['data_file'];

    $json = '';

    if (!file_exists($fname)) {
        file_put_contents($fname, '');
    } else {
        $json = file_get_contents($fname);
    }


    return $json;
}