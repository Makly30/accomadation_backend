<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dorm extends Model
{
    use HasFactory;
    protected $table="dorm";
    protected $fillable = [
        'dorm_name',
        'dorm_address',
        'dorm_profile',
        'dorm_facebook',
        'phone',
        'dorm_deposition',
        'dorm_contract',
        'dorm_electric',
        'dorm_water',
        'dorm_wifi',
        'like',
        'rate',
        'admin_id'
    ];
    public function admin(){
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
