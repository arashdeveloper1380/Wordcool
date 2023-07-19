<?php

require_once ARASH_DIR . 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

class CreateSampleTable extends Migration
{
    public function up()
    {
        Capsule::schema()->create('wp_sample', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->unique();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('wp_sample');
    }
}