<?php

namespace Core\Admin;

interface AdminInterface {

    public static function addCap($role, $cap);

    public static function has_cap($role, $cap);

}