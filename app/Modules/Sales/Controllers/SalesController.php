<?php

namespace App\Modules\Sales\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counsellor\Models\Counsellor;
use App\Modules\Sales\Models\Sales;
use App\Modules\Standard\Models\Standard;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Storage;

class SalesController extends Controller
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
    public function salesList()
    {
        return view('Sales::list');
    }

    public function salesData()
    {
        $sales_detail = Sales::orderBy('id','desc')->get();
        //dd($sales_detail);

        return Datatables::of($sales_detail)
            ->addColumn('counsellor_id', function($counsellor) {
                return $counsellor->counsellorName->counsellor_name;
            })
            ->make(true);
    }

    public function totalSales()
    {
        $sales = Sales::all('booking_value');
        $total_sales = $sales->sum('booking_value');
        return json_encode($total_sales);
    }

    public function checkCounsellorNameDuplication(Request $request)
    {
        $counsellor_name = $request->counsellor_name;
        if(isset($request->id))
        {
            $check_name = Counsellor::where('counsellor_name',$counsellor_name)->where('id','<>',$request->id)->first();
        }
        else
        {
            $check_name = Counsellor::where('counsellor_name',$counsellor_name)->first();
        }
        if($check_name->count() > 0)
        {
            return "false";
        }
        else
        {
            return "true";
        }

    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            $counsellors = Counsellor::all();
            return view('Sales::create',compact('counsellors'));
        }
        else
        {
            //dd($request->all());
            $validator = Validator::make($request->all(), [
                'date' => 'required',
                'customer_name' => 'required',
                'contact_no' => 'required',
                'booking_value' => 'required',
                'cash_submitted' => 'required',
                'first_installment' => 'required',
                'second_installment' => 'required',
                'second_installment_date' => 'required',
                'third_installment' => 'required',
                'third_installment_date' => 'required',
                'counsellor_id' => 'required',
                'mode_of_payment' => 'required',
                'place' => 'required',
                'cheque_status' => 'required',
                'cheque_no' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $insert_sales_record = new Sales();
            $insert_sales_record->recipt_no = mt_rand(100000, 999999);
            $insert_sales_record->date = $request->date;
            $insert_sales_record->customer_name = $request->customer_name;
            $insert_sales_record->contact_no = $request->contact_no;
            $insert_sales_record->booking_value = $request->booking_value;
            $insert_sales_record->cash_submitted = $request->cash_submitted;
            $insert_sales_record->first_installment = $request->first_installment;
            $insert_sales_record->second_installment = $request->second_installment;
            $insert_sales_record->second_installment_date = $request->second_installment_date;
            $insert_sales_record->third_installment = $request->third_installment;
            $insert_sales_record->third_installment_date = $request->third_installment_date;
            $insert_sales_record->counsellor_id = $request->counsellor_id;
            $insert_sales_record->mode_of_payment = $request->mode_of_payment;
            $insert_sales_record->place = $request->place;
            $insert_sales_record->cheque_status = $request->cheque_status;
            $insert_sales_record->cheque_no = $request->cheque_no;
            if($insert_sales_record->save())
            {
                return redirect('admin/sales/list')->with('success','Record Added Successfully!');
            }
            else
            {
                return redirect('admin/sales/list')->with('warning','Opps Something Went Wrong');
            }

        }
    }

    public function update(Request $request,$id)
    {
        //dd($id);
        $update_sales_detail = Sales::find($id);
        if($request->method()=="GET")
        {
            $counsellors = Counsellor::all();
            return view('Sales::update',['update_sales_detail'=>$update_sales_detail,'counsellors' => $counsellors]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'date' => 'required',
                'customer_name' => 'required',
                'contact_no' => 'required',
                'booking_value' => 'required',
                'cash_submitted' => 'required',
                'first_installment' => 'required',
                'second_installment' => 'required',
                'second_installment_date' => 'required',
                'third_installment' => 'required',
                'third_installment_date' => 'required',
                'counsellor_id' => 'required',
                'mode_of_payment' => 'required',
                'place' => 'required',
                'cheque_status' => 'required',
                'cheque_no' => 'required',
            ]);
            if ($validator->fails()) {
                dd($validator);
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $update_sales_detail->recipt_no = mt_rand(100000, 999999);
            $update_sales_detail->date = $request->date;
            $update_sales_detail->customer_name = $request->customer_name;
            $update_sales_detail->contact_no = $request->contact_no;
            $update_sales_detail->booking_value = $request->booking_value;
            $update_sales_detail->cash_submitted = $request->cash_submitted;
            $update_sales_detail->first_installment = $request->first_installment;
            $update_sales_detail->second_installment = $request->second_installment;
            $update_sales_detail->second_installment_date = $request->second_installment_date;
            $update_sales_detail->third_installment = $request->third_installment;
            $update_sales_detail->third_installment_date = $request->third_installment_date;
            $update_sales_detail->counsellor_id = $request->counsellor_id;
            $update_sales_detail->mode_of_payment = $request->mode_of_payment;
            $update_sales_detail->place = $request->place;
            $update_sales_detail->cheque_status = $request->cheque_status;
            $update_sales_detail->cheque_no = $request->cheque_no;
            if($update_sales_detail->save())
            {
                return redirect('admin/sales/list')->with('success','Record Updated Successfully!');
            }
            else
            {
                return redirect('admin/sales/list')->with('danger','Opps Something Went Wrong');

            }


        }
    }

    public function delete($id)
    {
        $delete_sales_record = Sales::find($id);
        $delete_sales_record->delete();
        return redirect('admin/sales/list')->with('success','Record Delete Successfully!');
    }
}
