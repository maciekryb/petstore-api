@extends('layouts.app')

@section('content')
    @if (session('deleted'))
        <x-alert type="success" :message="session('deleted')" />
    @elseif (session('updated'))
        <x-alert type="success" :message="session('updated')" />
    @else
        <h2>Informacje o zwierzaku</h2>

        @if ($error)
            <x-alert type="error" :message="$error" />
        @endif

        @if ($success)
            <x-alert type="success" :message="$success" />

            <pre class="response-preview">
                {{ json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
            </pre>

            <div class="actions">
                <a href="{{ route('pets.edit', ['id' => $response['id']]) }}" class="btn btn-primary">Edytuj</a>

                <form action="{{ route('pets.destroy', ['id' => $response['id']]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Usuń</button>
                </form>
            </div>

            <x-validation-errors />
        @endif
    @endif
@endsection