<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
      return view('registrations.create');
    }

    public function store()
    {
      // Validate the form
      $this->validate(request(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed'
      ]);

      // Create and save the user.
      $user = User::create(request(['name', 'email', 'password']));
      dd($user);

      // Sign in them.
      auth()->login($user);

      // Redirect to the home page.
      return redirect()->home();
    }
}
