@extends('layouts.app')

@section('content')
    <h2>Dodaj nowego zwierzaka</h2>

    @if (session('response'))
        <h3>Zwierzak dodany! Poniżej szczegółowe dane:</h3>
        <pre style="background-color: #f4f4f4; padding: 10px; border: 1px solid #ddd; overflow-x: auto;">
        {{ json_encode(session('response'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
        </pre>

        <form action="{{ route('pets.clearSession') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit"
                style="padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer;">
                Dodaj kolejnego
            </button>
        </form>
    @else
        @if (session('error'))
            <div style="border: 1px solid red; padding: 10px; margin-top: 20px; color: red !important;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('pets.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">Imię:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="identificationNumber">Numer identyfikacyjny:</label>
                <input type="number" id="identificationNumber" name="identificationNumber" min="1"
                    value="{{ old('identificationNumber') }}">
            </div>

            <div>
                <label for="category_id">Wybierz kategorię:</label>
                <select id="category_id" name="category_id">
                    <option value="" selected disabled>-- Wybierz kategorię --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="photoUrls">Adresy zdjęć (separowane przecinkami):</label>
                <input type="text" id="photoUrls" name="photoUrls" value="{{ old('photoUrls') }}" required>
            </div>

            <div>
                <label for="tag_id">Wybierz tag:</label>
                <select id="tag_id" name="tag_id">
                    <option value="" selected disabled>-- Wybierz tag --</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag['id'] }}" {{ old('tag_id') == $tag['id'] ? 'selected' : '' }}>
                            {{ $tag['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="" selected disabled>-- Wybierz status --</option>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Dostępny</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Oczekujący</option>
                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sprzedany</option>
                </select>
            </div>

            <button type="submit">Stwórz</button>
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

    @endif

@endsection
