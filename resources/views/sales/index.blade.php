@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">MENU</div>
                    <div class="panel-body">
                        {{--Vue Component--}}
                        <product-for-sale-list></product-for-sale-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection