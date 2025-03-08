<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'room_id', 'name', 'email', 'phone',
        'checkin_date', 'occupants', 'payment_method','status','user_id','payment_token'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}




