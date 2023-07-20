<?php

interface UserInterface{

    public static function createUser($username, $password, $email);

    public static function insertUser($user_data);

    public static function updateUser($user_id, $user_data);

    public static function deleteUser($user_id);

}