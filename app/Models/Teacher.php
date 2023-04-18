<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'email' , 'phone' , 'specialization'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->withPivot(['semester_id'])->withTimestamps();
    }
}
