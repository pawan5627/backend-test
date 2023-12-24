<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'employee_id',
        'schedule_id',
        'date',
        'clock_in',
        'clock_out',

    ];

}
