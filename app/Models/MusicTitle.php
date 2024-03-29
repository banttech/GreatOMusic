<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicTitle extends Model
{
    use HasFactory;
    protected $table = 'music';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
