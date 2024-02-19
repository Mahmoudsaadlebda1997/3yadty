<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = ['name', 'image'];
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'specialty_id');
    }
}
