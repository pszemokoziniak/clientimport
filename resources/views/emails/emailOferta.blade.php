@component('mail::message')
# Witam Serdecznie

Tekst trala la la....
@foreach ($emailData as $item) 

Oferta....<br />
Nazwa klienta: {{$item->nazwa}}<br /> 
Ilość modułów: {{$item->iloscModulow}}<br /> 
Sprzęt: {{$item->firma}}<br /> 
Moc: {{$item->moc}}<br />
Cena Brutto: {{$item->cenaBrutto}} zł

Tekst....

@endforeach

<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->

Pozdrawiam,<br>
{{$name}}
<!-- {{ config('app.name') }} -->
@endcomponent
