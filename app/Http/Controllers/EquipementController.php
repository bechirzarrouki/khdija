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

    // Additional method to retrieve soft deleted equipements
    public function deleted()
    {
        return Equipement::onlyTrashed()->get();
    }
}
