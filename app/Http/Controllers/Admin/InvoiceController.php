<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:invoice.show')->only(['show', 'index']);
        $this->middleware('can:invoice.create')->only(['create', 'store']);
        $this->middleware('can:invoice.edit')->only(['edit', 'update']);

    }
    public function index()
    {
        $invoices = Invoice::query();
        $this->filterData($invoices);
        $invoices = $invoices->paginate();
        return view('admin.invoices.index', compact("invoices"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::paginate(100);
        return view('admin.invoices.create',compact("clients"));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(InvoiceRequest $request): RedirectResponse
    {
        do {
            // $v =  Str::random(40);
            $v = (string) random_int(1000000000,9999999999);
            $exists = Invoice::where("number",$v)->exists();
        } while ($exists);
        
        $invoice = Invoice::create([
            "number"            => $v ,
            "date"              => $request->date ,
            "due_date"          => $request->due_date ,
            "items"             => $request->items ,
            "total_amount"      => $request->total_amount ,
            "client_id"         => $request->client_id ,
        ]);
        return redirect(route("dashboard.invoices.create"))->with("success", __("done success"));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.invoices.show',compact("invoice"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.invoices.create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceRequest $request, $id): RedirectResponse
    {

        $invoice = Invoice::findOrFail($id);
        $invoice->update([
            "number"            => "--" ,
            "date"              => $request->date ,
            "due_date"          => $request->due_date ,
            "items"             => $request->items ,
            "total_amount"      => $request->total_amount ,
            "client_id"         => $request->client_id ,
        ]);
            
        return redirect(route("dashboard.invoices.index"))->with("success", __("done success"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
    
    public function invoices()
    {
        $invoices = Invoice::where("email", 'like', '%' . request("search") . '%')
            ->orWhere("first_name", 'like', '%' . request("search") . '%')
            ->orWhere("last_name", 'like', '%' . request("search") . '%')
            ->orWhere("mobile", 'like', '%' . request("search") . '%')->paginate(30);
        return sendJson($invoices);
    }
    public function get_remove()
    {
        return view("admin.front.remove-account");
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
