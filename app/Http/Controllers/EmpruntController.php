<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Http\Requests\StoreEmpruntRequest;
use App\Models\Livre;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprunts = Emprunt::all();
        $emprunts->each->user;
        $emprunts->each->livre;
        return response()->json([
            "message" => "Liste des emprunts",
            'emprunts' => $emprunts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpruntRequest $request)
    {
        $livre = Livre::findOrFail($request->livre_id);
        if ($livre->quantite > 0) {
            $livre->update(['quantite' => $livre->quantite - 1, 'disponible' => true]);
        } else {
            $livre->update(['disponible' => false]);
            return response()->json([
                "message" => "Livre indisponible veuillez Patienter le temps qu'il soit disponible",
                'emprunt' => null
            ]);
        }
        $emprunt = new Emprunt();
        $emprunt->fill($request->validated());
        if ($request->date_emprunt == "") {
            $emprunt->date_emprunt = now()->format('Y-m-d');
        }
        $emprunt->save();
        return response()->json([
            "message" => "Emprunt créé avec succés",
            'emprunt' => $emprunt
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Emprunt $emprunt)
    {
        $emprunt->user;
        $emprunt->livre;
        return response()->json([
            "message" => "Emprunt recuperé avec succès",
            'emprunt' => $emprunt
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Emprunt $emprunt)
    {
        if ($emprunt->date_retour_reelle == null) {

            $emprunt->update([
                "date_retour_reelle" => now()->format('Y-m-d'),
            ]);
            $livre = Livre::findOrFail($emprunt->livre_id);
            if ($livre->quantite >= 0) {
                $livre->update(['quantite' => $livre->quantite + 1, 'disponible' => true]);
            }
            return response()->json([
                "message" => "Emprunt mis à jour avec succès",
                'emprunt' => $emprunt
            ]);
        } else {
            return response()->json([
                "message" => "Vous  ne pouvez rendre le meme emprunt deux fois"
            ], 403);
        }
    }
}
