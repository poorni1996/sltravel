<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payment = $request->all();
        return view('admin.payment_gate.pay', compact('payment'));
    }
}
