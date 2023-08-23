<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetterSubscriber extends Model
{
    use HasFactory;
    protected $table = 'email_list';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
