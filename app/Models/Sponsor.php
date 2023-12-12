<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    protected $table = 'sponsori'; 
    protected $primaryKey = 'sponsor_id';

    protected $fillable = ['nume'];

    public function evenimente()
    {
        return $this->belongsToMany(Event::class, 'sponsori_evenimente', 'sponsor_id', 'event_id');
    }

 
}
