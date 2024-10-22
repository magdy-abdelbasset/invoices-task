<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\AdminFcm;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $redirect_route = "dashboard.home";
    public function login()
    {
        if (auth()->user()) {
            return redirect(route($this->redirect_route));
        }
        return view('admin.auth.login');
    }
    public function loginPost(Request $request)
    {
        $data = $request->only(["email", "password"]);
        if (auth()->attempt($data)) {
            $user = Auth::getProvider()->retrieveByCredentials($data);
            Auth::login($user);
            return redirect(route($this->redirect_route));
        }
        return back()->withInput($request->input())
            ->withErrors(["error" => __("admin::messages.Password OR Email Wrong")]);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route("dashboard.login"));
    }

}
