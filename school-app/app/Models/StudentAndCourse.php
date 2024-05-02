<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAndCourse extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','course_id'];
    protected $hidden = ['created_at','updated_at'];
    protected $dates = ['created_at','updated_at'];

    public function course() : belongsTo {
        return $this->belongsTo(Course::class);
    }

    public function student() :belongsTo {
        return $this->belongsTo(Student::class);
    }
}
