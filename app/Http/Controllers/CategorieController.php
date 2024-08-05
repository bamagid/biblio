<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return response()->json([
            'message' => 'Liste des catégories récupérées avec succès',
            'categories' => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        $categorie = Categorie::create($request->validated());
        return response()->json([
            'message' => 'Catégorie créée avec succès',
            'categorie' => $categorie
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        $categorie->livres;
        return response()->json([
            'message' => 'Catégorie récupérée avec succès',
            'categorie' => $categorie
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $categorie->update($request->validated());
        return response()->json([
            'message' => 'Catégorie modifiée avec succès',
            'categorie' => $categorie
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return response()->json([
            'message' => 'Catégorie supprimée avec succès'
        ], 204);
    }
    public function restore($id)
    {
        $categorie = Categorie::withTrashed()->where('id', $id)->first();
        $categorie->restore();
        return response()->json([
            'message' => 'Catégorie restaurée avec succès',
            'categorie' => $categorie
        ], 200);
    }
    public function forceDelete($id)
    {
        $categorie = Categorie::withTrashed()->where('id', $id)->first();
        $categorie->forceDelete();
        return response()->json([
            'message' => 'Catégorie supprimée définitivement'
        ], 204);
    }
    public function Trashed()
    {
        $categories = Categorie::onlyTrashed()->get();
        return response()->json([
            'message' => 'Liste des catégories supprimées récupérées avec succès',
            'categories' => $categories
        ], 200);
    }
}
