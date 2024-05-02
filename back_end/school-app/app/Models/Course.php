<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','name','date_start','date_end','schedule','type'];
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $hidden = ['created_at','updated_at','deleted_at'];
    protected $appends = ['students_count'];

    public function studentAndCourse() : hasMany {
        return $this->hasMany(StudentAndCourse::class);
    }

    public function getStudentsCountAttribute() : int {
        return $this->studentAndCourse()->count();
    }
}
