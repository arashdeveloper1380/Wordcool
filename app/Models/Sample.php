<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model {
    protected $table = "wp_sample";

    protected $fillable = ['name', 'phone', 'status'];
}