@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Top Up</div>

                <div class="panel-body">

                    <h3>Prepaid Balance</h3>

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
                                 <form class="form-horizontal" role="form" method="POST" action="{{ url('/topup') }}">
                                 {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5">
                                                <label>Mobile Number</label><br/>
                                                <!-- 081<input type="text" class="form-control" name="mobilenumber" value="{{ old('mobilenumber') }}" onkeypress="return isNumber(event)"> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon">081</span>
                                                        <input class="form-control" type="text" name="mobilenumber" value="{{ old('mobilenumber') }}" onkeypress="return isNumber(event)" maxlength="9">
                                                </div>
                                        </div>
                                        <div class="col-md-3">
                                                <label>Value</label>
                                                <select name="value" class="form-control">
                                                    <option value="10000">Rp. 10.000</option>
                                                    <option value="50000">Rp. 50.000</option>
                                                    <option value="100000">Rp. 100.000</option>
                                                </select>

                                        </div>
                                        <div class="col-md-5">
                                                <label>Product</label>
                                                <textarea class="form-control" name="product">{{ old('product') }}</textarea>
                                        </div>
                                        <div class="col-md-5">
                                                <label>Shipping Address</label>
                                                <textarea class="form-control" name="shipping">{{ old('shipping') }}</textarea>
                                        </div>
                                        <div class="col-md-5">
                                                <label>Price</label>
                                                <input type="number" class="form-control" name="price"  onkeypress="return isNumber(event)" value="{{ old('price') }}">
                                        </div>
                                    </div>
                                    <br/>
                                    <button type="submit" class="btn btn-info btn-fill">Save</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}   
</script>
@endsection
