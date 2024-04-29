<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    
    protected $table = 'users';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'name',
        'usertype',
    ];

    use HasFactory;
}
