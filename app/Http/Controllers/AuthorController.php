<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client as GuzzleClient;
use App\Author;

class AuthorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $authors = Author::paginate(10);
        
        return view('authors.index')->with('authors', $authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = $this->getApi();

        return view('authors.create')->with('countries', $countries);
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
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'country' => 'required'
        ]);

        $author = Auth::user()->authors();

        $author->create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'country' => $request->input('country')
        ]);

        if ($validator == true)
        {
            Session::flash('created_author', 'The author has been created');
            return redirect('/authors');
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
        $countries = $this->getApi();
        $author = Author::findOrFail($id);

        return view('authors.edit')->with('author', $author)->with('countries', $countries);
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
        $author = Author::findOrFail($id);

        $validator = $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'country' => 'required'
        ]);
        
        $author->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'country' => $request->input('country')
        ]);

        if ($validator == true)
        {
            Session::flash('updated_author', 'The author has been updated');
            return redirect('/authors');
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
        return $countries = json_decode($response->getBody());
    }
}
