<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProtocolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'incoming_protocol_no' => 'required|string',
            'incoming_protocol_date' => 'required|date_format:"d/m/Y"',
            'sender' => 'required|string',
            'receiver' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'nullable|string'
        ];
    }
}
