<?php

namespace Core\Admin;

interface AdminInterface {

    public static function addCap($role, $cap);

    public static function hasCap($role, $cap);

    public static function addRole($role_name, $display_name, $capabilities = []);

    public static function authorCan($capabilities);

    public static function getRole($role_name);

    public static function getCapRole($role);

    public static function removeRole($role_name);

    public function removeCap($role_name, $capability);

    public static function isSuperAdmin($user_id);

}