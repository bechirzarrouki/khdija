<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!empty($request->name)) {
            $user->name = $request->name;
        }

        if (!empty($request->email)) {
            $user->email = $request->email;
        }

        if (!empty($request->matricule)) {
            $user->matricule = $request->matricule;
        }

        if (!empty($request->poste)) {
            $user->poste = $request->poste;
        }

        if (!empty($request->mode_dacces)) {
            $user->mode_dacces = $request->mode_dacces;
        }

        if (!empty($request->tel)) {
            $user->tel = $request->tel;
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    public function search(Request $request)
    {
        $name = $request->input('name');

        if (empty($name)) {
            return response()->json(['message' => 'Name is required for search'], 400);
        }

        $users = User::where('name', 'LIKE', '%' . $name . '%')->get();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'No users found with the given name'], 404);
        }

        return response()->json(['users' => $users], 200);
    }
}
