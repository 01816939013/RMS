@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Meal</div>

                <div class="panel-body">
                    {!! Form::open(array('route'=>'Meals.store','files'=>true)) !!}
                    <div class="col-lg-4 form-group"> 
                    <p class="error">@if (isset($errors[0])){{$errors[0]}} @endif</p>
                        {!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Meal Title:')) !!}
                    </div>
                    
                    <div class="col-lg-4 form-group"> 
                    <p class="error">@if (isset($errors[1])){{$errors[1]}} @endif</p>
                        {!! Form::select('status',[-1=>'Meal Status', 1=>'Active',0=>'inActive'], null, array( 'class'=>'form-control')) !!}
                    </div>
                    <div class="col-lg-4 form-group"> 
                    <p></p>
                        {!! Form::file('image', array('class'=>'form-control', 'placeholder'=>'Meal Picture')) !!}
                    </div>
                    <div class="col-lg-12 form-group"> 
                    <p class="error">@if (isset($errors[2])){{$errors[2]}} @endif</p>
                        {!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Meal Description:')) !!}
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                    <p class="error">@if (isset($errors[3])){{$errors[3]}} @endif</p>
                        @foreach($menus as $menu)
                            @if(count($menu->items) > 0)
                                <h4>{{$menu->title}}</h4>
                                <div class="form-group col-lg-6 menu_items">
                                    <ul>
                                        @foreach($menu->items as $item)
                                        <li>
                                            <input type="checkbox" name="items[]" value="{{$item->id}}"><input type="number" name="discount-{{$item->id}}" class="discount" value="0">{{$item->title}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-4"></div> 
                    <div class="col-lg-4 form-group"> 
                        {!! Form::submit('Add', ['class'=>'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
