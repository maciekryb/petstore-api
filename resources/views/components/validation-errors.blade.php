@if ($errors->any())
    <div style="border: 1px solid red; padding: 10px; margin-top: 20px; color: red !important;">
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif