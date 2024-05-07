<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','name','last_name','age','identification_card','email'];
    protected $appends = ['courses_count'];
    protected $hidden = ['created_at','updated_at','deleted_at'];
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function courses() : hasMany {
        return $this->hasMany(StudentAndCourse::class);
    }

    public function getCoursesCountAttribute() : int {
        return $this->courses()->count();
    }
}
