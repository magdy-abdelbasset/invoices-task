<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:customer.show')->only(['show', 'index']);
        $this->middleware('can:customer.create')->only(['create', 'store']);
        $this->middleware('can:customer.edit')->only(['edit', 'update']);
        $this->middleware('can:customer.delete')->only(['destroy']);

    }
    public function index()
    {
        $clients = Client::query();
        $this->filterData($clients);
        $clients = $clients->paginate();
        return view('admin.customers.index', compact("clients"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CustomerRequest $request): RedirectResponse
    {

        $client = Client::create([
            "email"                             => $request->email,
            "name"                            => $request->name,
            "address"                          => $request->address,
            "phone"                       => $request->phone,
        ]);
        return redirect(route("dashboard.customers.create"))->with("success", __("done success"));
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
        $client = Client::findOrFail($id);
        return view('admin.customers.create',compact("client"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, $id): RedirectResponse
    {
        $client = Client::findOrFail($id);
        $client->update([
            "email"                             => $request->email,
            "name"                            => $request->name,
            "address"                          => $request->address,
            "phone"                       => $request->phone,
        ]);
        return redirect(route("dashboard.customers.index"))->with("success", __("done success"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect(route("dashboard.customers.index"))->with("success", __("done success"));
    }
   
    private function filterData(&$data)
    {
        if (request("keyword")) {
            $data->where(function ($q) {
                $q->where("email", 'like', '%' . request("keyword") . '%')
                    ->orWhere("name", 'like', '%' . request("keyword") . '%')
                    ->orWhere("phone", 'like', '%' . request("keyword") . '%')
                    ->orWhere("address", 'like', '%' . request("keyword") . '%');
            });
        }
    }
}
