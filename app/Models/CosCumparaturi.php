<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CosCumparaturi extends Model
{
    use HasFactory;

    protected $table = 'cos_cumparaturi';
    protected $primaryKey = 'id_cos'; 

    protected $fillable = [
        'data',
        'user_id',
        'event_id',
        'nr_bilete_selectate',
    ];

    public function eveniment()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

