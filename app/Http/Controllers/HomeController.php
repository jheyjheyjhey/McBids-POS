<?php

namespace App\Http\Controllers;

use App\Products;
use App\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $totalProfit = 0.00;

        $sales = Sales::with(array('product', 'user'))->where('created_at', '>=', $today);
        $salesCount = $sales->count();
        $sales = $sales->get();

       foreach ($sales as $sale){
           $totalProfit += ($sale->product->price * $sale->qty);
       }

        return view('home', array(
            'totalSalesToday'   =>  $salesCount,
            'salesData'         =>  $sales,
            'totalProfitToday'   =>  $totalProfit
        ));
    }
}
