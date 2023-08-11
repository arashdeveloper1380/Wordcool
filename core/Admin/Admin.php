<?php

namespace Core\Admin;

class Admin {

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
    
}