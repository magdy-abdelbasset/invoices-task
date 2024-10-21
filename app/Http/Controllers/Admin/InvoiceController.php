<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Company;
use App\Models\CompanySpecialization;
use App\Models\FinancialStatements;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserSetting;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query();
        $this->filterData($users);
        $users = $users->paginate();
        return view('admin.customers.index', compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = CompanySpecialization::where("active",1)->paginate(100);
        return view('admin.customers.create',compact("specializations"));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CustomerRequest $request): RedirectResponse
    {
        //
        DB::beginTransaction();
        try {
            $user = User::create([
                "email"                             => $request->email,
                "mobile"                            => $request->mobile,
                "password"                          => Hash::make($request->password),
                "forget_code"                       => $request->forget_code,
                "active"                            => $request->active ? 1 : 0,
                "email_verified_at"                 => $request->email_confirmed ? Carbon::now() : null,
                "mobile_verified_at"                => $request->mobile_confirmed ? Carbon::now() : null,
                "company_informations_verfied_at"   => $request->company_informations_verfied ? Carbon::now() : null,
                "financial_statements_verfied_at"   => $request->financial_statements_verfied ? Carbon::now() : null,
                "bank_account_verfied_at"           => $request->bank_account_verfied ? Carbon::now() : null,
                "account_verfied_at"                => $request->account_verfied ? Carbon::now() : null,
            ]);
            UserSetting::create(["user_id" => $user->id]);
            Wallet::create(["user_id" => $user->id]);
            $company = Company::create([
                "user_id"                       => $user->id,
                "commercial_register"           => $request->company["commercial_register"],
                "name"                          => $request->company["name"],
                "company_specialization_id"     => $request->company["company_specialization_id"],
                "capital"                       => $request->company["capital"],
                "tax_number"                    => $request->company["tax_number"],
                "email"                         => $request->company["email"],
                "address"                       => $request->company["address"],
                "count_employees"               => $request->company["count_employees"],
                "company_mobile"                => $request->company["company_mobile"],
                "representative_name"           => $request->company["representative_name"],
                "representative_mobile"         => $request->company["representative_mobile"],
                "representative_email"          => $request->company["representative_email"],
                "credit_inquiry"                => $request->company["credit_inquiry"] ?? 0,
            ]);
            $financial_statement = FinancialStatements::create([
                "user_id"           => $user->id,
                "company_id"        => $company->id,
                "budget_from"       => $request->financial_statement["budget_from"],
                "budget_to"         => $request->financial_statement["budget_to"],
            ]);
            $bankAccount = BankAccount::create([
                "user_id"               => $user->id,
                "company_id"            => $company->id,
                "is_main"               => 1,
                "number_of_account"     => $request->bank_branch,
                "bank_name"             => $request->bank_name,
                "bank_branch"           => $request->number_of_account,
            ]);
            setFile("customers_profiles/", $request->image, $user);
            setFileMulti(
                "financial_satement/",
                $request->financial_statement_files,
                $financial_statement,
                FinancialStatements::FILE_TYPES[0]
            );

            setFileMulti(
                "cash_flows/",
                $request->cash_flows_files,
                $financial_statement,
                FinancialStatements::FILE_TYPES[1]
            );

            setFileMulti(
                "profit_loss/",
                $request->profit_loss_files,
                $financial_statement,
                FinancialStatements::FILE_TYPES[2]
            );
            setFileMulti(
                Company::FILE_TYPES[0] . "/",
                $request['tax_record_files'],
                $company,
                Company::FILE_TYPES[0]
            );


            setFileMulti(
                Company::FILE_TYPES[1] . "/",
                $request['commercial_license_files'],
                $company,
                Company::FILE_TYPES[1]
            );

            setFileMulti(
                Company::FILE_TYPES[2] . "/",
                $request['additional_documents_files'],
                $company,
                Company::FILE_TYPES[2]
            );
            setFileMulti(
                "statement_account/",
                $request->statement_account_files,
                $bankAccount,
                BankAccount::FILE_TYPES[0]
            );
            DB::commit();

        } catch (\Exception $e) {
            Log::info($e);
            DB::rollBack();
            return back()->with("error", __("Server Error"))->withInput();
        }
        return redirect(route("dashboard.customers.create"))->with("success", __("messages.done success"));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin.customers.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.customers.create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
        //
        DB::beginTransaction();
        try {
            DB::commit();
            $user = User::findOrFail($id);
            $user->update([
                "email"                             => $request->email,
                "mobile"                            => $request->mobile,
                "password"                          => Hash::make($request->password),
                "forget_code"                       => $request->forget_code,
                "active"                            => $request->active ? 1 : 0,
                "email_confirmed_at"                => $request->email_confirmed ? Carbon::now() : null,
                "mobile_confirmed_at"               => $request->mobile_confirmed ? Carbon::now() : null,
                "company_informations_verfied_at"   => $request->company_informations_verfied ? Carbon::now() : null,
                "financial_statements_verfied_at"   => $request->financial_statements_verfied ? Carbon::now() : null,
                "bank_account_verfied_at"           => $request->bank_account_verfied ? Carbon::now() : null,
                "account_verfied_at"                => $request->account_verfied ? Carbon::now() : null,
            ]);
            $company = Company::updateOrCreate([
                    "user_id"                       => $user->id,
            ],[
                "commercial_register"           => $request->company["commercial_register"],
                "name"                          => $request->company["name"],
                "company_specialization_id"     => $request->company["company_specialization_id"],
                "capital"                       => $request->company["capital"],
                "tax_number"                    => $request->company["tax_number"],
                "email"                         => $request->company["email"],
                "address"                       => $request->company["address"],
                "count_employees"               => $request->company["count_employees"],
                "company_mobile"                => $request->company["company_mobile"],
                "representative_name"           => $request->company["representative_name"],
                "representative_mobile"         => $request->company["representative_mobile"],
                "representative_email"          => $request->company["representative_email"],
                "credit_inquiry"                => $request->company["credit_inquiry"],
            ]);
            $financial_statement = FinancialStatements::updateOrCreate([
                [
                    "user_id"           => $user->id,
                    "company_id"        => $company->id
                ],[
                    "budget_from"       => $request->budget_from,
                    "budget_to"         => $request->budget_to,
                ]
            ]);
            $bankAccount = BankAccount::create(
                [
                    "user_id"           => $user->id,
                    "company_id"        => $company->id
                ],[
                "is_main"               => 1,
                "number_of_account"     => $request->bank_branch,
                "bank_name"             => $request->bank_name,
                "bank_branch"           => $request->number_of_account,
            ]);
            setFile("customers_profiles/", $request->image, $user);
            setFileMulti(
                "financial_satement/",
                $request->financial_statement_files,
                $financial_statement,
                FinancialStatements::FILE_TYPES[0]
            );

            setFileMulti(
                "cash_flows/",
                $request->cash_flows_files,
                $financial_statement,
                FinancialStatements::FILE_TYPES[1]
            );

            setFileMulti(
                "profit_loss/",
                $request->profit_loss_files,
                $financial_statement,
                FinancialStatements::FILE_TYPES[2]
            );
            setFileMulti(
                Company::FILE_TYPES[0] . "/",
                $request['tax_record_files'],
                $company,
                Company::FILE_TYPES[0]
            );


            setFileMulti(
                Company::FILE_TYPES[1] . "/",
                $request['commercial_license_files'],
                $company,
                Company::FILE_TYPES[1]
            );

            setFileMulti(
                Company::FILE_TYPES[2] . "/",
                $request['additional_documents_files'],
                $company,
                Company::FILE_TYPES[2]
            );
            setFileMulti(
                "statement_account/",
                $request->statement_account_files,
                $bankAccount,
                BankAccount::FILE_TYPES[0]
            );
        } catch (\Exception $e) {
            Log::info($e);
            DB::rollBack();
            return back()->with("error", __("Server Error"))->withInput();
        }
        return redirect(route("dashboard.customers.index"))->with("success", __("messages.done success"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
    public function active($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            "active"    => 1
        ]);
        return back()->with("success", __("messages.done success"));
    }
    public function unactive($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            "active"    => 0
        ]);
        return back()->with("success", __("messages.done success"));
    }
    public function users()
    {
        $users = User::where("email", 'like', '%' . request("search") . '%')
            ->orWhere("first_name", 'like', '%' . request("search") . '%')
            ->orWhere("last_name", 'like', '%' . request("search") . '%')
            ->orWhere("mobile", 'like', '%' . request("search") . '%')->paginate(30);
        return sendJson($users);
    }
    public function get_remove()
    {
        return view("admin.front.remove-account");
    }
    public function remove_account(Request $request)
    {
        $data = $request->only(["email", "password"]);
        if (auth("api-user")->attempt($data)) {
            $user = User::where(["email" => $request->email])->first();
            $user->delete();
            return back()->with("success", __("messages.done success"));
        }
        return back()->withInput($request->input())
            ->withErrors(["error" => __("admin::messages.Password OR Email Wrong")]);
    }
    private function filterData(&$data)
    {
        if (request("keyword")) {
            $data->where(function ($q) {
                $q->where("email", 'like', '%' . request("keyword") . '%')
                    ->orWhere("first_name", 'like', '%' . request("keyword") . '%')
                    ->orWhere("last_name", 'like', '%' . request("keyword") . '%')
                    ->orWhere("uid", 'like', '%' . request("keyword") . '%')
                    ->orWhere("mobile", 'like', '%' . request("keyword") . '%');
            });
        }
        if (request("active")) {
            $data->where("active", (bool)request("active"));
        }
        if (request("country_code")) {
            $data->where("country_code", request("country_code"));
        }
    }
}
