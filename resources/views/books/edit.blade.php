@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3">	
		<h1>Edit Book</h1>
		
		{!! Form::model($book, ['method' => 'PATCH', 'action' => ['BookController@update', $book->id]]) !!}
		  <div class="form-group {{$errors->has('title') ? 'has-error text-danger' : '' }}">
		    {!! Form::label('title', 'Title:', ['for' => 'title', 'class' => 'font-weight-bold']) !!}
		    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
		    @if($errors->has('title'))
		    	{{$errors->first('title')}}
		    @endif
		  </div>
		  <div class="form-group {{$errors->has('author_id') ? 'has-error text-danger' : '' }}">
		    {!! Form::label('author_id', 'Author:', ['for' => 'author_id', 'class' => 'font-weight-bold']) !!}
		    {!! Form::select('author_id', $authors, null, ['class' => 'form-control']) !!}
		    @if($errors->has('author_id'))
		    	{{$errors->first('author_id')}}
		    @endif
		  </div>
		  <div class="form-group {{$errors->has('publication_date') ? 'has-error text-danger' : '' }}">
		    {!! Form::label('publication_date', 'Publication Date:', ['for' => 'publication_date', 'class' => 'font-weight-bold']) !!}
		    {!! Form::date('publication_date', null, ['class' => 'form-control', 'placeholder' => 'Publication Date']) !!}
		    @if($errors->has('publication_date'))
		    	{{$errors->first('publication_date')}}
		    @endif
		  </div>
		  <h6 class="font-weight-bold {{$errors->has('translations') ? 'has-error text-danger' : '' }}">Translations:</h6>
		  @if($errors->has('translations'))
			    	{{$errors->first('translations')}}
		  @endif
		  @foreach($translations as $translation)
		  <div class="checkbox">
			    {!! Form::checkbox('translations[]', $translation->name, in_array($translation->name, $checked_translations), ['type' => 'checkbox']) !!}
			    {!! Form::label('translation', $translation->name, ['for' => $translation->name]) !!}
		  </div>
		  @endforeach
		  {!! Form::submit('Update Book', ['class' => 'btn btn-primary', 'name' => 'submit']) !!}
		{!! Form::close() !!}		
	</div>
</div>
@stop