<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    //
    public function payments(Request $request)
    {   
        $payments = Payment::with('offer', 'plan')->orderBy('id', 'DESC')->get();
        return view('user.payment.index')->with(compact('payments'));
    }
}
