@extends('layouts.app')

@section('content')
    <h1>Strona pozwala na stworzenie własnej kolekcji zwierzaków</h1>

    <a href="{{ route('pets.create') }}" class="btn btn-primary">Dodaj zwierzaka!</a>

    <form action="" method="GET" class="mt-3"
        onsubmit="event.preventDefault(); window.location.href = '{{ url('/pets') }}/' + document.getElementById('identificationNumber').value;">
        <label for="identificationNumber">Sprawdź dane zwierzaka:</label>
        <input type="number" id="identificationNumber" name="identificationNumber" class="form-control"
            placeholder="Wpisz ID " required>
        <button type="submit" class="btn btn-secondary mt-2">Pokaż szczegóły</button>
    </form>

    @if ($errors->any())
        <div style="border: 1px solid red; padding: 10px; margin-top: 20px; color: red !important;">
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
