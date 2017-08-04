@component('mail::message')

{{ $serviceName }}

@component('mail::button', ['url' => ''])
    Wynik testu: {{ $result }}.
@endcomponent

I co teraz?

@endcomponent