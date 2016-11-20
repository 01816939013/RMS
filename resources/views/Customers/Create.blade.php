@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Customer</div>

                <div class="panel-body">
                    {!! Form::open(array('route'=>'Customers.store')) !!}
                    <div class="col-md-6 form-group"> 
                        <p class="error">@if ($errors->has('name')) {{ $errors->first('name') }} @endif</p>
                        {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Customer Name:')) !!}
                    </div>
                    <div class="col-md-6 form-group"> 
                        <p class="error">@if ($errors->has('email')) {{ $errors->first('email') }} @endif</p>
                        {!! Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Customer Email:')) !!}
                    </div>
                    <div class="col-md-6 form-group"> 
                        <p class="error">@if ($errors->has('password')) {{ $errors->first('password') }} @endif</p>
                        {!! Form::password('password',array('class'=>'form-control')) !!}
                    </div>
                    <div class="col-md-6 form-group"> 
                        <p class="error">@if ($errors->has('address')) {{ $errors->first('address') }} @endif</p>
                        {!! Form::text('address', null, array('class'=>'form-control', 'placeholder'=>'Customer Address:')) !!}
                    </div>
                    <div class="col-md-6 form-group"> 
                        <p class="error">@if ($errors->has('city')) {{ $errors->first('city') }} @endif</p>
                        {!! Form::text('city', null, array('class'=>'form-control', 'placeholder'=>'City:')) !!}
                    </div>
                    <div class="col-md-6 form-group"> 
                        <p class="error">@if ($errors->has('phone')) {{ $errors->first('phone') }} @endif</p>
                        {!! Form::number('phone', null, array('class'=>'form-control', 'placeholder'=>'Customer Phone:')) !!}
                    </div>
                    <div class="col-md-6 form-group"> 
                        {!! Form::submit('Add', ['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
