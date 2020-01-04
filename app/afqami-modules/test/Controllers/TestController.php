<?php
namespace App\AfqamiModules\test\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class TestController extends Controller
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
    public function test()
    {
        return view('test::test');
    }
}
