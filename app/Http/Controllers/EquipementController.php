<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipement;

class EquipementController extends Controller
{
    public function index()
    {
        return Equipement::all();
    }

    public function store(Request $request)
    {
        return Equipement::create($request->all());
    }

    public function show($id)
    {
        return Equipement::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $equipement = Equipement::findOrFail($id);
        if (!empty($request->name)) {
            $equipement->name = $request->name;
        }
        
        if (!empty($request->description)) {
            $equipement->description = $request->description;
        }
        $equipement->save();
        return $equipement;
    }

    public function destroy($id)
    {
        $equipement = Equipement::findOrFail($id);
        $equipement->delete();
        return response()->json(null, 204);
    }

    // Method to retrieve soft deleted equipements
    public function deleted()
    {
        return Equipement::onlyTrashed()->get();
    }

    // Method to search equipment by name
    public function search(Request $request)
    {
        $searchTerm = $request->query('name');
        if (!$searchTerm) {
            return response()->json([], 400); // Bad request if no name query parameter is provided
        }

        $results = Equipement::where('name', 'LIKE', '%' . $searchTerm . '%')->get();
        return response()->json($results);
    }
}
