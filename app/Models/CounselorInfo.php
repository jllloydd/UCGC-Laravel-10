<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselorInfo extends Model
{
    protected $table = 'counselorinfo';

    protected $fillable = ['user_id', 'name', 'gender', 'department', 'expertise'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}