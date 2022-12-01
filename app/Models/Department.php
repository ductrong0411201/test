<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['department_name','company_id'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function users()
    {
        return $this->hasMany(Users::class);
    }
    public function manager()
    {
        return $this->hasOne(Users::class, 'id', 'manager_id');
    }
}
