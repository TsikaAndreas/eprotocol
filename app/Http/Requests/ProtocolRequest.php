<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class ProtocolRequest extends FormRequest
{
    protected const STORE_URI = 'protocol/store';
    protected const UPDATE_URI = 'protocol/{protocol}';
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
        return [
            'type' => Rule::in(['incoming','outgoing']),
            'incoming_protocol' => ['required_if:type,===,incoming','string','max:20'],
            'incoming_protocol_date' => ['required_if:type,===,incoming','date'],
            'protocol_date' => ['required_if:'.Request::route()->uri().',===,'.self::STORE_URI,'date'],
            'creator' => ['required','string','max:80'],
            'receiver' => ['required','string','max:80'],
            'title' => ['required','string','max:100'],
            'description' => ['nullable','string','max:500'],
            'file.*' => ['nullable','file','max:5120']
        ];
    }

    public function messages()
    {
        return [
            'type.in' => 'The hidden input :attribute must be one of the following types: :values',
        ];
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
            case self::STORE_URI:
                $message = ['failure' => collect([
                    'title' => trans('message.alert.failure.protocol_create.title'),
                    'content' => trans('message.alert.failure.protocol_create.content'),
                ])];
                break;
            case self::UPDATE_URI:
                $message = ['failure' => collect([
                    'title' => trans('message.alert.failure.protocol_update.title'),
                    'content' => trans('message.alert.failure.protocol_update.content'),
                ])];
                break;
        }
        if ($validator->errors()->has('type'))
        {
            $message = array_merge($message, ['type-error' => collect([
                'title' => trans('message.alert.failure.protocol_type_error.title'),
                'content' => trans('message.alert.failure.protocol_type_error.content'),
            ])]);
        }
        if ($validator->errors()->has('file.*'))
        {
            $message = array_merge($message, ['file-error' => collect([
                'title' => trans('message.alert.store_file_error'),
                'content' => collect($validator->errors()->get('file.*'))->map(function ($item) {
                    return $item[key($item)];
                }),
            ])]);
        }

        throw new HttpResponseException(back()->withErrors($validator->errors())
            ->with($message));
    }
}
