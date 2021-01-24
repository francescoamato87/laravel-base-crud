<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use Illuminate\Validation\Rule;

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
        $data = $request->all();
        // dd($request->all());
        // dd($data);

        // VALIDAZIONE
        $request->validate([
            'name'=> 'required|unique:classrooms|max:10',
            'description' => 'required',
        ]);

        // SALVARE A DB

        // $classroom = new Classroom();
        // $classroom->name = $data['name'];
        // $classroom->description = $data['description'];

        // SALVARE A DB CON METODO fillable;
        $classroom = New Classroom();
        $classroom->fill($data); // <---- guarda in Classroom

        $saved = $classroom->save();
        // dd($saved);

        // REINDIRIZZARE DOVE VOGLIAMO NELLA PAGINA <-----------
        if($saved == true) {
            return redirect()->route('classrooms.show', $classroom->id);  // <----ti reindirizza alla pagina di dettaglio
        }

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

        // Crud 2

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // <---- EDITARE UN POST GIA' ESISTENTE
    {
        $classroom = Classroom::find($id);

        return view ('classrooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // <----- UPDATE: permette un aggiornamento in tempo reale di un contenuto già esistente
    {
        // <--- dati inviati dalla FORM
        $data =  $request->all(); // <---- prendiamo i DATI inviati dal nostro form Update e ci crea un Array

        // ISTANZA SPECIFICA
        $classroom = Classroom::find($id);

        $request->validate([
        'name' => [
            'required',
            Rule::unique('classrooms')->ignore($classroom->id),
            'max:10'
        ],
        'description' => 'required'
        ]);

        // AGGIORNARE DATI DB
        $updated = $classroom->update($data); // $fillable nel model

        // Creiamo la rotta per l'UPDATE
        if($updated) {
            return redirect()->route('classrooms.show', $classroom->id);
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
       $classroom = CLassroom::find($id);

       $ref = $classroom->name;
       $deleted = $classroom->delete();


      if ($deleted) {
        return redirect()->route('classrooms.index')->with('deleted', $ref);
        }
    }
}
