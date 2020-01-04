<?php

namespace App\Modules\ContactUs\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ContactUs\Models\EmailTemplate;
use App\Modules\ContactUs\Models\GlobalValue;
use DataTables;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Modules\ContactUs\Models\ContactUs;
use Validator;
use Image;
use Storage;
use Mail;

class ContactUsController extends Controller {

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
    public function listContactUs() {
        return view('ContactUs::list');
    }

    public function contactusData() {
        $contactus = ContactUs::all();
        return Datatables::of($contactus)
            ->addColumn('status', function($contactus) {
                return $contactus->reply == '' ? '<label class="label label-danger">New, Not replied yet!</label>' : "<label class='label label-success'>Replied</label>";
            })
            ->rawColumns(['status','reply'])
            ->make(true);
    }

    public function createContactUs(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        else
        {
            $contactus = new ContactUs();

            $contactus->name = $request->name;
            $contactus->email = $request->email;
            $contactus->message = $request->message;

            if ($request->hasFile('image')) {
                $photo = $request->file('image');
                $ext = $request->image->getClientOriginalExtension();
                $new_name = time() . '.' . $ext;
                $destinationPath = base_path().'/storage/app/public/contactus';

                $img = Image::make($photo->getRealPath());
                $img->move($destinationPath, $new_name);

                $contactus->image = $new_name;
            }

            $contactus->save();

            $site_title = GlobalValue::where('slug','site-title')->first();
            $site_email = GlobalValue::where('slug','site-email')->first();

            $data['USER_NAME'] = $request->name;
            $data['SITE_TITLE'] = $site_title->value;
            $data['SITE_EMAIL'] = $site_email->value;

            $email_template = EmailTemplate::where('template_key','contact-us-thanks')->first();
            Mail::send('emailtemplate.contact-us-thanks',$data, function($message) use ($site_email,$site_title,$request,$email_template) {
                $message->to($request->email, $request->name)->subject($email_template->subject)->from($site_email->value,$site_title->value);
            });
            return redirect()->back()->with('success','Thank You For Contacting Us');
        }
    }

    public function updateContactUs(Request $request, $id) {
        $contactus = ContactUs::find($id);
        if ($request->method() == "GET") {
            return view('ContactUs::edit', ['contactus' => $contactus]);
        } else {

            $validator = Validator::make($request->all(), [
                'value' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $contactus->reply = $request->value;
            $contactus->save();

            $site_title = GlobalValue::where('slug','site-title')->first();
            $site_email = GlobalValue::where('slug','site-email')->first();

            $data['MESSAGE'] = $request->value;
            $data['SITE_TITLE'] = $site_title->value;
            $data['SITE_EMAIL'] = $site_email->value;
            $email_template = EmailTemplate::where('template_key','contact-us-reply')->first();
            Mail::send('emailtemplate.contact-us-reply',$data, function($message) use ($site_email,$site_title,$contactus,$email_template) {
                $message->to($contactus->email, $contactus->name)->subject($email_template->subject)->from($site_email->value,$site_title->value);
            });

            return redirect('admin/contactus/list')->with('success','Reply Successfully!');
        }
    }

}
