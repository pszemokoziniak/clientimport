@include('clientSearch')

<div class="container">
    
    <!-- <a href="{{url('export-excel')}}" class="btn btn-primary btn-block">Eksport do Excel</a> -->
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nazwa</th>
                <!-- <th scope="col">Adres</th> -->
                <th scope="col">Telefon</th>
                <!-- <th scope="col">Handlowiec</th> -->
                <th scope="col">Status</th>
                <th scope="col">Kontakt Data</th>
                <!-- <th scope="col">Operacje</th> -->
                <th scope="col">Łączenia</th>


            </tr>
        </thead>
        <tbody>
        {{ session()->put('massage', collect(request()->segments())->last()) }}
            @foreach($data as $item)

            @if ($item['status'] === 2) 
                <tr style="cursor:pointer; background-color:#98FB98;" onclick="javascript:location.href='klient/{{$item['id']}}'">
            @elseif ($item['nieObiera'] === 1)
                <tr style="cursor:pointer; background-color:#FF7F50;" onclick="javascript:location.href='klient/{{$item['id']}}'">
            @else
                <tr style="cursor:pointer" onclick="javascript:location.href='klient/{{$item['id']}}'">
            @endif

                <td>{{$item['nazwa']}}</td>
                <td>{{phone($item['nrtelefonu'], 'PL')->formatNational()}}</td>
                <td>{{$item['nameStatus']}}</td>
                <td>{{$item['kontakt_data']}}</td>
                <td>{{$item['countCalls']}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- <button onclick="location.href='{{ url('addstatus') }}'" class="btn btn-primary float-right">Dodaj status</button> -->
</div>
