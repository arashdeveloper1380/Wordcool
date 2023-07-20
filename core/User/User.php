<?php
require_once ABSPATH . 'wp-includes/pluggable.php';
require_once ABSPATH . 'wp-admin/includes/user.php';

include "UserInterface.php";

class AR_User implements UserInterface{

    public static function createUser($username, $password, $email){
        $password = wp_hash_password($password);
        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            echo $user_id->get_error_message();
        } else {
            return 'User Created Successful' . $user_id;
        }
    }

    public static function insertUser($user_data) {
        $user_id = wp_insert_user($user_data);

        if (!is_wp_error($user_id)) {
            return $user_id;
        } else {
            return $user_id->get_error_message();
        }
    }

    public static function updateUser($user_id, $user_data){
        $updated_user_id = wp_update_user(array_merge([
            'ID' => $user_id
        ], $user_data));

        if(!is_wp_error($updated_user_id)){
            return true;
        }else{
            return $updated_user_id->intl_get_error_message();
        }
    }

    public static function deleteUser($user_id){
        if (wp_delete_user($user_id)) {
            echo 'User Deleted Successful';
        } else {
            echo $user_id->get_error_message();
        }
    }

}