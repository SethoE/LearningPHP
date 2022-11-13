<?php


class MySQLDataProvider extends DataProvider
{
    private $tablename = 'terms';

    private function connect()
    {
        try {
            return new PDO($this->source, CONFIG['DB_username'], CONFIG['DB_password']);
        } catch (PDOException $e) {
            return null;
        }
    }
    public function get_terms()
    {
        $db = $this->connect();

        if ($db == null) {
            return [];
        }
        $query = $db->query("SELECT * FROM " . $this->tablename);

        $data = $query->fetchAll(PDO::FETCH_CLASS, 'GlossaryTerm');

        $query = null;
        $db = null;

        return $data;
    }

    public function get_term($id)
    {
        $db = $this->connect();

        if ($db === null) {
            return;
        }

        $query = "SELECT * FROM " . $this->tablename . " WHERE term_id = :id";
        $smt = $db->prepare($query);

        $smt->execute([
            ":id" => $id,
        ]);

        $data = $smt->fetchAll(PDO::FETCH_CLASS, 'GlossaryTerm');

        $smt = null;
        $db = null;

        if (empty($data)) {
            return;
        }

        return $data[0];
    }

    public function search_terms($search)
    {
        $db = $this->connect();

        if ($db === null) {
            return [];
        }

        $query = "SELECT * FROM " . $this->tablename . " WHERE term LIKE :search OR definition LIKE :search";
        $smt = $db->prepare($query);

        $smt->execute([
            ":search" => '%' . $search . '%',
        ]);

        $data = $smt->fetchAll(PDO::FETCH_CLASS, 'GlossaryTerm');

        $smt = null;
        $db = null;

        if (empty($data)) {
            return [];
        }

        return $data;
    }

    public function add_term($term, $definition)
    {
        $db = $this->connect();

        if ($db === null) {
            return;
        }

        $query = 'INSERT INTO ' . $this->tablename . ' (term, definition) ' . ' VALUES(:term, :definition)';
        $smt = $db->prepare($query);

        $smt->execute([
            ":term" => $term,
            ":definition" => $definition
        ]);

        $smt = null;
        $db = null;
    }

    public function update_term($original_term, $new_term, $new_definition)
    {
        $db = $this->connect();

        if ($db == null) {
            return;
        }

        $query = "UPDATE " . $this->tablename . " SET term = :new_term, definition = :new_definition WHERE term_id = :original_term";

        $smt = $db->prepare($query);

        $smt->execute([
            ":new_term" => $new_term,
            ":new_definition" => $new_definition,
            ":original_term" => $original_term
        ]);

        $smt = null;
        $db = null;
    }

    public function delete_term($id)
    {
        $db = $this->connect();

        if ($db == null) {
            return;
        }

        $query = "DELETE FROM " . $this->tablename . " WHERE term_id = :id";

        $smt = $db->prepare($query);

        $smt->execute([
            ":id" => $id, 
        ]);

        $smt = null;
        $db = null;
    }

}