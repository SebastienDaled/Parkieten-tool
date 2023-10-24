<?php

namespace App\Http\Controllers;

use App\Models\Ring;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    //
    public function index()
    {   
        // maak cart session aan
        // Session::flush();
        Session::put('cart', []);

        return view('home');
    }

    public function history()
    {
        // only orders with the actiev user 
        $orders = Order::with('orderItems')->where('user_id', auth()->user()->id)->get();
        
        
        $rings = Ring::with('type')->get();


        return view('history.index', compact('orders', 'rings'));
    }
    public function order()
    {
        $rings = Ring::with('type')->get();

    

        return view('order.index', compact('rings'));
    }
}
