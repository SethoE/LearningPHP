<?php


class MySQLDataProvider extends DataProvider
{
    
    private function connect() {
        try {
            return new PDO($this->source, CONFIG['DB_username'], CONFIG['DB_password']);
        } catch (PDOException $e) {
            return null;
        }
    }
    public function get_terms()
    {
    }

    public function get_term($term)
    {
    }

    public function search_terms($search)
    {
    }

    public function add_term($term, $definition)
    {
    }

    public function update_term($original_term, $new_term, $new_definition)
    {
    }

    public function delete_term($term)
    {
    }

}