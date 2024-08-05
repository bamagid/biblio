<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Http\Requests\StoreEmpruntRequest;
use App\Http\Requests\UpdateEmpruntRequest;
use App\Models\Livre;
use Illuminate\Support\Facades\Gate;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Emprunt::class);
        $emprunts = Emprunt::all();
        $emprunts->each->user;
        $emprunts->each->livre;
        return $this->CustomJsonResponse("Liste des emprunts", $emprunts);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpruntRequest $request)
    {
        Gate::authorize('create', Emprunt::class);
        $livre = Livre::findOrFail($request->livre_id);
        if ($livre->disponible == false || $livre->quantite == 0) {
            return $this->CustomJsonResponse("Livre indisponible", null, 400);
        }
        $emprunt = new Emprunt();
        $emprunt->fill($request->validated());
        if ($emprunt->date_emprunt == null) {
            $emprunt->date_emprunt = date('Y-m-d');
        }
        $emprunt->save();
        $livre->update(['quantite' => $livre->quantite - 1,]);
        if ($livre->quantite == 0) {
            $livre->update(['disponible' => false]);
        }
        return $this->CustomJsonResponse("Emprunt créé avec succès", $emprunt);
    }

    /**
     * Display the specified resource.
     */
    public function show(Emprunt $emprunt)
    {
        Gate::authorize('view', $emprunt);
        $emprunt->user;
        $emprunt->livre;
        return $this->CustomJsonResponse("Details de l'emprunt", $emprunt);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Emprunt $emprunt)
    {
        Gate::authorize('update', $emprunt);
        if ($emprunt->date_retour_reelle !== null) {
            return $this->CustomJsonResponse("Impossible de modifier un emprunt qui a déjà été retourné", null, 400);
        }
        $emprunt->update(["date_retour_reelle" => date('Y-m-d')]);
        $emprunt->livre->update([
            'quantite' => $emprunt->livre->quantite + 1,
            'disponible' => true
        ]);
        return $this->CustomJsonResponse("Emprunt retourné avec succès", $emprunt);
    }
}
