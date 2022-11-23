<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Totp;
use App\Models\Favored;
use Seshac\Otp\Otp;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'phone'    => ['required','numeric','min:9'],
        ]);

        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $request['password'] = '123123123';

        $credentials = $request->only('phone', 'password');



        if (Auth::attempt($credentials)) {

          if (auth()->user()->code == '0000')
          {
            Auth::logout();
            return response()->api([], 1, 'Error otpValidate');
          }

            $user          = auth()->user();
            $data['user']  = new UserResource($user);
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;

            return response()->api($data);

        } else {

            return response()->api([], 1, __('auth.failed'));

        }//end of else

    }//end of login

    public function otpValidate(Request $request){
      $id = $request->id;
      $token = $request->otp;
      $phone = $request->phone;
      $verify = Otp::validate($id, $token);

      if ($verify->status == true) {
        $user = User::whereId($id)->wherePhone($phone)->first();
        $password='123123123';
        $phone= $user->phone;
        if (Auth::attempt(['phone' => $phone, 'password' => $password]) ) {

            $user          = auth()->user();
            $data['user']  = new UserResource($user);
            $user->code  = $token;
            $user->save();
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;


            return response()->api($data);

        } else {

            return response()->api([], 1, __('auth.failed'));

        }//end of else

      } else {
        return response()->api([], 1, "invalid");
      }


    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'region'   => ['required'],
            'phone'    => ['required','unique:users'],
            // 'password' => ['required','min:6'],
        ]);


        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }
        $request_data = $request->except('image');
        $request_data['password'] = bcrypt('123123123');

        if($request->image) {

            $request_data['image'] = $request->file('image')->store('user_images','public');

        }//end of image

        $user = User::create($request_data);
        // create otp
        $password = Otp::generate($user->id)->token;
        // send otp
        $curl = curl_init();

        $SenderID = "sallat App";
        $PhoneNumber = $user->phone;
        $message = "OTP=".$password;

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://mazinhost.com/smsv1/sms/api",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "action=send-sms&api_key=aW5mb3RvdWNoOTk5QGdtYWlsLmNvbTo4QDltWklPdkcq&to=$PhoneNumber&from=$SenderID&sms=$message",
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return response()->api($user);

        $request['password'] = '123123123';
        $credentials = $request->only('phone', 'password');

    }//end of register

    public function user()
    {
        $data['user'] = new UserResource(auth()->user('sanctum'));

        $data['favoreds']      = User::with('favoreds')->find($data['user']->id);
        $data['favored_count'] = Favored::where('user_id', $data['user']->id)->count();

        return response()->api($data);

    }// end of user

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'region'   => ['required'],
            // 'phone'    => ['required','unique:users'],
            // 'image'    => ['required','image'],
            // 'password' => ['required','min:6'],
        ]);


        if ($validator->fails()) {
            return response()->api([], 1, $validator->errors()->first());
        }

        $data['user'] = new UserResource(auth()->user('sanctum'));

        $user = User::find($data['user']->id);

        if ($request->image) {

            if ($user->image != 'user_images/default.png') {

                Storage::disk('local')->delete('public/'. $user->image);

            } //end of if

            $request_data['image'] = $request->file('image')->store('user_images','public');

            $user->update([
                'username' => $request->username,
                'region'   => $request->region,
                'image'    => $request_data['image'],
            ]);

        } else {

            $user->update([
                'username' => $request->username,
                'region'   => $request->region,
            ]);

        }//end of if

        $user = User::find($data['user']->id);

        return response()->api($user);

    }//end of update user

    public function update_user(User $user, Request $request)
    {
        $user = User::find($request->id);

        $user->update([
            'username' => $request->username,
            'region'   => $request->region,
        ]);

        return response()->api($user);

    }//end of update user

}//end of controller
