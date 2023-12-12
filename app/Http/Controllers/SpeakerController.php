<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speaker;

class SpeakerController extends Controller
{
    public function index()
    {
        $speakeri = Speaker::all();
        return view('speakeri.index', compact('speakeri'));
    }
    
    public function show($speaker_id)
    {
        $speaker = Speaker::where('speaker_id', $speaker_id)->firstOrFail();
        return view('speakeri.show', compact('speaker'));
    }

    public function create()
    {
        return view('speakeri.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'nume' => 'required|string|max:255', 
        ]);

        Speaker::create([
            'nume' => $request->nume,
        ]);

        return redirect()->route('speakeri.index')->with('success', 'Speaker creat cu succes!');
    }

    public function edit($speaker_id)
    {
        $speaker = Speaker::where('speaker_id', $speaker_id)->firstOrFail();
        return view('speakeri.edit', compact('speaker'));
    }

    public function update(Request $request, $speaker_id)
    {
        $speaker = Speaker::where('speaker_id', $speaker_id)->firstOrFail();
        $speaker->update($request->all());

        return redirect()->route('speakeri.show', ['speaker_id' => $speaker_id])->with('success', 'Sponsorul a fost actualizat cu succes!');
    }

    public function destroy($speaker_id)
    {
        $speaker = Speaker::where('speaker_id', $speaker_id)->firstOrFail();
        $speaker->evenimente()->detach();
        $speaker->delete();
        
        return redirect()->route('speakeri.index')->with('success', 'Sponsorul a fost șters cu succes!');
    }
}
