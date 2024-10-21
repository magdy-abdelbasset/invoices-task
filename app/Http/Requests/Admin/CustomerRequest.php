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
        $company_id = null;
        if($user_id){
            $company_id = Company::where("user_id",$user_id)->first()?->id;
        }
        $rules=  [
            "email"                             => "required|email|string|unique:users,email,".$user_id,
            "mobile"                            => "required|min:6|max:20|string|phone|unique:users,mobile,".$user_id,
            "password"                          => "required|min:6|string|confirmed",
            "forget_code"                       => "nullable|min:6|string",
            "image"                             => "required|max:90000|mimetypes:image/*",
            "active"                            => "nullable|boolean",
            "email_confirmed"                   => "nullable|boolean",
            "mobile_confirmed"                  => "nullable|boolean",
            "company"                           => "required|array",
            "company.commercial_register"       => "required|string|min:6|max:50|unique:companies,commercial_register,".$company_id,
            "company.name"                      => "required|string|min:3|max:50",
            "company.company_specialization_id" => "required|numeric|exists:company_specializations,id",
            "company.capital"                   => "required|string|min:3|max:50",
            "company.tax_number"                => "required|string|min:6|max:50|unique:companies,tax_number,".$company_id,
            "company.email"                     => "required|email|min:5|max:100|unique:companies,email,".$company_id ,
            "company.address"                   =>  "nullable|string|min:5|max:255" ,
            "company.count_employees"           =>  "nullable|numeric|min:1|max:9999999999" ,
            "company.company_mobile"            =>  "required|string|min:6|max:50|phone|unique:companies,company_mobile,".$company_id ,
            "company.representative_name"       =>  "required|string|min:3|max:50" ,
            "company.representative_mobile"     =>  "required|string|min:6|max:50|phone" ,
            "company.representative_email"      =>  "required|email|min:5|max:100" ,
            "company.credit_inquiry"            => "nullable|boolean",
            "financial_statement.budget_from"   => "required|min:1000|max:999999999999|numeric",
            "financial_statement.budget_to"     => "required|min:1000|max:999999999999|numeric|gt:financial_statement.budget_from",
            "company_informations_verfied"      => "nullable|boolean" ,
            "financial_statement_files"         => "required|max:5|min:1|list" ,
            "financial_statement_files.*"       => "required|max:90000|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*" ,
            "cash_flows_files"                  => "required|max:5|min:1|list" ,
            "cash_flows_files.*"                => "required|max:90000|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*" ,
            "profit_loss_files"                 => "required|max:5|min:1|list" ,
            "profit_loss_files.*"               => "required|max:90000|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*" ,
            "financial_statements_verfied"      => "nullable|boolean" ,
            "commercial_license_files"          => "required|max:5|min:1|list" ,
            "commercial_license_files.*"        => "required|max:90000|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*" ,
            "additional_documents_files"        => "required|max:5|min:1|list" ,
            "additional_documents_files.*"      => "required|max:90000|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*" ,
            "commercial_register_files"         => "required|max:5|min:1|list" ,
            "commercial_register_files.*"       => "required|max:90000|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*" ,
            "company_documents_verfied"         => "nullable|boolean" ,
            "number_of_account"                 => "required|string|min:3|max:50" ,
            "bank_name"                         => "required|string|min:3|max:50" ,
            "bank_branch"                       => "required|string|min:3|max:50" ,
            "statement_account_files"           => "required|max:5|min:1|list",
            "statement_account_files.*"         => "required|max:90000|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/*",
            "bank_account_verfied"              => "nullable|boolean" ,
            "account_verfied"                   => "nullable|boolean" ,
        ];
        if(Request::isMethod("PATCH")){
            // $rules["image"] =  "nullable|mimes:png,jpeg,jpg|max:5121";
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
