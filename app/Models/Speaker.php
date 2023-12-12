<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    protected $table = 'speakers'; 
    protected $primaryKey = 'speaker_id';

    protected $fillable = ['nume'];

    public function evenimente()
    {
        return $this->belongsToMany(Event::class, 'speakers_evenimente', 'speaker_id', 'event_id');
    }

}
