<?php 
    use App\Http\Controllers\RaportController;
?>

    <h2>Telefony</h2>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Handlowiec</th>
                <th scope="col">Łącznia w wybrabym okresie</th>
                <th scope="col">Wszytskie Łącznie</th>
            </tr>
        </thead>
        <tbody>
        <!-- {{ session()->put('massage', collect(request()->segments())->last()) }} -->
            @foreach($user as $item)
            <tr>
                <td>{{$item['name']}}</td>
                <td>{{RaportController::countCallsDate($item->id, $start, $end)}}</td>
                <td>{{RaportController::countCalls($item->id)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


