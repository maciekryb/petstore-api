@props(['type', 'message'])

<div style="border: 1px solid {{ $type === 'success' ? 'green' : 'red' }}; padding: 10px; margin-top: 20px; color: {{ $type === 'success' ? 'green' : 'red' }} !important;">
    {{ $message }}
</div>