<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\CustomPassword;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show() {

        return view('profile')->with(['title' => 'Profile', 'user' => Auth::user()]);
    }

    public function update(Request $request) {
        $data = $request->only(['email', 'firstname', 'lastname', 'pref_lang']);
        $rules = [
            'email' => ['required','email','unique:App\Models\User,email,'.Auth::user()->getAuthIdentifier().',id'],
            'firstname' => ['required','string','min:3','max:20'],
            'lastname' => ['required','string','min:3','max:20'],
            'pref_lang' => ['required', 'string', Rule::in(array_keys(Config::get('languages')))]
        ];
        $validateResult = sanitize($data, $rules);
        if ($validateResult !== true) {
            return back()->withErrors(json_decode($validateResult))->with(['failure' => collect([
                'title' => trans('message.alert.failure.account.title'),
                'content' => trans('message.alert.failure.account.content'),
            ])]);
        }
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

    public function passwordChange(Request $request) {
        $user = User::findorFail(Auth::user()->getAuthIdentifier());
        $data = $request->only(['password', 'new_password', 'new_password_confirmation']);

        $rules = [
            'password' => ['required','current_password'],
            'new_password' => ['required','confirmed', 'max:16',
                CustomPassword::min(6)->mixedCase()->symbols()->numbers()->letters()->uncompromised(3)],
            'new_password_confirmation' => ['required','same:new_password'],
        ];
        $validateResult = sanitize($data, $rules);
        if ($validateResult !== true) {
            return back()->withErrors(json_decode($validateResult))->with(['failure' => collect([
                'title' => trans('message.alert.failure.password.title'),
                'content' => trans('message.alert.failure.password.content'),
            ])]);
        }
        $user->update(['password' => Hash::make($data['new_password'])]);

        activity('password-update')->causedBy($user)->performedOn($user)
            ->log('User: '.$user->getFullName().' updated the account password.');

        return redirect()->route('profile.show')->with(['success' => collect([
            'title' => trans('message.alert.success.password.title'),
            'content' => trans('message.alert.success.password.content'),
        ])]);
    }
}
