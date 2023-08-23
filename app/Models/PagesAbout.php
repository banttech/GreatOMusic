<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesAbout extends Model
{
    use HasFactory;
    protected $table = 'about';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
