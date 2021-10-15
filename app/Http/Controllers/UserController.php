<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show() {

        return view('profile')->with(['title' => 'Profile', 'user' => Auth::user()]);
    }

    public function update(ProfileRequest $request) {
        $data = $request->validated();
        $user = User::findorFail(Auth::user()->getAuthIdentifier());
        $user->update([
            'email' => $data['email'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'preferable_language' => $data['pref_lang']
        ]);

        Session::put('applocale', $data['pref_lang']);
        App::setLocale(Session::get('applocale'));

        activity('user-update')->causedBy($user)->performedOn($user)
            ->log('User: '.$user->getFullName().' updated the profile details.');

        return Redirect::route('profile.show')->with(['success' => collect([
            'title' => trans('message.alert.success.account.title'),
            'content' => trans('message.alert.success.account.content'),
        ])]);
    }

    public function passwordChange(ProfileRequest $request) {
        $data = $request->validated();
        $user = User::findorFail(Auth::user()->getAuthIdentifier());
        $user->update(['password' => Hash::make($data['new_password'])]);

        activity('password-update')->causedBy($user)->performedOn($user)
            ->log('User: '.$user->getFullName().' updated the account password.');

        return redirect()->route('profile.show')->with(['success' => collect([
            'title' => trans('message.alert.success.password.title'),
            'content' => trans('message.alert.success.password.content'),
        ])]);
    }
}
