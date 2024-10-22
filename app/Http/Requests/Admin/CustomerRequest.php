<?php

namespace App\Http\Requests\Admin;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class CustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $user_id = request()->route("customer");

        $rules=  [
            "email"                             => "required|email|string",
            "name"                            => "required|min:6|max:20|string",
            "address"                          => "required|min:6|string",
            "phone"                       => "required|min:6|string",
            
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
