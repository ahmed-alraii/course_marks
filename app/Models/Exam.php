<?php

namespace App\Models;

use App\Enums\ExamType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Exam extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => ExamType::class
    ];

    protected $fillable = ['type' , 'number' , 'full_mark' ,
        'teacher_id' , 'course_id' , 'semester_id'];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class );
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class );
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class );
    }

    public function mark(): HasOne
    {
        return $this->hasOne(Mark::class );
    }
}
