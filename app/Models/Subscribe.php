<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'competition_subscribes';

    protected $fillable = [
        'id_competition',
         'id_user'
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'id_competition');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
}
