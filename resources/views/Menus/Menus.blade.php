@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Menus</div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>User</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($menus as $menu)
                        <tr>
                            <td>{{$menu->id}}</td>
                            <td>{{$menu->title}}</td>
                            <td>{{$menu->type}}</td>
                            <td>{{$menu->description}}</td>
                            <td>{{$menu->status}}</td>
                            <td><img src="{{$menu->image}}" class="img-responsive image_menu" width="100" height="200"></td>
                            <td>{{$menu->user_id}}</td>
                            <td>
                            {!! Form::open(['method'=>'DELETE', 'route'=>['Menus.destroy', $menu->id]]) !!}
                            {!! Form::submit('X', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            </td>
                            <td><a href="Menus/{{$menu->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
