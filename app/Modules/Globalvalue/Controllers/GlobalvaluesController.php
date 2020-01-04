<?php

namespace App\Modules\Globalvalue\Controllers;

use App\Helper\fileUploadHelper;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Modules\Models\GlobalValue;
use Validator;
use Image;
use Storage;

class GlobalvaluesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function listGlobalValues() {
        return view('Globalvalue::list');
    }

    public function globalValueData() {
        $global_value = GlobalValue::all();
        return Datatables::of($global_value)
//                        ->addColumn('status', function($cms) {
//                            return $cms->status == '1' ? 'Published' : "Unpublished";
//                        })
                        ->make(true);
    }

    public function updateGlobalValue(Request $request, $id) {
        $global_value = GlobalValue::find($id);
        if ($request->method() == "GET") {
            return view('Globalvalue::edit', ['global_value' => $global_value]);
        } else {
            
            $validator = Validator::make($request->all(), [
                        'value' => 'required',
            ]);
             if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

            if ($request->hasFile('value')) {

                $image = fileUploadHelper::fileUpload(['file_type'=>'image','html_input_name'=>'value','file'=>$request->value,
                    'destination'=>'/storage/app/public/admin/site-logo']);

                $request->value = $image[0];
            }
        
            $global_value->value=$request->value;
            $global_value->save();
            
            return redirect('admin/manage-global-value')->with('success','Global Value Updated Successfully!');
        }
    }

}
