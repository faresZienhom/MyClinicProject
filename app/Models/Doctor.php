<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name', 'city', 'email', 'password', 'image', 'major_id'];
   // protected $with =['major'];


   protected $hidden = ['password'];

    // forien key
    function major()
    {
        return $this->belongsTo(Major::class);
    }
       function booking()
    {
        return $this->hasMany(Booking::class);
    }
    function rates()
    {
        return $this->hasMany(Rate::class);
    }


}
