@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Items <a href="Items/create" class="pull-right"><span class="glyphicon glyphicon-plus"></span></a></div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Menu</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Created By</th>
                            <th>Delete</th>
                            <th>Update</th>
                        </tr>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->menu->title}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->price}}</td>
                            <td><img src="{{$item->image}}" class="img-responsive image_menu" width="100" height="200"></td>
                            <td>{{$item->user->name}}</td>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'route'=>['Items.destroy', $item->id]]) !!}
                                {!! Form::submit('X', ['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td><a href="Items/{{$item->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            {{$items->render()}}
        </div>
    </div>
</div>
@endsection
