@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        @if (Session::has('added_menu_success'))
        <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{Session::get('added_menu_success')}}</div>
        @endif

        @if (Session::has('deleted_menu_success'))
        <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{Session::get('deleted_menu_success')}}
        </div>
        @endif
        @if (Session::has('updated_menu_success'))
        <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{Session::get('updated_menu_success')}}
        </div>
        @endif
        @if (Session::has('deleted_menu_faild'))
        <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{Session::get('deleted_menu_faild')}}
        </div>
        @endif
            <div class="panel panel-default">
                <div class="panel-heading">Menus <a href="Menus/create" class="pull-right"><span class="glyphicon glyphicon-plus"></span></a></div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Created By</th>
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
                            <td>{{$menu->user->name}}</td>
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
        <div class="col-lg-12">
            {{$menus->render()}}
        </div>
    </div>
</div>
@endsection
