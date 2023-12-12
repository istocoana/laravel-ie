<?php

namespace App\Http\Controllers;

use App\Models\CosCumparaturi;
use App\Models\IstoricComenzi;
use App\Models\Event;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CosController extends Controller
{
    public function adaugaInCos(Request $request)
    {
        $user = auth()->user();
        $event_id = $request->event_id;
    
        $request->validate([
            'event_id' => 'required|exists:evenimente,event_id',
            'numar_bilete' => 'required|integer|min:1',
        ]);

        $existingCartItem = CosCumparaturi::where('user_id', auth()->id())
            ->where('event_id', '!=', $event_id)
            ->first();


            if ($existingCartItem) {
                session()->flash('error', 'Nu poți lua bilete de la evenimente diferite.');
                return redirect()->route('events.index')->with('error', 'Există deja un alt eveniment în coș.');
            }
        
            $cosCumparaturi = CosCumparaturi::updateOrCreate(
                ['user_id' => auth()->id(), 'event_id' => $event_id],
                ['nr_bilete_selectate' => DB::raw("nr_bilete_selectate + " . (int)$request->numar_bilete)]
            );
        
            session()->flash('success', 'Eveniment adăugat în coș cu succes.');
            return redirect()->route('events.index')->with('success', 'Eveniment adăugat în coș cu succes');
        }
    

    public function vizualizeazaCos(Request $request)
    {
        $user = auth()->user();

        $cos = CosCumparaturi::with('eveniment')->where('user_id', $user->id)->get();

        return view('cos.vizualizeazaCos', compact('cos'));
    }

    public function actualizeazaInCos(Request $request)
    {
        $user = auth()->user();
        $cosItem = CosCumparaturi::where('user_id', $user->id)
            ->where('event_id', $request->event_id)
            ->firstOrFail();

        $event = Event::findOrFail($request->event_id);

        if ($request->actiune === 'adauga') {
            $request->validate([
                'numar_bilete' => 'required|integer|min:1|max:' . ($event->bilete_disponibile - $cosItem->nr_bilete_selectate),
            ]);

            $cosItem->update(['nr_bilete_selectate' => DB::raw("nr_bilete_selectate + " . (int)$request->numar_bilete)]);
        } elseif ($request->actiune === 'scade') {
            $request->validate([
                'numar_bilete' => 'required|integer|min:1|max:' . $cosItem->nr_bilete_selectate,
            ]);

            $cosItem->update(['nr_bilete_selectate' => DB::raw("nr_bilete_selectate - " . (int)$request->numar_bilete)]);

            if ($cosItem->nr_bilete_selectate <= 0) {
                $cosItem->delete();
            }
        }

        return redirect()->route('cos.vizualizeazaCos')->with('success', 'Coșul a fost actualizat cu succes');
    }

    public function stergeEveniment(Request $request)
    {
        $user = auth()->user();
        $cosItem = CosCumparaturi::where('user_id', $user->id)
            ->where('event_id', $request->event_id)
            ->firstOrFail();

        $cosItem->delete();

        return redirect()->route('cos.vizualizeazaCos')->with('success', 'Evenimentul a fost șters din coș');
    }


}
