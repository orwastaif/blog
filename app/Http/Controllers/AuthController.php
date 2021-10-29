<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Password_reset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\session;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Mail\ForgerPasswordMail;




class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function registerUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        event(new Registered($user));
        return redirect()->route('login')->with('success', 'You are successfully registered please log in');

    
    }

    public function loginUser(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
        $user = User::where('email', $request->input('email'));
        $auth_check = Auth::attempt($validation->validated());

        if($validation->fails()){
            return redirect()->route('login')->with('fail', $validation->errors()->toJson());
        }
        if($user){
                if($auth_check){
                    $request->session()->regenerate();
                    return redirect()->route('profile')->with('success', 'logged in successfully');
                }
            return redirect()->route('login')->with('fail', 'Incorrect password or username!');
        }
        return redirect()->route('login')->with('fail', 'User is not rigestered');
    }

    public function profile()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('profile', compact('data'));
    }
    public function profile1()
    {
        $data = User::latest()->get();
        return view('index', compact('data'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'=> 'required|email'
        ]);
        $user=User::where('email', $request->email)->first();

        if(!$user){
            return redirect()->back()->with('fail', 'user not found.');

        }else{
            $reset_code=str::random(200);
            Password_reset::create([
                'user_id'=>$user->id,
                'reset_code'=>$reset_code,
                'email'=>$request->email,
            ]);
            Mail::to($user->email)->send(new ForgerPasswordMail($user->name,$reset_code));

            return redirect()->back()->with('success', 'We have sent the reset link to your email plz check!');




        }
    }

    public function getResetPassword($reset_code)
    {
        $password_reset_data=Password_reset::where('reset_code',$reset_code)->first();
        if(!$password_reset_data || Carbon::now()->subMinutes(10)>$password_reset_data->created_at){
            return redirect()->route('getresetpassword')->with('fail', 'Link expired');
        }else{
            
            return view('auth.reset_password',compact('reset_code'));
        }
    }

    public function postResetPassword($reset_code, Request $request)
    {
        $password_reset_data=Password_reset::where('reset_code',$reset_code)->first();
        if(!$password_reset_data || Carbon::now()->subMinutes(10)>$password_reset_data->created_at){
            return redirect()->route('getresetpassword')->with('fail', 'Link expired');
        }else{
            $request->validate([
                'email'=>'required|email',
                'password'=>'required|min:6|max:100',
                'password_confirmation'=>'required|same:password',
            ]);

            $user=User::find($password_reset_data->user_id);

            if($user->email!=$request->email){
                return redirect()->back()->with('fail', 'Enter correct email');
            }else{
                $password_reset_data->delete();
                $user->update([
                    'password'=>bcrypt($request->password)
                ]);
            }
            return redirect()->route('login')->with('success', 'password has changed successfully');
        }
    }
}
