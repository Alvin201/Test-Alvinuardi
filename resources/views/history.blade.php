@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Order History</div>

                <div class="panel-body">

                    <h3>Order History</h3>

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

                    <p>Cari Data No Order :</p>
                    <form action="{{ url('history') }}" method="GET">
                        <input type="search" name="search" placeholder="Search by Order No .." value="{{ request('search') }}">
                        <input type="submit" value="Search">
                    </form>

                    @if(count($history)> 0)
                        <table class="table table-hover table-striped" id="myTable">
                          <thead>
                                <th >No</th>
                                <th >Order ID</th>
                                <th >Total</th>
                                <th >Status</th>
                          </thead>
                           @foreach($history as $index => $row)
                          <tbody>
                                <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $row->order_id }}</td>
                                        <td>{{ $row->total }}</td>
                                        <td>
                                            @if($row->paid == 0)         
                                                  <label class="btn btn-warning">Not Paid</label>         
                                            @elseif ($row->paid == 1)
                                                  <label class="btn btn-success">Success</label>
                                            @else
                                                  <label class="btn btn-danger">Canceled</label>     
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->paid == 0)         
                                                 <a href="/history/edit/{{ $row->order_id }}">Pay Now</a>     
                                            @endif
                                        

                    
                                        </td>
                                </tr>
                          </tbody>
                          @endforeach
                         </table>
                    @else
                        <p style="margin-left:5px;">Data not found</p>
                    @endif
                    Page : {{ $history->currentPage() }} <br/>
                    Total Data : {{ $history->total() }} <br/>            
                    Data Per Page : {{ $history->perPage() }} <br/>
                    {{ $history->links() }}

                    
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
