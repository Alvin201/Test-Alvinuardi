<?php

namespace App\Http\Controllers;
use App\Models\Topup;

use Illuminate\Http\Request;
use Session;
use Auth;
use Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TopupController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    public function index()
    {
    	$history = Topup::orderBy('order_id','desc')->paginate(10);
        return view('topup', compact('history'));
    }

      public function store(Request $request) {

      	$validator = Validator::make($request->all(), [
            'mobilenumber'  => 'min:9|required',
            'value'  => 'required|',
            'product'  => 'required|min:9|max:150',
            'shipping'  => 'required|min:9|max:150',
            'price'  => 'required|'


        ],
        [
            'mobilenumber.required'     => 'Mobile Number cannot be empty..',
            'mobilenumber.min'     => 'The :attribute value input is not between :min',
            'value.required'     => 'Top up cannot be empty..',
            'product.required'     => 'Product Name cannot be empty..',
            'product.between'     => 'The :attribute value :input is not between :min - :max.',
            'shipping.required'     => 'Shipping Address cannot be empty..',
            'shipping.between'     => 'The :attribute value :input is not between :min - :max.',
            'price.required'     => 'Price cannot be empty..'

        ]
    	);




       	if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $invoice = Topup::selectRaw('LPAD(CONVERT(COUNT("id") + 2, char(8)) , 8,"0") as invoice')->first();
        $request['order_id']= 'T' . $invoice->invoice;
        $request['mobilenumber'] =  '081' . $request->input('mobilenumber');
        
        $ttl = $request->input('value') + 0.05;
        $ttlp =  $ttl + 10000;
        $request['total'] = $ttlp;
        $request['id_user'] = Auth::id();
        Topup::create($request->all());
        Session::flash('flash_message', 'Topup has been Sucessfully! Your Order is '.$request['order_id']);
        return redirect('topup');
    }

}
