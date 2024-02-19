<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['name', 'password', 'age'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
