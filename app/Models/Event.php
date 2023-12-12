<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'evenimente'; 
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'titlu', 'descriere', 'data', 'locatie', 'bilete_disponibile', 'pret', 'image_path'
    ];
    
    public function sponsori()
    {
        return $this->belongsToMany(Sponsor::class, 'sponsori_evenimente', 'event_id', 'sponsor_id');
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'speakers_evenimente', 'event_id', 'speaker_id');
    }

    public function parteneri()
    {
        return $this->belongsToMany(Partener::class, 'parteneri_evenimente', 'event_id', 'partener_id');
    }


    public function cosCumparaturi()
    {
        return $this->belongsTo(CosCumparaturi::class, 'event_id', 'event_id');
    }

    public function istoricComenzi()
    {
        return $this->belongsTo(IstoricComenzi::class, 'id', 'event_id');
    }
}
