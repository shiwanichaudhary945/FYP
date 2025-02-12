<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_type',
        'location',
        'bedrooms',
        'bathrooms',
        'parking',
        'furnished',
        'area',
        'price',
        'description',
        'image',
        'latitude',
        'longitude',
        'amenities',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amenities' => 'array', // Converts JSON to an array automatically
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_amenity');
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}


}
