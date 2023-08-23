<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesMusicSearch extends Model
{
    use HasFactory;
    protected $table = 'music_search';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
