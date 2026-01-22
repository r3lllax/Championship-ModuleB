<?php

namespace App\Models;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $duration
 * @property int $price
 * @property Date $start_date
 * @property Date $end_date
 * @property string $volume
 *
 * @property-read Lesson[] $lessons
 * @property-read User[] $users
 * @property-read bool $access
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

    /**
     * Courser users
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Record::class,'course_id','id','id','user_id');
    }

    /**
     * Can user access to course
     * @param int $userID
     * @return bool
     */
    public function AccessToUser(int $userID): bool
    {
        return (bool)$this->users()->find($userID);
    }
}
