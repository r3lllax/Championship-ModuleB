<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $course_id
 * @property string $video_link
 * @property int $duration
 */
class Lesson extends Model
{
    use HasFactory;
    protected $table = 'lessons';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'content',
        'course_id',
        'video_link',
        'duration',
    ];

    /**
     * Course
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
