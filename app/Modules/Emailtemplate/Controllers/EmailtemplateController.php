<?php

namespace App\Modules\Emailtemplate\Controllers;

use App\Modules\Emailtemplate\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Validator;

class EmailtemplateController extends Controller
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
    public function listEmailTemplate() {
        return view('Emailtemplate::list');
    }

    public function emailtemplateData() {
        $emailtemplate = EmailTemplate::all();
        return Datatables::of($emailtemplate)
//                        ->addColumn('status', function($emailtemplate) {
//                            return $emailtemplate->status == '1' ? 'Published' : "Unpublished";
//                        })
            ->make(true);
    }

    public function updateEmailTemplate(Request $request, $id) {
        $emailtemplate = EmailTemplate::find($id);
        if ($request->method() == "GET") {
            return view('Emailtemplate::edit', ['emailtemplate' => $emailtemplate]);
        } else {

            $validator = Validator::make($request->all(), [
                'value' => $emailtemplate->validate,
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $file_location = base_path().'/resources/views/emailtemplate/'.$emailtemplate->template_key.'.blade.php';
            $template = fopen($file_location,'w+');
            fwrite($template,$request->value);
            fclose($template);
            $emailtemplate->value = $request->value;
            $emailtemplate->save();

            return redirect('admin/emailtemplate/list')->with('success','EmailTemplate Updated Successfully!');
        }
    }

}
