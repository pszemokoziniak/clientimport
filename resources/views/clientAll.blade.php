@extends('layouts.app')

@section('content')


<div class="container">

    <h3 align="center" class="m-10">Liczba rekordów : <span id="total_records"></span></h3>
    
    <!-- <a href="{{url('export-excel')}}" class="btn btn-primary btn-block">Eksport do Excel</a> -->
    
    <table class="table table-hover">
        <thead>
            <tr>
                <td>
                    <input type="text" class="form-control filter-input" id="searchKlient"
                        placeholder="Klient" data-column="0">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" id="searchMiasto"
                        placeholder="Miasto" data-column="1">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" id="searchBranza"
                        placeholder="Branża" data-column="2">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" id="searchKampania"
                        placeholder="Kampania" data-column="3">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" id="searchHandlowiec"
                        placeholder="Handlowiec" data-column="4">
                </td>
                <td>
                    <i class="fas fa-broom fa-2x mt-2" id="clearFilter" style="color:blue; cursor:pointer;"></i>
                </td>


            </tr>

            <tr>
                <th scope="col">Klient</th>
                <!-- <th scope="col">Adres</th> -->
                <th scope="col">Miasto</th>
                <!-- <th scope="col">Handlowiec</th> -->
                <th scope="col">Branża</th>
                <th scope="col">Kampania</th>
                <!-- <th scope="col">Operacje</th> -->
                <th scope="col">Handlowiec</th>


            </tr>
        </thead>
        <tbody>
         @foreach($data as $item)
            <tr style="cursor:pointer" onclick="javascript:location.href='klient/{{$item->id}}'">
                <td>{{$item->nazwa}}</td>
                <td>{{$item->adresmiasto}}</td>
                <td>{{$item->branza}}</td>
                <td>{{$item->kampania}}</td>
                <td>{{$item->name}}</td>
                <td><a href="/klient/'.$item->id.'" title="Zobacz"><i class="fas fa-edit fa-2x" style="color:blue; cursor:pointer;"> </i></a></td>


            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
$(document).ready(function(){

    fetch_customer_data();

    function fetch_customer_data(miasto, handlowiec, branza, kampania, klient)
    {
        $.ajax({
        url:"{{ route('klienciAll.action') }}",
        method:'GET',
        data:{miasto:miasto, handlowiec:handlowiec, branza:branza, kampania:kampania, klient:klient},
        dataType:'json',
        success:function(data)
        {
            $('tbody').html(data.table_data);
            $('#total_records').text(data.total_data);
        }
        })
    }

    $(document).on('keyup', '#searchHandlowiec', function(){
    var handlowiec = $(this).val();
    var miasto = $('#searchMiasto').val();
    var branza = $('#searchBranza').val();
    var kampania = $('#searchKampania').val();
    var klient = $('#searchKlient').val();

    fetch_customer_data(miasto, handlowiec, branza, kampania, klient);
    });

    $(document).on('keyup', '#searchMiasto', function(){
    var miasto = $(this).val();
    var handlowiec = $('#searchHandlowiec').val();
    var branza = $('#searchBranza').val();
    var kampania = $('#searchKampania').val();
    var klient = $('#searchKlient').val();

    fetch_customer_data(miasto, handlowiec, branza, kampania, klient);
    });

    $(document).on('keyup', '#searchBranza', function(){
    var branza = $(this).val();
    var handlowiec = $('#searchHandlowiec').val();
    var miasto = $('#searchMiasto').val();
    var kampania = $('#searchKampania').val();
    var klient = $('#searchKlient').val();

    fetch_customer_data(miasto, handlowiec, branza, kampania, klient);
    });

    $(document).on('keyup', '#searchKampania', function(){
    var kampania = $(this).val();
    var handlowiec = $('#searchHandlowiec').val();
    var branza = $('#searchBranza').val();
    var miasto = $('#searchMiasto').val();
    var klient = $('#searchKlient').val();


    fetch_customer_data(miasto, handlowiec, branza, kampania, klient);
    });

    $(document).on('keyup', '#searchKlient', function(){
    var klient = $(this).val();
    var handlowiec = $('#searchHandlowiec').val();
    var branza = $('#searchBranza').val();
    var kampania = $('#searchKampania').val();
    var miasto = $('#searchMiasto').val();


    fetch_customer_data(miasto, handlowiec, branza, kampania, klient);
    });

    $(document).on('click', '#clearFilter', function(){
        $('#searchHandlowiec').val('');
        $('#searchMiasto').val('');
        $('#searchBranza').val('');
        $('#searchKampania').val('');
        $('#searchKlient').val('');
        fetch_customer_data(miasto='', handlowiec='', branza='', kampania='', klient='');

    });



});
</script>

@endsection

