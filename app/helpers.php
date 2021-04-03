<?php

use Illuminate\Support\Facades\Validator;

if (!function_exists('sanitize')) {
    function sanitize($request, $rules, $messages = [])
    {
        // if(empty($messages))
        $validator = Validator::make($request, $rules, $messages);
        $errors = $validator->errors()->getMessages();
        if (count($errors) > 0) {
            return json_encode($errors);
        }
        return true;
    }
}
