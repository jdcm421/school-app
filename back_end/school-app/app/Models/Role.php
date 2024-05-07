<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{

    public const ADMIN = "Admin";
    public const TEACHER="Teacher";

    protected $fillable = ['type'];
    protected $hidden = ['created_at','updated_at'];

    public function user(): hasMany {
        return $this->hasMany(User::class);
    }

}
