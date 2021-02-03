<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExampleModel extends Model
{
    use SoftDeletes;
    protected $table = 'example';
}
