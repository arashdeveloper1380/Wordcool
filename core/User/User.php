<?php
require_once ABSPATH . 'wp-includes/pluggable.php';
require_once ABSPATH . 'wp-admin/includes/user.php';

include "UserInterface.php";

class WCL_User implements UserInterface{

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
            $error = new WP_Error('inser_error', 'There was an error inserted the user.');
            return $error->get_error_message();
        }
    }

    public static function updateUser($user_id, $user_data){
        $updated_user_id = wp_update_user(array_merge([
            'ID' => $user_id
        ], $user_data));

        if(!is_wp_error($updated_user_id)){
            return true;
        }else{
            $error = new WP_Error('update_error', 'There was an error updating the user.');
            echo $error->get_error_message();
        }
    }

    public static function deleteUser($user_id){
        if (wp_delete_user($user_id)) {
            echo 'User Deleted Successful';
        } else {
            $error = new WP_Error('delete_error', 'There was an error deleting the user.');
            echo $error->get_error_message();
        }
    }

    public static function addUserMeta($user_id, $meta_key, $meta_value) {
        add_user_meta($user_id, $meta_key, $meta_value);
    }

    public static function getUserMeta($user_id, $meta_key) {
        return get_user_meta($user_id, $meta_key, true);
    }

    public static function updateUserMeta($user_id, $meta_key, $meta_value) {
        update_user_meta($user_id, $meta_key, $meta_value);
    }

    public static function getTheAuthorMeta($meta_key, $user_id) {
        return get_the_author_meta($meta_key, $user_id);
    }
    
    public static function deleteUserMeta($user_id, $meta_key) {
        delete_user_meta($user_id, $meta_key);
    }

    public static function isUserLoggedIn(){
        return is_user_logged_in();
    }

    public static function customLoginForm($args){
        wp_login_form($args);
    }
}