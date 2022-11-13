<?php

require("dataprovider.class.php");

class Data
{

    static private $dataStore;
    static public function initialize(DataProvider $data_provider)
    {
        return self::$dataStore = $data_provider;
    }
    static public function getTerms()
    {
        return self::$dataStore->get_terms();
    }

    static public function getTerm($term)
    {
        return self::$dataStore->get_term($term);;
    }

    static public function searchTerms($search)
    {
        return self::$dataStore->search_terms($search);
    }
    static public function addTerm($term, $definition)
    {
        return self::$dataStore->add_term($term, $definition);
    }
    static public function updateTerm($original_term, $new_term, $new_definition)
    {
        return self::$dataStore->update_term($original_term, $new_term, $new_definition);
    }
    static public function deleteTerm($term)
    {
        return self::$dataStore->delete_term($term);
    }

}