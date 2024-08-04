<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Http\Requests\StoreLivreRequest;
use App\Http\Requests\UpdateLivreRequest;
use Illuminate\Support\Facades\Gate;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livres = Livre::all();
        return response()->json([
            "message" => "Liste des livres recuperer avec succés ",
            'livres' => $livres,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLivreRequest $request)
    {
        Gate::authorize('create', Livre::class);

        $livre = Livre::create($request->validated());
        return response()->json([
            "message" => "Livre ajouté avec succès ",
            'livre' => $livre,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Livre $livre)
    {
        return response()->json([
            "message" => "Livre récupéré avec succès ",
            'livre' => $livre,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLivreRequest $request, Livre $livre)
    {
        Gate::authorize('update', $livre);
        $livre->update($request->validated());
        return response()->json([
            "message" => "Livre modifié avec succès ",
            'livre' => $livre,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livre $livre)
    {
        Gate::authorize('delete', $livre);
        $livre->delete();
        return response()->json([
            "message" => "Livre supprimé avec succès ",
        ], 200);
    }
    public function restore($id)
    {
        $livre = Livre::onlyTrashed()->where('id', $id)->first();
        Gate::authorize('restore', $livre);
        $livre->restore();
        return response()->json([
            "message" => "Livres restaurés avec succès ",
            'livre' => $livre,
        ], 200);
    }
    public function forceDelete($id)
    {
        $livre = Livre::onlyTrashed()->where('id', $id)->first();
        Gate::authorize('forceDelete', $livre);
        $livre->forceDelete();
        return response()->json([
            "message" => "Livre supprimé définitivement avec succès ",
        ], 200);
    }
    public function trashed()
    {

        $livres = Livre::onlyTrashed()->get();
        return response()->json([
            "message" => "Liste des livres supprimés avec succès ",
            'livres' => $livres,
        ], 200);
    }
}
