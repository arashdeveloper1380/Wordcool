<?php
namespace core;

class ValidateSession{

    public static function setErrors($errors){
        session_start();
        $_SESSION['errors'] = $errors;
    }

    public static function getErrors(){
        session_start();
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
            return $errors;
        }
        return [];
    }
    public static function showErrors(){
        $errors = self::getErrors();
        if(!empty($errors)){ 
            foreach ($errors as $key => $value): ?>
                <ul>
                    <?php foreach($value as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        <?php }
    }

}