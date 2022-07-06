<?php

namespace App\Http\Controllers\API\Setting;

use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Models\User;
use App\Models\method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class AccountSettingController extends Controller
{
    public function update_setting(Request $request)
    {
        $user = Auth::user();
        $v = Validator::make($request->all(),[
            'username' => 'required|alpha_dash|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|unique:users,phone,'.$user->id,
        ]);
        if($v->fails())
        {
            if ($v->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $v->errors(),
                ]);
            }
        }

        $is_phone_verified = ($user->phone === $request->phone) ? 1 : 0;
        $is_email_verified = ($user->email === $request->email) ? 1 : 0;

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_phone_verified' => $is_phone_verified,
            'is_email_verified' => $is_email_verified,
        ];

        $user->update($data);

        if($is_phone_verified == 0)
        {
            $receiverNumber = $user->phone;
            $code = rand(100000,999999);
            $message = "Your Zilla's Top Swap Verification Code is ".$code;

            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_TOKEN");
            $twilio_number = env("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
                $client->messages->create($receiverNumber, [
                    'from' => $twilio_number, 
                    'body' => $message]);
            
            $user->update([
                'phone_code' => $code
            ]);
        }

        if($is_email_verified == 0)
        {
            $code = rand(100000,999999);

            $user->update([
                'email_code' => $code
            ]);
            
            Mail::to($user->email)->send(new VerificationMail($user, $code));

        }

        $user = User::find($user->id)->only(['username','email','phone','is_email_verified','is_phone_verified',]);
        
        return response()->json([
            'success' => true,
            'message' => 'Account Setting Updated Successfully.',
            'user' => $user
        ]);
    }
    public function create_trade_settings(Request $request){
        $input = $request->all();
        $user= Auth::user();
        if($request->has('apple_pay')){
            $meth = method::where('name','apple_pay')->first();
            if($user->user_methods){
                $user->user_methods()->detach($meth->id);    
            }
            $user->user_methods()->attach($meth->id,['cash_tag' => $request->apple_pay]);
        }
        if($request->has('chime')){
            $meth = method::where('name','chime')->first();
            if($user->user_methods){
                $user->user_methods()->detach($meth->id);    
            }
            $user->user_methods()->attach($meth->id,['cash_tag' => $request->chime]);
        }
        if($request->has('venmo')){
            $meth = method::where('name','venmo')->first();
            if($user->user_methods){
                $user->user_methods()->detach($meth->id);    
            }
            $user->user_methods()->attach($meth->id,['cash_tag' => $request->venmo]);
            
        }
        if($request->has('square_cash')){
            $meth = method::where('name','square_cash')->first();
            if($user->user_methods){
                $user->user_methods()->detach($meth->id);    
            }
            
                $user->user_methods()->attach($meth->id,['cash_tag' => $request->square_cash]);
        }
        if($request->has('paypal')){
            $meth = method::where('name','paypal')->first();
            if($user->user_methods){
                $user->user_methods()->detach($meth->id);    
            }
            $user->user_methods()->attach($meth->id,['cash_tag' => $request->paypal]);
            
        }
        if($request->has('zelle')){
            $meth = method::where('name','zelle')->first();
            if($user->user_methods){
                $user->user_methods()->detach($meth->id);    
            }
            $user->user_methods()->attach($meth->id,['cash_tag' => $request->zelle]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Payment Methods Add Successfully',
        ]);
    }
}