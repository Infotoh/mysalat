<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainCategoryController;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\FavoredController;
use App\Models\User;
use Seshac\Otp\Otp;
use App\Models\Totp;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('resend-otp/{id}', function ($id) {
  Totp::where('identifier', $id)->delete();
  $user = User::find($id);
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
  return response()->api([], 1, 'new otp sended');
});
Route::get('apitest', function () {
  $curl = curl_init();

  $SenderID = "sallat App";
  $PhoneNumber = "249915254564";
  $message = "Salam from Brqsms API";

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
  echo $response;

});
Route::get('/', function () {

    $users = \App\Models\User::where('id', '!=',2)
                        ->pluck('phone');

    dd($users);

    return App\Models\User::first();

});

Route::get('min_category', [MainCategoryController::class,'index']);

Route::get('owner/{id}', [OwnerController::class,'index']);

Route::get('banners/{id}', [BannerController::class,'index']);

Route::post('order/store', [OrderController::class,'store']);
Route::get('order/show/{order}', [OrderController::class,'show'])->name('order.show');
Route::get('order/user/{id}', [OrderController::class,'show_all_order']);
Route::get('order/cancel/{order}', [OrderController::class,'orderCancel']);
// Route::get('order/payment_user/{order}', [OrderController::class,'payment_order_status']);
Route::post('order/payment', [OrderController::class,'payment_order']);

Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::post('/user_update', [AuthController::class,'update_user']);
Route::post('/otp-validate', [AuthController::class,'otpValidate']);

Route::get('search/{categorey_id}/{user_id}/{search}', [SettingController::class,'search']);
Route::post('/settings/support', [SettingController::class,'store']);
Route::get('/settings/support/{id}', [SettingController::class,'show']);

Route::post('favored/store', [FavoredController::class,'store']);
Route::get('favored/{user_id}', [FavoredController::class,'get_favored']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/show_order', [OrderController::class,'show_order']);
    Route::get('/user', [AuthController::class,'user']);
    Route::post('/user/update', [AuthController::class,'update']);

});
