@extends('layouts.app')

@section('content')
    <h2>Informacje o zwierzaku</h2>


    @if (session('deleted'))
        <div style="border: 1px solid green; padding: 10px; margin-top: 20px; color: green !important;">
            {{ session('deleted') }}
        </div>
    @else
        @if (session('updated'))
            <div style="border: 1px solid green; padding: 10px; margin-top: 20px; color: green !important;">
                {{ session('updated') }}
            </div>
        @else
            @if ($error)
                <div style="border: 1px solid red; padding: 10px; margin-top: 20px; color: red !important;">
                    {{ $error }}
                </div>
            @endif

            @if ($success)
                <div style="border: 1px solid green; padding: 10px; margin-top: 20px; color: green !important;">
                    {{ $success }}
                </div>

                <pre style="background: #f4f4f4; padding: 10px; border: 1px solid #ddd; margin-top: 20px;">
                {{ json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
        </pre>

                <div style="margin-top: 20px;">
                    <a href="{{ route('pets.edit', ['id' => $response['id']]) }}" class="btn btn-primary"
                        style="margin-right: 10px;">Edytuj</a>

                    <form action="{{ route('pets.destroy', ['id' => $response['id']]) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </div>
                <x-validation-errors />
            @endif
        @endif
    @endif
@endsection
