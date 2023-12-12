<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partener;

class ParteneriController extends Controller
{
    public function index()
    {
        $parteneri = Partener::all();
        return view('parteneri.index', compact('parteneri'));
    }
    
    public function show($partener_id)
    {
        $partener = Partener::findOrFail($partener_id);
        return view('parteneri.show', compact('partener'));
    }
    

    public function create()
    {
        return view('parteneri.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'nume' => 'required|string|max:255', 
        ]);

        Partener::create([
            'nume' => $request->nume,
        ]);

        return redirect()->route('parteneri.index')->with('success', 'Partener creat cu succes!');
    }

    public function edit($partener_id)
    {
        $partener = Partener::where('partener_id', $partener_id)->firstOrFail();
        return view('parteneri.edit', compact('partener'));
    }

    public function update(Request $request, $partener_id)
    {
        $partener = Partener::where('partener_id', $partener_id)->firstOrFail();
        $partener->update($request->all());

        return redirect()->route('parteneri.show', ['partener_id' => $partener_id])->with('success', 'Sponsorul a fost actualizat cu succes!');
    }

    public function destroy($partener_id)
    {
        $partener = Partener::where('partener_id', $partener_id)->firstOrFail();
        $partener->evenimente()->detach();
        $partener->delete();
        
        return redirect()->route('parteneri.index')->with('success', 'Sponsorul a fost șters cu succes!');
    }
}
