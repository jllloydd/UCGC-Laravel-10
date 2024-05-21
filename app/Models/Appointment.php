<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Appointment extends Model
{
    use Sortable;

    protected $table = 'appointments';

    protected $guarded = [];
    use HasFactory;
    public $sortable = ['date', 'time', 'course', 'mode', 'gender'];
}
