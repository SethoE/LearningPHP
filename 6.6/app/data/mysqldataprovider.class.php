<?php


class MySQLDataProvider extends DataProvider
{
    private $tablename = 'terms';
    
    private function connect() {
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

        if(empty($data)) {
            return;
        }
        $smt = null;
        $db = null;

        return $data[0];
    }

    public function search_terms($search)
    {
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
    }

    public function delete_term($term)
    {
    }

}