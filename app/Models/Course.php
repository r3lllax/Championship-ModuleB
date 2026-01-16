<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $duration
 * @property int $price
 * @property string $start_date
 * @property string $end_date
 * @property string $volume
 */
class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    public $timestamps = false;
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
