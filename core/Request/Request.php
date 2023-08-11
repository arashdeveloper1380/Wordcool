<?php
namespace Core\Request;

class Request {
    
    public function get($key = null) {
        if ($key == null) {
            return $_GET;
        }
        return $_GET[$key] ?? null;
    }

    public function post($key = null) {
        if ($key == null) {
            return $_POST;
        }
        return $_POST[$key] ?? null;
    }
    
    public function all() {
        return array_merge($this->get(), $this->post());
    }

    public function isGet() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    
    public function validate($rules) {
        $errors = [];
    
        foreach ($rules as $key => $rule) {
            $value = $this->all()[$key] ?? null;
    
            foreach (explode('|', $rule) as $r) {
                $params = explode(':', $r);
                $ruleName = $params[0];
                $ruleValue = $params[1] ?? null;
    
                switch ($ruleName) {

                    case 'required':
                        if (empty($value)) {
                            $errors[$key][] = 'The ' . $key . ' field is required.';
                        }
                        break;

                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$key][] = 'The ' . $key . ' field must be a valid email address.';
                        }
                        break;

                    case 'numeric':
                        if (!is_numeric($value)) {
                            $errors[$key][] = 'The ' . $key . ' field must be numeric.';
                        }
                        break;

                    case 'alpha':
                        if (!ctype_alpha($value)) {
                            $errors[$key][] = 'The ' . $key . ' field may only contain alphabetic characters.';
                        }
                        break;

                    case 'max':
                        if (strlen($value) > $ruleValue) {
                            $errors[$key][] = 'The ' . $key . ' field must not be greater than ' . $ruleValue . ' characters.';
                        }
                        break;

                    case 'min':
                        if (strlen($value) < $ruleValue) {
                            $errors[$key][] = 'The ' . $key . ' field must be at least ' . $ruleValue . ' characters.';
                        }
                        break;

                    case 'date':
                        if (!strtotime($value)) {
                            $errors[$key][] = 'The ' . $key . ' field must be a valid date.';
                        }
                        break;

                    case 'string':
                        if (!is_string($value)) {
                            $errors[$key][] = 'The ' . $key . ' field must be a string.';
                        }
                        break;

                    case 'url':
                        if (!filter_var($value, FILTER_VALIDATE_URL)) {
                            $errors[$key][] = 'The ' . $key . ' field must be a valid URL.';
                        }
                        break;

                    default:
                        break;
                }
            }
        }
    
        return $errors;
    }
}
