@extends('layouts.app')

@section('content')
    <h2>Informacje o zwierzaku</h2>

    @if ($error)
        <div style="border: 1px solid red; padding: 10px; margin-top: 20px; color: red !important;">
            {{ $error }}
        </div>
    @endif

    @if ($success)
        <div style="border: 1px solid green; padding: 10px; margin-top: 20px; color: green !important;">
            {{ $success }}
        </div>

        @if ($response)
            <pre style="background: #f4f4f4; padding: 10px; border: 1px solid #ddd; margin-top: 20px;">
                {{ json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
            </pre>
        @endif
    @endif
@endsection