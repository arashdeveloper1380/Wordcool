<?php
require_once ABSPATH . 'wp-includes/pluggable.php';

class AR_User {

    public static function createUser($username, $password, $email){
        $password = wp_hash_password($password);
        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            echo $user_id->get_error_message();
        } else {
            return 'کاربر با موفقیت ایجاد شد. شناسه کاربر: ' . $user_id;
        }
    }

}