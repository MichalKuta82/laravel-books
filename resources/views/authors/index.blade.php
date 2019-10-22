@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('created_author'))
              <div class="alert alert-success text-center">{{session('created_author')}}</div>
            @endif
            @if(Session::has('updated_author'))
              <div class="alert alert-success text-center">{{session('updated_author')}}</div>
            @endif
            <div class="card">    
                <div class="card-header">
                  All Authors
                  <a href="{{ route('authors.create') }}" class="btn btn-primary btn-sm float-right">Create Author</a>
                </div>

                <div class="card-body">
                    @if(count($authors) > 0)
                    <table class="table">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">First Name</th>
                          <th scope="col">Last Name</th>
                          <th scope="col">Country</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($authors as $author)
                        <tr>
                          <td>{{ $author->first_name }}</td>
                          <td>{{ $author->last_name }}</td>
                          <td>{{ $author->country }}</td>
                          <td><a href="{{ route('authors.edit', $author->id) }}" class="btn btn-secondary btn-sm float-none">Update Author</a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif
                    {{ $authors->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
