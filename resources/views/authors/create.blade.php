@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">	
		<h1>Create Author</h1>
		{!! Form::open(['method' => 'POST', 'action' => 'AuthorController@store']) !!}
		  <div class="form-group {{$errors->has('first_name') ? 'has-error text-danger' : '' }}">
		    {!! Form::label('first_name', 'First Name:', ['for' => 'first_name', 'class' => 'font-weight-bold']) !!}
		    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First name']) !!}
		    @if($errors->has('first_name'))
		    	{{$errors->first('first_name')}}
		    @endif
		  </div>
		  <div class="form-group {{$errors->has('last_name') ? 'has-error text-danger' : '' }}">
		    {!! Form::label('last_name', 'Last Name:', ['for' => 'last_name', 'class' => 'font-weight-bold']) !!}
		    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last name']) !!}
		    @if($errors->has('last_name'))
		    	{{$errors->first('last_name')}}
		    @endif
		  </div>
		  <h6 class="font-weight-bold {{$errors->has('country') ? 'has-error text-danger' : '' }}">Authors Country:</h6>
		  @if($errors->has('country'))
			{{$errors->first('country')}}
		  @endif
		  @foreach($countries as $country)
		  <div class="radio">
			    {!! Form::radio('country', $country->name, false, ['type' => 'radio']) !!}
			    {!! Form::label('country', $country->name, ['for' => $country->name]) !!}    
		  </div>
		  @endforeach
		  {!! Form::submit('Create Author', ['class' => 'btn btn-primary', 'name' => 'submit']) !!}
		{!! Form::close() !!}		
	</div>
</div>

@stop