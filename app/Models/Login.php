<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Login extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $table = 'login';
    protected $primaryKey = 'id';

    public $timestamps = false;
}