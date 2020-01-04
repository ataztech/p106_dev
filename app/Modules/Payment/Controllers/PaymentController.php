<?php

namespace App\Modules\Payment\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counsellor\Models\Counsellor;
use App\Modules\Standard\Models\Standard;
use App\PaymentDetail;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Storage;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentList()
    {
        return view('Payment::list');
    }

    public function PaymentData()
    {
        $payment_detail = \App\Modules\Payment\Models\PaymentDetail::orderBy('id','desc')->get();

        return Datatables::of($payment_detail)
            ->make(true);
    }

    public function totalPayment()
    {
        $payment = \App\Modules\Payment\Models\PaymentDetail::all('amount');
        $total = $payment->sum('amount');
        return json_encode($total);
    }


}
