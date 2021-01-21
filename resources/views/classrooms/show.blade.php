@extends('layouts.main')

@section('content')

    <div class="container mb-5">
        <h1> {{ $classroom->name}} DETAILS</h1>
        <h6>ID: {{$classroom->id}}</h6>
        <hr>
        <p>{{$classroom->description}}</p>
        <hr>
        <div class="mb-3">Created_at: {{$classroom->created_at}} </div>
        <div class="mb-3">Updated_at: {{$classroom->updated_at}} </div>

        <p>Lorem ipsum...ABBIAMO POPOLATO LA NUOVA PAGINA DI DETTAGLIO...........!</p>


    </div>

@endsection
