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

function add_term($term, $definition) {
    $items = get_terms();

    $obj = (object) [
        'term' => $term,
        'definition' => $definition
    ];
    
    $items[] = $obj;

    set_data($items);
}

function update_term($original_term, $new_term, $new_definition) {
    $terms = get_terms();

    foreach ($terms as $item) {
        if ($item->term == $original_term) {
            $item->term = $new_term;
            $item->definition = $new_definition;
            break;
        }
    }
    set_data($terms);
}

function set_data($arr) {
    $fname = CONFIG['data_file'];

    $json = json_encode($arr);

    file_put_contents($fname, $json);
}

function delete_term($term) {
    $terms = get_terms();

    for ($i = 0; $i < count($terms); $i++) {
        if ($terms[$i]->term === $term) {
            unset($terms[$i]);
            break;
        }
    }

    $new_terms = array_values($terms);
    // 0 
    // 2 
    
    // TODO: rebuild this array
    set_data($new_terms);
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