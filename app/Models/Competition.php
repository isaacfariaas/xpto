<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'raffle_date',
        'start_date',
        'end_date',
        'scholarship_amount',
    ];

    public function winners()
    {
        return $this->hasMany(Winners::class, 'id_competition');
    }

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'id_competition');
    }
}
