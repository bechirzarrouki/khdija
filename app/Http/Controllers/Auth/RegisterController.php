<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function register(Request $request)
    {
        $validator = $this->validator($request->all());
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Create a new user instance
        $user = new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password= $request->password;
        $user->matricule= $request->matricule;
        $user->poste = $request->poste;
        $user->mode_dacces = $request->mode_dacces;
        $user->tel = $request->tel;
    
        // Save the user to the database
        $user->save();
    
        // Fire the Registered event
        event(new Registered($user));
    
        // Return a success response
        return response()->json(['message' => 'User registered successfully'], 201);
    }
    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'poste' => ['required', 'string', 'max:255'],
            'mode_dacces' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
        ]);
    }
}
