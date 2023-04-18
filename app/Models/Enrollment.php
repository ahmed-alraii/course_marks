<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Enrollment extends Model
{
    use HasFactory;

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'enrollments');
    }
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }
    public function yearSemesters(): BelongsToMany
    {
        return $this->belongsToMany(Semester::class, 'enrollments');
    }
}
