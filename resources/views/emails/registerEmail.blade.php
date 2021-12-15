@component('mail::message')
# Enerji CRM


Nowy Użytkownik<br />
Nazwa klienta: {{$email}}<br /> 

Tekst....


@component('mail::button', ['url' => 'http://127.0.0.1:8000/register?token='.$token])
Zarejestruj się
@endcomponent

Pozdrawiam,<br>
{{$token}}
<!-- {{ config('app.name') }} -->
@endcomponent
