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

    private function mysqlQuery($query, $parameterArray = [])
    {

        $db = $this->connect();

        if ($db == null) {
            return [];
        }
        $smt = null;

        if (empty($parameterArray)) {
            $smt = $db->query($query);

        } else {
            $smt = $db->prepare($query);
            $smt->execute($parameterArray);

        }
        $data = $smt->fetchAll(PDO::FETCH_CLASS, 'GlossaryTerm');

        if (empty($data)) {
            return [];
        }
        $smt = null;
        $db = null;

        return $data;
    }

    private function mysqlExecute($query, $parameterArray)
    {
        $db = $this->connect();

        if ($db === null) {
            return;
        }

        $smt = $db->prepare($query);
        $smt->execute($parameterArray);

        $smt = null;
        $db = null;
    }


    public function get_terms()
    {
        return $this->mysqlQuery("SELECT * FROM " . $this->tablename);
    }

    public function search_terms($search)
    {
        $query = "SELECT * FROM " . $this->tablename . " WHERE term LIKE :search OR definition LIKE :search";
        $parameterArray = [
            ":search" => '%' . $search . '%',
        ];
        return $this->mysqlQuery($query, $parameterArray);

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

    public function add_term($term, $definition)
    {

        $query = 'INSERT INTO ' . $this->tablename . ' (term, definition) ' . ' VALUES(:term, :definition)';
        $parameterArray = [
            ":term" => $term,
            ":definition" => $definition
        ];

        $this->mysqlExecute($query, $parameterArray);
    }

    public function update_term($original_term, $new_term, $new_definition)
    {

        $query = "UPDATE " . $this->tablename . " SET term = :new_term, definition = :new_definition WHERE term_id = :original_term";
        $parameterArray = [
            ":new_term" => $new_term,
            ":new_definition" => $new_definition,
            ":original_term" => $original_term
        ];

        $this->mysqlExecute($query, $parameterArray);
    }

    public function delete_term($id)
    {
        $query = "DELETE FROM " . $this->tablename . " WHERE term_id = :id";
        $parameterArray = [
            ":id" => $id,
        ];

        $this->mysqlExecute($query, $parameterArray);
    }



}