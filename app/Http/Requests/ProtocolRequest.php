<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = array();
        $type = $this->request->get('type');
        if ($type == 'ingoing'){
            $rules = [
                'ingoing_protocol' => 'required|string|max:20',
                'ingoing_protocol_date' => 'required|date',
            ];
        }elseif ($type == 'outgoing'){
            $rules = [];
        }

        $details = [
            'protocol_date' => 'required|date',
            'type' => Rule::in(['ingoing','outgoing']),
            'creator' => 'required|string|max:80',
            'receiver' => 'required|string|max:80',
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:500'
        ];

        $files = [

        ];

        $rules = array_merge( $rules, $details);

        return $rules;
    }

    public function messages()
    {
        return [
            'type.in' => 'The hidden input :attribute must be one of the following types: :values',
        ];
    }
}
