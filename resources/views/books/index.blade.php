@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
             @if(Session::has('created_book'))
              <div class="alert alert-success text-center">{{session('created_book')}}</div>
            @endif
            @if(Session::has('updated_book'))
              <div class="alert alert-success text-center">{{session('updated_book')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    All Books
                    <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm float-right">Create book</a>
                </div>

                <div class="card-body">
                    @if(count($books) > 0)
                    <table class="table">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">@sortablelink('title', 'Book Title')</th>
                          <th scope="col">@sortablelink('author_id', 'Authors Full Name')</th>
                          <th scope="col">Publication Date</th>
                          <th scope="col">@sortablelink('translations', 'Translations')</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($books as $book)
                        <tr>
                          <td>{{ $book->title }}</td>
                          <td>{{ $book->author->first_name .' '. $book->author->last_name}}</td>
                          <td>{{ $book->publication_date }}</td>
                          <td>{{ $book->translations }}</td>
                          <td><a href="{{ route('books.edit', $book->id) }}" class="btn btn-secondary btn-sm float-none">Update Book</a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection