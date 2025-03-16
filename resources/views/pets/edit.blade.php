@extends('layouts.app')

@section('content')
    <h2>Edytuj zwierzaka</h2>

    @if (session('response'))
        <h3>Zwierzak zaktualizowany! Poniżej szczegółowe dane:</h3>
        <pre style="background-color: #f4f4f4; padding: 10px; border: 1px solid #ddd; overflow-x: auto;">
        {{ json_encode(session('response'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
        </pre>
    @else
        @if (session('error'))
            <div style="border: 1px solid red; padding: 10px; margin-top: 20px; color: red !important;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('pets.update', ['id' => $response['id']]) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Imię:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $response['name'] ?? '') }}" required>
            </div>

            <div>
                <label for="id">Numer identyfikacyjny:</label>
                <input type="number" id="id" name="id" min="1"
                    value="{{ old('id', $response['id'] ?? '') }}">
            </div>

            <div>
                <label for="category_id">Wybierz kategorię:</label>
                <select id="category_id" name="category_id">
                    <option value="" disabled
                        {{ old('category_id', $response['category']['id'] ?? null) === null ? 'selected' : '' }}>-- Wybierz
                        kategorię --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}"
                            {{ old('category_id', $response['category']['id'] ?? null) == $category['id'] ? 'selected' : '' }}>
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="photoUrls">Adresy zdjęć (separowane przecinkami):</label>
                <input type="text" id="photoUrls" name="photoUrls"
                    value="{{ old('photoUrls', $response['photoUrls'][0] ?? '') }}" required>
            </div>

            <div>
                <label for="tag_id">Wybierz tag:</label>
                <select id="tag_id" name="tag_id">
                    <option value="" disabled
                        {{ old('tag_id', $response['tags'][0]['id'] ?? null) === null ? 'selected' : '' }}>-- Wybierz tag
                        --
                    </option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag['id'] }}"
                            {{ old('tag_id', $response['tags'][0]['id'] ?? null) == $tag['id'] ? 'selected' : '' }}>
                            {{ $tag['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="" disabled
                        {{ old('status', $response['status'] ?? null) === null ? 'selected' : '' }}>-- Wybierz status --
                    </option>
                    <option value="available"
                        {{ old('status', $response['status'] ?? null) == 'available' ? 'selected' : '' }}>Dostępny</option>
                    <option value="pending"
                        {{ old('status', $response['status'] ?? null) == 'pending' ? 'selected' : '' }}>
                        Oczekujący</option>
                    <option value="sold" {{ old('status', $response['status'] ?? null) == 'sold' ? 'selected' : '' }}>
                        Sprzedany</option>
                </select>
            </div>
            <button type="submit">Zapisz zmiany</button>
        </form>

        <x-validation-errors />
    @endif
@endsection
