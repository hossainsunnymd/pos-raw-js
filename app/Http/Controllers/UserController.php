<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OtpMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\select;

class UserController extends Controller
{
    public function login()
    {
        return view('pages.auth.login-page');
    }

    public function registration()
    {
        return view('pages.auth.registration-page');
    }

    public function sendOtpPage()
    {
        return view('pages.auth.send-otp-page');
    }

    public function resetPass()
    {
        return view('pages.auth.reset-page');
    }

    public function verifyOtpPage()
    {
        return view('pages.auth.verify-otp-page');
    }

    public function homePage()
    {
        return view('pages.dashboard.home-page');
    }

    public function dashboard()
    {
        return view('pages.dashboard.dashboard-page');
    }

    public function profilePage(Request $request)
    {
        $email=$request->header('email');
        $user=User::where('email','=',$email)->first();
        return view('pages.dashboard.profile-page',['data'=>$user]);
    }


    public function userRegistration(Request $request)
    {
        try {
            User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => $request->password
            ]);
            return response()->json([
                'status' => "success",
                'message' => "User Registered Successfully"
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'status' => "failed",
                'message' => "User registration failed"
            ]);
        }
    }

    public function userLogin(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))->select('id')->first();

        if ($count != null) {
            $token = JWTToken::createToken($request->input('email'), $count->id);
            return response()->json([
                'status' => "success",
                'message' => "User Logged In Successfully",
            ], 200)->cookie('token',$token,60*60);
        } else {
            return response()->json([
                'status' => "failed",
                'message' => "unauthorized"
            ]);
        }
    }


    public function sendOtp(Request $request)
    {
        try {
            $count = User::where('email', '=', $request->input('email'))->count();
            if ($count == 1) {
                $rand = rand(100000, 999999);
                User::where('email', '=', $request->input('email'))->update(['otp' => $rand]);
                $otpMail = new OtpMail($rand);
                Mail::to($request->input('email'))->send($otpMail);
                return response()->json([
                    'status' => "success",
                    'message' => "Otp Sent Successfully"
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => "failed",
                'message' => "unauthorized"
            ], 401);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $count = User::where('email', '=', $request->input('email'))
                ->where('otp', '=', $request->input('otp'))->count();
            if ($count == 1) {
                User::where('email', '=', $request->input('email'))->update(['otp' => '0']);
                $token = JWTToken::createOtpToken($request->input('email'));
                return response()->json([
                    'status' => "success",
                    'message' => "Otp Verified Successfully",
                ],200)->cookie('token',$token,60*5);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => "failed",
                'message' => "unauthorized"
            ]);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);
            return response()->json([
                'status' => "success",
                'message' => "Password Reset Successfully"
            ],200);
        } catch (Exception $e) {
            return response()->json([
                'status' => "failed",
                'message' => "unauthorized"
            ]);
        }
    }
    public function userLogout(){
        return redirect('/')->cookie('token','',-1);
    }

    public function updateUser(Request $request){
       try{
        $email=$request->header('email');
        User::where('email','=',$email)->update(
            [
            'firstName'=>$request->input('firstName'),
            'lastName'=>$request->input('lastName'),
            'mobile'=>$request->input('mobile'),
            'password'=>$request->input('password')
        ]);
        return response()->json([
            'status' => "success",
            'message' => "User Data Updated Successfully"
        ],200);
       }catch(Exception $e){
        return response()->json([
            'status' => "failed",
            'message' => "User Data Updation Failed"
        ]);
       }
    }
}
