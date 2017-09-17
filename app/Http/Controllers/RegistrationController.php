<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;

class RegistrationController extends Controller
{
    public function create()
    {
      return view('registrations.create');
    }

    public function store(RegistrationForm $form)
    {
      // Validate the form manual, without RegistrationRequest
      // $this->validate(request(), [
      //   'name' => 'required',
      //   'email' => 'required|email',
      //   'password' => 'required|confirmed'
      // ]);

      // Create and save the user.
      // $user = User::create([
      //   'name' => request('name'),
      //   'email' => request('email'),
      //   'password' => bcrypt(request('password'))
      // ]);
      //
      // // Sign in them.
      // auth()->login($user);
      //
      // \Mail::to($user)->send(new Welcome($user));

      // if use RegistrationForm in Request, the code more simple and clean
      $form->persist();

      session()->flash('message', 'Thanks for signin up!');

      // Redirect to the home page.
      return redirect()->home();
    }
}
