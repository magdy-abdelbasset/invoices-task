<?php

namespace App\Http\Requests\Admin;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class InvoiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules=  [
            "date"              => "required|date" ,
            "due_date"          => "required|date" ,
            "items"             => "required|array" ,
            "total_amount"      => "required|numeric" ,
            "client_id"         => "required|exists:clients,id",
            
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
