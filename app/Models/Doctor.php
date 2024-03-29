<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name', 'age', 'user_id', 'specialty_id', 'image', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class,'specialty_id');
    }
}
