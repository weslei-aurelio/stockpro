<?php

namespace App\Http\Controllers;

use App\Models\Status;
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

    public function create() 
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->merge(['status_id' => Status::ATIVO]);

        $input = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'password'  => 'required|min:6',
            'status_id' => 'required|integer'
        ]);

        User::create($input);

        request()->session()->flash('success', 'Usuário cadastrado com sucesso');

        return redirect()->route('users.index');

        // return redirect()
        //     ->route('users.index')
        //     ->with('status', 'Usuário cadastrado com sucesso!');
    }

    public function inactivate(User $user) 
    {
        $user = User::where('id', $user->id)->first();
        $user->status_id = Status::SUSPENSO;

        $user->save();

        request()->session()->flash('success', 'Usuário inativado com sucesso');

        return redirect()->route('users.index');
        // return redirect()
        //     ->route('users.index')
        //     ->with('status', 'Usuário inativado com sucesso!');

    }

    public function activate(User $user) 
    {
        $user = User::where('id', $user->id)->first();
        $user->status_id = Status::ATIVO;

        $user->save();

        request()->session()->flash('success', 'Usuário ativado com sucesso');

        return redirect()->route('users.index');
        // return redirect()
        //     ->route('users.index')
        //     ->with('status', 'Usuário ativado com sucesso!');
    }

}
