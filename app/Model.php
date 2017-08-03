<?php
/**
 * Created by PhpStorm.
 * User: xxx
 * Date: 2017-07-29
 * Time: 08:08
 */

namespace App;

use Illuminate\Database\Eloquent\Model as LaravelModel;

class Model extends LaravelModel
{
    protected $guarded = ['user_id'];
}