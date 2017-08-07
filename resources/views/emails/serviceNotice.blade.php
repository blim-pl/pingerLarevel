@component('mail::message')

@component('mail::panel')
{{ $serviceName }}
@endcomponent

@component('mail::button', ['url' => '', 'color' => $result ? 'green' : 'red'])
    Wynik testu: {{ $message }}.
@endcomponent

@component('mail::panel')
I co teraz?
@endcomponent

@endcomponent