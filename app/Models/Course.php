<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    /**
     * Get category that owns the course
     */
    public function category(){
        $this->belongsTo(CourseCategory::class, 'category_id');
    }

    /**
     * Get lesson associate with course
     */
    public function lessons(){
        $this->hasMany(CourseLesson::class, 'course_id');
    }
}
