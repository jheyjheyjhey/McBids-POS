@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">PRODUCTS</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>Code</td>
                                    <td>Description</td>
                                    <td>Price</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product['name']}}</td>
                                        <td>{{$product['description']}}</td>
                                        <td>{{$product['price']}}</td>
                                        <td>
                                            <button class="btn btn-xs btn-info" type="button" data-id="{{$product['id']}}" data-action="edit">Edit</button>
                                            <button class="btn btn-xs btn-danger" type="button" data-id="{{$product['id']}}" data-action="delete">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"><span class="note">* All products are subjected to price change with prior notice.</span></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="pull-right">
                            <button class="btn btn-md btn-success" data-action="add">Add New Product</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection