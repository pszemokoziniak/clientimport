@component('mail::message')
# Witam Serdecznie

Tekst trala la la....

Oferta....<br />
Ilość modułów: {{$data->iloscModulow}}<br /> 
Sprzęt: {{$data->firma}}<br /> 
Moc: {{$data->moc}}<br />
Cena Brutto: {{$data->cenaBrutto}} zł

Tekst....


<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->

Pozdrawiam,<br>
{{$name}}
<!-- {{ config('app.name') }} -->
@endcomponent
