<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Option;

class HomeController extends Controller
{
    public function index()
    {
        //la index mi serve per mostrare tutti gli appartamenti inizialmente
        $apartments = Apartment::all();
        //passo le options alla view per costruire le checkbox
        $options = Option::all();
        // dd($apartments);
        return view('index', ['apartments' => $apartments, 'options' => $options]);
    }

    public function show($id)
    {
        //l show mostra il dettaglio specifica dell'appartamento selezionato
        $apartment = Apartment::find($id);
        // dd($apartment);
        return view('show', ['apartment' => $apartment]);
    }

    //process request and return data
    public function ajaxResponse(Request $request)
    {
        if ($request->ajax()) {
            // dd($request);
            // $distance = $request->distance;
            $postiLetto = $request->posti_letto;
            $stanze = $request->stanze;
            $options = $request->options;
            if ($options === null) {
                $apartments = Apartment::where('visibilita', '1')
                ->where('posti_letto', $postiLetto)
                ->where('stanze', $stanze)
                ->get();
            } else {
                //conto numero servizi selezionati tramite filtro
                $options_selected = count($options);
                //seleziono ap in db per visibilità, posti letto e numero stanze
                $apartments = Apartment::where('visibilita', '1')
                ->where('posti_letto', $postiLetto)
                ->where('stanze', $stanze)
                //faccio la join con la tabella apartment_option
                ->join('apartment_option', 'apartment_option.apartment_id', '=', 'apartments.id')
                //seleziono id titolo e indirizzo che mi servono per costruire la card
                //devo conteggiare il numero di servizi che ogni appartamento ha in db dalla tab apartment_option
                ->selectRaw('apartments.id, apartments.titolo, apartments.indirizzo, COUNT(apartments.id) AS num_options_ap')
                // ->select('id, titolo, indirizzo, count(apartments.id) as num_options_ap')
                // ->count('apartment_option.apartment_id' as 'num_options_ap')
                //verifico che le option id di apartemtno sono tra quelle selezionate tramite filtri
                ->whereIn('option_id', $options)
                //raggruppo per id nella colonna ap_option
                ->groupBy('apartment_option.apartment_id')
                // ->groupBy('apartment_option.apartment_id AS num_options_ap')
                //devo prendere solo quelli in cui il numero dei loro servizi o uguale al numero di servizi selezionati
                ->having('num_options_ap', '=', $options_selected)
                ->get();

            }
            return response()->json($apartments);
        } else {
            return 'nessun risultato';
        }
    }
}
