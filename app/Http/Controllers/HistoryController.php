<?php

namespace App\Http\Controllers;
use App\Models\Topup;
use Input;
use Session;
use Auth;
use DB;


use Illuminate\Http\Request;

class HistoryController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	// $history = Topup::orderBy('order_id','desc')->paginate(10);
     //    return view('history', compact('history'));

    	$pagination  = 10;
	    $history    = Topup::when($request['search'], function ($query) use ($request) {
	        $query
	        ->where('order_id', 'like', "%{$request->search}%");
	    })->orderBy('order_id', 'desc')->paginate($pagination);

	    $history->appends($request->only('search'));

	    return view('history', [
	        'title'    => 'History',
	        'history' => $history,
	    ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }



    public function edit($order_id)
    {
    	$history = Topup::orderBy('order_id','desc')->paginate(10);
    	$data = DB::table('topup')
                ->where('order_id', $order_id)->first();

    	return view('edit', compact('data','history'));
	}
    
    public function update(Request $request, $order_id){     
     $data = Topup::where('order_id', '=', $order_id)->first();
     $data->paid=$request->get('paid');
     $data->save();
     Session::flash('flash_message', 'Balance is successfully paid');
     return redirect('history');
     //dd($data);
    }
}
