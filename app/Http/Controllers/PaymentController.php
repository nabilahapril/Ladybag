<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\District;
use App\Status;
use App\line_item_clone;
use App\User;
use App\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['district','status'])->orderBy('created_at', 'DESC');
   
       
        if (request()->status_id != '') {
            $payments = $payments->where('status_id', request()->status_id);
        }

        $payments = $payments->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function view($cart_id)
    {
        $payment = Payment::find($cart_id);
        $status = Status::get();
        $district= District::get();
        $line_item_clone=line_item_clone::where('cart_id', $cart_id)->get();
        $user=User::get();
        return view('payments.view', compact('payment', 'district','status','line_item_clone','user'));
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->forget();
       
        return redirect(route('payments.index'));
    }

    public function acceptPayment($id)
    {
        $payment = Payment::where('id', $id)->first();
        $payment->update(['status_id' => 3]);
        return redirect()->back();
    }
  
    public function done(Request $request)
    {
        $payment = Payment::with(['user'])->find($request->payment_id);
        $payment->update(['status_id' => 2]);
        $cart = Cart::where('cart_id', $id)->get();
        $cart->delete();
        return redirect()->back();
    }

}
