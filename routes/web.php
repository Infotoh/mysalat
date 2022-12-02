<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
// use Spatie\Browsershot\Browsershot;
use App\Models\Order;
use App\Models\PaymentOrder;
use App\Models\User;
use App\Models\Admin;
// use Notification;
use App\Notifications\NewOrderNotification;

// Route::get('/', [\App\Http\Controllers\Api\WelcomeController::class,'index']);

// Route::prefix('dashboard/owner')->name('dashboard.owner.')->middleware('auth:owner')->group(function () {
//
// });
Route::get('notif', function () {
  dd(auth()->guard('owner')->user()->unreadNotifications);
  $admin = Admin::first();



  $details = [

      'greeting' => 'Hi Artisan',

      'body' => 'This is my first notification from ItSolutionStuff.com',

      'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',

      'actionText' => 'View My Site',

      'actionURL' => url('/'),

      'order_id' => 101

  ];



  // Notification::send($admin, new NewOrderNotification($details));
  $admin->notify(new NewOrderNotification($details));



  dd('done');
});
Route::get('/', function () {
  return redirect()->route('dashboard.admin.home');
});
// $order = Order::first();
// // dd('test');
//
// // dd(auth('admin')->user()->isAbleTo('admins-create'));
// // return $order;
// $user  = User::find($order->user_id);
//
// // dd($orders);
//
// return view('dashboard_admin.invoice.order', compact('order', 'user'));

// Browsershot::url('https://example.com')->save('example.pdf');



Route::get('test', function () {

    //  \PDF::loadView('home')
    // ->setPaper('letter', 'landscape')
    // ->save(public_path('invoice.pdf'));
    //
    // $banners = App\Models\Banner::where('categoreys_id',1)->get();
    //
    // return response()->api(App\Http\Resources\BannerResource::collection($banners));

        $admin = \App\Models\Admin::create([
            'name'     => 'admin',
            'phone'    => '123123123',
            'email'    => 'super_admin@app.com',
            'password' => bcrypt('123123123'),
        ]);

        $admin->attachRole('admin');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/imei', [App\Http\Controllers\HomeController::class, 'imeiCheck'])->name('imei');
Route::post('/imei', [App\Http\Controllers\HomeController::class, 'imeiSubmit']);
