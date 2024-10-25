<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\models\User;

class AuthController extends Controller
{
  public function login()
  {
    return view('Auth.index', [
      "title" => "Login Page",
      "active" => "loginPage",
    ]);
      
  }
  
  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);
    
    if(Auth::attempt($credentials)){
      $request->session()->regenerate();
      return redirect()->intended('/dashboard');
      
    }
    
    return back()->with('loginError', 'Login Failed !!!');
    
  }
  
  public function register()
  {
    return view('Auth.register', [
      "title" => "Login Page",
      "active" => "loginPage",
    ]);
      
  }
  
  public function addUser(Request $request)
  {
    $validatedData = $request->validate([
      'name'     => 'required|max:125|min:5',
      
      'username' => 'required|max:125|min:5|unique:users',
      
      'email'    => 'required|email|unique:users',
      
      'password' => 'required|max:125|min:5',
    ]);
    
    $validatedData['password'] = Hash::make($validatedData['password']);
    
    User::create($validatedData);
    
    $request->session()->flash('success', 'Registrasi Berhasil Silahkan Login');
    
    return redirect('/login');
    
  }
  
  public function logout(Request $request)
  {
    Auth::logout();
    
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    $request->session()->flash('successLogout', 'You Has Been Logout');
    
    return redirect('/login');
    
  }
  
}
