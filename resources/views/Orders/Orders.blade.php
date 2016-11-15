@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Orders <a href="Orders/create" class="pull-right"><span class="glyphicon glyphicon-plus"></span></a></div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>CashIn</th>
                            <th>Payment</th>
                            <th>Change</th>
                            <th>Customer</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->cashIn}}</td>
                            <td>{{$order->payment}}</td>
                            <td>{{$order->change}}</td>
                            <td>{{$order->customer->name}}</td>
                            <td>
                            {!! Form::open(['method'=>'DELETE', 'route'=>['Orders.destroy', $order->id]]) !!}
                            {!! Form::submit('X', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            </td>
                            <td><a href="Orders/{{$order->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            {{$orders->render()}}
        </div>
    </div>
</div>
@endsection
