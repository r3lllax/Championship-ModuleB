<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $duration
 * @property int $price
 * @property string $start_date
 * @property string $end_date
 * @property string $volume
 *
 * @property-read Lesson[] $lessons
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

    /**
     * Lessons
     * @return HasMany
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
