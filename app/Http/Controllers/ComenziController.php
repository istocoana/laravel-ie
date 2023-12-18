<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CosCumparaturi;
use App\Models\Event;
use App\Models\IstoricComenzi;
use App\Mail\DetaliiComandaMail;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Exception;
use Illuminate\Http\RedirectResponse;
use Barryvdh\Debugbar\Facades\Debugbar;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;


class ComenziController extends Controller
{
    public function formularPlata()
    {

        $user = Auth::user();
        $cos = CosCumparaturi::with('eveniment')->where('user_id', $user->id)->get();
        $amount = 0;

            foreach ($cos as $item) {
                $amount += $item->eveniment->pret * $item->nr_bilete_selectate;
            }

        return view('comenzi.formularPlata', compact('cos', 'amount'));
    }

    public function procesarePlata()
    {
        try {
            Stripe::setApiKey((env('STRIPE_SECRET')));

            $user = Auth::user();
            $cos = CosCumparaturi::with('eveniment')->where('user_id', $user->id)->get();

            $lineItems = [];

            $amount = 0;

            foreach ($cos as $item) {
                $amount += $item->eveniment->pret * $item->nr_bilete_selectate;
            }

            foreach ($cos as $item) {
                $product = [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $item->eveniment->pret * 100,
                        'product_data' => [
                            'name' => $item->eveniment->titlu,
                            'description' => $item->eveniment->descriere,
                        ],
                    ],
                    'quantity' => $item->nr_bilete_selectate,
                ];

                $lineItems[] = $product;
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('success'), 
                'cancel_url' => route('cancel'),
            ]);

            return view('comenzi.success');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function success(Request $request)
    {
        $user = Auth::user();
        $cos = CosCumparaturi::with('eveniment')->where('user_id', $user->id)->get();
    
        try {
            foreach ($cos as $item) {
                $eveniment = Event::find($item->event_id);
                $eveniment->bilete_disponibile -= $item->nr_bilete_selectate;
                $eveniment->save();

    
                $istoricComanda = new IstoricComenzi();
                $istoricComanda->user_id = $user->id;
                $istoricComanda->event_id = $item->event_id;
                $istoricComanda->numar_bilete_achizitionate = $item->nr_bilete_selectate;
                $istoricComanda->data_achizitiei = now();
                $istoricComanda->save(); 
                
            }

            CosCumparaturi::where('user_id', $user->id)->delete();

            return redirect()->route('success-page');

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function successPage(Request $request)
    {
        $user = Auth::user();
        $comanda = IstoricComenzi::where('user_id', $user->id)->latest()->first();
        if ($comanda) {
            $comanda_id = $comanda->id;
    
            return view('comenzi.successPage', compact('comanda_id'));
        } else {
            return view('comenzi.faraComanda');
        }
    }

    public function comenzi()
    {
        $user = Auth::user();
        $comenzi = IstoricComenzi::with('eveniment')->where('user_id', $user->id)->get();
        return view('comenzi.comenzi', compact('comenzi'));
    }

    public function detaliiComanda($comanda_id) 
    {
        
        $comanda = IstoricComenzi::findOrFail($comanda_id);
        return view('comenzi.detaliiComanda', compact('comanda'));
        
    }

    public function descarcaPDF($comanda_id)
    {
        $comanda = IstoricComenzi::findOrFail($comanda_id);

        $html = View::make('comenzi.detaliiComandaPDF', compact('comanda'))->render();
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
    
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        return $dompdf->stream('detalii_comanda.pdf');

        $pdfContent = $dompdf->output();
    }

    public function comenziEveniment($event_id)
    {
        $user = Auth::user();
        $comenzi = IstoricComenzi::where('event_id', $event_id)->get();
        return view('comenzi.eveniment', compact('comenzi', 'event_id'));
    }

}
