<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partener extends Model
{
    use HasFactory;

    protected $table = 'parteneri'; 
    protected $primaryKey = 'partener_id';

    protected $fillable = ['nume'];

    public function evenimente()
    {
        return $this->belongsToMany(Event::class, 'parteneri_evenimente', 'partener_id', 'event_id');
    }

}
