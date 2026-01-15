<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'Courses';
    protected $fillable = [
        'title',
        'description',
        'duration',
        'price',
        'start_date',
        'end_date',
        'volume'
    ];
}
