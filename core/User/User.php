<?php
namespace core\User;

require_once ABSPATH . 'wp-includes/pluggable.php';
require_once ABSPATH . 'wp-admin/includes/user.php';
include "UserInterface.php";

use core\User\UserInterface;

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

    public static function loginUser($username, $password) {
        $user_credentials = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true
        );
        $user_signon = wp_signon( $user_credentials, false );
        if ( is_wp_error( $user_signon ) ) {
            return $user_signon;
        } else {
            return true;
        }
    }

    public static function logoutUser() {
        wp_logout();
        wp_redirect( home_url() );
        exit;
    }

    public static function getUserCount() {
        $user_counts = count_users();
        $role_counts = array();

        foreach ( $user_counts['avail_roles'] as $role => $count ) {
            $role_counts[ $role ] = $count;
        }
        
        $role_counts['total'] = $user_counts['total_users'];
        return $role_counts;
    }

    public static function countUserPosts($user_id, $post_type = 'post', $public_only = true){
        $post_count = count_user_posts($user_id, $post_type, $public_only);
        return $post_count;
    }

    public static function countManyUsersPosts($user_ids = [], $post_type = 'post', $public_only = true){
        $total_count = 0;

        foreach ($user_ids as $id){
            $post_count = self::countUserPosts($id, $post_type, $public_only);
            $total_count += $total_count;
        }

        return $total_count;
    }

    public static function emailExists($email){
        $email_exists = email_exists($email);
        return (bool) $email_exists;
    }

    public static function getCurrentUser(){
        $current_user = wp_get_current_user();
        return $current_user;
    }

    public static function getCurrentUserId() {
        $user_id = get_current_user_id();
        return $user_id;
    }

    public static function getUserByField( $field, $value ) {
        $user = get_user_by( $field, $value );
        return $user ? $user : false;
    }

    public static function getUserData($user_id){
        $user_data = get_userdata($user_id);
        return $user_data;
    }

    public static function getUsers($args) {
        // $args = [
        //     'number' => $number,
        //     'orderby' => 'registered',
        //     'order' => 'DESC'
        // ];
        $users = get_users($args);
        return $users;
    }

    public static function usernameExists($username){
        if (username_exists($username)) {
            echo true;
        } else {
            echo false;
        }
    }

    public static function getAuthorPostUrl($author_id){
        $author_posts_url = get_author_posts_url($author_id);
        echo $author_posts_url;
    }
}