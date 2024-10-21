<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function home()
    {
        $data = [];
        return view("admin.home.home", compact("data"));
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::paginate(15);
        return view('admin.admins.index', compact("admins"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::take(80)->pluck("name");
        return view('admin.admins.create',compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try{
            $data = $request->only("email","full_name","password","active");
            $data["type"]   = "admin";
            $data["password"]   = Hash::make($data["password"]);
            $admin = Admin::create($data);
            $admin->assignRole($request->roles);
            setFile("admin_profile/",$request->image,$admin);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            // dd($e);
            return back()->with("error",__("Server Error"))->withInput();
        }
        return redirect(route("dashboard.admins.create"))->with("success",__("messages.done success"));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin.admins.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Role::take(80)->pluck("name");
        $admin = Admin::findOrFail($id);
        return view('admin.admins.create',compact("admin","roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, $id): RedirectResponse
    {
        DB::beginTransaction();
        try{
            $data = $request->only("email","full_name","password","active");
            $admin = Admin::findOrFail($id);
            $data["password"]   = empty($data["password"]) ? $admin->password : Hash::make($data["password"]);
            $admin->update($data);
            $admin->syncRoles($request->roles);
            setFile("admin_profile/",$request->image,$admin);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with("error",__("Server Error"))->withInput();
        }
        return redirect(route("dashboard.admins.index"))->with("success",__("messages.done success"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return back()->with("success",__("messages.done success"));
    }
    
    public function active($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update([
            "active"    => 1
        ]);
        return back()->with("success",__("messages.done success"));
    }
    public function unactive($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update([
            "active"    => 0
        ]);
        return back()->with("success",__("messages.done success"));

    }
}
