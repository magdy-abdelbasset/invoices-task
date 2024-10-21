<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules=  [
            "name"                        => "required|string|max:255|string|unique:roles,name,".request()->route("role"),
            "permissions"                 => "nullable|array" , 
            "permissions.*"               => "required|exists:permissions,name" 
        ];
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
