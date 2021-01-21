<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource. (Archivio)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'Classromms Index Page';

        // get Data from DB
        $classrooms = Classroom::all();
        // dd($classrooms);
        // dump($classrooms);
        return view('classrooms.index', compact('classrooms')); // <-----// questo passaggio ci permette il trasporto dei dati relativi alla variabile $classrooms [array] che sono nel DB

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $data = $request->all();
        // dd($data);

        // VALIDAZIONE
        $request->validate([
            'name'=> 'required|unique:classrooms|max:10',
            'description' => 'required'
        ]);

        // SALVARE A DB
        $classroom = new Classroom();
        $classroom->name = $data['nome'];
        $classroom->name = $data['description'];

        $saved = $classroom->save();
        dd($saved);

    }

    /**
     * Display the specified resource. // (PAGINA DI DETTAGLIO)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom){
        return view('classrooms.show', compact('classroom'));
    }

    // public function show($id){
    // $id = $_GET['id'];
    // {
    //     // return 'SHOW DETAILS' .$id;
    //     $classroom = Classroom::find($id);
    //     // dd($classroom);
    //     return view('classrooms.show', compact('classroom'));
    // }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //
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
}
