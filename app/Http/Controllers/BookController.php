<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Http\Controllers\GuzzleHttp\Client;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BookCollection(Book::paginate());
        
    }

    /**
    *
    */
    public function fetch(Request $request)
    {
        
        $getData = Http::get('https://www.anapioficeandfire.com/api/books', [
            'query' => [
                'name' => $request->input('name'),
            ],
        ]);
        return response()->json([
            "status_code" => "200",
            "status" => "success",
            "data"=> $getData->json(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string',
            'isbn'            => 'required|string',
            'authors' => 'required|string',
            'country' => 'required|string',
            'number_of_pages' => 'required|string',
            'publisher' => 'required|string',
            'release_date' => 'required|string',
        ]);

        $book = Book::create($request->all());
        // return new BookResource($book);
        return response()->json([
            "status_code" => "201",
            "status" => "success",
            "data" => [
                "id"=>$book->id,
                "name"=>$book->name,
                "isbn"=>$book->isbn,
                "authors"=>[
                    $book->authors
                ],
                "number_of_pages"=>$book->number_of_pages,
                "publisher"=>$book->publisher,
                "country"=>$book->country,
                "release_date"=>$book->release_date
            ]
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        $book = Book::find($id);

        return response()->json([
            "status_code" => "200",
            "status" => "success",
            "data" => [
                "id"=>$book->id,
                "name"=>$book->name,
                "isbn"=>$book->isbn,
                "authors"=>[
                    $book->authors
                ],
                "number_of_pages"=>$book->number_of_pages,
                "publisher"=>$book->publisher,
                "country"=>$book->country,
                "release_date"=>$book->release_date
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book $book)
    {
        $book->update($request->all());
        //return new BookResource($book);
        return response()->json([
            "status_code" => "200",
            "status" => "success",
            "message" => "The book {$book->name} was updated successfully",
            "data" => [
                "id"=>$book->id,
                "name"=>$book->name,
                "isbn"=>$book->isbn,
                "authors"=>[
                    $book->authors
                ],
                "number_of_pages"=>$book->number_of_pages,
                "publisher"=>$book->publisher,
                "country"=>$book->country,
                "release_date"=>$book->release_date
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(book $book)
    {
        $book->delete();
        return response()->json([
            "status_code" => "204",
            "status" => "success",
            "message" => "The book {$book->name} was deleted successfully",
            "data" => []
        ]);
    }
}
