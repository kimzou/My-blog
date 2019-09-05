<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'username' => 'nullable', 'string', 'max:255', 'unique:users',
            'email' => 'nullable', 'string', 'email', 'max:255', 'unique:users',
            'name' => 'nullable', 'string', 'max:255',
            'lastname' => 'nullable', 'string', 'max:255',
            'birthdate' => 'nullable', 'date',
            'password' => 'nullable', 'string', 'min:8', 'confirmed',
        ]);

       $user = User::find($id);
       
       foreach ($data as $field => $value) {
            if ($value === null) {
                $data[$field] = $user->$field;
            } else  if ($field === 'password') {
                $data['password'] = Hash::make($value);
            }
       }

       $user->update($data);

       return view('auth.edit', compact('user'))->with('success', 
       'Vos informations ont bien été modifiées !');
    }

    public function destroy($id)
    {
        User::whereId($id)->delete();
        
        return redirect('/')->with('success', 'Votre compte à bien été supprimer.');
    }
}
