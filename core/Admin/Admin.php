<?php

namespace Core\Admin;

use Core\Admin\AdminInterface;

class Admin implements AdminInterface{

    public static function addCap($role, $cap){
        $role = get_role($role);
        $role->add_cap($cap);
    }

    public static function hasCap($role, $cap){
        $role = get_role($role);

        if (null !== $role) {
            $capabilities = $role->capabilities [$cap];
            return $capabilities;
        }
    }

    public static function addRole($role_name, $display_name, $capabilities = []){
        $role = $role_name;
        $display_name = $display_name;
        $capabilities = $capabilities;

        if (!get_role($role)) {
            add_role($role, $display_name, $capabilities);
        }
    }

    public static function authorCan($capabilities) {
        $user_id = get_current_user_id();
        
        if ($user_id !== 0) {
            if (is_array($capabilities)) {
                foreach ($capabilities as $capability) {
                    if (!current_user_can($capability)) {
                        return false;
                    }
                }
                return true;
            } elseif (is_string($capabilities)) {
                return current_user_can($capabilities);
            }
        }
        
        return false;
    }

    public static function getCapRole($role_name){
        $role = Admin::getRole($role_name);

        if ($role) {
            foreach ($role->capabilities as $capability => $value) {
                echo $capability . '<br>';
            }
        } else {
            echo 'Role not found!';
        }
    }

    public static function getRole($role_name){
        return get_role($role_name);
    }

    public static function removeRole($role_name){
        $result = remove_role($role_name);
        if ($result) {
            echo 'Role ' . $role_name . ' has been successfully removed.';
        } else {
            echo 'Role ' . $role_name . ' does not exist.';
        }
    }

    public static function removeCap($role_name, $capability){ 
        $role = get_role($role_name);
        if ($role) {
            $role->remove_cap($capability);
            echo 'Capability ' . $capability . ' removed from role ' . $role_name;
        } else {
            echo 'Role not found!';
        }
    }
    
    public static function getSuperAdmins(){
        $super_admins = get_super_admins();

        if (!empty($super_admins)) {
            echo 'Super Administrators: <br>';
            foreach ($super_admins as $super_admin) {
                echo $super_admin . '<br>';
            }
        } else {
            echo 'No super administrators found.';
        }
    }

    public static function isSuperAdmin($user_id){
        if (is_super_admin($user_id)) {
            echo 'User with ID ' . $user_id . ' is a super administrator.';
        } else {
            echo 'User with ID ' . $user_id . ' is not a super administrator.';
        }
    }
    
}