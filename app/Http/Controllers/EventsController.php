<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Sponsor;
use App\Models\Partener;
use App\Models\Speaker;
use Illuminate\Http\Request;
use  App\Models\User;
use App\Mail\EventsMailer;
use App\Models\Speakers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function show($event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('events.show', compact('event'));
    }
    
    public function create()
    {
        $allSponsors = Sponsor::all(); 
        $allSpeakers = Speaker::all();
        $allPartners = Partener::all();
        return view('events.create', compact('allSponsors', 'allSpeakers', 'allPartners'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titlu' => 'required|max:255',
            'descriere' => 'required',
            'data' => 'required|date',
            'locatie' => 'required|max:255',
            'bilete_disponibile' => 'required|integer|min:0',
            'pret' => 'required|numeric|min:0',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
            $validatedData['image_path'] = $imageName;
        }

        $event = Event::create($validatedData);

        if ($request->has('sponsori')) {
            $sponsoriSelectati = $request->input('sponsori');
            $event->sponsori()->attach($sponsoriSelectati);
        }
    
        if ($request->has('speakers')) {
            $speakeriSelectati = $request->input('speakers');
            $event->speakers()->attach($speakeriSelectati);
        }

        if ($request->has('parteneri')) {
            $parteneriSelectati = $request->input('parteneri');
            $event->parteneri()->attach($parteneriSelectati);
        }
        
        $clients = User::where('role', 'client')->get();

        try {
            foreach ($clients as $client) {
                Mail::to($client->email)->send(new EventsMailer($event)); 
            }
        } catch (\Exception $e) {
            Log::error('Eroare la trimiterea e-mailului: ' . $e->getMessage());
            return redirect()->back()->with('error', 'A apărut o eroare la trimiterea e-mailului către utilizatori!');
        }
        
        return redirect()->route('events.index')
            ->with('success', 'Evenimentul a fost creat cu succes!');
    }

    public function edit($event_id)
    {
        $event = Event::findOrFail($event_id);
        $allSponsors = Sponsor::all();
        $allSpeakers = Speaker::all();
        $allPartners = Partener::all();
        $selectedSponsors = $event->sponsori->pluck('sponsor_id')->toArray(); 
        $selectedSpeakers = $event->speakers->pluck('speaker_id')->toArray(); 
        $selectedPartners = $event->parteneri->pluck('partener_id')->toArray(); 

        return view('events.edit', compact('event', 'allSponsors', 'selectedSponsors', 'allSpeakers', 'allPartners', 'selectedSpeakers', 'selectedPartners'));
    }


    public function update(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);

        $validatedData = $request->validate([
            'titlu' => 'required|max:255',
            'descriere' => 'required',
            'data' => 'required|date',
            'locatie' => 'required|max:255',
            'bilete_disponibile' => 'required|integer|min:0',
            'pret' => 'required|numeric|min:0',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
            $validatedData['image_path'] = $imageName;
        }

        $event->update($validatedData);

        if ($request->has('sponsori')) {
            $sponsori = $request->input('sponsori');
            $event->sponsori()->sync($sponsori);
        } else {
            $event->sponsori()->detach();
        }

        if ($request->has('speakers')) {
            $speakers = $request->input('speakers');
            $event->speakers()->sync($speakers);
        } else {
            $event->speakers()->detach();
        }

        if ($request->has('parteneri')) {
            $parteneri = $request->input('parteneri');
            $event->parteneri()->sync($parteneri);
        } else {
            $event->parteneri()->detach();
        }
    
        return redirect()->route('events.index')
            ->with('success', 'Evenimentul a fost actualizat cu succes!');
    }
    
    public function destroy($event_id)
    {
        $event = Event::findOrFail($event_id);

        $istoricComenzi = $event->istoricComenzi;


        $event->delete();

        session()->flash('success', 'Evenimentul a fost șters cu success.');
        return redirect()->route('events.index')->with('success', 'Evenimentul a fost șters cu succes, înregistrările din istoricul comenzilor asociate au fost păstrate.');
    }

    public function attachSponsorsToEvent(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);
    
        $selectedSponsors = $request->input('sponsori');
    
        $event->sponsori()->sync($selectedSponsors);
    
        return redirect()->route('events.index', ['event_id' => $event_id])
            ->with('success', 'Sponsori adăugați cu succes la eveniment!');
    }
    

}
