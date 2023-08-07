<?php
namespace Core;

class Session
{
    private static $instance;

    private function __construct()
    {
        session_start();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Session();
        }

        return self::$instance;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function destroy()
    {
        session_destroy();
    }
}