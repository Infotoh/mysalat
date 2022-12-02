<?php
namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorey;
use App\Models\Owner;

class WelcomController extends Controller
{

    public function index()
    {
        $min_categorys = Categorey::all();
    $notifications = auth()->user()->unreadNotifications;
    // dd($notifications);
        return view('dashboard.admin.home', compact('min_categorys','notifications'));

    }//end of index

}//end of controller
