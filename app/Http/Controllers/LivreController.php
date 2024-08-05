<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Http\Requests\StoreLivreRequest;
use App\Http\Requests\UpdateLivreRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use phpDocumentor\Reflection\Types\This;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $livres = Livre::all();
        return $this->CustomJsonresponse("La liste des livres", $livres);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLivreRequest $request)
    {
        Gate::authorize('create', Livre::class);
        $livre = new Livre();
        $livre->fill($request->validated());
        $livre->image = $request->file('image')->store('images', 'public');
        $livre->save();
        return $this->CustomJsonresponse("Livre créé avec succès", $livre);
    }

    /**
     * Display the specified resource.
     */
    public function show(Livre $livre)
    {
        return $this->CustomJsonresponse("Livre trouvé", $livre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLivreRequest $request, Livre $livre)
    {
        Gate::authorize('update', $livre);
        $livre->fill($request->validated());
        if ($request->hasFile('image')) {
            if (File::exists(storage_path($livre->image))) {
                File::delete(storage_path($livre->image));
            }
            $livre->image = $request->file('image')->store('images', 'public');
        }
        $livre->update();
        return $this->CustomJsonresponse("Livre modifié avec succès", $livre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livre $livre)
    {
        Gate::authorize('delete', $livre);
        $livre->delete();
        return $this->CustomJsonresponse("Livre archivé avec succès", $livre);
    }
    public function restore($id)
    {
        $livre = Livre::onlyTrashed()->where('id', $id)->first();
        Gate::authorize('restore', $livre);
        if ($livre) {
            $livre->restore();
            return $this->CustomJsonresponse("Livre rétabli avec succès", $livre);
        }
        return $this->CustomJsonresponse("Livre introuvable", null, 404);
    }
    public function forceDelete($id)
    {
        $livre = Livre::onlyTrashed()->where('id', $id)->first();
        Gate::authorize('forceDelete', $livre);
        if ($livre) {
            $livre->forceDelete();
            return $this->CustomJsonresponse("Livre supprimé définitivement", $livre);
        }
        return $this->CustomJsonresponse("Livre introuvable", null, 404);
    }
    public function Trashed()
    {
        $livres = Livre::onlyTrashed()->get();
        Gate::authorize('viewAny', Livre::class);
        return $this->CustomJsonresponse("Livres archivés", $livres);
    }
    public function emptyTrashes()
    {
        $livres = Livre::onlyTrashed()->get();
        foreach ($livres as $livre) {
            Gate::authorize('forceDelete', $livre);
        }
        $livres->each->forceDelete();
        return $this->CustomJsonresponse("Tous les livres archivés ont été supprimés définitivement", null);
    }
}
