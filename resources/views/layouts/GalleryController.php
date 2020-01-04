<?php

namespace App\Modules\Gallery\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counsellor\Models\Counsellor;
use App\Modules\Standard\Models\Standard;
use App\PaymentDetail;
use App\User;
use App\Modules\Gallery\Models\Gallery;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Storage;

class GalleryController extends Controller
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


    /*
    Date:21/12/2019
    Name: Sana shaikh
    It return subscribers list
    */
    public function galleryList()
    {
        return view ('Gallery::list');
    }

    public function createGallery(Request $request)
    {
         if($request->method()=="GET")
        {
            return view('Gallery::create');
        }
        else
        {

            $validator = Validator::make($request->all(), [
                'image' => 'required',
                'title' => 'required',
                'sequence_number' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }


            $gallery =  new Gallery();

          if( $request->hasFile('image')) {
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path("img"), $new_name);
                $gallery->image = $new_name;
              /*$file = $request->file('image');
              $extension = $file->getClientOriginalExtension();
              $filename = time() . '.' .$extension;
                $file->move('/img/', $filename);
              $gallery->image = $filename;*/

                }
          else
          {
            return $request;
            $gallery->image = '';
          }

            $gallery->title = $request->title;
            $gallery->sequence_number = $request->sequence_number;

            $gallery->save();
            return redirect('admin/gallery/list')->with('success','Gallery Added Successfully!')->with('path', $new_name);
    }

}
        public function galleryData()
        {
             $gallery = Gallery::all();
            return Datatables::of($gallery)
            ->make(true);
        }



}
