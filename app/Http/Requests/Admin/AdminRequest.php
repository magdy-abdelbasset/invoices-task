<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class AdminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules=  [
            "email"                 => "required|string|max:255|email|unique:admins,email,".request()->route("admin"),
            "full_name"             => "required|string|max:255",
            "password"              => "required|max:50|min:6|confirmed",
            "image"                 => "nullable|mimes:png,jpeg,jpg|max:5121",
            "active"                => "nullable|boolean" ,
            "roles"                 => "nullable|array" , 
            "roles.*"               => "required|exists:roles,name" 
        ];
        if(Request::isMethod("PATCH")){
            $rules["image"] =  "nullable|mimes:png,jpeg,jpg|max:5121";
            $rules["password"] =  "nullable|max:50|min:6|confirmed";
        }
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
