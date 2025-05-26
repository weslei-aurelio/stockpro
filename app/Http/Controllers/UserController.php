<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index ()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {

        return view('users.edit', compact('user'));
    }

    public function update (User $user, Request $request)
    {
        $input = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'exclude_if:password,null|min:6'
        ]);

        $user->fill($input);
        $user->save();

        return redirect()
            ->route('users.index')
            ->with('status', 'Usuário editado com sucesso!');
    }
}
