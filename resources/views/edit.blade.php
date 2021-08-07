@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Payment</div>

                <div class="panel-body">

                    <h3>Payment Balance</h3>

                    @if (session('flash_message'))
                        <div class="alert alert-success">
                            {{ session('flash_message') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif

                    <hr/>


                     <div class="content">
                       <form method="post" action="{{ url('/history/update', $data->order_id) }}"  role="form">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Order ID : </label>  
                                <label>{{$data->order_id}}</label> 
                                <br/>
                                <label for="name">The {{$data->product}} that Rp.{{$data->price}} will be shipped to : {{$data->shipping}}</label>                 
                                <input type="hidden" name="paid" value ='1' class="form-control">                
                            </div>
                            
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
