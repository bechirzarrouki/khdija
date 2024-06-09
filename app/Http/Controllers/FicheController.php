<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use Illuminate\Http\Request;

class FicheController extends Controller
{
    public function index()
    {
        // Retrieve all fiches
        $fiches = Fiche::all();
        return response()->json($fiches);
    }

    public function store(Request $request)
    {
        // Create a new fiche
        $fiche = Fiche::create($request->all());
        return response()->json($fiche, 201);
    }

    public function show($id)
    {
        // Retrieve a single fiche by ID
        $fiche = Fiche::findOrFail($id);
        return response()->json($fiche);
    }

    public function update(Request $request, $id)
    {
        // Update a fiche
        $fiche = Fiche::findOrFail($id);

        if (!empty($request->name)) {
            $fiche->name = $request->name;
        }
    
        if (!empty($request->description)) {
            $fiche->description = $request->description;
        }
    
        if (!empty($request->da)) {
            $fiche->type = $request->type;
        }

        if (!empty($request->df)) {
            $fiche->type = $request->type;
        }
        
        $fiche->save();
        return response()->json($fiche, 200);
    }

    public function destroy($id)
    {
        // Delete a fiche
        $fiche = Fiche::findOrFail($id);
        $fiche->delete();
        return response()->json(null, 204);
    }

    public function getDeletedFiches()
    {
        $deletedFiches = Fiche::onlyTrashed()->get();
        return response()->json($deletedFiches, 200);
    }

    // Method to search fiches by name
    public function search(Request $request)
    {
        $searchTerm = $request->query('name');
        if (!$searchTerm) {
            return response()->json([], 400); // Bad request if no name query parameter is provided
        }

        $results = Fiche::where('name', 'LIKE', '%' . $searchTerm . '%')->get();
        return response()->json($results);
    }
}
