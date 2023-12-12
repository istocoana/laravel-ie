<?php

namespace App\Http\Controllers;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsori = Sponsor::all();
        return view('sponsori.index', compact('sponsori'));
    }
    
    public function show($sponsor_id)
    {
        $sponsor = Sponsor::where('sponsor_id', $sponsor_id)->firstOrFail();
        return view('sponsori.show', compact('sponsor'));
    }

    public function create()
    {
        return view('sponsori.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'nume' => 'required|string|max:255', 
        ]);

        Sponsor::create([
            'nume' => $request->nume,
        ]);

        return redirect()->route('sponsori.index')->with('success', 'Sponsor creat cu succes!');
    }

    public function edit($sponsor_id)
    {
        $sponsor = Sponsor::where('sponsor_id', $sponsor_id)->firstOrFail();
        return view('sponsori.edit', compact('sponsor'));
    }

    public function update(Request $request, $sponsor_id)
    {
        $sponsor = Sponsor::where('sponsor_id', $sponsor_id)->firstOrFail();
        $sponsor->update($request->all());

        return redirect()->route('sponsori.show', ['sponsor_id' => $sponsor_id])->with('success', 'Sponsorul a fost actualizat cu succes!');
    }

    public function destroy($sponsor_id)
    {
        $sponsor = Sponsor::where('sponsor_id', $sponsor_id)->firstOrFail();
        $sponsor->evenimente()->detach();
        $sponsor->delete();
        
        return redirect()->route('sponsori.index')->with('success', 'Sponsorul a fost șters cu succes!');
    }
    
}
