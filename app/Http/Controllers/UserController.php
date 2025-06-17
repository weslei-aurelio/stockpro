<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index ()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function update (User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'exclude_if:password,null|min:6|confirmed'
        ]);
      
        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        request()->session()->flash('success', 'Usuário editado com sucesso');
        return redirect()->route('users.index');
    }

    public function store(Request $request)
    {
        $user = new User();

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'create')
                ->withInput();
        }

        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->password  = $request->password;
        $user->status_id = Status::ATIVO;
        $user->save();

        request()->session()->flash('success', 'Usuário cadastrado com sucesso');
        return redirect()->route('users.index');
    }

    public function inactivate(User $user) 
    {
        $user->status_id = Status::SUSPENSO;
        $user->save();

        request()->session()->flash('success', 'Usuário inativado com sucesso');
        return redirect()->route('users.index');
    }

    public function activate(User $user) 
    {
        $user->status_id = Status::ATIVO;
        $user->save();

        request()->session()->flash('success', 'Usuário ativado com sucesso');
        return redirect()->route('users.index');
    }

}
