<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    protected $table = 'competition_winners';

    protected $fillable = [
        'id_competition',
         'id_subscribe',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'id_competition');
    }

    public function subscribe()
    {
        return $this->belongsTo(Subscribe::class, 'id_subscribe');
    }
}
