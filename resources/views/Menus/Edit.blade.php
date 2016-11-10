@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Menu</div>

                <div class="panel-body"> 
                        {!! Form::model($menu, array('method'=>'PATCH', 'action'=>['MenusController@update', $menu->id],'files'=>true)) !!}
                        <div class="col-md-4 form-group"> 
                            <p class="error">@if (isset($errors[0])){{$errors[0]}} @endif</p>
                            {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Menu Title:')) !!}
                        </div>
                        <div class="col-md-4 form-group"> 
                        <p class="error">@if (isset($errors[1])){{$errors[1]}} @endif</p>
                            {!! Form::select('type',[-1=>'Menu Type', 'Hot Drinks'=>'Hot Drinks','Cold Drinks'=>'Cold Drinks', 'Food'=>'Food'],null, array('class'=>'form-control')) !!}
                        </div>
                        <div class="col-md-4 form-group"> 
                        <p class="error">@if (isset($errors[2])){{$errors[2]}} @endif</p>
                            {!! Form::select('status',[-1=>'Menu Status', 1=>'Active',0=>'inActive'], null, array( 'class'=>'form-control')) !!}
                        </div>
                        <div class="col-md-12 form-group"> 
                            <p class="error">@if (isset($errors[3])){{$errors[3]}} @endif</p>
                            {!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Menu Description:')) !!}
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset($menu->image)}}" class="img-responsive img-rounded">
                        </div>
                        <div class="col-md-4 form-group">
                            {!! Form::file('image', array('class'=>'form-control', 'placeholder'=>'Menu Picture')) !!}
                        </div>
                        <div class="col-md-4 form-group"> 
                            {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
