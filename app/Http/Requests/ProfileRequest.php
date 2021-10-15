<?php

namespace App\Http\Requests;

use App\Rules\CustomPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProfileRequest extends FormRequest
{
    protected const PROFILE_URI = 'profile/update';
    protected const PASSWORD_URI = 'password-change';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        switch (Request::route()->uri())
        {
            case self::PROFILE_URI:
                $rules = [
                    'email' => ['required','email','unique:App\Models\User,email,'.Auth::user()->getAuthIdentifier().',id'],
                    'firstname' => ['required','string','min:3','max:20'],
                    'lastname' => ['required','string','min:3','max:20'],
                    'pref_lang' => ['required', 'string', Rule::in(array_keys(Config::get('languages')))]
                ];
                break;
            case self::PASSWORD_URI:
                $rules = [
                    'password' => ['required','current_password'],
                    'new_password' => ['required','confirmed', 'max:16',
                        CustomPassword::min(6)->mixedCase()->symbols()->numbers()->letters()->uncompromised(3)],
                    'new_password_confirmation' => ['required','same:new_password'],
                ];
                break;
        }
        return $rules;
    }
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public function failedValidation(Validator $validator)
    {
        $message = [];
        switch (Request::route()->uri())
        {
            case self::PROFILE_URI:
                $message = ['failure' => collect([
                    'title' => trans('message.alert.failure.account.title'),
                    'content' => trans('message.alert.failure.account.content'),
                ])];
                break;
            case self::PASSWORD_URI:
                $message = ['failure' => collect([
                    'title' => trans('message.alert.failure.password.title'),
                    'content' => trans('message.alert.failure.password.content'),
                ])];
                break;
        }

        throw new HttpResponseException(back()->withErrors($validator->errors())
            ->with($message));
    }
}
