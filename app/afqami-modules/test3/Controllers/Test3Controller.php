<?php
namespace App\AfqamiModules\test3\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class Test3Controller extends Controller
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
        dd(456);
        return view('test::test');
    }
}
