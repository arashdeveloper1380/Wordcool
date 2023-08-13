<?php

namespace Core\Csrf;

use Core\Request\Request;
use Core\Session\Session;

class Csrf {

    private $token;
    private $tokenFieldName = 'csrf_token';
    private $sessionKey = 'csrf_token';

    public function __construct()
    {
        session_start();

        if (!isset($_SESSION[$this->sessionKey])) {
            $this->generateToken();
        }

        $this->token = $_SESSION[$this->sessionKey];
    }

    public function generateToken()
    {
        $token = bin2hex(random_bytes(32));

        $_SESSION[$this->sessionKey] = $token;
        echo '<input type="hidden" name="' . $this->tokenFieldName . '" value="' . $token . '">';
    }

    public function validateToken()
    {
        if (
            isset($_POST[$this->tokenFieldName]) &&
            $_POST[$this->tokenFieldName] === $this->token
        ) {
            // Token is valid
            return true;
        }

        // Invalid token
        return false;
    }

}