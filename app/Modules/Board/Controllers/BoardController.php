<?php

namespace App\Modules\Board\Controllers;

use App\Helper\fileUploadHelper;
use App\Http\Controllers\Controller;
use App\Modules\Board\Models\Board;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use DataTables;
use Image;

class BoardController extends Controller
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
     * Show the application dashBoard::
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return view('Board::list');
    }

    public function data()
    {
        $boards = Board::orderBy('id','desc')->get();

        return Datatables::of($boards)
//            ->addColumn('image', function($board) {
//                return '<label>jhgjg</label>';
//            })
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->isMethod("GET"))
        {
            return view('Board::create');
        }
        else
        {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'required',
                'full_form_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $board =  new Board();
            $board->name=$request->name;
            $board->full_form_name=$request->full_form_name;

            if ($request->hasFile('image')) {

                $image = fileUploadHelper::fileUpload(['file_type'=>'image','html_input_name'=>'image','file'=>$request->image,
                    'destination'=>'/storage/app/public/board','resize'=>['resize'=>true,'height'=>100,'width'=>100,'resize_destination'=>'/storage/app/public/board/thumb']]);

                if(isset($image['error_code']) && $image['error_code'])
                {
                    dd($image);
                }
                else
                {
                    $board->link = '/storage/app/public/board/';
                    $board->image = $image[0];
                }

            }

            $board->save();
            return redirect('admin/board/list')->with('success','Board Added Successfully!');
        }
    }

    public function update(Request $request,$id)
    {
        $board = Board::find($id);
        if($request->method()=="GET")
        {
            return view('Board::update',['board'=>$board]);
        }
        else
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'full_form_name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $board->name=$request->name;
            $board->full_form_name=$request->full_form_name;

            if ($request->hasFile('image')) {

                $image = fileUploadHelper::fileUpload(['file_type'=>'image','html_input_name'=>'image','file'=>$request->image,
                    'destination'=>'/storage/app/public/board','resize'=>['resize'=>true,'height'=>100,'width'=>100,'resize_destination'=>'/storage/app/public/board/thumb']]);

                if(isset($image['error_code']) && $image['error_code'])
                {
                    dd($image);
                }
                else
                {
                    $board->link = '/storage/app/public/board/';
                    $board->image = $image[0];
                }
            }

            $board->save();
            return redirect('admin/board/list')->with('success','Board Updated Successfully!');
        }
    }

    public function delete($id)
    {
        Board::find($id)->delete();
        return redirect('admin/board/list')->with('success','Board Delete Successfully!');
    }


}
