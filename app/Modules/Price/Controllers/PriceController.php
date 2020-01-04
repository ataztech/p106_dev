<?php

namespace App\Modules\Price\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Price\Models\Price;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;

class PriceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return view('Price::list');
    }

    public function data()
    {
        $prices = Price::orderBy('id','desc')->get();

        return Datatables::of($prices)
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->method()=="GET")
        {
            return view('Price::create');
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'year' => 'required',
                'silver' => 'required',
                'gold' => 'required',
                'diamond' => 'required',
                'platinum' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $price =  new Price();
            $price->year = $request->year;
            $price->silver = $request->silver;
            $price->gold = $request->gold;
            $price->diamond = $request->diamond;
            $price->platinum = $request->platinum;
            $price->save();
            return redirect('admin/price/list')->with('success','Price Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $price = Price::find($id);
        if($request->method()=="GET")
        {
            return view('Price::update',['price'=>$price]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'year' => 'required',
                'silver' => 'required',
                'gold' => 'required',
                'diamond' => 'required',
                'platinum' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $price->year = $request->year;
            $price->silver = $request->silver;
            $price->gold = $request->gold;
            $price->diamond = $request->diamond;
            $price->platinum = $request->platinum;
            $price->save();
            return redirect('admin/price/list')->with('success','Price Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Price::find($id)->delete();
        return redirect('admin/price/list')->with('success','Price Delete Successfully!');
    }
}
