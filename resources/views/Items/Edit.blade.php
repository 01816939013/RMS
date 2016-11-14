@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Update Item</div>

                <div class="panel-body">
                    {!! Form::model($item, array('method'=>'PATCH', 'action'=>['ItemsController@update', $item->id],'files'=>true)) !!}
                    <div class="col-md-4 form-group"> 
                        <p class="error">@if (isset($errors[0])){{$errors[0]}} @endif</p>
                        {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Item Title:')) !!}
                    </div>
                    <div class="col-md-4 form-group"> 
                        <p class="error">@if (isset($errors[1])){{$errors[1]}} @endif</p>
                        {!! Form::select('menu_id', $menus, null, array('class'=>'form-control', 'placeholder'=>'Choose Item Menu')) !!}
                    </div>
                    <div class="col-md-4 form-group"> 
                        <p class="error">@if (isset($errors[2])){{$errors[2]}} @endif</p>
                        {!! Form::select('status',[-1=>'Item Status', 1=>'Active',0=>'inActive'], null, array( 'class'=>'form-control')) !!}
                    </div>
                    <div class="col-md-12 form-group"> 
                        <p class="error">@if (isset($errors[3])){{$errors[3]}} @endif</p>
                        {!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Item Description:')) !!}
                    </div>
                    <div class="col-md-4">
                        <p class="error">@if (isset($errors[4])){{$errors[4]}} @endif</p>
                        {!! Form::number('price', null, array('step'=>'any' ,'class'=>'form-control', 'placeholder'=>'Item Price')) !!}
                    </div>
                    <div class="col-md-4 form-group"> 
                        <p></p>
                        {!! Form::file('image', array('class'=>'form-control', 'placeholder'=>'Item Picture')) !!}
                    </div>
                    <div class="col-md-4 form-group"> 
                        {!! Form::submit('UPdate', ['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
