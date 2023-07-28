<?php
namespace core;

class JsonQueryBuilder {

    protected $filepath;
    protected $query = [];

    public function __construct($filepath){
        $this->filepath = ARASH_DIR . $filepath;
    }

    public function select($fields){
        $this->query['select'] = $fields;
        return $this;
    }

    public function from($table){
        $this->query['from'] = $table;
        return $this;
    }

    public function where($condation){
        $this->query['where'] = $condation;
        return $this;
    }

    public function limit($limit) {
        $this->query['limit'] = $limit;
        return $this;
    }

    public function orderBy($fields, $direction = 'ASC'){
        $this['order_by'] = [
            'field'         => $fields,
            'direction'     => $direction
        ];
        return $this;
    }

    public function get() {
        $json = file_get_contents($this->filepath);

        $data = json_decode($json, true);

        $filteredData = $this->applyQuery($data);

        return $filteredData;
    }

    protected function applyQuery($data)
    {
        if (isset($this->query['select'])) {
            $fields = $this->query['select'];
            $data = array_map(function ($item) use ($fields) {
                return array_intersect_key($item, array_flip($fields));
            }, $data);
        }

        if (isset($this->query['where'])) {
            $condition = $this->query['where'];
            $data = array_filter($data, function ($item) use ($condition) {
                return eval("return $condition;");
            });
        }

        if (isset($this->query['order_by'])) {
            $field = $this->query['order_by']['field'];
            $direction = $this->query['order_by']['direction'];
            usort($data, function ($a, $b) use ($field, $direction) {
                if ($direction == 'ASC') {
                    return $a[$field] <=> $b[$field];
                } else {
                    return $b[$field] <=> $a[$field];
                }
            });
        }
        if (isset($this->query['limit'])) {
            $limit = $this->query['limit'];
            $data = array_slice($data, 0, $limit);
        }

        return $data;
    }

}