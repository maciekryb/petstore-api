@extends('layouts.app')

@section('content')
    <h1>Strona pozwala na stworzenie własnej kolekcji zwierzaków</h1>

    <a href="{{ route('pets.create') }}" class="btn btn-primary">Dodaj zwierzaka!</a>

@endsection