<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Author;
use App\Models\Author_Books;
use Illuminate\Support\Facades\DB;
class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::all();
        return view('books.index',['books' => $books]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $author = Author::all();
        return view('books.add',['authors' => $author]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "title" => "required|max:255",
            "author_id" => "max:255",
            "description" => "required|max:225",
            'pdf' => 'mimetypes:application/pdf',
        ]);
        if($request->hasFile('pdf')){
            $pdf_path = 'pdf/'.$request->file('pdf')->getClientOriginalName();
            $request->file('pdf')->move(public_path().'/pdf',$request->file('pdf')->getClientOriginalName());
        } else {
            $pdf_path = '';
        }
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'pdf' => $pdf_path,
            ];
        Books::insert($data);
        $getDataId = Books::orderBy('id', 'desc')->first()->id;
        if(is_array($request->author_id)){
            for($i=0;$i<count($request->author_id);$i++){
                $insert[] = [
                    "books_id" => $getDataId,
                    "author_id" => $request->author_id[$i]
                ];
            }
        } else {
            $insert = [
                "books_id" => $getDataId,
                "author_id" => $request->author_id
            ];
        }
        Author_Books::insert($insert);
        return redirect()->back()->with('success','Success add books');
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
        $books = Books::where('id',$id)->first();
        $author = Author::all();
        return view('books.edit',['books' => $books,'authors' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            "title" => "required|max:255",
            "author_id" => "max:255",
            "description" => "required|max:225",
            'pdf' => 'mimetypes:application/pdf',
            "id" => 'required|max:255'
        ]);
        $data = [];
        if($request->hasFile('pdf')){
            $data['pdf'] = 'pdf/'.$request->file('pdf')->getClientOriginalName();
            $request->file('pdf')->move(public_path().'/pdf',$request->file('pdf')->getClientOriginalName());
        }
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        Books::where("id",$request->id)->update($data);
        if(is_array($request->author_id)){
            for($i=0;$i<count($request->author_id);$i++){
                $insert[] = [
                    "books_id" => $request->id,
                    "author_id" => $request->author_id[$i]
                ];
            }
        } else {
            $insert = [
                "books_id" => $request->id,
                "author_id" => $request->author_id
            ];
        }
        Author_Books::where('books_id',$request->id)->delete();
        Author_Books::insert($insert);
        return redirect()->back()->with('success','Success Edit Books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Books::find($id)->delete();
        Author_Books::where('books_id',$id)->delete();
        return redirect()->route('books')->with('success','Success Delete books');
    }
}
