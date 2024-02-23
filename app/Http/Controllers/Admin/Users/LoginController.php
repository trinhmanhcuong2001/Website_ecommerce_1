<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class LoginController extends Controller
{
    public function index(){
       return view('admin/users/login',[
        'title' => 'Đăng nhập',
       ]); 
    }
    public function store(Request $request){

        $this->validate($request, [
           'email' => 'required|email:filter',
           'password' => 'required',
        ]);

        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ],$request->input('remember'))){
            return redirect('/admin/main');
        }
        session()->flash('error', 'Tài khoản hoặc mật khẩu không chính xác');
        return redirect()->back();
    }
}
