<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Role\SettingRequest;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:role.create')->only(['create', 'store']);
        $this->middleware('can:role.edit')->only(['edit', 'update']);
        $this->middleware('can:role.delete')->only(['destroy']);

    }
    public function index()
    {
        $roles = Role::paginate(15);
        return view('admin.roles.index', compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::take(80)->pluck("name");
        return view('admin.roles.create',compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try{
            $data = $request->only("name");
            $data["guard_name"]   = "web";
            $role = Role::create($data);
            $role->syncPermissions($request->permissions);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error",__("Server Error"))->withInput();
        }
        return redirect(route("dashboard.roles.create"))->with("success",__("done success"));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin.roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.create',compact("role"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, $id): RedirectResponse
    {
       
        DB::beginTransaction();
        try{
            $data = $request->only("name");
            $data["guard_name"]   = "web";
            $role = Role::findOrFail($id);
            $role->update($data);
            $role->syncPermissions($request->permissions);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error",__("Server Error"))->withInput();
        }
        return redirect(route("dashboard.roles.index"))->with("success",__("done success"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect(route("dashboard.roles.index"))->with("success",__("done success"));
    }


}
