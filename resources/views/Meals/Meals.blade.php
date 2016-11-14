@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">Meals <a href="Meals/create" class="pull-right"><span class="glyphicon glyphicon-plus"></span></a></div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Created By</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($meals as $meal)
                        <tr>
                            <td>{{$meal->id}}</td>
                            <td>{{$meal->title}}</td>
                            <td>{{$meal->status}}</td>
                            <td>{{$meal->description}}</td>
                            <td>{{$meal->price}}</td>
                            <td><img src="{{$meal->image}}" class="img-responsive image_menu" width="100" height="200"></td>
                            <td>{{$meal->user->name}}</td>
                            <td>
                            {!! Form::open(['method'=>'DELETE', 'route'=>['Meals.destroy', $meal->id]]) !!}
                            {!! Form::submit('X', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            </td>
                            <td><a href="Meals/{{$meal->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            {{$meals->render()}}
        </div>
    </div>
</div>
@endsection
