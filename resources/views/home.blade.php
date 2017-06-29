@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <div class="form-group">
                        <h3 class="text-center">
                            <span class="text-success sales-count">{{$totalSalesToday}}</span><br>Transaction(s) for today!
                        </h3>
                    </div>
                    <div class="form-group">
                        <h3 class="text-center">
                            <span class="text-success sales-count">₱{{$totalProfitToday}}</span><br>Estimated profit for today!
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
