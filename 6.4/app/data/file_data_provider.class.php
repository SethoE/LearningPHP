<?php

class FileDataProvider extends DataProvider
{
    public function get_terms()
    {
        $json = $this->get_data();

        return json_decode($json);
    }

    public function get_term($term)
    {
        $terms = $this->get_terms();

        foreach ($terms as $item) {
            if ($item->term == $term) {
                return $item;
            }
        }

        return false;
    }

    public function search_terms($search)
    {
        $items = $this->get_terms();

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

    public function add_term($term, $definition)
    {
        $items = $this->get_terms();
        $items[] = new GlossaryTerm($term, $definition);
        $this->set_data($items);
    }

    public function update_term($original_term, $new_term, $new_definition)
    {
        $terms = $this->get_terms();

        foreach ($terms as $item) {
            if ($item->term == $original_term) {
                $item->term = $new_term;
                $item->definition = $new_definition;
                break;
            }
        }
        $this->set_data($terms);
    }

    private function set_data($arr)
    {

        $json = json_encode($arr);

        file_put_contents($this->source, $json);
    }

    public function delete_term($term)
    {
        $terms = $this->get_terms();

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
        $this->set_data($new_terms);
    }
    private function get_data()
    {

        $json = '';

        if (!file_exists($this->source)) {
            file_put_contents($this->source, '');
        } else {
            $json = file_get_contents($this->source);
        }


        return $json;
    }
}