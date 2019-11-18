<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $logged_user_id = Auth::user()->id;

        $logged_user_name = Auth::user()->name;

        $customers = Customer::where('user_id',$logged_user_id)->get();

        $data = [

            'customers' => $customers,
            'logged_user_name' => $logged_user_name

        ];
        
        return view('home', $data);
    }
}
