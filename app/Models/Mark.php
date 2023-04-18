<?php

namespace App\Models;

use App\Enums\ExamType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mark extends Model
{
    use HasFactory;


    protected $fillable = [ 'student_mark' , 'student_id' , 'exam_id'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class );
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class );
    }

}
