@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Customers <a href="Customers/create" class="pull-right"><span class="glyphicon glyphicon-plus"></span></a></div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->password}}</td>
                            <td>{{$customer->address}}</td>
                            <td>{{$customer->city}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'route'=>['Customers.destroy', $customer->id]]) !!}
                                {!! Form::submit('X', ['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td><a href="Customers/{{$customer->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            {{$customers->render()}}
        </div>
    </div>
</div>
@endsection
