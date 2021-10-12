<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Product;
use App\Category;
use App\User;
use DB;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $products = Product::count();
        $categories = Category::count();
        $users = User::count();
        $payments = Payment::sum('total');
       
        return view('home', compact('products','categories','payments','users'));
    }

    public function orderReport()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') ;
            $end = Carbon::parse($date[1])->format('Y-m-d') ;
        }

        $payments = Payment::with(['district'])
        ->where('status_id', 3)
        ->whereBetween('created_at', [$start, $end])->get();
        return view('report.order', compact('payments'));
    }

    public function orderReportPdf($daterange)
    {
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $payments = Payment::with(['district'])
        ->where('status_id', 3)
        ->whereBetween('created_at', [$start, $end])->get();
        $pdf = PDF::loadView('report.order_pdf', compact('payments', 'date'));
        return $pdf->stream();
    }

    
}
