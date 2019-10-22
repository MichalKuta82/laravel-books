<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\Author;
use DB;

class BookController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $books = Book::sortable()->orderBy('publication_date', 'desc')->paginate(10);

        return view('books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $translations = $this->getApi();
        $authors = $this->authorsFullName();

        return view('books.create')->with('translations', $translations)->with('authors', $authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = $request->validate([
            'title' => 'required|min:3',
            'author_id' => 'required',
            'publication_date' => 'required',
            'translations' => 'required'
        ]);

        $book = Book::create([
            'title' => $request->input('title'),
            'publication_date' => $request->input('publication_date'),
            'author_id' => $request->input('author_id'),
            'translations' => implode(', ', $request->input('translations'))
        ]);

        if ($validator == true)
        {
            Session::flash('created_book', 'The book has been created');

            return redirect('/books');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $book = Book::findOrFail($id);
        $authors = $this->authorsFullName();
        $translations = $this->getApi();
        $checked_translations = $book->select('translations')->get();
        dd($checked_translations);

        return view('books.edit')->with('book', $book)->with('translations', $translations)->with('authors', $authors)->with('checked_translations', $checked_translations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $book = Book::findOrFail($id);

        $validator = $request->validate([
            'title' => 'required|min:3',
            'author_id' => 'required',
            'publication_date' => 'required',
            'translations' => 'required'
        ]);

        $book ->update([
            'title' => $request->input('title'),
            'publication_date' => $request->input('publication_date'),
            'author_id' => $request->input('author_id'),
            'translations' => implode(', ', $request->input('translations'))
        ]);

        if ($validator == true)
        {
            Session::flash('updated_book', 'The book has been updated');
            return redirect('/books');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getApi()
    {
        $client = new GuzzleClient();
        $response = $client->get('https://restcountries.eu/rest/v2/all');

        return json_decode($response->getBody());
    }

    public function authorsFullName()
    {
        return Author::select(DB::raw('CONCAT(first_name, " ", last_name) AS full_name'),'id')->pluck('full_name','id')->all();
    }
}
