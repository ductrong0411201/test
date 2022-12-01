<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // use HasFactory;
    protected $fillable = ['name', 'user_account','password','email' , 'department_id'];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
