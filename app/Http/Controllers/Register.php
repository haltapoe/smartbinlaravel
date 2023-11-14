<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class Register extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'Full name' => ['required', 'string', 'max:255'],
            'email address' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'Create password' => ['required', 'string', 'min:8', 'confirmed'],
            'Repeat password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'Full name' => $data['name'],
            'email address' => $data['email'],
            'Create password' => Hash::make($data['password']),
            'repeat password' => Hash::make($data['password']),
        ]);
    }
}

