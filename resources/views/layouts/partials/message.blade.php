@if($message)
    <div class="alert alert-{{ $message['type'] }} message">
        {{ $message['content'] }}
    </div>
@endif