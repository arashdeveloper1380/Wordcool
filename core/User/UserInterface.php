<?php

interface UserInterface{

    public static function createUser($username, $password, $email);

    public static function insertUser($user_data);

    public static function updateUser($user_id, $user_data);

    public static function deleteUser($user_id);
    
    public static function addUserMeta($user_id, $meta_key, $meta_value);

    public static function deleteUserMeta($user_id, $meta_key);

    public static function getUserMeta($user_id, $meta_key);

    public static function updateUserMeta($user_id, $meta_key, $meta_value);
    
    public static function getTheAuthorMeta($meta_key, $user_id);

    public static function isUserLoggedIn();

    public static function customLoginForm($args);

    public static function login_user($username, $password);

    public static function logoutUser();

}