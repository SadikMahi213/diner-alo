<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Table name (optional, default: courses)
    protected $table = 'courses';

    // Mass assignable fields
    protected $fillable = [
        'name',            // course_name
        'short_description', // course_short_desc
        'teacher_id',      // relation to users table (teacher)
        'status',          // published, draft, archived
        'enrolled_count',  // total enrolled students
    ];

    /**
     * Teacher relation
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
         ->where('role', 'student');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'course_package');
    }
}