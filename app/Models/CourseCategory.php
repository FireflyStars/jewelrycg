<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;
    /**
     * Get the courses associate with the category
     */
    public function courses(){
        $this->hasMany(Course::class, 'category_id');
    }
}
