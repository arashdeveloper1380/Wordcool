<?php

namespace Core;

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

    public function where($field, $operator, $value){
        $this->query['where'][] = compact('field', 'operator', 'value');
        return $this;
    }

    public function find($field, $value)
    {
        return $this->where($field, '=', $value);
    }

    public function limit($limit) {
        $this->query['limit'] = $limit;
        return $this;
    }

    public function orderBy($fields, $direction = 'ASC'){
        $this->query['order_by'] = [
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

    public function count()
    {
        $json = file_get_contents($this->filepath);
        $data = json_decode($json, true);
        $filteredData = $this->applyQuery($data);
        return count($filteredData);
    }

    public function exists()
    {
        $json = file_get_contents($this->filepath);
        $data = json_decode($json, true);
        $filteredData = $this->applyQuery($data);
        return count($filteredData) > 0;
    }

    public function first()
    {
        $this->limit(1);
        $result = $this->get();
        return !empty($result) ? $result[0] : null;
    }

    protected function applyQuery($data)
    {
        if (isset($this->query['select'])) {
            $fields = $this->query['select'];
            $data = array_map(function ($item) use ($fields) {
                return array_intersect_key($item, array_flip($fields));
            }, $data);
        }

        if (!empty($this->query['where'])) {
            $filteredData = array_filter($data, function ($item) {
                foreach ($this->query['where'] as $condition) {
                    $field = $condition['field'];
                    $operator = $condition['operator'];
                    $value = $condition['value'];
    
                    switch ($operator) {
                        case '=':
                            if ($item[$field] != $value) {
                                return false;
                            }
                            break;
                        case '>':
                            if ($item[$field] <= $value) {
                                return false;
                            }
                            break;
                        case '<':
                            if ($item[$field] >= $value) {
                                return false;
                            }
                            break;
                        // اضافه کردن شرایط دیگر به صورت مشابه
                        default:
                            return false;
                    }
                }
    
                return true;
            });
    
            $data = array_values($filteredData);
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

        if (isset($this->query['find'])) {
            $findField = $this->query['find']['field'];
            $findValue = $this->query['find']['value'];
            
            $this->where($findField, '=', $findValue);
        }

        return $data;
    }
}