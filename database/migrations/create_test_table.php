<?php

define("ROOT_DIR", $_SERVER["DOCUMENT_ROOT"]);

include ROOT_DIR . 'vendor/autoload.php';
include ROOT_DIR . 'config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

class CreateTestTable extends Migration
{
    public function up()
    {
        Capsule::schema()->create('wp_test', function ($table)  {
            $table->increments('id');
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('wp_test');
    }
} 