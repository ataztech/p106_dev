<?php

namespace App\Modules\Cms\Controllers;

use App\Modules\Cms\Models\Cms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Validator;

class CmsController extends Controller
{
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
    public function listCms() {
        return view('Cms::list');
    }

    public function cmsData() {
        $cms = Cms::all();
        return DataTables::of($cms)
//                        ->addColumn('status', function($cms) {
//                            return $cms->status == '1' ? 'Published' : "Unpublished";
//                        })
            ->make(true);
    }

    public function updateCms(Request $request, $id) {
        $cms = Cms::find($id);
        if ($request->method() == "GET") {
            return view('Cms::edit', ['cms' => $cms]);
        } else {

            $validator = Validator::make($request->all(), [
                'value' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $cms->value=$request->value;
            $cms->save();

            return redirect('admin/cms/list')->with('success','Cms Updated Successfully!');
        }
    }

}
