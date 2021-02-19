<?php 
    use App\Http\Controllers\RaportController;
?>
    <h2>Spotkania</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Handlowiec</th>
                <!-- <th scope="col">Adres</th> -->
                <th scope="col">Spotkania potencjalne w wybranym okresie</th>
                <!-- <th scope="col">Handlowiec</th> -->
                <th scope="col">Wszytskie Spotkania potencjalne</th>
                <th scope="col">Spotkania odbyte w wybranym okresie</th>
                <th scope="col">Wszytskie Spotkania odbyte</th>


            </tr>
        </thead>
        <tbody>
        <!-- {{ session()->put('massage', collect(request()->segments())->last()) }} -->
            @foreach($user as $item)

                <td>{{$item['name']}}</td>
                <td>{{RaportController::countMeetingPlanowane($item->id, $start, $end)}}</td>
                <td>{{RaportController::countMeetingPlanowaneAll($item->id)}}</td>
                <td>{{RaportController::countMeeting($item->id, $start, $end)}}</td>
                <td>{{RaportController::countMeetingAll($item->id)}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

