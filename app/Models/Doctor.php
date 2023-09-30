<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Doctor extends Model implements HasMedia
{
    use HasFactory,HasApiTokens,SoftDeletes,InteractsWithMedia;
    protected $fillable = ['name', 'city', 'email', 'password', 'major_id'];
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
    public function registerMediaConversions(Media $media = null): void
     {
      $this
        ->addMediaCollection('doctor_images');
       }


}
