<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'parent_email' , 'parent_phone' , 'gender' , 'date_of_birth'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->withPivot(['year_semester_id'])->withTimestamps();
    }
}
