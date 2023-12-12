<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IstoricComenzi extends Model
{
    use HasFactory;
    protected $table = 'istoric_comenzi';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'user_id',
        'event_id',
        'numar_bilete_achizitionate',
        'data_achizitiei',
    ];

    public function eveniment()
    {
        return $this->hasMany(Event::class, 'event_id', 'event_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
