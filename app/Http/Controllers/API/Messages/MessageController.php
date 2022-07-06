<?php

namespace App\Http\Controllers\API\Messages;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;
use Twilio\Rest\Client;

use function PHPUnit\Framework\isType;

class MessageController extends Controller
{
    public function messages()
    {
        return Message::with('user')->get();
    }
    
    public function messageStore(Request $request)
    {
        $user = Auth::user();
    
        $msg = message::create([
            'user_id' => $user->id,
            'message' => $request->message
        ]);
        $message = message::with('user')->find($msg->id);

        return $message;
    }


    public function sendCodeToUser(Request $request)
    {
        $phoneNumber =  $this->checkNumber($request->mobileNumber);   
        
        if(is_int($phoneNumber))
        {
        $user_id = Auth::user()->id;  
        $cont = '+';
        $userPhoneNumber =  $cont.$userNumber = (string)$phoneNumber;
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code =  $this->generateCode($permitted_chars, 6);
        $message = "your verification ".$code. " code";
     
        try {
            $account_sid = "AC5553568dcada9393cb00d72155c26246";
            $auth_token = "53e903441ace7194b3e72027863a5e9b";
            $twilio_number = "+19282565802";
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($userPhoneNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
                
            return response()->json([
                'success' => true,
                'message' => 'Code send on phone.',
                
            ]);

        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'please Enter Valid Mobile Number',
                
            ]);
        }
       
    }

    public  function generateCode($input, $strength = 16)
    {
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
    public function checkNumber($number)
    {
       
        $plusNumber =  substr($number, 0,3);
        $plusNumber2 =  substr($number, 0,2);
        $plusNumberReman =  substr($number,3,12);
        
       if($plusNumber == +92 || $plusNumber2 == 92)
        {
            if(preg_match('/^[0-9]{10}+$/', $plusNumberReman)) {
                $validateNumber =  $plusNumber.$plusNumberReman;
                return  (int)$validateNumber;                  
            }else{
                return;
            }
        }   
       elseif($plusNumber2 == 03)
        {
            return;
        }
    
    }
}
