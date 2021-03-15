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
        $rules = array();
        $type = $this->request->get('type');
        if ($type == 'incoming'){
            $rules = [
                'incoming_protocol' => 'required|string',
                'incoming_protocol_date' => 'required|date_format:"d/m/Y"',
            ];
        }elseif ($type == 'outgoing'){
            $rules = [
                'outgoing_protocol_date' => 'required|date_format:"d/m/Y"',
            ];
        }

        $details = [
            'sender' => 'required|string',
            'receiver' => 'required|string',
            'title' => 'required|string',
            'description' => 'nullable|string'
        ];

        $rules = array_merge( $rules, $details);

        return $rules;
    }
}
